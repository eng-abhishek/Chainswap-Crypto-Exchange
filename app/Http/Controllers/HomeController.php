<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Libraries\Exch;
use App\Libraries\Godex;
use App\Models\Order;
use App\Models\Setting;
use App\Models\ExchRate;
use App\Models\ContactUs;
use App\Models\Trusted;
use App\Models\Seo;
use App\Models\AboutUs;
use App\Models\CustomPage;
use App\Models\ReferralCommission;
use App\User;
use App\Models\Coin;
use App\Http\Requests\Frontend\ExchangeRequest;
use App\Http\Requests\Frontend\ContactRequest;
use App\Models\Exchange;
use App\Models\Faq;
use Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     // $this->middleware('auth');
    	$this->exch = new Exch();
    	$this->godex = new Godex();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

    	if(!empty($request->get('ref'))){
    		$this->check_cookies($request->get('ref'));
    	}
        
    	$data['trusted'] = Trusted::all();
    	$data['seoData'] = Seo::where('slug','home')->first();
    	$data['coins'] = Coin::all();
        $data['faq'] = Faq::where('page_type','home-page')->orwhere('page_type','all')->get();
     
    	$data['from_coin'] = '';
    	$data['to_coin'] = '';

    	return view('frontend.index',$data);
    }

    public function coin_pairs($from_coin,$to_coin)
    {
    	$data['trusted'] = Trusted::all();
    	$data['seoData'] = Seo::where('slug','home')->first();
    	$data['coins'] = Coin::all();

    	$data['from_coin'] = strtoupper($from_coin);
    	$data['to_coin'] = strtoupper($to_coin);

    	return view('frontend.index',$data);
    }


    public function exchange(ExchangeRequest $request)
    {
    	try{
    		$from_amount = $request->get('from_amount');
    		$currency_from = $request->get('currency_from');
    		$currency_to = $request->get('currency_to');
    		$to_address = $request->get('to_address');
    		$refund_address = $request->get('refund_address');
    		$rate_mode = $request->get('rate_mode');
    		$send_network = $request->get('send_network');
    		$receive_network = $request->get('receive_network');

    		/* Generate unique order id */
          
    		do {
    			$orderid = uniqid();
    		} while (Order::where('orderid', $orderid)->exists());


    		/*----- check referral id using setting table -------*/

    		$setting = Setting::take(1)->orderBy('id','desc')->first();

    		if(isset($setting) && !empty(get_api_type())){

    			if(get_api_type() == "godex_api"){

    				if(!empty(get_godex_referral())){

    					$referral_id = get_godex_referral();

    				}else{

    					return redirect()->route('home')->with(['status' => 'danger', 'message' => __('Oops something went wrong, please contact to support.')]);
    				}
    			}elseif(get_api_type() == "exch_api"){


    				if(!empty(get_exch_referral())){

    					$referral_id = get_exch_referral();

    				}else{

    					return redirect()->route('home')->with(['status' => 'danger', 'message' => __('Oops something went wrong, please contact to support.')]);

    				}

    			}elseif(get_api_type() == "both"){

    				return redirect()->route('home')->with(['status' => 'danger', 'message' => __('Oops something went wrong, please contact to support.')]);

    			}else{

    				return redirect()->route('home')->with(['status' => 'danger', 'message' => __('Oops something went wrong, please contact to support.')]);

    			}
    		}else{

    			return redirect()->route('home')->with(['status' => 'danger', 'message' => __('Oops something went wrong, please contact to support.')]);
    		}

    		/*----- end check referral id using setting table -------*/
 
                 if(isset($_COOKIE['ref'])){
                 $referal_user = User::where('affiliate_id',$_COOKIE['ref']);
                 $ref_count = $referal_user->count();
                 }else{
                 $ref_count = 0;
                 }

                    if($ref_count > 0){
                    
                    $record = $referal_user->first();
                    $user_id = $record->id;
                    $order_type = 'referal';
                    }else{

                    $user_id = user()->id;
                    $order_type = 'direct';
                    }


    		if(get_api_type() == "godex_api"){

    			$affiliate_id = $referral_id;

    			$response = $this->godex->create_exchange($currency_from,$currency_to,$from_amount,$to_address,$affiliate_id,$refund_address,$send_network,$receive_network);
    			if($response['status_code'] == 200){

    				$create_array = [
    					'user_id' => $user_id,
    					'from_currency' => $currency_from,
    					'to_currency' => $currency_to,
    					'to_address' => $to_address,
    					'from_address' => $response['data']->deposit,
    					'from_amount' => $from_amount,
    					'to_amount' => $response['data']->withdrawal_amount,
    					'actual_orderid'=> $response['data']->transaction_id,
    					'orderid' => $orderid,
    					'rate'=> $response['data']->rate,
    					'svc_fee'=> $response['data']->fee,
    					'referral_id'=> $affiliate_id,
    					'refund_address' => $response['data']->return_extra_id,
    					'state'=> get_order_status($response['data']->status),
    					// 'return_extra_id' => $response['data']->return_extra_id,
    					'deposit_extra_id' => $response['data']->deposit_extra_id,
    					'order_generated_from' => 'godex_api',
    					'networks_from' => $send_network,
    					'networks_to' => $receive_network,
                        'order_type' => $order_type,
    				];

    				$order = Order::create($create_array);
    				
                   /* Manage referral commission */
                    $commision_rate = \Config::get('constants.referral_commision_rate.rate');
                    $commission_amount =($from_amount/100)*$commision_rate;
                    
               $record = [
                'user_id' => $user_id,
                'commission_rate' => $commision_rate,
                'order_id'=> $order->id,
                'from_coin' => $currency_from,
                'to_coin' => $currency_to,
                'exchange_amount' => $from_amount,
                'commission_amount' => $commission_amount,
            ];

            ReferralCommission::create($record);

                    return redirect()->route('order',$orderid);

    			}elseif($response['status_code'] == 422){

    				return redirect()->route('home')->with(['status' => 'danger', 'message' =>__('Oops this coin is temporarily suspended, please try again after sometime.')]);

    			}else{

    				return redirect()->route('home')->with(['status' => 'danger', 'message' => __('Oops something went wrong, please try again later.')]);
    			}
    		}elseif(get_api_type() == "exch_api"){

    			$pair = strtoupper($currency_from).'_'.strtoupper($currency_to);

    			$pair_data = ExchRate::where(['pair'=>$pair,'rate_mode'=>$rate_mode])->first();

    			$rate = $pair_data->rate;

    			$to_amount = $from_amount*$rate;

    			$response = $this->exch->create_order($currency_from,$currency_to,$to_address,$refund_address,$rate_mode,$referral_id);

    			if($response['status_code'] == 200){

    				$response = $this->exch->get_order_details($response['data']->orderid);

    				if(isset($response['data']->state_error)){

    					$state_error = $response['data']->state_error;

    				}else{
    					$state_error = '';
    				}

    				$create_array = [
    					'user_id' => $user_id,
    					'from_currency' => $currency_from,
    					'to_currency' => $currency_to,
    					'from_address' => $response['data']->from_addr,
    					'to_address' => $to_address,
    					'from_amount' => $from_amount,
    					'to_amount' => $to_amount,
    					'refund_address' => $refund_address,
    					'rate_mode' => $response['data']->rate_mode,
    					'actual_orderid'=> $response['data']->orderid,
    					'orderid' => $orderid,
    					'rate'=> $response['data']->rate,
    					'svc_fee'=> $response['data']->svc_fee,
    					// 'svc_fee_override'=> $commission_precentage,
    					'network_fee'=> $response['data']->network_fee,
    					'from_amount_received'=> $response['data']->from_amount_received,
    					'max_input' => $response['data']->max_input,
    					'min_input' => $response['data']->min_input,
    					'wallet_pool'=> null,
    					'referral_id'=> $referral_id,
    					'fee_option'=> 'f',
    					'aggregation'=> null,
    					'state'=> get_order_status($response['data']->state),
    					'state_error'=> $state_error,
    					'transaction_id_received'=> $response['data']->transaction_id_received,
    					'transaction_id_sent'=> $response['data']->transaction_id_sent,
    					'refund_private_key'=> null,
    					'order_generated_from' => 'exch_api',
                        'order_type' => $order_type,
    				];

    				Order::create($create_array);

    				return redirect()->route('order',$orderid);

    			}else{

    				return redirect()->route('home')->with(['status' => 'danger', 'message' => __('Oops something went wrong, please try again later.')]);
    			}
    		}elseif(get_api_type() == "both"){

    			return redirect()->route('home')->with(['status' => 'danger', 'message' => __('Oops something went wrong, please contact to support.')]);

    		}else{

    			return redirect()->route('home')->with(['status' => 'danger', 'message' => __('Oops something went wrong, please try again later.')]);
    		}

    		/*------ end check active apis from setting table and create order ------*/

    	}catch(\Exception $e){

    		return redirect()->route('home')->with(['status' => 'danger', 'message' => __('Oops something went wrong, please try again later.')]);
    	}
    }


    public function order($orderid){

    	$data['seoData'] = Seo::where('slug','order')->first();
    	$data['order_details'] = Order::where('orderid',$orderid)->first();

    	if(!empty($data['order_details'])){

    		/*----- check referral id using setting table -------*/

    		$setting = Setting::take(1)->orderBy('id','desc')->first();

    		if(isset($setting) && !empty(get_api_type())){

    			if($data['order_details']->order_generated_from == "godex_api"){

    				$response = $this->godex->get_transaction($data['order_details']->actual_orderid);
     
    				$record = array(
    					'rate'=> $response['data']->rate,
    					'state'=> get_order_status($response['data']->status),
    					'final_amount' => $response['data']->final_amount,
    					'hash_in' => $response['data']->hash_in,
    					'hash_out' => $response['data']->hash_out,
    				);

    			}elseif($data['order_details']->order_generated_from == "exch_api"){


    				if($data['order_details']->state_error == 'TO_ADDRESS_INVALID'){

    					return redirect()->route('home')->with(['status' => 'danger', 'message' => __('Please enter valid to address.')]);
    				}

    				if($data['order_details']->from_address == '_GENERATING_'){

    					return redirect()->route('home')->with(['status' => 'danger', 'message' => __('Oops something went wrong, please contact to support.')]);
    				}

    				$response = $this->exch->get_order_details($data['order_details']->actual_orderid);
    				if(empty($response['data']->error)){

    					$record = array(
    						'rate'=> $response['data']->rate,
    						'state'=> get_order_status($response['data']->state),

    					);
    				}else{

    					return redirect()->route('home')->with(['status' => 'danger', 'message' => __('Oops this order id do not exist.')]);
    				}
    			}elseif($data['order_details']->order_generated_from == "both"){

    				return redirect()->route('home')->with(['status' => 'danger', 'message' => __('Oops something went wrong, please contact to support.')]);

    			}else{

    				return redirect()->route('home')->with(['status' => 'danger', 'message' => __('Oops something went wrong, please contact to support.')]);
    			}

    			Order::where('orderid',$orderid)->update($record);

    			return view('frontend.order.order',$data);

    		}else{

    			return redirect()->route('home')->with(['status' => 'danger', 'message' => __('Oops something went wrong, please contact to support.')]);
    		}
    	}
    }

    public function getPairRate(Request $request){

    	$currency_from = $request->get('currency_from');
    	$currency_to = $request->get('currency_to');

    	if(!empty(get_api_type())){

    		if(get_api_type() == "godex_api"){

    			$response = $this->godex->get_info($currency_from,$currency_to,1);
                // dd($response);
            // echo "--".$min_amount.'--';
    			if($response['status_code'] == 200){

    				$min_amount = $response['data']->min_amount;
    				$inner_response = $this->godex->get_info($currency_from,$currency_to,$min_amount);

    				if($inner_response['status_code'] == 200){

    					$rate = $inner_response['data']->rate;

    					//$html_rate = $min_amount.' '.$currency_from."=".$rate." ".$currency_to;
    					$html_rate = '1 '.$currency_from."=".$rate." ".$currency_to;

    					return response()->json(['status'=>'success','rate'=>$html_rate]);

    				}else{
    					return response()->json(['status'=>'error','message'=> __('Oops something went wrong, please try again later.')]);
    				}
    			}elseif($response['status_code'] == 500){

    				return response()->json(['status'=>'error','message'=> __('Oops this coin is temporarily suspended, please try again after sometime.')]);

    			}else{
    				return response()->json(['status'=>'error','message'=> __('Oops something went wrong, please try again later.')]);
    			}

    		}elseif(get_api_type() == "exch_api"){

    			$pair = $currency_from.'_'.$currency_to;

    			if(!empty($request->rate_mode)){

    				$data = ExchRate::where(['pair'=>$pair,'rate_mode'=>$request->rate_mode])->first();

    				if(!empty($data)){
    					$rate =  $data->rate;
    					$html_rate = "1 ".$currency_from."=".$rate." ".$currency_to;
    					return response()->json(['status'=>'success','rate'=>$html_rate]);
    				}else{

    					return response()->json(['status'=>'error','message'=> __('Oops something went wrong, please try again later.')]);
    				}
    			}else{

    				$data = ExchRate::where(['pair'=>$pair,'rate_mode'=>'flat'])->first();

    				if(!empty($data)){

    					$rate =  $data->rate;
    					$html_rate = "1 ".$currency_from."=".$rate." ".$currency_to;
    					return response()->json(['status'=>'success','rate'=>$html_rate]);
    				}else{

    					return response()->json(['status'=>'error','message'=> __('Oops something went wrong, please try again later.')]);
    				}
    			}
    		}else{

    			return response()->json(['status'=>'error','message'=> __('Oops something went wrong, please try again later.')]);

    		}
    	}else{
    		return response()->json(['status'=>'error','message'=> __('Oops something went wrong, please try again later.')]);
    	}
    }

    public function getExchangeAmount(Request $request){

    	$currency_from = $request->get('currency_from');
    	$currency_to = $request->get('currency_to');
    	$from_amount = $request->get('from_amount');

    	if(!empty(get_api_type())){
    		if(get_api_type() == "godex_api"){

    			$response = $this->godex->get_info($currency_from,$currency_to,1);

    			if($response['status_code'] == 200){

    				if(empty($from_amount)){

    					$min_amount = $response['data']->min_amount;

    				}else{

    					if($from_amount >=  $response['data']->min_amount){

    						$min_amount = $from_amount;

    					}else{

    						return response()->json(['status'=>'error','message'=>__('Oops the min amount should be min_amount currency_from',['min_amount'=>$response['data']->min_amount, 'currency_from'=> $currency_from])]);

    					}
    				}
    			}elseif($response['status_code'] == 500){

    				return response()->json(['status'=>'error','message'=>__('Oops this coin is temporarily suspended, please try again after sometime.')]);

    			}else{

    				return response()->json(['status'=>'error','message'=>__('Oops something went wrong, please try again later.')]);
    			}


    			$inner_response = $this->godex->get_info($currency_from,$currency_to,$min_amount);

    			if($inner_response['status_code'] == 200){

    				if(!empty($inner_response['data']->networks_from)){

    					$networks_send = array();

    					foreach ($inner_response['data']->networks_from as $key => $value){
    						if($value->is_active == 1){

    							$networks_send[] = $value;

    						}
    					}

    				}else{
    					$networks_send = array();
    				}

    				if(!empty($inner_response['data']->networks_to)){


    					$networks_receive = array();

    					foreach ($inner_response['data']->networks_to as $key => $value){
    						if($value->is_active == 1){

    							$networks_receive[] = $value;

    						}
    					}
    				}else{
    					$networks_receive = array();
    				}

    				$send_network = view('frontend.layouts.partials.send_network',['from_coin'=>$currency_from,'networks_send'=>$networks_send])->render();

    				$receive_network = view('frontend.layouts.partials.receive_network',['networks_receive'=>$networks_receive,'to_coin'=>$currency_to])->render();

    				return response()->json(['status'=>'success','to_amount'=>$inner_response['data']->amount,'min_amount'=>$min_amount,'networks_send'=>$send_network,'networks_receive'=>$receive_network]);

    			}elseif($response['status_code'] == 500){

    				return response()->json(['status'=>'error','message'=>__('Oops this coin is temporarily suspended, please try again after sometime.')]);

    			}else{

    				return response()->json(['status'=>'error','message'=>__('Oops something went wrong, please try again later.')]);

    			}

    		}elseif(get_api_type() == "exch_api"){

    			$pair = $currency_from.'_'.$currency_to;

    			if(empty($from_amount)){

    				$min_amount = 1;

    			}else{
    				$min_amount = $from_amount;
    			}


    			if(!empty($request->rate_mode)){

    				$data = ExchRate::where(['pair'=>$pair,'rate_mode'=>$request->rate_mode])->first();

    				if(!empty($data)){
    					$to_amount = $min_amount*$data->rate;
    					return response()->json(['status'=>'success','to_amount'=>$to_amount,'min_amount'=>$min_amount]);
    				}else{
    					return response()->json(['status'=>'error','message'=>__('Oops something went wrong, please try again later.')]);
    				}


    			}else{

    				$data = ExchRate::where(['pair'=>$pair,'rate_mode'=>'flat'])->first();

    				if(!empty($data)){
    					$to_amount = $min_amount*$data->rate;
    					return response()->json(['status'=>'success','to_amount'=>$to_amount,'min_amount'=>$min_amount]);

    				}else{
    					return response()->json(['status'=>'error','message'=> __('Oops something went wrong, please try again later.')]);
    				}

    			}
    		}else{
    			return response()->json(['status'=>'error','message'=> __('Oops something went wrong, please try again later.')]);
    		}
    	}else{
    		return response()->json(['status'=>'error','message'=>__('Oops something went wrong, please try again later.')]);
    	}
    }


    public function contact(){
    	$data['seoData'] = Seo::where('slug','contact_us')->first();
    	return view('frontend.contact',$data);
    }

    /**
     * send contact us inquiry.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendInquiry(ContactRequest $request)
    {
    	/* Validate inputs */
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255',
        //     'order_id' => 'nullable|exists:orders,order_id',
        //     'message' => 'required',
        //     'captcha_field' => 'required|captcha',
        // ], [], ['order_id' => 'order id']);

    	try {

    		ContactUs::create([
    			'name' => $request->get('name'),
    			'email' => $request->get('email'),
    			'order_id' => $request->get('order_id'),
    			'message' => $request->get('message'),
    		]);

    		return redirect()->route('contact-us')->with(['status' => 'success', 'message' => 'Your inquiry submitted successfully.']);

    	} catch (\Exception $e) {
    		return redirect()->route('contact-us')->with(['status' => 'danger', 'message' => 'Oops something went wrong, please try again later.']);
    	}
    }

    public function howItWorks(){
    	$data['seoData'] = Seo::where('slug','how-it-work')->first();
    	return view('frontend.how_it_work',$data);
    }

    public function aboutus(){
    	$data['seoData'] = Seo::where('slug','about-us')->first();
    	$data['record'] = AboutUs::orderBy('id','desc')->first();
    	return view('frontend.about',$data);
    }

    public function privacy_policy(){
    	$data['seoData'] = Seo::where('slug','privacy_policy')->first();
    	$data['record'] = CustomPage::where('slug','privacy_policy')->first();
    	return view('frontend.privacy_policy',$data);
    }

    public function term_condition(){
    	$data['seoData'] = Seo::where('slug','terms_condition')->first();
    	$data['record'] = CustomPage::where('slug','terms_condition')->first();
    	return view('frontend.term_condition',$data);
    }

    public function sitemap(){
    	$data['coin_pairs'] = Exchange::all();
    	return response()->view('frontend.sitemap',$data)->header('Content-Type', 'text/xml');
    }

    public function check_cookies($referral_id){

    	$ref=User::where('affiliate_id',$referral_id);
        // dd($ref);
    	if($ref->count()>0){

    		$record = $ref->first();
            setcookie('ref', $record->affiliate_id,  time()+86400);

    	}else{
    		if(isset($_COOKIE['ref'])){

    			$ref=User::where('affiliate_id',$_COOKIE['ref']);
    			if($ref->count()<1){
    				unset($_COOKIE['ref']);
    				setcookie('ref', '', time()-86400, '/');
    			}
    		}
    	}
    }

}

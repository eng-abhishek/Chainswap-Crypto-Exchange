<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use Illuminate\Http\Request;
use App\Models\Seo;
use App\Libraries\Coinrank;
use App\Libraries\Godex;
use App\Models\Coin;
use App\Models\Order;
use App\Models\Setting;
use App\Http\Requests\Frontend\ExchangeRequest;

class ExchangeController extends Controller
{

	public function __construct()
	{
     // $this->middleware('auth');
		$this->coinranking = new Coinrank();
		$this->godex = new Godex();
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['seoData'] = Seo::where('slug','exchange')->first();
    	$data['coin_pairs'] = Exchange::with('get_from_symbol','get_to_symbol')->inRandomOrder()->paginate(9);
        if(count($data['coin_pairs']->items()) < 1){
           abort(404);
        }

    	return view('frontend.exchange.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exchange  $exchange
     * @return \Illuminate\Http\Response
     */
    
    // public function show($slug)
    // {
    
    //    $data['record'] = Exchange::with('get_from_symbol','get_to_symbol')->where('slug',$slug)->first();
    
    //    if(is_null($data['record'])){
    //     return redirect()->route('exchange')->with(['status'=>'danger','message'=>'Oop`s this coin is not exist.']);
    //    }

    //    $data['seoData'] = Seo::where('slug','exchange')->first();
    
    //    $from_coin_symbol = strtoupper($data['record']->get_from_symbol->symbol);
    //    $to_coin_symbol = strtoupper($data['record']->get_to_symbol->symbol);
    
    //   /*---- Get from coin rate --------*/

    //    $coin_rate_from_coin = $this->godex->get_info($from_coin_symbol,$to_coin_symbol,1);
    //    if($coin_rate_from_coin['status_code'] == 200){

    //     $min_amount_from_coin = $coin_rate_from_coin['data']->min_amount;
    //     $inner_response_from_coin = $this->godex->get_info($from_coin_symbol,$to_coin_symbol,$min_amount_from_coin);
    
    //     if($inner_response_from_coin['status_code'] == 200){

    //         $rate_from_coin = $inner_response_from_coin['data']->rate;
    
    //     }
    // }

    //     $data['from_coin_rate_calculater'] =  $this->get_calculation($rate_from_coin);

    //     /*---- Get to coin rate --------*/

    //    $coin_rate_to_coin = $this->godex->get_info($to_coin_symbol,$from_coin_symbol,1);
    //    if($coin_rate_to_coin['status_code'] == 200){

    //     $min_amount_to_coin = $coin_rate_to_coin['data']->min_amount;
    //     $inner_response_to_coin = $this->godex->get_info($to_coin_symbol,$from_coin_symbol,$min_amount_to_coin);

    //     if($inner_response_to_coin['status_code'] == 200){

    //         $rate_to_coin = $inner_response_to_coin['data']->rate;
    
    //     }
    // }

    //    $data['to_coin_rate_calculater'] =  $this->get_calculation($rate_to_coin);
    
    //     /*---- Get to coin rate --------*/

    //    $from_data = $this->coinranking->coins($from_coin_symbol);
    //    $to_data = $this->coinranking->coins($to_coin_symbol);

    //    if($from_data['status_code'] == 200){
    
    //     $data['from_coins_info'] = ($from_data['data']->data->coins) ? $from_data['data']->data->coins[0] : '';
    
    //     $data['from_low_rate']= end($data['from_coins_info']->sparkline);
    //     $data['from_high_rate']= reset($data['from_coins_info']->sparkline);

    //     $data['from_stats'] = ($from_data['data']->data->stats) ? $from_data['data']->data->stats : '';
    //    }

    //    if($to_data['status_code'] == 200){
    
    //     $data['to_coins_info'] = ($to_data['data']->data->coins) ? $to_data['data']->data->coins[0] : '';


    //     $data['to_high_rate']= end($data['to_coins_info']->sparkline);
    //     $data['to_low_rate']= reset($data['to_coins_info']->sparkline);

    //     $data['to_stats'] = ($to_data['data']->data->stats) ? $to_data['data']->data->stats : '';
    //    }

    //   /*----- Exchange part ----*/
    
    //     $data['from_coin'] = strtoupper($from_coin_symbol);
    //     $data['to_coin'] = strtoupper($to_coin_symbol);
    //     $data['coins'] = Coin::all();
    
    //   /*----- end exchange part ----*/

    //    return view('frontend.exchange.detail',$data);
    // }


    public function show($slug)
    {
    	
    	$data['record'] = Exchange::with('get_from_symbol','get_to_symbol')->where('slug',$slug)->first();
    	
    	if(is_null($data['record'])){
    		return redirect()->route('exchange')->with(['status'=>'danger','message'=>'Oop`s this coin is not exist.']);
    	}

        $data['seoData'] = Seo::where('slug','exchange-detail')->first();
    	
    	$from_coin_symbol = strtoupper($data['record']->get_from_symbol->symbol);
    	$to_coin_symbol = strtoupper($data['record']->get_to_symbol->symbol);
    	
    	/*---- Get from coin rate --------*/

    	$coin_rate_from_coin = $this->godex->get_info($from_coin_symbol,$to_coin_symbol,1);

    	if($coin_rate_from_coin['status_code'] == 200){

    		$min_amount_from_coin = $coin_rate_from_coin['data']->min_amount;
    		$inner_response_from_coin = $this->godex->get_info($from_coin_symbol,$to_coin_symbol,$min_amount_from_coin);
    		
    		if($inner_response_from_coin['status_code'] == 200){

    			$rate_from_coin = $inner_response_from_coin['data']->rate;
    			
    		}
    	}

    	if(isset($rate_from_coin)){
    		
    		$data['from_coin_rate_calculater'] =  $this->get_calculation($rate_from_coin);
    		
    	}else{

    		$data['from_coin_rate_calculater'] =  array();
    	}

    	/*---- Get to coin rate --------*/

    	$coin_rate_to_coin = $this->godex->get_info($to_coin_symbol,$from_coin_symbol,1);
    	if($coin_rate_to_coin['status_code'] == 200){

    		$min_amount_to_coin = $coin_rate_to_coin['data']->min_amount;
    		$inner_response_to_coin = $this->godex->get_info($to_coin_symbol,$from_coin_symbol,$min_amount_to_coin);

    		if($inner_response_to_coin['status_code'] == 200){

    			$rate_to_coin = $inner_response_to_coin['data']->rate;
    			
    		}
    	}

    	if(isset($rate_to_coin)){

    		$data['to_coin_rate_calculater'] =  $this->get_calculation($rate_to_coin);

    	}else{
    		$data['to_coin_rate_calculater'] =  array();
    	}

    	
    	/*---- Get to coin rate --------*/
    	
    	$from_uuid = Coin::select('coinranking_uuid')->where('symbol',$from_coin_symbol)->first();
    	
    	/*---- from coin info ------*/
    	
    	if(!empty($from_uuid->coinranking_uuid)){
    		$from_data = $this->coinranking->get_coins_info_uuid($from_uuid->coinranking_uuid);

    		if($from_data['status_code'] == 200){
    			
    			$data['from_coins_info'] = ($from_data['data']->data->coin) ? $from_data['data']->data->coin : '';

        // dd($data['from_coins_info']->supply);
    			/*------ All time high price -----*/

    			if(isset($data['from_coins_info']->allTimeHigh)){

    				$data['from_allTimeHighPrice'] = isset($data['from_coins_info']->allTimeHigh->price) ? $data['from_coins_info']->allTimeHigh->price : '';

    			}else{

    				$data['from_allTimeHighPrice'] = '';

    			}

    			/*------ End All time high price -----*/

    			/*------ sparkline high and low -------*/

    			$data['from_low_rate']= isset($data['from_coins_info']->sparkline) ? end($data['from_coins_info']->sparkline) : '';

    			$data['from_high_rate']= isset($data['from_coins_info']->sparkline) ? reset($data['from_coins_info']->sparkline) : '';

    			/*------ end sparkline high and low -------*/


    			/*------ Fully diluated Market Capital & market capital -------*/

    			$data['from_fullyDilutedMarketCap'] = isset($data['from_coins_info']->fullyDilutedMarketCap) ? $data['from_coins_info']->fullyDilutedMarketCap : '';

    			// $data['from_marketCap'] = isset($data['from_coins_info']->marketCap) ? $data['from_coins_info']->marketCap : '';

    			if(isset($data['from_marketCap']) && $data['from_marketCap']->marketCap){
    				$data['from_marketCap'] = $data['from_marketCap']->marketCap;
    			}else{
    				$data['from_marketCap'] = '';
    			}

    			/*------ end fully diluated Market Capital & market capital -------*/


    			/*------ market supply info and 24hvalume -------*/

    			$data['from_coins_supply_info'] = isset($data['from_coins_info']->supply) ? $data['from_coins_info']->supply : '';

    			$data['from_24hVolume'] = isset($data['from_coins_info']->{'24hVolume'}) ? $data['from_coins_info']->{'24hVolume'} : '';

    			$data['from_price'] = isset($data['from_coins_info']->price) ? $data['from_coins_info']->price : '';

    			$data['from_rank'] = isset($data['from_coins_info']->rank) ? $data['from_coins_info']->rank : '';

        // +"supplyAt": 1712534437
        // +"max": "50000000000"
        // +"total": "50000000000"
        // +"circulating": "33719597561.60456"

    			/*------ end market supply info -------*/
    		}else{

    			$data['from_allTimeHighPrice'] = '';
    			$data['from_low_rate'] = '';
    			$data['from_high_rate'] = '';
    			$data['from_fullyDilutedMarketCap'] = '';
    			$data['from_marketCap'] = '';
    			$data['from_coins_supply_info'] = '';
    			$data['from_24hVolume'] = '';
    			$data['from_price'] = '';
    			$data['from_rank']  = '';
    		}
    	}else{

    		$data['from_allTimeHighPrice'] = '';
    		$data['from_low_rate'] = '';
    		$data['from_high_rate'] = '';
    		$data['from_fullyDilutedMarketCap'] = '';
    		$data['from_marketCap'] = '';
    		$data['from_coins_supply_info'] = '';
    		$data['from_24hVolume'] = '';
    		$data['from_price'] = '';
    		$data['from_rank']  = '';
    	}

    	/*------- to coin info ---------*/

    	$to_uuid = Coin::select('coinranking_uuid')->where('symbol',$to_coin_symbol)->first();

    	if(!empty($to_uuid->coinranking_uuid)){

    		$to_data = $this->coinranking->get_coins_info_uuid($to_uuid->coinranking_uuid);

    		if($to_data['status_code'] == 200){

    			$data['to_coins_info'] = ($to_data['data']->data->coin) ? $to_data['data']->data->coin : '';

    			/*------ All time high price -----*/

    			if(isset($data['to_coins_info']->allTimeHigh)){

    				$data['to_allTimeHighPrice'] = isset($data['to_coins_info']->allTimeHigh->price) ? $data['to_coins_info']->allTimeHigh->price : '';

    			}else{

    				$data['to_allTimeHighPrice'] = '';

    			}

    			/*------ End All time high price -----*/

    			/*------ sparkline high and low -------*/

    			$data['to_low_rate']= isset($data['to_coins_info']->sparkline) ? end($data['to_coins_info']->sparkline) : '';

    			$data['to_high_rate']= isset($data['to_coins_info']->sparkline) ? reset($data['to_coins_info']->sparkline) : '';

    			/*------ end sparkline high and low -------*/


    			/*------ Fully diluated Market Capital & market capital -------*/

    			$data['to_fullyDilutedMarketCap'] = isset($data['to_coins_info']->fullyDilutedMarketCap) ? $data['to_coins_info']->fullyDilutedMarketCap : '';

    			$data['to_marketCap'] = isset($data['to_coins_info']->marketCap) ? $data['to_coins_info']->marketCap : '';

    			/*------ end fully diluated Market Capital & market capital -------*/


    			/*------ market supply info and 24hvalume -------*/

    			$data['to_coins_supply_info'] = isset($data['to_coins_info']->supply) ? $data['to_coins_info']->supply : '';

    			$data['to_24hVolume'] = isset($data['to_coins_info']->{'24hVolume'}) ? $data['to_coins_info']->{'24hVolume'} : '';

    			$data['to_price'] = isset($data['to_coins_info']->price) ? $data['to_coins_info']->price : '';

    			$data['to_rank'] = isset($data['to_coins_info']->rank) ? $data['to_coins_info']->rank : '';

    			/*------ end market supply info -------*/
    		}else{

    			$data['to_allTimeHighPrice'] = '';
    			$data['to_low_rate'] = '';
    			$data['to_high_rate'] = '';
    			$data['to_fullyDilutedMarketCap'] = '';
    			$data['to_marketCap'] = '';
    			$data['to_coins_supply_info'] = '';
    			$data['to_24hVolume'] = '';
    			$data['to_price'] = '';
    			$data['to_rank']  = '';

    		}
    	}else{

    		$data['to_allTimeHighPrice'] = '';
    		$data['to_low_rate'] = '';
    		$data['to_high_rate'] = '';
    		$data['to_fullyDilutedMarketCap'] = '';
    		$data['to_marketCap'] = '';
    		$data['to_coins_supply_info'] = '';
    		$data['to_24hVolume'] = '';
    		$data['to_price'] = '';
    		$data['to_rank']  = '';

    	}


    	/*----- Exchange part ----*/

    	$data['from_coin'] = strtoupper($from_coin_symbol);
    	$data['to_coin'] = strtoupper($to_coin_symbol);
    	$data['coins'] = Coin::all();

    	/*----- end exchange part ----*/

    	return view('frontend.exchange.detail',$data);
    }

    public function get_calculation($rate){

    	return  array('rate_calculater'=>[

    		['amount' => 1, 'amount_you_get' => round(1*$rate,6)],
    		['amount' => 5,'amount_you_get' => round(5*$rate,6)],
    		['amount' => 10, 'amount_you_get' => round(10*$rate,6)],
    		['amount' => 25,'amount_you_get' => round(25*$rate,6)],
    		['amount' => 50, 'amount_you_get' => round(50*$rate,6)],
    		['amount' => 100,'amount_you_get' => round(100*$rate,6)],
    		['amount' => 500, 'amount_you_get' => round(500*$rate,6)],
    		['amount' => 1000,'amount_you_get' => round(1000*$rate,6)],

    	]);
    }



    public function exchange(ExchangeRequest $request)
    {

    	$slug = strtolower($request->get('currency_from')).'-to-'.strtolower($request->get('currency_to'));
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

    					return redirect()->route('exchange-detail',$slug)->with(['status' => 'danger', 'message' => 'connect to admin  Something went wrong, please try again later.']);

    				}

    			}elseif(get_api_type() == "exch_api"){


    				if(!empty(get_exch_referral())){

    					$referral_id = get_exch_referral();

    				}else{

    					return redirect()->route('exchange-detail',$slug)->with(['status' => 'danger', 'message' => 'connect to admin  Something went wrong, please try again later.']);

    				}

    			}elseif(get_api_type() == "both"){

    				return redirect()->route('exchange-detail',$slug)->with(['status' => 'danger', 'message' => 'connect to admin  Something went wrong, please try again later.']);

    			}else{

    				return redirect()->route('exchange-detail',$slug)->with(['status' => 'danger', 'message' => 'connect to admin  Something went wrong, please try again later.']);

    			}
    		}else{

    			return redirect()->route('exchange-detail',$slug)->with(['status' => 'danger', 'message' => 'connect to admin Something went wrong, please try again later.']);
    		}

    		/*----- end check referral id using setting table -------*/

    		if(get_api_type() == "godex_api"){

    			$affiliate_id = $referral_id;

    			$response = $this->godex->create_exchange($currency_from,$currency_to,$from_amount,$to_address,$affiliate_id,$refund_address,$send_network,$receive_network);

    			if($response['status_code'] == 200){

    				$create_array = [
    					'user_id' => user()->id,
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
    				];
    				Order::create($create_array);
    				return redirect()->route('order',$orderid);
    			}else{

    				return redirect()->route('exchange-detail',$slug)->with(['status' => 'danger', 'message' => 'Something went wrong, please try again later.']);   
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
    					'user_id' => user()->id,
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
    					'order_generated_from' => 'exch_api'
    				];

    				Order::create($create_array);
    				return redirect()->route('order',$orderid);

    			}else{

    				return redirect()->route('exchange-detail',$slug)->with(['status' => 'danger', 'message' => 'Something went wrong, please try again later.']);
    			}
    		}elseif(get_api_type() == "both"){

    			return redirect()->route('exchange-detail',$slug)->with(['status' => 'danger', 'message' => 'Oop`s both apis is active please enable anyone at a time.']);

    		}else{

    			return redirect()->route('exchange-detail',$slug)->with(['status' => 'danger', 'message' => 'Something went wrong, please try again later.']);
    		}

    		/*------ end check active apis from setting table and create order ------*/

    	}catch(\Exception $e){

    		return redirect()->route('exchange-detail',$slug)->with(['status' => 'danger', 'message' => 'Something went wrong, please try again later.']);
    	}
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exchange  $exchange
     * @return \Illuminate\Http\Response
     */
    public function edit(Exchange $exchange)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exchange  $exchange
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exchange $exchange)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exchange  $exchange
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exchange $exchange)
    {
        //
    }
}

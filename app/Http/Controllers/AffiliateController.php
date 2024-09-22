<?php

namespace App\Http\Controllers;
use App\User;
use App\Models\Order;
use App\Models\ReferralCommission;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\AffiliateRequest;
use App\Http\Requests\Frontend\CheckAffiliateUserRequest;
use App\Http\Requests\Frontend\RedeemAmountRequest;

class AffiliateController extends Controller
{

	public function index()
	{
		return view('frontend.affiliate.index');
	}

	public function profile($id)
	{

	try{

		$record = User::where('name',$id)->first();
 
		$order_data = Order::with('referral_order')->where(['user_id'=>$record->id,'order_type'=>'referal']);
		$data['total_exchange'] = $order_data->count();
		$data['completed_exchange'] = $order_data->where('state','Completed')->count();
         
        $data['completed_exchange_list'] = $order_data->get();

		$data['total_payable_commission'] = ReferralCommission::with('order')->whereHas('order',function($q){
			$q->where('state','Completed');
		})->where(['payment_status'=>'payable','user_id'=>$record->id])->sum('commission_amount_in_btc');

		$data['total_pending_commission'] = ReferralCommission::with('order')->whereHas('order',function($q){
			$q->where('state','Completed');
		})->where(['payment_status'=>'pending','user_id'=>$record->id])->sum('commission_amount_in_btc');

       $data['withdraw_record'] = ReferralCommission::with('user')->select('updated_at','user_id','txn_has',\DB::raw('sum(commission_amount_in_btc) as total_amount'))->where(['payment_status'=>'paid','user_id'=>$record->id])->groupBy('updated_at','txn_has','user_id')->get();

		$data['record'] = $record;
		return view('frontend.affiliate.profile',$data);

	}catch(\Exception $e){
       return redirect()->route('affiliate')->with(['status'=>'danger','message'=>'Oop`s something went wrong']); 
	}
		
	}

	public function store(AffiliateRequest $request){
                
		$partnerCount = User::where('email',$request->get('email'))->where('is_admin','N');
       
		if($partnerCount->count() > 0){

			$user = $partnerCount->first();			
			$user_name = $user->name;
			
		}else{

			$user = new User;
			do {
				$unique_id = uniqid();

			} while (\App\User::where('name', $unique_id)->exists());

			$created_user = User::Create([
				'affiliate_id' => $user->generateRandomString(10),
				//'api_key' => $user->generateKey(),
                'api_key' => $unique_id,
				'email' => $request->get('email'),
				'name' => $unique_id,
				'is_admin' => 'N',
			]);

			$user_name = $created_user->name;
		}
		return redirect()->route('affiliate-profile',$user_name);
	}

	public function checkAffiliateUser(CheckAffiliateUserRequest $request){

		$partnerCount = User::where('name',$request->get('partner_id'));

		if($partnerCount->count() > 0){

			$user = $partnerCount->first();

			return redirect()->route('affiliate-profile',$user->name);

		}else{
			return redirect()->route('affiliate')->with(['status'=>'danger','message'=>'Oop`s please enter valid partner Id !']); 
		}
	}

	public function redeemAmoutRequest(RedeemAmountRequest $request){

		try{
			$check_user = User::where('name',$request->get('partner_id'));
			if($check_user->count() > 0){
    
			   User::where('name',$request->get('partner_id'))->update(['btc_address'=>$request->get('redeem_btc_address')]);

				$user = $check_user->first();
                
				ReferralCommission::where(['user_id'=>$user->id,'payment_status'=>'payable'])->update(['payment_status'=>'pending']);

				return redirect()->route('affiliate-profile',$user->name)->with(['status'=>'success','message'=>'Your request submitted successfully.']); 

			}
		}catch(\Exception $e){
			return redirect()->route('affiliate')->with(['status'=>'danger','message'=>'Oop`s something went wrong.']); 
		}
	}
}

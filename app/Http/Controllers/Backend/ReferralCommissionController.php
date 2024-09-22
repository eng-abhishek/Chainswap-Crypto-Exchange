<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\ReferralCommission;
use App\Http\Requests\Backend\ReferralCommissionRequest;
use Illuminate\Http\Request;
use App\User;
use DataTables;

class ReferralCommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       if ($request->ajax()) {
         
         $data = ReferralCommission::with('user')->select('user_id',\DB::raw("sum(commission_amount_in_btc) as total_amount"))->where('payment_status','pending')->groupBy('user_id');

         return Datatables::of($data)
         ->addIndexColumn()
         
         ->addColumn('total_commission',function($row){
           
           return $row->total_amount;

       })

         ->addColumn('partner_id',function($row){
           
           return $row->user->name;

       })

         ->addColumn('email',function($row){
           
           return $row->user->email;

       })

         ->addColumn('affiliate_id',function($row){
           
           return $row->user->affiliate_id;

       })

         ->addColumn('wallet_address',function($row){

            return  $row->user->btc_address;

        })

         ->addColumn('action', function($row){
            $btn = '';
            $btn .= '<a href="'.route("backend.affiliate.referral-commission.edit", $row->user_id).'" class="edit-record m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>';
            return $btn;
        })
         
         ->rawColumns(['action','total_commission','partner_id','email','affiliate_id','wallet_address'])
         ->make(true);
     }
     return view('backend.affiliate.referral.index');

 }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReferralCommession  $referralCommession
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data['record'] = ReferralCommission::with('user')->select('user_id',\DB::raw("sum(commission_amount_in_btc) as total_amount"))->where(['payment_status'=>'pending','user_id'=>$id])->groupBy('user_id')->first();

      return view('backend.affiliate.referral.edit',$data);
  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReferralCommession  $referralCommession
     * @return \Illuminate\Http\Response
     */
    public function update(ReferralCommissionRequest $request, $id)
    {
       if(!empty($request->get('txn_has'))){
        
         $check_user = ReferralCommission::where(['user_id'=>$id,'payment_status'=>'pending']);

         if($check_user->count() > 0){
           
           $check_user->update(['payment_status'=>'paid','txn_has'=>$request->get('txn_has')]);

           return redirect()->route('backend.affiliate.referral-commission.index')->with(['status'=>'success','message'=>'Referral commission paid successfully.']);
       }else{
           return redirect()->route('backend.affiliate.referral-commission.index')->with(['status'=>'danger','message'=>'Oop`s something went wrong.']);
       }
   }else{
    return redirect()->route('backend.affiliate.referral-commission.index')->with(['status'=>'danger','message'=>'Oop`s please enter txt has.']);
}
}

/* commission report */

public function commissionReport(Request $request){

if ($request->ajax()) {
         
         $data = ReferralCommission::with('user')->select('user_id',\DB::raw("sum(commission_amount_in_btc) as total_commission_amount"),\DB::raw("sum(exchange_amount_in_btc) as total_exchange_amount"),\DB::raw("count(id) as total_completed_order"))->where('payment_status','paid')->groupBy('user_id')->get();


         return Datatables::of($data)
         ->addIndexColumn()
         
         ->addColumn('total_exchange_amount',function($row){
           
           return $row->total_exchange_amount." BTC";

       })

      ->addColumn('total_commission_amount',function($row){
           
           return $row->total_commission_amount." BTC";

       })

        ->addColumn('total_completed_order',function($row){
           
           return $row->total_completed_order;

       })

      ->addColumn('commission_precentage',function($row){
           
           return \Config::get('constants.default_payout.amount');

       })

         ->addColumn('partner_id',function($row){
           
           return $row->user->name;

       })

         ->addColumn('email',function($row){
           
           return $row->user->email;

       })

         ->addColumn('affiliate_id',function($row){
           
           return $row->user->affiliate_id;

       })

         ->addColumn('wallet_address',function($row){

            return  $row->user->btc_address;

        })
         
         ->rawColumns(['email','affiliate_id','wallet_address','total_completed_order','commission_precentage','total_commission_amount','total_exchange_amount'])
         ->make(true);
     }
     return view('backend.affiliate.referral.report');
}

}

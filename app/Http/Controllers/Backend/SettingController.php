<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Http\Requests\Backend\SettingRequest;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
     $record = Setting::take(1)->orderBy('id','desc')->first();
     
     return view('backend.setting.create',['record'=>(!empty($record) ? json_decode($record->data) : '')]);
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
    public function store(SettingRequest $request)
    {
        try{

         $data = [
        //'exch_referral_id' => $request->exch_referral_id,
        'godex_referral_id' => $request->godex_referral_id,
        'coinranking_api_key' => $request->coinranking_api_key,
        'user_api_type' => 'godex_api',
               ];

        $value = json_encode($data);
        $result = Setting::take(1)->orderBy('id','desc')->get();
     
        if(isset($result[0]->id)){
         Setting::where('id',$result[0]->id)->update(['data'=>$value]);
        }else{
         Setting::create(['data'=>$value]);
        }

        return redirect()->route('backend.setting.index')->with(['status'=>'success','message'=>'Website setting has updated successfully.']);

        }catch(\Exception $e){
        return redirect()->route('backend.setting.index')->with(['status'=>'danger','message'=>'Oop`s something wents wrong.']);        
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}

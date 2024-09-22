@extends('frontend.layouts.app')
@section('styles')
<style type="text/css">
    .error-help-block{
        color:#e66f6f;
    }
    .invalid-feedback{
        display: block;
    }
</style>
@endsection
@section('content')
<main>
    <section class="breadcrumb-section py-3 text-white text-center">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-12">
                    <h1 class="fs-2">Affiliate Program</h1>
                    <nav class="breadcrumb-nav">
                        <ol class="breadcrumb mb-0 justify-content-center">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Affiliate Program</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-3">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-6 col-lg-10 py-3">
                    <div class="exchange-wrap bg-theme py-5 px-5">
                        <div class="affiliate-details">
                            <div class="affiliate-details-information">
                                <div class="row mb-3">
                                    <div class="col text-lg-end">Partner Id private key: </div>
                                    <div class="col text-lg-start ">{{$record->name}}</div>
                                </div>
                                <div class="row  mb-3">
                                    <div class="col text-lg-end">Partner Email: </div>
                                    <div class="col text-lg-start text-success">{{$record->email}}</div>
                                </div>
                                <div class="row  mb-3">
                                    <div class="col text-lg-end">Referrer ID: </div>
                                    <div class="col text-lg-start text-danger">{{$record->affiliate_id}}</div>
                                </div>
                                <div class="row  mb-3">
                                    <div class="col text-lg-end">Referrer link: </div>
                                    <div class="col text-lg-start"><a class="text-warning" target="_blank" href="{{route('home')}}/?ref={{$record->affiliate_id}}">{{route('home')}}/?ref={{$record->affiliate_id}}</a></div>
                                </div>
                                <div class="row  mb-3">
                                    <div class="col text-lg-end">Exchanges created:  </div>
                                    <div class="col text-lg-start">{{$total_exchange}}</div>
                                </div>
                                <div class="row  mb-3">
                                    <div class="col text-lg-end">Exchanges complete:  </div>
                                    <div class="col text-lg-start">{{$completed_exchange}} </div>
                                </div>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-3">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-6 col-lg-10 py-3">
                    <div class="exchange-wrap bg-theme py-5 px-5">
                        <div class="affiliate-balance-information">
                            <h3 class="text-center py-3">Balances</h3>
                            <div class="affiliate-balance">
                              @if($total_payable_commission > 0)
                              <div class="row mb-3">
                                <div class="col text-lg-end">Total Profit</div>
                                =
                                <div class="col text-lg-start">{{!empty($total_payable_commission) ? $total_payable_commission : ''}} BTC</div>
                            </div>

                            @if($total_payable_commission < \Config::get('constants.default_payout.amount'))
                            <div class="col text-lg-end">
                            You can redeem your commission if it will be {{\Config::get('constants.default_payout.amount')}} BTC.</div>
                            @endif

                            @else
                            <div class="row mb-3">
                                <div class="col text-lg-end">No balances available for now. Start referring to earn coins.</div>
                            </div>
                            @endif

                            @if($total_payable_commission >= \Config::get('constants.default_payout.amount'))
                            <form method="post" action="{{route('redeem_amout_request',['partner_id'=>$record->name])}}" id="redeem-form">
                                @csrf
                                
                                <div class="mb-3">
                                    <div class="col">
                                        <input type="text" class="form-control" name="redeem_btc_address" value="{{$record->btc_address ?? ''}}" placeholder="Please enter btc address only.">
                                        @error('redeem_btc_address')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="py-3 text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                                @endif

                                @if($total_pending_commission > 0)
                                <p> Your Request of <span class="text-warning">{{$total_pending_commission}} BTC </span>is under processing, system will quick pay you your requested comission Thanks.</p>
                                @endif
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-3">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-12 col-lg-10 py-3">
                    <div class="affiliate-information-table">
                        @if(count($withdraw_record) > 0)
                        <div class="affiliate-withdrawals-table py-3">
                            <h3 class="withdrawals-heading text-center text-light py-3">Withdrawals</h3>
                            <div class="table-responsive">
                                <table class="table table-striped table-transparent">
                                    <thead>
                                      <tr>
                                        <th scope="col">Time</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Transaction Has</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($withdraw_record as $value)
                                    <tr>
                                        <th scope="row">{{$value->updated_at}}</th>
                                        <td>{{$value->total_amount}} BTC</td>
                                        <td>{{$value->user->btc_address}}</td>
                                        <td>
                                            <span class="d-inline-block text-truncate txn_has" style="max-width: 350px;" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$value->txn_has ?? ''}}">{{$value->txn_has ?? ''}}</span>
                                            <a href="javasicrpt:void(0)" class="text-end" onclick="copyToClipboard('.txn_has')"><i class="text-white fa fa-solid fa-copy"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    <hr class="mt-5" style="color: #fff;">
                    <div class="affiliate-order-table py-3">
                        <h3 class="order-heading text-center text-light py-3">Completed Order</h3>
                        @if(count($completed_exchange_list) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-transparent">
                                <thead>
                                  <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Currencies</th>
                                    <th scope="col">Your fee/profit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($completed_exchange_list as $value)
                                <tr>
                                    <th scope="row">{{$value->orderid}}</th>
                                    <td>{{$value->created_at}}</td>
                                    <td>{{$value->from_amount}} {{$value->from_currency}} To {{$value->to_amount}} {{$value->to_currency}}</td>
                                    <td>3.00% = {{$value->referral_order->commission_amount}} {{$value->from_currency}} ({{$value->referral_order->commission_amount_in_btc}} BTC)</td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-center text-white">No orders were made with this partner ID.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
</section>
</main>
@endsection
@section('scripts')

{!! JsValidator::formRequest('App\Http\Requests\Frontend\RedeemAmountRequest','#redeem-form'); !!}

<script type="text/javascript">
    function copyToClipboard(element,id=null) {

        var $temp = $("<input>");
        $("body").append($temp);
        if(id != null){
            $temp.val($(element+id).text()).select();
        }else{
            $temp.val($(element).text()).select();
        }

        document.execCommand("copy");
        $temp.remove();
        if(id != null){
            $(element+id).addClass('text-success');
        }else{
            $(element).addClass('text-success');
        }

        setTimeout(function(){
            if(id != null){
                $(element+id).removeClass('text-success');
            }else{
                $(element).removeClass('text-success');
            }
        },1200)
    }
</script>
@endsection
@extends('frontend.layouts.app')
@section('extra_meta')
@if($order_details->state == 'COMPLETE' OR $order_details->state == 'CANCELLED')
@else
<meta http-equiv="refresh" content="10" />
@endif
@endsection

@section('meta_detail')
<title>{{ !empty($seoData->title) ? $seoData->title : 'ChainSwap - '.config('app.name') }}</title>
<meta name="title" content="{{ !empty($seoData->meta_title) ? $seoData->meta_title : 'Chain Swap'}}">
<meta name="description" content="{{ !empty($seoData->meta_des) ? $seoData->meta_des : 'chainswap.io - Exchange between BTC, ETH, BCH, XMR and 300+ other cryptocurrencies. The best exchange rates.'}}">
<meta name="keywords" content="{{$seoData->meta_keyword ?? 'BTC, ETH, BCH, XMR, Btc to xmr swap,xmr to btc swap,btc to xmr,xmr to btc,crypto swap 2023,nokyc crypto swap,nokyc crypto,privacy swap crypto,best crypto swap,best crypto exchange,btc to xmr exchange,zcash to xmr exchange,btc to zach exchangecrypto,crypto currency,binance us,crypto currency prices,crypto prices,crypto market,crypto wallet,altcoin,best crypto to buy now,trade crypto,whats crypto,best crypto wallet,crypto exchange,cryptocurrency market,crypto coin'}}">
<meta name="author" content="Chain Swap">
<link rel="canonical" href="{{url()->current()}}"/>
<meta property="og:type" content="website" />
<meta property="og:title" content="{{$seoData->meta_title ?? 'chainswap.io'}}" />
<meta property="og:description" content="{{$seoData->meta_des ?? 'chainswap.io - Exchange between BTC, ETH, BCH, XMR and 300+ other cryptocurrencies. The best exchange rates.'}}" />

<meta property="og:url" content="{{url()->current()}}"/>
<meta property="og:image" content="{{getNormalImage('featured_image',$seoData->featured_image) ??   asset('assets/frontend/images/logo/featured-crypto-exchange.png')}}" />
<meta property="og:image:width" content="850">
<meta property="og:image:height" content="560">
<meta property="og:site_name" content="chainswap" />
<meta property="og:locale" content="en" />

<meta property="twitter:url" content="{{url()->current()}}">
<meta property="twitter:image" content="{{getNormalImage('featured_image',$seoData->featured_image) ?? asset('assets/frontend/images/logo/featured-crypto-exchange.png')}}">

<meta property="twitter:title" content="{{$seoData->meta_title ?? 'chainswap.io'}}">
<meta property="twitter:description" content="{{$seoData->meta_des ?? 'chainswap.io - Exchange between BTC, ETH, BCH, XMR and 300+ other cryptocurrencies. The best exchange rates.'}}">

<meta name="twitter:description" content="{{$seoData->meta_des ?? 'chainswap.io - Exchange between BTC, ETH, BCH, XMR and 300+ other cryptocurrencies. The best exchange rates.'}}">
<meta name="twitter:image" content="{{getNormalImage('featured_image',$seoData->featured_image) ?? asset('assets/frontend/images/logo/featured-crypto-exchange.png')}}">

<meta name="twitter:card" value="summary_large_image">
<meta name="twitter:site" value="@chainswap">
@endsection

@section('content')
<main>
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-8 col-lg-10 py-lg-0 py-3">
                    <div class="exchange-wrap bg-theme">
                        <div class="row">
                            <div class="col-md-auto flex-grow-1 text-md-start text-center">
                                <div class="exchange-info">
                                    <p>Order ID:</p>
                                    <h3 class="mb-0">{{$order_details->orderid}}</h3>
                                </div>
                            </div>
                            <div class="col-md-auto text-md-end text-center mt-md-0 mt-3">
                                <div class="exchange-info">
                                    <p>Exchange rate:</p>
                                    <h3 class="mb-0">1 {{$order_details->from_currency}} = {{$order_details->rate}} {{$order_details->to_currency}}</h3>
                                </div>
                            </div>
                        </div>
                        @if($order_details->state == 'Waiting')
                        
                        @include('frontend.order.partials.waiting',['status'=>'Waiting'])

                        @elseif($order_details->state == 'Confirmation')

                        @include('frontend.order.partials.processing',['status'=>'Confirmation'])

                        @elseif($order_details->state == 'Confirmed')

                        @include('frontend.order.partials.processing',['status'=>'Confirmed'])

                        @elseif($order_details->state == 'Exchanging')

                        @include('frontend.order.partials.processing',['status'=>'Exchanging'])

                        @elseif($order_details->state == 'Completed')

                        @include('frontend.order.partials.success',['status'=>'Finished'])
                        
                        @elseif($order_details->state == 'Cancelled')

                        @include('frontend.order.partials.expire',['status'=>'Failed'])

                        @elseif($order_details->state == 'Refunded')

                        @include('frontend.order.partials.refunded',['status'=>'Refunded'])
                        
                        @elseif($order_details->state == 'Overdue')

                        @include('frontend.order.partials.expire',['status'=>'Failed'])
                        
                        @else

                        @include('frontend.order.partials.processing',['status'=>'Exchanging'])

                        @endif

                        <div class="row mt-3">
                            <div class="col-md-auto text-md-start text-center">
                                <div class="exchange-info">
                                    <p>Receiving Address:</p>
                                    <h3 class="mb-0 text-truncate" data-bs-toggle="tooltip" data-bs-original-title="{{$order_details->to_address}}">{{ \Illuminate\Support\Str::limit($order_details->to_address, $limit = 50, $end = '...') }}
                                    </h3>
                                </div>
                            </div>
                            <div class="col-md-auto flex-grow-1 text-md-end text-center mt-md-0 mt-3">
                                <div class="exchange-info">
                                    <p>Created at:</p>
                                    <h3 class="mb-0">{{$order_details->created_at}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
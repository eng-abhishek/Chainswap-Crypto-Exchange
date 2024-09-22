@extends('frontend.layouts.app')
@section('meta_detail')
<title>{{ !empty($seoData->title) ? $seoData->title : 'How it work - '.config('app.name') }}</title>
<meta name="title" content="{{ !empty($seoData->meta_title) ? $seoData->meta_title : 'Chain Swap'}}">
<meta name="description" content="{{ !empty($seoData->meta_des) ? $seoData->meta_des : 'chainswap.io - Exchange between BTC, ETH, BCH, XMR and 300+ other cryptocurrencies. The best exchange rates.'}}">
<meta name="keywords" content="{{$seoData->meta_keyword ?? 'BTC, ETH, BCH, XMR, Btc to xmr swap,xmr to btc swap,btc to xmr,xmr to btc,crypto swap 2023,nokyc crypto swap,nokyc crypto,privacy swap crypto,best crypto swap,best crypto exchange,btc to xmr exchange,zcash to xmr exchange,btc to zach exchangecrypto,crypto currency,binance us,crypto currency prices,crypto prices,crypto market,crypto wallet,altcoin,best crypto to buy now,trade crypto,whats crypto,best crypto wallet,crypto exchange,cryptocurrency market,crypto coin'}}">
<meta name="author" content="Chain Swap">
<link rel="canonical" href="{{url()->current()}}"/>
<meta property="og:type" content="website" />
<meta property="og:title" content="{{$seoData->meta_title ?? 'chainswap.io'}}" />
<meta property="og:description" content="{{$seoData->meta_des ?? 'chainswap.io - Exchange between BTC, ETH, BCH, XMR and 300+ other cryptocurrencies. The best exchange rates.'}}" />

<meta property="og:url" content="{{url()->current()}}"/>
<meta property="og:image" content="{{getNormalImage('featured_image',$seoData->featured_image) ?? asset('assets/frontend/images/logo/featured-crypto-exchange.png')}}" />
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

{!! organization_jsonld() !!}

{!! breadcrumbs_jsonld([
    ['url' => route('home'), 'title' => 'Home'],
    ['title' => 'How it Works']
]) 
!!}


@endsection
@section('styles')
<style type="text/css">
.help-block{
  color: #dc3545;
}
</style>
@endsection
@section('content')
    <main>
        <div class="container wrk-container mt-5">
            <div class="row">
                <div class="col-md-6 mt-2">
                    <img src="{{asset('assets/frontend/images/how_it_work/hwt.png')}}" class="img-fluid" id="hwt-img">
                </div>
                <div class="col-md-6">
                    <div class="row step-row guide-row">
                        <div class="col-md-4 text-center">
                            <div class="step-circle">01</div>
                        </div>
                        <div class="col-md-8">
                            <h2 class="guide-text-hd">{{__('Choose the crypto exchange pair')}}</h2>
                            <p class="guide-text">
                            {{__('Let\'s assume you have Bitcoin and you want to have Ethereum.')}}
                            {{__('Here is how the ETH to BTC exchange process takes place on Chainswap.')}}
                            </p>
                            <div class="step-img-container">
                                <img src="{{asset('assets/frontend/images/how_it_work/1.jpeg')}}" class="img-fluid step-img" id="guide-img-1"
                                    alt="Step 1">
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="row step-row guide-row">
                        <div class="col-md-4 text-center">
                            <div class="step-circle">02</div>
                        </div>
                        <div class="col-md-8">
                            <h2 class="guide-text-hd">{{__('Enter the recipient\'s address')}}</h2>
                            <p class="guide-text">
                            {{__('Now you need to enter the recipient\'s Ethereum address. Be extremely careful and double-check your ETH address. Your Ethereum coins will be sent to this address right after the exchange.')}}
                            </p>
                            <div class="step-img-container">
                                <img src="{{asset('assets/frontend/images/how_it_work/2.jpeg')}}" class="img-fluid step-img" id="guide-img-2"
                                    alt="Step 2">
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="row step-row guide-row">
                        <div class="col-md-4 text-center">
                            <div class="step-circle">03</div>
                        </div>
                        <div class="col-md-8">
                            <h2 class="guide-text-hd">{{__('Send and receive cryptocurrencies')}}</h2>
                            <p class="guide-text">
                            {{__('On the exchange page, you will see the address to send the indicated amount of Bitcoins to continue the exchange.')}}
                            </p>
                            <div class="step-img-container">
                                <img src="{{asset('assets/frontend/images/how_it_work/3.jpeg')}}" class="img-fluid step-img" id="guide-img-3"
                                    alt="Step 3">
                            </div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="row step-row guide-row">
                        <div class="col-md-4 text-center">
                            <div class="step-circle">04</div>
                        </div>
                        <div class="col-md-8">
                            <h2 class="guide-text-hd">{{__('Receive cryptocurrency')}}</h2>
                            <p class="guide-text">
                            {{__('When the swap process is over and the exchange is successfully finished, you will get the desired crypto.')}}
                            </p>
                            <div class="step-img-container">
                                <img src="{{asset('assets/frontend/images/how_it_work/4.jpeg')}}" class="img-fluid step-img" id="guide-img-4"
                                    alt="Step 4">
                            </div>
                        </div>
                    </div>
                    <!-- Additional steps can be added here -->
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Frontend\ContactRequest', '#contact-us-form'); !!}
@endsection
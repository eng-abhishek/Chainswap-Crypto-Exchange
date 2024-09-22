@extends('frontend.layouts.app')
@section('meta_detail')
<title>{{ !empty($seoData->title) ? $seoData->title : 'Contact us - '.config('app.name') }}</title>
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
    ['title' => 'Contact']
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
    <section class="breadcrumb-section py-3 text-white text-center">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-12">
                    <h1 class="fs-2">Contact Us</h1>
                    <nav class="breadcrumb-nav">
                        <ol class="breadcrumb mb-0 justify-content-center">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Contact Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-3">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-8 col-lg-10 py-3">
                    <div class="exchange-wrap bg-theme">
                        <h2 class="fs-5">Get In Touch !</h2>
                        {!! Form::open(['route' => 'send-inquiry', 'id' => 'contact-us-form', 'class' => 'position-relative'])!!}
                        @include('frontend.layouts.partials.alert-messages')
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="" class="form-label small">Name: <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control form-custom" placeholder="Name">
                                @error('name')
                                <span class="small invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="" class="form-label small">Email: <span class="text-danger">*</span></label>
                                <input type="text" name="email" id="email" class="form-control form-custom" placeholder="Email">
                                @error('email')
                                <span class="small invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="" class="form-label small">Order ID: <span class="text-danger">*</span></label>
                                <input type="text" name="order_id" id="order_id" class="form-control form-custom" placeholder="Order ID">
                                @error('order_id')
                                <span class="small invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="" class="form-label small">Message: <span class="text-danger">*</span></label>
                                <textarea type="text" name="message" id="message" class="form-control form-custom" placeholder="Message" rows="5"></textarea>
                                @error('message')
                                <span class="small invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="" class="form-label small">Captcha: <span class="text-danger">*</span></label>
                                <div class="custom-contact-input">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display(['data-type'=>'image']) !!}
                                </div>
                                @if ($errors->has('g-recaptcha-response'))
                                <div class="small invalid-feedback d-block">
                                {{ $errors->first('g-recaptcha-response') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-custom rounded-pill px-5 text-uppercase">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Frontend\ContactRequest', '#contact-us-form'); !!}
@endsection
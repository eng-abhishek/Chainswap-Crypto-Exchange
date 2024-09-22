@extends('frontend.layouts.app')

@section('meta_detail')
<title>{{ !empty($seoData->title) ? $seoData->title : 'About-us - '.config('app.name') }}</title>
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
    ['title' => 'About Us']
]) 
!!}

@endsection

@section('content')
    <main>
        <section class="breadcrumb-section py-3 text-white text-center">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-12">
                        <h1 class="fs-2">{{__('About Us')}}</h1>
                        <nav class="breadcrumb-nav">
                            <ol class="breadcrumb mb-0 justify-content-center">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Home')}}</a></li>
                                <li class="breadcrumb-item active">{{__('About Us')}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-3">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-5 py-lg-0 py-3">
                        <img src="{{asset('assets/frontend/images/about/about.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="col-lg-7 py-lg-0 py-3">
                        <h2 class="fs-3 text-white">{{$record->title}}</h2>
                        {!! $record->description !!}

                    </div>
                </div>
            </div>
        </section>
        
        <section class="divider">
            <span class="dot"></span>
            <span class="mid"></span>
            <span class="dot"></span>
        </section>
        <section class="text-white py-3">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-auto flex-grow-1">
						<div class="text-md-start text-center text-white w-100">
							<h4>{{__('Got any questions?')}}</h4>
							<p class="mb-md-0 mb-3">{{__('Don\'t hesitate to get in touch.')}}</p>
						</div>
					</div>
					<div class="col-md-auto">
						<div class="text-md-end text-center w-100">
							<a href="{{route('contact-us')}}" class="btn btn-custom btn-lg rounded-pill">{{__('Contact Us')}}</a>
						</div>
					</div>
				</div>
			</div>
		</section>
        <section class="divider">
            <span class="dot"></span>
            <span class="mid"></span>
            <span class="dot"></span>
        </section>
        <section class="text-white py-3">
			<div class="container">
				<div class="row text-center">
					<div class="col-lg-12">
						<h3>{{__('How It Works?')}}</h3>
					</div>
                </div>
                <div class="row align-items-center">
					<div class="col-lg-4 py-3 process-single-grid">
						<div class="process-single">
							<div class="process-count">
								<span>01</span>
							</div>
							<h3 class="fs-4">{{__('Select')}}</h3>
							<p class="mb-0">{{__('Choose the cryptocurrency you wish to exchange on ChainSwap.io.')}}</p>
						</div>
					</div>
					<div class="col-lg-4 py-3 process-single-grid">
						<div class="process-single">
							<div class="process-count">
								<span>02</span>
							</div>
							<h3 class="fs-4">{{__('Enter')}}</h3>
							<p class="mb-0">{{__('Please enter the correct address for the specific coin to send to.')}}</p>
						</div>
					</div>
					<div class="col-lg-4 py-3 process-single-grid">
						<div class="process-single">
							<div class="process-count">
								<span>03</span>
							</div>
							<h3 class="fs-4">{{__('Exchange')}}</h3>
							<p class="mb-0">{{__('Double-check the entered address and coin. Then, press the "EXCHANGE" button.')}}</p>
						</div>
					</div>
				</div>
			</div>
		</section>
    </main>
@endsection
@extends('frontend.layouts.app')
@section('meta_detail')
<title>{{ !empty($seoData->title) ? $seoData->title : 'Faq - '.config('app.name') }}</title>
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
    ['title' => 'FAQ']
])
!!}


@endsection

@section('content')
    <main>
        <section class="breadcrumb-section py-3 text-white text-center">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-12">
                        <h1 class="fs-2">{{__('FAQ')}}</h1>
                        <nav class="breadcrumb-nav">
                            <ol class="breadcrumb mb-0 justify-content-center">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Home')}}</a></li>
                                <li class="breadcrumb-item active">{{__('FAQ')}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="divider">
            <span class="dot"></span>
            <span class="mid"></span>
            <span class="dot"></span>
        </section>
        <section class="py-3 text-white">
            <div class="container">
                @forelse($record as $value)
                <div class="row py-3">
                    <div class="col-lg-12">
                        <a href="{{route('faq-details',$value->slug)}}" class="faq-wrap">
                            <div class="exchange-wrap bg-theme">
                            <h2 class="fs-4">{{$value->title}}</h2>
                            {{ \Illuminate\Support\Str::limit($value->description, 300, $end='..') }}
                            <p class="posted-on mb-0">Posted by: {{Config::get('app.name')}}</p>
                            <p class="posted-on mb-0">Updated on {{$value->created_at}}</p>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                <div class="row text-center">
                    <div class="col-lg-12">
                        <div class="alert-custom alert-custom-error">
                            <h2 class="mb-0 fs-5">{{__('No result found!')}}</h2>
                        </div>
                    </div>
                </div>
                @endforelse
                {{ $record->onEachSide(6)->links('frontend.layouts.paginators.reviews') }}
            </div>
        </section>
    </main>
@endsection
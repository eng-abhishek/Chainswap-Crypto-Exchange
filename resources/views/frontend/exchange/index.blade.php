@extends('frontend.layouts.app')

@section('meta_detail')
<title>{{ !empty($seoData->title) ? $seoData->title : 'Exchange - '.config('app.name') }}</title>
<meta name="title" content="{{ !empty($seoData->meta_title) ? $seoData->meta_title : 'Chain Swap'}}">
<meta name="description" content="{{ !empty($seoData->meta_des) ? $seoData->meta_des : 'chainswap.io - Exchange between BTC, ETH, BCH, XMR and 300+ other cryptocurrencies. The best exchange rates.'}}">
<meta name="keywords" content="{{$seoData->meta_keyword ?? 'BTC, ETH, BCH, XMR, Btc to xmr swap,xmr to btc swap,btc to xmr,xmr to btc,crypto swap 2023,nokyc crypto swap,nokyc crypto,privacy swap crypto,best crypto swap,best crypto exchange,btc to xmr exchange,zcash to xmr exchange,btc to zach exchangecrypto,crypto currency,binance us,crypto currency prices,crypto prices,crypto market,crypto wallet,altcoin,best crypto to buy now,trade crypto,whats crypto,best crypto wallet,crypto exchange,cryptocurrency market,crypto coin'}}">
<meta name="author" content="Chain Swap">
<link rel="canonical" href="{{request()->fullUrl()}}"/>
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

@if(!is_null($coin_pairs->previousPageUrl()))
<link rel="prev" href="{{preg_replace('/\?'.$coin_pairs->getPageName().'=[1]$/','', $coin_pairs->appends(['filters' => request('filters'), 'category' => request('category'), 'tag' => request('tag')])->previousPageUrl())}}" />
@endif

@if(!is_null($coin_pairs->nextPageUrl()))
<link rel="next" href="{{preg_replace('/\?'.$coin_pairs->getPageName().'=[1]$/','', $coin_pairs->appends(['filters' => request('filters'), 'category' => request('category'), 'tag' => request('tag')])->nextPageUrl())}}" />
@endif

{!! organization_jsonld() !!}

{!! breadcrumbs_jsonld([
    ['url' => route('home'), 'title' => 'Home'],
    ['title' => 'Exchange Tutorials']
    ]) 
    !!}

    @endsection

    @section('content')

    <main>
        <section class="breadcrumb-section py-3 text-white text-center">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-12">
                        <h1 class="fs-2">{{__('Exchange')}}</h1>
                        <nav class="breadcrumb-nav">
                            <ol class="breadcrumb mb-0 justify-content-center">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Home')}}</a></li>
                                <li class="breadcrumb-item active">{{__('Exchange')}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-3">
            <div class="container">
                <div class="row">
                    @foreach($coin_pairs as $pairs)
                    <div class="col-lg-4 col-md-6 py-3">
                        <div class="blog-wrap">
                            <div class="blog-image">
                                <a href="{{route('exchange-detail',$pairs->slug)}}" title="">
                                    <div class="exchange-tutorials-image">
                                        <div class="row align-items-center justify-content-between text-center h-100">
                                            <div class="col-5">
                                                <img src="{{$pairs->get_from_symbol->image_url}}" alt="" data-bs-toggle="tooltip" data-bs-original-title="{{$pairs->get_from_symbol->symbol}}">
                                                <p class="text-truncate mb-0" data-bs-toggle="tooltip" data-bs-original-title="{{$pairs->get_from_symbol->coin_name}}">{{$pairs->get_from_symbol->coin_name}}</p>
                                            </div>
                                            <div class="col-5">
                                                <img src="{{$pairs->get_to_symbol->image_url}}" alt="" data-bs-toggle="tooltip" data-bs-original-title="{{$pairs->get_to_symbol->symbol}}">
                                                <p class="text-truncate mb-0" data-bs-toggle="tooltip" data-bs-original-title="{{$pairs->get_to_symbol->coin_name}}">{{$pairs->get_to_symbol->coin_name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="blog-content">
                                
                                <h2 class="fs-5"><a href="{{route('exchange-detail',$pairs->slug)}}" title="Exchange {{$pairs->get_from_symbol->coin_name}} to {{$pairs->get_to_symbol->coin_name}}">
                                    {{__('Exchange from_coin_name to to_coin_name',['from_coin_name'=>$pairs->get_from_symbol->coin_name,'to_coin_name'=>$pairs->get_to_symbol->coin_name])}}
                                </a></h2>

                                <p>{{__('Exchange from_coin_name to to_coin_name instantly, without registration and hidden fees. Full automation, maximum speed and the best exchange rates.',['from_coin_name'=>$pairs->get_from_symbol->coin_name,'to_coin_name'=>$pairs->get_to_symbol->coin_name])}}</p>
                                
                                <div class="blog-author">
                                    <img src="{{asset('assets/frontend/images/logo/favicon-32x32.png')}}" class="img-fluid" alt=""> {{__('ChainSwap')}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row pt-3">
                    <div class="col-lg-12">
                        {{ $coin_pairs->links() }}
                        {{--<nav class="pagination-custom">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link"><i class="fa-regular fa-angle-left"></i></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fa-regular fa-angle-right"></i></a>
                                </li>
                            </ul>
                        </nav>--}}
                    </div>
                </div>
            </div>
        </section>
    </main>
    @endsection
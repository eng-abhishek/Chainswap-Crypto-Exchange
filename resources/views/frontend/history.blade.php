@extends('frontend.layouts.app')
@section('meta_detail')
<title>{{ !empty($seoData->title) ? $seoData->title : 'History - '.config('app.name') }}</title>
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
    ['title' => 'Exchange History']
]) 
!!}

@endsection

@section('content')
<main>
	<section class="breadcrumb-section py-3 text-white text-center">
		<div class="container">
			<div class="row justify-content-center align-items-center">
				<div class="col-lg-12">
					<h1 class="fs-2">{{__('Exchange History')}}</h1>
					<nav class="breadcrumb-nav">
						<ol class="breadcrumb mb-0 justify-content-center">
							<li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Home')}}</a></li>
							<li class="breadcrumb-item active">{{__('Exchange History')}}</li>
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

	<section class="py-3">
		<div class="container">
			<div class="row justify-content-center align-items-center">
				<div class="col-lg-12">
				 @if(!empty($record))
                 @if(count($record) > 0)
					<div class="exchange-history-header d-lg-block d-none">
						<div class="row text-center">
							<div class="col-lg-2">
								<p class="mb-0">Created At</p>
							</div>
							<div class="col-lg-6">
								<div class="row">
									<div class="col-lg-6">
										<p class="mb-0">From</p>
									</div>
									<div class="col-lg-6">
										<p class="mb-0">To</p>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<p class="mb-0">Status</p>
							</div>
							<div class="col-lg-2">
								<p class="mb-0">View</p>
							</div>
						</div>
					</div>
					@endif
					@forelse($record as $value)
					<div class="exchange-history-body">
						<div class="row align-items-center">
							<div class="col-lg-2 col-auto py-lg-0 py-3 text-lg-center text-start order-lg-0 order-0 ">
								<p class="small mb-0">{{$value->created_at}}</p>
							</div>
							<div class="col-lg-6 col-12 py-lg-0 py-3 order-lg-1 order-2">
								<div class="row">
									<div class="col-lg-6 col-5 text-lg-center text-start">
										<div class="exchange-coin d-inline-block" data-bs-toggle="tooltip" data-bs-original-title="{{$value->get_from_symbol->coin_name}}">
											<img src="{{$value->get_from_symbol->image_url}}" alt="" class="coin-image">
											<span class="coin-ticker text-truncate">{{$value->from_currency}}</span>
										</div>
									</div>
									<div class="col-lg-6 col-2 d-lg-none d-block text-center">
										<i class="fa-regular fa-arrow-right-long"></i>
									</div>
									<div class="col-lg-6 col-5 text-lg-center text-end">
										<div class="exchange-coin d-inline-block" data-bs-toggle="tooltip" data-bs-original-title="{{$value->get_to_symbol->coin_name}}">
											<img src="{{$value->get_to_symbol->image_url}}" alt="" class="coin-image">
											<span class="coin-ticker text-truncate">{{$value->to_currency}}</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-auto flex-grow-1 py-lg-0 py-3 text-lg-center text-end order-lg-2 order-1">
								
								@if($value->state == 'Waiting')
								
								<p class="mb-0 status-pending"><i class="fa-light fa-hourglass-half me-2"></i>{{$value->state}}</p>

                                @elseif($value->state == 'Processing')
                                
                                <p class="mb-0 status-processing"><i class="fa-light fa-hourglass-half me-2"></i>{{$value->state}}</p>

                                @elseif($value->state == 'Completed')

                                <p class="mb-0 status-completed"><i class="fa-light fa-hourglass-half me-2"></i>{{$value->state}}</p>

                                @elseif($value->state == 'Cancelled')

                                <p class="mb-0 status-expired"><i class="fa-light fa-hourglass-half me-2"></i>{{$value->state}}</p>
                                
                                @elseif($value->state == 'Overdue')

                                <p class="mb-0 status-expired"><i class="fa-light fa-hourglass-half me-2"></i>Cancelled</p>
                                
                                @else

                                <p class="mb-0 status-pending"><i class="fa-light fa-hourglass-half me-2"></i>{{$value->state}}</p>

                                @endif

							</div>
							<div class="col-lg-2 py-lg-0 py-3 text-center order-lg-3 order-3">
								<a href="{{route('order', $value->orderid)}}" class="btn btn-custom rounded-pill w-100">View</a>
							</div>
						</div>
					</div>
					@empty
					<div class="row text-center">
						<div class="col-lg-12">
							<div class="alert-custom alert-custom-error">
								<h2 class="mb-0 fs-5 text-white">{{__('No result found!')}}</h2>
							</div>
						</div>
					</div>
					@endif
					@else
					<div class="row text-center">
						<div class="col-lg-12">
							<div class="alert-custom alert-custom-error">
								<h2 class="mb-0 fs-5 text-white">{{__('No result found!')}}</h2>
							</div>
						</div>
					</div>
                    @endif
				</div>
			</div>
			{{ $record->onEachSide(6)->links('frontend.layouts.paginators.reviews') }}
		</div>
	</section>
</main>
@endsection
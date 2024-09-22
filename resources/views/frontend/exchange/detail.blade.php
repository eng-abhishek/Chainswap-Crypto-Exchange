@extends('frontend.layouts.app')

@section('meta_detail')

@php

$title = ( !empty($seoData->title) ? $seoData->title : __('from_coin_symbol to to_coin_symbol swap Exchange from_coin_name to to_coin_name anonymously Chainswap',['from_coin_symbol'=>$record->get_from_symbol->symbol,'to_coin_symbol'=>$record->get_to_symbol->symbol,'from_coin_name'=>$record->get_from_symbol->coin_name,'to_coin_name'=>$record->get_to_symbol->coin_name]) );


$meta_title = ( !empty($record->meta_title) ? $record->meta_title : (!empty($seoData->meta_title) ? $seoData->meta_title :  __('from_coin_symbol to to_coin_symbol swap Exchange from_coin_name to to_coin_name anonymously Chainswap',['from_coin_symbol'=>$record->get_from_symbol->symbol,'to_coin_symbol'=>$record->get_to_symbol->symbol,'from_coin_name'=>$record->get_from_symbol->coin_name,'to_coin_name'=>$record->get_to_symbol->coin_name]) ));


$meta_description = ( !empty($record->meta_description) ? $record->meta_description : (!empty($seoData->meta_description) ? $seoData->meta_description  : __('Quickly and easily swap from_coin_name to to_coin_name without registration. Anonymous from_coin_symbol to to_coin_symbol Exchange online ➤ Best from_coin_symbol to to_coin_symbol exchange rate on Chainswap.io.',['from_coin_symbol'=>$record->get_from_symbol->symbol,'to_coin_symbol'=>$record->get_to_symbol->symbol,'from_coin_name'=>$record->get_from_symbol->coin_name,'to_coin_name'=>$record->get_to_symbol->coin_name])));


@endphp

<title>{{$title}}</title>

<meta name="title" content="{{$meta_title}}">

<meta name="description" content="{{$meta_description}}">

<meta name="keywords" content="{{$seoData->meta_keyword ?? __('BTC, ETH, BCH, XMR, Btc to xmr swap,xmr to btc swap,btc to xmr,xmr to btc,crypto swap current_date ,nokyc crypto swap,nokyc crypto,privacy swap crypto,best crypto swap,best crypto exchange,btc to xmr exchange,zcash to xmr exchange,btc to zach exchangecrypto,crypto currency,binance us,crypto currency prices,crypto prices,crypto market,crypto wallet,altcoin,best crypto to buy now,trade crypto,whats crypto,best crypto wallet,crypto exchange,cryptocurrency market,crypto coin',['current_date'=> date('Y')])}}">

<meta name="author" content="Chain Swap">
<link rel="canonical" href="{{url()->current()}}"/>
<meta property="og:type" content="website" />

<meta property="og:title" content="{{$meta_title}}" />

<meta property="og:description" content="{{$meta_description}}" />

<meta property="og:url" content="{{url()->current()}}"/>
<meta property="og:image" content="{{asset('assets/frontend/images/logo/featured-crypto-exchange.png')}}" />
<meta property="og:image:width" content="850">
<meta property="og:image:height" content="560">
<meta property="og:site_name" content="chainswap" />
<meta property="og:locale" content="en" />

<meta property="twitter:url" content="{{url()->current()}}">

<meta property="twitter:image" content="{{asset('assets/frontend/images/logo/featured-crypto-exchange.png')}}">

<meta property="twitter:title" content="{{$meta_title}}">

<meta property="twitter:description" content="{{$meta_description}}">

<meta name="twitter:description" content="{{$meta_description}}">

<meta name="twitter:image" content="{{asset('assets/frontend/images/logo/featured-crypto-exchange.png')}}">

<meta name="twitter:card" value="summary_large_image">
<meta name="twitter:site" value="@chainswap">

{!! organization_jsonld() !!}

{!! breadcrumbs_jsonld([
	['url' => route('home'), 'title' => 'Home'],
	['url' => route('exchange'), 'title' => 'Exchange'],
	['title' => 'Exchange '.strtoupper($record->get_from_symbol->symbol).' to '.strtoupper($record->get_to_symbol->symbol).' anonymously - Chainswap',
	]
	]) 
	!!}

	@endsection
	@section('content')

	<main>
		<section class="breadcrumb-section py-3 text-white text-center">
			<div class="container">
				<div class="row justify-content-center align-items-center">
					<div class="col-lg-12">
						<h1 class="fs-2">{{__('from_coin to to_coin Swap',['from_coin'=>$from_coin,'to_coin'=>$to_coin])}}</h1>
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
				<div class="row justify-content-center">
					<div class="col-lg-8 col-md-10">
						<div class="exchange-wrap bg-theme">
							<h2 class="fs-5 text-white">{{__('Start exchange')}}</h2>
							<form action="{{route('create-exchange')}}" method="post" id="exchangeForm">
								@csrf
								@include('frontend.layouts.partials.alert-messages')
								<div class="row">
									<div class="col-lg-12 py-1">
										<div class="exchange-wrap-inner bg-theme">
											<div class="row">
												<div class="col-lg-12">
													<label for="you_send" class="small">{{__('You Send')}}:</label>
													<input type="checkbox" id="exchange_from" class="d-none">
													<div class="row">
														<div class="col-lg-8">
															<div id="from_amount_id" class="input-busy">
																<input type="text" name="from_amount" id="you_send" class="form-control form-amount from_amount" placeholder="{{__('Enter Amount')}}" value="1">
																@error('from_amount')
																<span class="small invalid-feedback d-block">{{ $message }}</span>
																@enderror
															</div>
														</div>
														<div class="col-lg-4 mt-lg-0 mt-3 ">
															<label id="from-main-label" for="exchange_from" class="exchange-label exchange-coin" data-bs-toggle="tooltip" data-bs-original-title="{{$record->get_from_symbol->coin_name}}">
																@if($from_coin)
																<img id="from-main-image" src="{{asset('assets/frontend/images/coins/'.strtolower($from_coin).'.png')}}" alt="" class="coin-image">
																<span id="from-main-symbol" class="coin-ticker text-truncate">{{$from_coin}}</span>
																<input type="hidden" value="{{$from_coin}}" name="currency_from" class="currency_from">
																@else

																<img id="from-main-image" src="{{asset('assets/frontend/images/coins/btc.png')}}" alt="" class="coin-image">
																<span id="from-main-symbol" class="coin-ticker text-truncate">BTC</span>
																<input type="hidden" value="BTC" name="currency_from" class="currency_from">

																@endif

															</label>
														</div>
														<div class="col-lg-12">
															<div class="exchange-list from-exchange-section">
																<div class="exchange-list-inner bg-theme z-top">
																	<div class="row">
																		<div class="col-lg-12 text-end pb-3">
																			<label for="exchange_from" class="close-list"><i class="fa-regular fa-xmark-large"></i></label>
																		</div>
																		<div class="col-lg-12 pb-3">
																			<div class="form-search">
																				<i class="fa-regular fa-magnifying-glass"></i>
																				<input type="search" name="" id="search_from" class="form-control form-custom" placeholder="{{__('Type a cryptocurrency or ticker')}}">
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-12">

																			<div class="">
																				<ul class="row list-unstyled exchange-coin-list mb-0" id="exchange_from_list">

																					@foreach($coins as $key => $value)
																					<li class="col-lg-4 col-md-6 py-lg-3 py-2">
																						<a href="#" onclick="return getFromCoin({{$value->id}})" title="{{$value->coin_name}}" data-symbol="{{strtoupper($value->symbol)}}" class="exchange-coin coin_from{{$value->id}} from_coin_symbol{{strtoupper($value->symbol)}}">
																							<img src="{{$value->image_url}}" alt="{{$value->symbol}}" class="coin-image coin_from_img{{$value->id}}">
																							<span class="coin-ticker text-truncate">{{$value->coin_name}} ({{$value->symbol}})</span>
																						</a>
																					</li>
																					@endforeach

																					<li class="col-lg-12 no-result-from" style="display: none;">
																						<a href="javascript:void(0)" title="Not Found" class="exchange-coin">
																							<img src="{{asset('assets/frontend/images/coins/not-found.png')}}" alt="" class="coin-image">
																							<span class="coin-name">{{__('Not Found')}}</span></a>
																						</li>

																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<div id="send_network"> </div>

													<div class="col-lg-12 text-center py-2">
														<div class="swap-coin-wrap">
															<a href="javascript:void(0)" onclick="swapcoin()"><span class="swap-coin"><i class="fa-light fa-arrow-up-arrow-down"></i></span></a>
														</div>
													</div>

													<div class="col-lg-12">
														<label for="you_get" class="small">{{__('You Get')}}:</label>
														<input type="checkbox" id="exchange_to" class="d-none">
														<div class="row">

															<div class="col-lg-8">
																<div id="to_amount_id" class="input-busy">
																	<input type="text" name="to_amount" id="you_get" class="form-control form-amount" placeholder="{{__('Enter Amount')}}" value="0.0025">
																</div>
															</div>

															<div class="col-lg-4 mt-lg-0 mt-3">
																<label for="exchange_to" class="exchange-label exchange-coin" id="to-main-label" data-bs-toggle="tooltip" data-bs-original-title="{{$record->get_to_symbol->coin_name}}">

																	@if($to_coin)
																	<img id="to-main-image" src="{{asset('assets/frontend/images/coins/'.strtolower($to_coin).'.png')}}" alt="" class="coin-image">
																	<span id="to-main-symbol" class="coin-ticker text-truncate">{{$to_coin}}</span>
																	<input type="hidden" value="{{$to_coin}}" name="currency_to" class="currency_to">
																	@else
																	<img src="{{asset('assets/frontend/images/coins/xmr.png')}}" id="to-main-image" alt="" class="coin-image">
																	<span id="to-main-symbol" class="coin-ticker text-truncate">XMR</span>
																	<input type="hidden" value="XMR" name="currency_to" class="currency_to">
																	@endif
																</label>
															</div>

															<div id="received_network"> </div>

															<div class="col-lg-12 col-md-12">
																<div class="exchange-info">
																	<p>{{__('Exchange rate')}}</p>
																	<h3 class="mb-0 coin_pair_rate">1 BTC = XX.XXXXX XMR</h3>
																</div>
															</div>

															<div class="col-lg-12 col-md-12 pt-4">
																<div class="row">

																	<div class="col-md-6 d-none">
																		<div class="form-check">
																			<input class="form-check-input" name="rate_mode" value="flat" type="radio" id="flexRadioDefault1" checked>
																			<label class="form-check-label" for="flexRadioDefault1">
																				{{__('Limit Less')}}
																			</label>
																		</div>
																	</div>

																	<div class="col-md-6">
																		<div class="form-check dynamic_rate d-none">
																			<input class="form-check-input" type="radio" name="rate_mode" value="dynamic" id="flexRadioDefault2">
																			<label class="form-check-label" for="flexRadioDefault2">
																				{{__('Dynamic Rate')}}
																			</label>
																		</div>
																	</div>

																</div>
															</div>

															<div class="col-lg-12">
																<div class="exchange-list to-exchange-section">
																	<div class="exchange-list-inner bg-theme z-bottom">

																		<div class="row">
																			<div class="col-lg-12 text-end pb-3">
																				<label for="exchange_to" class="close-list"><i class="fa-regular fa-xmark-large"></i></label>
																			</div>
																			<div class="col-lg-12 pb-3">
																				<div class="form-search">
																					<i class="fa-regular fa-magnifying-glass"></i>
																					<input type="search" name="" id="search_to" class="form-control form-custom" placeholder="{{__('Type a cryptocurrency or ticker')}}">
																				</div>
																			</div>
																		</div>

																		<div class="row">
																			<div class="col-lg-12">
																				<div class="">
																					<ul class="row list-unstyled exchange-coin-list mb-0" id="exchange_to_list">

																						@foreach($coins as $key => $value)
																						<li class="col-lg-4 col-md-6 py-lg-3 py-2">
																							<a href="#" onclick="return getToCoin({{$value->id}})" title="{{$value->coin_name}}" data-symbol="{{strtoupper($value->symbol)}}" class="exchange-coin coin_to{{$value->id}} to_coin_symbol{{strtoupper($value->symbol)}}">
																								<img src="{{$value->image_url}}" alt="{{$value->symbol}}" class="coin-image coin_to_img{{$value->id}}">
																								<span class="coin-ticker text-truncate">{{$value->coin_name}} ({{$value->symbol}})</span>
																							</a>
																						</li>
																						@endforeach

																						<li class="col-lg-12 no-result-to" style="display: none;">
																							<a href="javascript:void(0)" title="Not Found" class="exchange-coin">
																								<img src="assets/images/coins/not-found.png" alt="">
																								<span class="coin-name">{{__('Not Found')}}</span>
																							</a>
																						</li>

																					</ul>
																				</div>
																			</div>
																		</div>

																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-12 py-1">    
											<div class="exchange-wrap-inner bg-theme">
												<div id="to_address_busy_input" class="input-busy">
													<input type="text" name="to_address" id="to_address" class="form-control form-amount" placeholder="Enter XMR Address">
												</div>
												{{--<span class="small invalid-feedback d-block">Enter valid XMR Address</span>--}}

												@error('to_address')
												<span class="small invalid-feedback d-block">{{ $message }}</span>
												@enderror

											</div>
										</div>

										<div class="col-lg-12 py-1">            
											<div class="exchange-wrap-inner bg-theme">
												<div class="">
													<input type="text" name="refund_address" id="refund_address" class="form-control form-amount" placeholder="{{__('Enter Refund Address')}}">
												</div>                  
												@error('refund_address')
												<span class="small invalid-feedback d-block">{{ $message }}</span>
												@enderror
											</div>
										</div>

										<div class="col-lg-12 py-1">
											<button class="btn btn-custom btn-lg w-100 text-uppercase">{{__('Exchange')}}</button>
										</div>

										<div class="row">
											<div class="col-lg-12">
												<div class="alert-custom alert-custom-success">
													<p class="mb-0">{{__('Exchange_notes')}}</p>
												</div>
											</div>
										</div>

									</div>
								</form>
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
			<section class="py-3 text-white">
				<div class="container">
					<div class="row py-5">
						<div class="col-xxl-12 col-lg-12 col-12">
							<div class="row text-center">
								<div class="col-xxl-12 col-lg-12 col-12">
									<h2>{{__('Exchange from_coin to to_coin', ['from_coin' => $record->get_from_symbol->coin_name,'to_coin'=>$record->get_to_symbol->coin_name])}}
									</h2>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-5 py-3">
									<div class="content-wrap h-100">
										<h3 class="mb-3">{{__('Exchange in 3 steps')}}</h3>
										<ul class="list-unstyled mb-0 list-steps">
											<li><span>1</span>
												{{__('Enter the desired amount of from_coin and write your wallet address to receive currency.',['from_coin'=>$record->get_from_symbol->coin_name])}}</li>
												<li><span>2</span>{{__('Click the "Exchange now" button and you will be taken inside your order.')}}</li>
												<li><span>3</span>
													{{__('Send from_coin to the address from your order, after the required network confirmation, to_coin will be sent instantly.',['from_coin'=>$record->get_from_symbol->coin_name,'to_coin'=>$record->get_to_symbol->coin_name])}}
												</li>
											</ul>
										</div>
									</div>
									<div class="col-lg-7 py-3">
										<div class="content-wrap h-100">
											<h3 class="mb-3">{{__('What do you need to know?')}}</h3>
											<ul class="list-unstyled mb-0 list-desc">
												<li>
													<div class="exchange-tutorials-icon">
														<img src="{{asset('assets/frontend/images/icons/bolt.png')}}" alt="">
													</div>
													<span>
														{{__('You need 2 confirmations of the from_coin blockchain for the exchange',['from_coin'=>$record->get_from_symbol->coin_name])}}
													</span>
												</li>
												<li>
													<div class="exchange-tutorials-icon">
														<img src="{{asset('assets/frontend/images/icons/id.png')}}" alt="">
													</div>
													<span>{{__('When sending to_coin Payment ID, you do not need to enter, we use integrated wallets',[$record->get_to_symbol->coin_name])}}</span>
												</li>
												<li>
													<div class="exchange-tutorials-icon">
														<img src="{{asset('assets/frontend/images/icons/btc.png')}}" alt="">
													</div>
													<span>{{__('The speed of confirmation of a to_coin transaction depends on the level of congestion of the to_coin blockchain network, read more in our',['to_coin'=>$record->get_to_symbol->coin_name])}}
														<a href="{{route('home')}}" class="custom-link">{{__('article')}}</a></span>
													</li>
												</ul>
											</div>
										</div>
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

					<section>
						<!-------- Overview Section --->
						@if(!empty($record->from_coin_des) && !empty($record->to_coin_des))
						<div class="container overview-container">
							<div class="row">
								<div class="col-md-12">
									<h1>Overview</h1>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12">
									<h3>{{__('About')}} {{$record->get_from_symbol->coin_name}} ({{$record->get_from_symbol->symbol}})</h3>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									{!! $record->from_coin_des !!}
								</div>

								<div class="row">
									<div class="col-md-12">
										<h4>{{__('Resources')}}</h4>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										@if($record->from_coin_whitepaper_url)
										<a href="{{$record->from_coin_whitepaper_url}}" target="_blank">
											<button id="whiteppr-btn">
												<img src="{{asset('assets/frontend/images/icons/whiteppr-ico.png')}}" class="img-fluid">
												{{__('Whitepaper')}}
											</button>
										</a>
										@endif
										@if($record->from_coin_officialsite_url)
										<a href="{{$record->from_coin_officialsite_url}}" target="_blank">
											<button id="officialweb-btn">
												<img src="{{asset('assets/frontend/images/icons/web.png')}}" class="img-fluid">
												{{__('Official website')}}
											</button>
										</a>
										@endif
									</div>
								</div>

							</div>
							<div class="row">
								<div class="col-md-12">
									<h3>About {{$record->get_to_symbol->coin_name}} ({{$record->get_to_symbol->symbol}})</h3>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									{!! $record->to_coin_des !!}
								</div>

								<div class="row">
									<div class="col-md-12">
										<h4>{{__('Resources')}}</h4>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										@if($record->to_coin_whitepaper_url)
										<a href="{{$record->to_coin_whitepaper_url}}" target="_blank">
											<button id="whiteppr-btn">
												<img src="{{asset('assets/frontend/images/icons/whiteppr-ico.png')}}" class="img-fluid">
												{{__('Whitepaper')}}
											</button>
										</a>
										@endif

										@if($record->to_coin_officialsite_url)
										<a href="{{$record->to_coin_officialsite_url}}">
											<button id="officialweb-btn">
												<img src="{{asset('assets/frontend/images/icons/web.png')}}" class="img-fluid">
												{{__('Official website')}}
											</button>
										</a>
										@endif

									</div>
								</div>
							</div>
						</div>
						@endif
						<!-------- End Overview Section --->

						<!-------- Market Info Section ----->

						<div class="container market-container">
							<div class="row">
								<div class="col-md-12">
									<h1>{{__('Market')}}</h1>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12">
									<h3>{{$record->get_from_symbol->coin_name}} ({{$record->get_from_symbol->symbol}})</h3>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<h6>{{__('MARKET CAP')}}</h6>
									<p>{{$from_marketCap}} USD</p>
								</div>

								<div class="col-md-3">
									<h6>{{__('VOLUME (24H)')}}</h6>
									<p>{{$from_24hVolume}} USD</p>
								</div>

								<div class="col-md-3">
									<h6>{{__('PRICE')}}</h6>
									<p>{{$from_price}} USD</p>
								</div>

								<div class="col-md-3">
									<h6>{{__('HIGH (24H)')}}</h6>
									<p>{{$from_high_rate}} USD</p>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<h6>{{__('LOW (24H)')}}</h6>
									<p>{{$from_low_rate}} USD</p>
								</div>
							</div>
						</div>


						<div class="container market-container">
							<hr>
							<div class="row">
								<div class="col-md-12">
									<h3>{{$record->get_to_symbol->coin_name}} ({{$record->get_to_symbol->symbol}})</h3>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<h6>{{__('MARKET CAP')}}</h6>
									<p>{{$to_marketCap}} USD</p>
								</div>

								<div class="col-md-3">
									<h6>{{__('VOLUME (24H)')}}</h6>
									<p>{{$to_24hVolume}} USD</p>
								</div>

								<div class="col-md-3">
									<h6>{{__('PRICE')}}</h6>
									<p>{{$to_price}} USD</p>
								</div>

								<div class="col-md-3">
									<h6>{{__('HIGH (24H)')}}</h6>
									<p>{{$to_high_rate}} USD</p>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<h6>{{__('LOW (24H)')}}</h6>
									<p>{{$to_low_rate}} USD</p>
								</div>
							</div>
						</div>

						<!-- Conversion tables -->

						<div class="container conversion-container">

							<div class="row">
								<div class="col-md-12">
									<h1>{{__('Conversion tables')}}</h1>
								</div>
							</div>
							<hr>
							<div class="row">

								<div class="col-md-6">
									<div class="container table-container">
										<h2>{{__('from_coin to to_coin Conversion Table',['from_coin'=>$record->get_from_symbol->symbol,'to_coin'=>$record->get_to_symbol->symbol])}}</h2>
										<table class="table">
											<thead>
												<tr>
													<th scope="col">{{__('Amount')}} ({{$record->get_from_symbol->symbol}})</th>
													<th scope="col">{{__('Amount')}} ({{$record->get_to_symbol->symbol}})</th>
												</tr>
											</thead>
											<tbody>
												@if(count($from_coin_rate_calculater) > 0)
												@foreach($from_coin_rate_calculater['rate_calculater'] as $key=>$value)
												<tr>
													<td>{{$value['amount']}} {{$record->get_from_symbol->symbol}}</td>
													<td>{{$value['amount_you_get']}}  {{$record->get_to_symbol->symbol}}</td>
												</tr>
												@endforeach
												@endif
											</tbody>
										</table>
									</div>
								</div>

								<div class="col-md-6">
									<div class="container table-container">
										<h2>{{__('to_coin to from_coin Conversion Table',['to_coin'=>$record->get_to_symbol->symbol,'from_coin'=>$record->get_from_symbol->symbol])}}</h2>
										<table class="table">
											<thead class="thead-dark">
												<tr>
													<th scope="col">{{__('Amount')}} ({{$record->get_to_symbol->symbol}})</th>
													<th scope="col">{{__('Amount')}} ({{$record->get_from_symbol->symbol}})</th>
												</tr>
											</thead>
											<tbody>
												@if(count($to_coin_rate_calculater) > 0)
												@foreach($to_coin_rate_calculater['rate_calculater'] as $key => $value)
												<tr>
													<td>{{$value['amount']}} {{$record->get_to_symbol->symbol}}</td>
													<td>{{$value['amount_you_get']}}  {{$record->get_from_symbol->symbol}}</td>
												</tr>
												@endforeach
												@endif
											</tbody>
										</table>
									</div>
								</div>

							</div>
							<hr>
							<div class="row">
								<div class="col-md-12">
									<h6>{{__('Last update')}}: {{date('M')}} {{date('d, Y')}} at {{date('h:i A')}}</h6>
								</div>
							</div>
							<hr>
						</div>

						<!-- End Conversion tables -->

						<!--- End Market Info---->

						<div class="container About-coin-container">
							<div class="row">
								<div class="col-md-6">
									<div class="container mt-4 table-container">
										<h2>{{__('About')}} {{$record->get_from_symbol->coin_name}}</h2>

										<table class="table">
											<tbody>
												<tr>
													<th scope="row">{{__('Name')}}</th>
													<td>{{$record->get_from_symbol->coin_name ?? ''}}</td>
												</tr>
												<tr>
													<th scope="row">{{__('Symbol')}}</th>
													<td>{{$record->get_from_symbol->symbol ?? ''}}</td>
												</tr>
												<tr>
													<th scope="row">{{__('Circulating supply')}}</th>
													<td>{{isset($from_coins_supply_info->circulating) ? $from_coins_supply_info->circulating : 'NaN'}} USD</td>
												</tr>
												<tr>
													<th scope="row">{{__('Max supply')}}</th>
													<td>{{isset($from_coins_supply_info->max) ? $from_coins_supply_info->max : 'NaN'}} USD</td>
												</tr>
												<tr>
													<th scope="row">{{__('CMC rank')}}</th>
													<td>{{$from_rank}}</td>
												</tr>
												<tr>
													<th scope="row">{{__('Volume 24h')}}</th>
													<td>{{$from_24hVolume}} USD</td>
												</tr>
												<tr>
													<th scope="row">{{__('HIGH (24H)')}}</th>
													<td>{{$from_high_rate}} USD</td>
												</tr>
												<tr>
													<th scope="row">{{__('LOW (24H)')}}</th>
													<td>{{$from_low_rate}} USD</td>
												</tr>
												<tr>
													<th scope="row">{{__('Market Capital')}}</th>
													<td>{{$from_marketCap}} USD</td>
												</tr>
												<tr>
													<th scope="row">{{__('Full Diluted Market Capital')}}</th>
													<td>{{$from_fullyDilutedMarketCap}} USD</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>

								<div class="col-md-6">
									<div class="container mt-4 table-container">
										<h2>{{__('About')}} {{$record->get_to_symbol->coin_name}}</h2>

										<table class="table">

											<tbody>
												<tr>
													<th scope="row">{{__('Name')}}</th>
													<td>{{$record->get_to_symbol->coin_name ?? ''}}</td>
												</tr>
												<tr>
													<th scope="row">{{__('Symbol')}}</th>
													<td>{{$record->get_to_symbol->symbol ?? ''}}</td>
												</tr>
												<tr>
													<th scope="row">{{__('Circulating supply')}}</th>
													<td>{{isset($to_coins_supply_info->circulating) ? $to_coins_supply_info->circulating : 'NaN' }} USD</td>
												</tr>
												<tr>
													<th scope="row">{{__('Max supply')}}</th>
													<td>{{ isset($to_coins_supply_info->max) ? $to_coins_supply_info->max : 'NaN' }} USD</td>
												</tr>
												<tr>
													<th scope="row">{{__('CMC rank')}}</th>
													<td>{{$to_rank}}</td>
												</tr>
												<tr>
													<th scope="row">{{__('Volume 24h')}}</th>
													<td>{{$to_24hVolume}} USD</td>
												</tr>
												<tr>
													<th scope="row">{{__('HIGH (24H)')}}</th>
													<td>{{$to_high_rate}} USD</td>
												</tr>
												<tr>
													<th scope="row">{{__('LOW (24H)')}}</th>
													<td>{{$to_low_rate}} USD</td>
												</tr>
												<tr>
													<th scope="row">{{__('Market Capital')}}</th>
													<td>{{$to_marketCap}} USD</td>
												</tr>
												<tr>
													<th scope="row">{{__('Full Diluted Market Capital')}}</th>
													<td>{{$to_fullyDilutedMarketCap}} USD</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

						<div class="container coin-cal-container">
							<div class="row">
								<div class="col-md-12">
									<h1>{{__('from_coin to to_coin calculator',['from_coin'=>$record->get_from_symbol->symbol,'to_coin'=>$record->get_to_symbol->symbol])}}</h1>
								</div>
							</div>

							<div class="row">
								<p>
									{{__('Investors and hustlers always crunch the numbers before diving into digital deals. Need to know the scoop on your from_coin to to_coin move? Glide over to chainswap.io converter!',['from_coin'=>$record->get_from_symbol->symbol,'to_coin'=>$record->get_to_symbol->symbol])}}
									<br> <br>
									{{__('With its sleek interface, you can swap from_coin for to_coin in a snap, pinning down those buy and sell figures. Don\'t sweat the math—this tool\'s got your back for lightning fast profitability predictions!',['from_coin'=>$record->get_from_symbol->symbol,'to_coin'=>$record->get_to_symbol->symbol])}}
								</p>
							</div>

							<div class="row">
								<div class="col-md-12">
									<h3>
										{{__('How to Convert from_coin to to_coin ?',['from_coin'=>$record->get_from_symbol->symbol,'to_coin'=>$record->get_to_symbol->symbol])}}
									</h3>
								</div>
							</div>

							<div class="row">
								<p>
									{{__('Transforming your from_coin_name (from_coin_symbol) into to_coin_name (to_coin_symbol) is a breeze with our online exchange platform. Just follow these quick and easy steps to make the switch hassle-free:',['from_coin_name'=>$record->get_from_symbol->coin_name,'from_coin_symbol'=>$record->get_from_symbol->symbol,'to_coin_name'=>$record->get_to_symbol->coin_name,'to_coin_symbol'=>$record->get_to_symbol->symbol])}}
								</p>
							</div>

							<div class="row">
								<div class="col-md-2">
									<hr id="stepline">
								</div>
								<div class="col-md-10">
									<p>
										{{__('Step 1: Select from_coin_symbol from the dropdown menu on the left side of the exchanger, and to_coin_symbol from the dropdown menu on the right side. Then, simply enter the amount you want to convert from from_coin_symbol to to_coin_symbol,and let the calculator do the rest—it\'ll instantly show you how much to_coin_symbol you\'ll receive for your from_coin_symbol! Easy as pie.',['from_coin_symbol'=>$record->get_from_symbol->symbol,'to_coin_symbol'=>$record->get_to_symbol->symbol])}}
									</p>
								</div>
							</div>

							<div class="row">
								<div class="col-md-2">
									<hr id="stepline">
								</div>
								<div class="col-md-10">
									<p>
										{{__('Step 2: Pop your to_coin_symbol wallet address into the designated field to ensure you receive the converted amount from from_coin_symbol to to_coin_symbol. Then, hit that "Exchange" button to kickstart the process. Watch as the magic unfolds your order to swap from_coin_symbol to to_coin_symbol is now in motion!',['from_coin_symbol'=>$record->get_from_symbol->symbol,'to_coin_symbol'=>$record->get_to_symbol->symbol])}}

									</p>
								</div>
							</div>

							<div class="row">
								<div class="col-md-2">
									<hr id="stepline">
								</div>
								<div class="col-md-10">
									<p>
										{{__('Step 3: Hold tight for the next stage! We\'ll send you a deposit address where you\'ll transfer the from_coin_symbol amount you\'re looking to exchange. Once that\'s done, keep an eye out for your transaction ID we\'ll notify you as soon as it\'s confirmed!',['from_coin_symbol'=>$record->get_from_symbol->symbol])}}
									</p>
								</div>
							</div>

							<div class="row">
								<div class="col-md-2">
									<hr id="stepline">
								</div>
								<div class="col-md-10">
									<p>
										{{__('Step 4: Throughout the entire transaction journey, rest assured we guarantee a fixed from_coin_symbol to to_coin_symbol rate from start to finish. No surprises, just smooth sailing all the way to completion!',['from_coin_symbol'=>$record->get_from_symbol->symbol,'to_coin_symbol'=>$record->get_to_symbol->symbol])}}
									</p>
								</div>
							</div>

							<div class="row">
								<div class="col-md-2">
									<hr id="stepline">
								</div>
								<div class="col-md-10">
									<p>
										{{__('Step 5: Get ready to welcome to_coin_symbol straight into the wallet you specified at the start, complete with all the order details and its duration. Your crypto journey is almost complete just a few more moments till your to_coin_symbol arrives!',['to_coin_symbol'=>$record->get_to_symbol->symbol])}}
									</p>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<p>{{__('Easy and fast!')}}</p>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<h3>{{__('Live from_coin_symbol to to_coin_symbol Price',['from_coin_symbol'=>$record->get_from_symbol->symbol,'to_coin_symbol'=>$record->get_to_symbol->symbol])}}</h3>
								</div>
							</div>

							<div class="row">
								<p>
									{{__('Unlock real-time insights into from_coin_symbol to to_coin_symbol rate fluctuations with chainswap.io! Check out the latest closing rates for from_coin_symbol to to_coin_symbol right here. Plus, with chainswap, explore the actual volume of from_coin_symbol to to_coin_symbol transactions, giving you the pulse of the crypto market at your fingertips.',['from_coin_symbol'=>$record->get_from_symbol->coin_name,'to_coin_symbol'=>$record->get_to_symbol->coin_name])}}

								</p>
							</div>

							<div class="row">
								<div class="col-md-12">
									<h1>
										{{__('Convert from_coin_symbol to to_coin_name at the Best Rates',['from_coin_symbol'=>$record->get_from_symbol->symbol,'to_coin_name'=>$record->get_to_symbol->coin_name])}}
									</h1>
								</div>
							</div>

							<div class="row">
								<p>
									{{__('Rest easy with ChainSwap exchange service—all exchanges are utterly secure. With a proven track record and top-notch reviews, we\'ve earned a spotless reputation and a wealth of positive feedback. Exchange not only from_coin_name for to_coin_name, but also over 200 other crypto coins across 40,000+ trade pairs! Our system keeps an eye on the best rates in real-time from major platforms like Bitfinex, HITBtc, Binance, and more, ensuring you the ultimate exchange experience. Say goodbye to market volatility we offer a fixed exchange rate that remains steady until your transaction is complete. Safe, reliable, and hassle free that\'s the ChainSwap promise.',['from_coin_name'=>$record->get_from_symbol->coin_name,'to_coin_name'=>$record->get_to_symbol->coin_name])}}
								</p>
							</div>

							<div class="row">
								<div class="col-md-12">
									<h3>
										{{__('from_coin_name Vs to_coin_name Exchange Benefits',['from_coin_name'=>$record->get_from_symbol->coin_name,'to_coin_name'=>$record->get_to_symbol->coin_name])}}
									</h3>
								</div>
							</div>

							<div class="row">
								<p>
									{{__('Experience anonymous, lightning-fast, and secure exchanges with ChainSwap. Our dedicated support team is available round-the-clock, ensuring that any transaction inquiries are swiftly addressed, typically within minutes. With the launch of the ChainSwap mobile app for iOS and Android, access to digital coin rates is at your fingertips from any smart device. This convenient feature appeals to traders seeking swift and lucrative crypto transactions and exchanges. Convert from_coin_symbol to to_coin_symbol at the most competitive rates with ChainSwap, where the exchange process operates seamlessly like a Swiss watch.',['from_coin_symbol'=>$record->get_from_symbol->symbol,'to_coin_symbol'=>$record->get_to_symbol->symbol])}}
								</p>
							</div>

							<div class="row">
								<div class="col-md-12">
									<h3>
										{{__('from_coin_symbol to to_coin_symbol Price Details',['from_coin_symbol'=>$record->get_from_symbol->symbol,'to_coin_symbol'=>$record->get_to_symbol->symbol])}}</h3>
									</div>
								</div>

								<div class="row">
									<p>

										{{__('If you\'re looking to sell from_coin_symbol and snag some to_coin_name, look no further than the integrated ChainSwap price calculator. With just one click, you\'ll see exactly how much to_coin_name you\'ll score after specifying the amount of from_coin_name you\'re itching to exchange. It\'s that simple!',['from_coin_symbol'=>$record->get_from_symbol->symbol,'to_coin_name'=>$record->get_to_symbol->coin_name,'from_coin_name'=>$record->get_from_symbol->coin_name])}}

										<br><br>

										{{__('To secure the best rates for our clients, ChainSwap collaborates with top-tier crypto exchanges. This partnership allows us to provide relevant trading details and exchange rate comparisons, ensuring you get the most out of your transactions.')}}

										<br><br>
										<b>{{__('Circulating supply')}}</b>
										<br> <br>

										{{__('The circulating supply of from_coin_name stands at from_circulating_supply USD coins out of a maximum supply of from_coin_max_supply USD coins. Meanwhile, to_coin_name boasts a circulating supply of to_coin_circulating_supply USD with no defined maximum supply.',['to_coin_circulating_supply'=>isset($to_coins_supply_info->circulating) ? $to_coins_supply_info->circulating : 'NaN','to_coin_name'=>$record->get_to_symbol->coin_name,'from_coin_name'=> $record->get_from_symbol->coin_name,'from_circulating_supply'=>isset($from_coins_supply_info->circulating) ? $from_coins_supply_info->circulating : 'NaN','from_coin_max_supply'=>isset($from_coins_supply_info->max) ? $from_coins_supply_info->max : 'NaN'])}}								
										{{--<br><br>
											<b>Trading volume</b>
											<br> <br>
											{{$record->get_from_symbol->coin_name}} sees a daily trading volume of 16,541,670,222.74600000, while {{$record->get_to_symbol->coin_name}}'s daily volume amounts to 6,931,401,317.98590000. --}}

											<br><br>
											<b>{{__('Percentage price change')}}</b>
											<br> <br>
											{{__('Over the past 24 hours, the from_coin_name rate has experienced a change of day_valume USD, and over all market capital is from_marketCap USD',['from_coin_name'=>$record->get_from_symbol->coin_name,'day_valume'=>$from_24hVolume,'from_marketCap'=>$from_marketCap])}}
											<br><br>

											{{__('Over the past 24 hours, the to_coin_name rate has changed by day_to_volume USD, and over all market capital is to_marketCap USD',['to_coin_name'=>$record->get_to_symbol->coin_name,'day_to_volume'=>$to_24hVolume,'to_marketCap'=>$to_marketCap])}}
										</p>
									</div>

									<div class="row">
										<div class="col-md-12">
											<h3>
												{{__('How from_coin_name to to_coin_name calculator works',['from_coin_name'=>$record->get_from_symbol->coin_name,'to_coin_name'=>$record->get_to_symbol->coin_name])}}
											</h3>
										</div>
									</div>

									<div class="row">
										<p>
											{{__('A cryptocurrency converter streamlines the process of understanding the relative values of different digital currencies. Simply input the desired amount into the designated field of the chainswap calculator, and voila! You\'ll instantly see the real-time conversion results, making it easy to gauge the cost of one cryptocurrency in terms of another.')}}
											<br><br>

											{{__('For the convenience of users, the chainswap immediately shows the values of the main types of digital money, so that you can independently calculate or check the obtained  amounts. The calculator saves the time, indicating actual values on conversion of from_coin_symbol to to_coin_symbol',['from_coin_symbol'=>$record->get_from_symbol->symbol,'to_coin_symbol'=>$record->get_to_symbol->symbol])}}
										</p>
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
									<div class="row d-flex justify-content-center align-items-center">
										<div class="col-lg-12">
											<h2 class="fs-4 text-center">FAQ</h2>
											<div class="exchange-tutorials-faq py-3">
												<div class="faq-item">
													<div class="faq-question bg-theme">Who provides your liquidity? Can you verify your reserves?<i class="fas fa-chevron-down"></i></div>
													<div class="faq-answer">
														<p>We rely solely on our internal reserves allocated across our nodes and do not engage with third-party liquidity providers. Proof of reserves is available upon request.</p>
													</div>
												</div>

												<div class="faq-item">
													<div class="faq-question bg-theme">How exchanges are performed?<i class="fas fa-chevron-down"></i></div>
													<div class="faq-answer">
														<p>We generate a unique, one-time input address exclusively for your transaction. Once you transfer the required amount to this address and the transaction is confirmed, you will receive the purchased cryptocurrency.</p>
													</div>
												</div>
												<div class="faq-item">
													<div class="faq-question bg-theme">Are there any documents required from me for the exchange process?<i class="fas fa-chevron-down"></i></div>
													<div class="faq-answer">
														<p>No, we operate as a non-KYC exchange. Additionally, we never require proof of the source of funds (SoF).</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</main>
						@endsection
						@section('scripts')
						{!! JsValidator::formRequest('App\Http\Requests\Frontend\ExchangeRequest', '#exchangeForm'); !!}
						<script type="text/javascript">
							document.addEventListener("DOMContentLoaded", function() {
								const faqQuestions = document.querySelectorAll('.faq-question');

								faqQuestions.forEach(question => {
									question.addEventListener('click', () => {
                    // Toggle the active class
                    question.classList.toggle('active');

                    // Toggle the display of the answer
                    const answer = question.nextElementSibling;
                    if (question.classList.contains('active')) {
                    	answer.style.display = 'block';
                    } else {
                    	answer.style.display = 'none';
                    }
                });
								});
							});

							var api_type = @json(get_api_type());
							$(function(){

								if(api_type == 'godex_api'){
									$('.dynamic_rate').addClass('d-none');
								}else{
									$('.dynamic_rate').removeClass('d-none');
								}

								getPairRate();
								getExchangeAmount();
							})

							$('#you_send').on('keyup',function(){
								getExchangeAmount('','you_send');
							})

							$('#flexRadioDefault1').on('change',function(){
								getPairRate('','flat');
								getExchangeAmount('flat');
							})

							$('#flexRadioDefault2').on('change',function(){
								getPairRate('','dynamic');
								getExchangeAmount('dynamic');
							})

							function getExchangeAmount(rate_mode=null,type=null){
								$('#to_amount_id').addClass('input-busy');
								$('#from_amount_id').addClass('input-busy');

								setTimeout(function(){
									var currency_from = $('.currency_from').val();
									var currency_to = $('.currency_to').val();

									if(type == null){
										var from_amount = '';
									}else{
										var from_amount = $('.from_amount').val();
									}

									$('#to_address').attr('placeholder','Enter '+currency_to+' address');
									$('#to_address_busy_input').removeClass("input-busy");
									$.ajax({
										headers: {
											'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
										},
										url : "{{ url('get-exchange-amount') }}",
										data : {from_amount:from_amount,currency_from:currency_from,currency_to:currency_to,rate_mode:rate_mode},
										type : 'POST',
// dataType : 'json',
success : function(result){
	if(result.status == 'success'){

		$('#to_amount_id').removeClass('input-busy');
		$('#from_amount_id').removeClass('input-busy');
		$('#you_send').val(result.min_amount);
		$('#you_get').val(result.to_amount);

		$('#send_network').html(result.networks_send);
		$('#received_network').html(result.networks_receive);
		$('#to-main-label').removeAttr('disabled');
		$('#jserror_msg').addClass('d-none');

		$('.from-exchange-section').removeClass('d-none');
		$('.to-exchange-section').removeClass('d-none');

	}else{
		$('#from_amount_id').removeClass('input-busy');
		$('#jserror_msg').removeClass('d-none');
		$('#jserror_msg .message').html(result.message);

	}
}
});
								},3000)
							}

// 					function getPopularPair(currency_from,currency_to){

// 						$('#to_amount_id').addClass('input-busy');
// 						$('#from_amount_id').addClass('input-busy');

// 						$('#exchange_from_list').each(function(){

// 							var container = $(this);

// 							var from_symbol = container.find('li .from_coin_symbol'+currency_from).attr('data-symbol');

// 							var from_title = container.find('li .from_coin_symbol'+currency_from).attr('title');

// 							var from_src = container.find('li .from_coin_symbol'+currency_from+' img').attr('src');

// 							var to_symbol = container.find('li .from_coin_symbol'+currency_to).attr('data-symbol');

// 							var to_title = container.find('li .from_coin_symbol'+currency_to).attr('title');

// 							var to_src = container.find('li .from_coin_symbol'+currency_to+' img').attr('src');

// 							$('#from-main-image').attr('src',from_src);
// 							$('#from-main-symbol').html(from_symbol);
// 							$("#from-main-label").attr('data-bs-original-title',from_title);
// 							$('.currency_from').val(from_symbol);

// 							$('#to-main-image').attr('src',to_src);
// 							$('#to-main-symbol').html(to_symbol);
// 							$("#to-main-label").attr('data-bs-original-title',to_title);
// 							$('.currency_to').val(to_symbol);
// 							$('#to_address').attr('placeholder','Enter '+to_symbol+' address');

// 						});

// 						var currency_from = currency_from;
// 						var currency_to = currency_to;

// 						getPairRate('','',currency_from,currency_to);

// 						$.ajax({
// 							headers: {
// 								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 							},
// 							url : "{{ url('get-exchange-amount') }}",
// 							data : {currency_from:currency_from,currency_to:currency_to},
// 							type : 'POST',
// // dataType : 'json',
// success : function(result){
// 	if(result.status == 'success'){

// 		$('#to_amount_id').removeClass('input-busy');
// 		$('#from_amount_id').removeClass('input-busy');
// 		$('#you_send').val(result.min_amount);
// 		$('#you_get').val(result.to_amount);
// 		$('#send_network').html(result.networks_send);
// 		$('#received_network').html(result.networks_receive);

// 		$('#jserror_msg').addClass('d-none');
// 	}else{

// 		$('#jserror_msg').removeClass('d-none');
// 		$('#jserror_msg .message').html(result.message);

// 	}
// }
// });
// 					}

function getPairRate(type=null,rate_mode=null,currency_from=null,currency_to=null){

	if((currency_from == null) && (currency_to == null)){

		if(type == 'swap'){

			var currency_to = $('.currency_from').val();
			var currency_from = $('.currency_to').val();
			var pair = currency_to+'_'+currency_from;

		}else{

			var currency_from = $('.currency_from').val();
			var currency_to = $('.currency_to').val();
			var pair = currency_from+'_'+currency_to;

		}
	}else{

		var pair = currency_from+'_'+currency_to;
	}

	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url : "{{ url('get-pair-rate') }}",
		data : {'coin_pair':pair,currency_from:currency_from,currency_to:currency_to,rate_mode:rate_mode},
		type : 'POST',
// dataType : 'json',
success : function(result){
	if(result.status == 'success'){

		$('.coin_pair_rate').html(result.rate); 
		$('#jserror_msg').addClass('d-none');
	}else{

		$('#jserror_msg').removeClass('d-none');
		$('#jserror_msg .message').html(result.message);
	}
}
});
}

function swapcoin(){

	var currency_from = $('.currency_from').val();
	var currency_to = $('.currency_to').val();

	getPairRate('swap');

	var from_image = $('#from-main-image').attr('src');
	var to_image = $('#to-main-image').attr('src');

	$('#from-main-image').attr('src',to_image);
	$('#to-main-image').attr('src',from_image);

	$('.currency_from').val(currency_to);
	$('.currency_to').val(currency_from);

	$("#from-main-symbol").html(currency_to);
	$("#to-main-symbol").html(currency_from);

	$("#from-main-label").attr('data-bs-original-title',currency_to);
	$("#to-main-label").attr('data-bs-original-title',currency_from);

	$('#to_address').attr('placeholder','Enter '+currency_from+' address');
	getExchangeAmount();
}

function getFromCoin(key){

	/*------- Change form url -------*/
	var from_symbol = $('.coin_from'+key).attr('data-symbol');
	var currency_to = $('.currency_to').val();
	$('.to-exchange-section').addClass('d-none');

	if(from_symbol == currency_to){
		$('#exchange_from').prop('checked', false);
		swapcoin();
		return false;
	}

	var from_title = $('.coin_from'+key).attr('title');
	var from_src = $('.coin_from_img'+key).attr('src');

	$('#from-main-image').attr('src',from_src);
	$('#from-main-symbol').html(from_symbol);
	$("#from-main-label").attr('data-bs-original-title',from_title);
	$('.currency_from').val(from_symbol);
	$('#exchange_from').prop('checked', false);
	getPairRate();
	getExchangeAmount();
	return false;
}

function getToCoin(key){

	var to_symbol = $('.coin_to'+key).attr('data-symbol');
	var to_src = $('.coin_to_img'+key).attr('src');
	var to_title = $('.coin_to'+key).attr('title');
	$('#exchange_from').prop('checked', false);
	$('.from-exchange-section').addClass('d-none');

	$('#to-main-image').attr('src',to_src);
	$('#to-main-symbol').html(to_symbol);
	$("#to-main-label").attr('data-bs-original-title',to_title);
	$('.currency_to').val(to_symbol);
	$('#exchange_to').prop('checked', false);

	getPairRate();
	getExchangeAmount();
	return false;
}

</script>
@endsection
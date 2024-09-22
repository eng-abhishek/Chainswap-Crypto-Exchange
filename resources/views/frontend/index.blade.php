@extends('frontend.layouts.app')
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

{!! organization_jsonld() !!}

{!! breadcrumbs_jsonld([
	['url' => route('home'), 'title' => 'Home']
	]) 
	!!}

	@if(( count($faq) > 0) && !empty($faq))
	<script data-n-head="ssr" type="application/ld+json" data-body="true">
		{
			"@context": "https://schema.org",
			"@type": "FAQPage",
			"mainEntity": [

			@php
			$i = 0;
			@endphp

			@foreach($faq as $record)
			{
				@php		
				$i = $i+1;
				@endphp

				"@type": "Question",
				"name": "{{$record->title}}",
				"acceptedAnswer": {
				"@type": "Answer",
				"text": "{{$record->description}}"
			}}@if(count($faq) == $i)@else, @endif
			@endforeach
			]}
		</script>
		@endsection
		@endif

		@section('styles')
		<style type="text/css">
			.error-help-block{
				color: #dc3545;
			}
		</style>
		@endsection

		@section('content')
		<main>
			<section class="py-5">
				<div class="container">
					<div class="row justify-content-center align-items-center">
						<div class="col-lg-4 py-lg-0 py-3 text-light text-lg-start text-center">
							<h1 class="mb-3">{{__('No-KYC Crypto Exchange')}}</h1>
							<h2 class="fs-5 mb-3">{{__('Effortless, Anonymous, Hassle-Free Crypto Exchange')}}</h2>
							<p class="mb-0 text-justify">{{__('ChainSwap Empowering Limitless Web3.0 Crypto Exchange')}}</p>
						</div>
						<div class="col-lg-8 py-lg-0 py-3">
							<div class="exchange-wrap bg-theme">
								<h2 class="fs-5 text-white">{{__('Start exchange')}}</h2>
								<form action="{{route('exchange')}}" method="post" id="exchangeForm">
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
																<label id="from-main-label" for="exchange_from" class="exchange-label exchange-coin" data-bs-toggle="tooltip" data-bs-original-title="Ethereum">
																	@if($from_coin)
																	<img id="from-main-image" src="{{asset('assets/frontend/images/coins/'.$from_coin.'.png')}}" alt="" class="coin-image">
																	<span id="from-main-symbol" class="coin-ticker text-truncate">{{$from_coin}}</span>
																	<input type="hidden" value="{{$from_coin}}" name="currency_from" class="currency_from">
																	@else

																	{{--<img id="from-main-image" src="{{asset('assets/frontend/images/coins/eth.png')}}" alt="" class="coin-image">
																	<span id="from-main-symbol" class="coin-ticker text-truncate">ETH</span>
																	<input type="hidden" value="ETH" name="currency_from" class="currency_from">--}}

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
																								<span class="coin-name">Not Found</span></a>
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
																	<label for="exchange_to" class="exchange-label exchange-coin" id="to-main-label" data-bs-toggle="tooltip" data-bs-original-title="Bitcoin">

																		@if($to_coin)
																		<img id="to-main-image" src="{{asset('assets/frontend/images/coins/'.$to_coin.'.png')}}" alt="" class="coin-image">
																		<span id="to-main-symbol" class="coin-ticker text-truncate">{{$to_coin}}</span>
																		<input type="hidden" value="{{$to_coin}}" name="currency_to" class="currency_to">
																		@else
																		{{--<img src="{{asset('assets/frontend/images/coins/btc.png')}}" id="to-main-image" alt="" class="coin-image">
																		<span id="to-main-symbol" class="coin-ticker text-truncate">BTC</span>
																		<input type="hidden" value="BTC" name="currency_to" class="currency_to">--}}
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
																								<a href="javascript:void(0)" title="{{__('Not Found')}}" class="exchange-coin">
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
														<input type="text" name="to_address" id="to_address" class="form-control form-amount" placeholder="{{__('Enter to_coin Address',['to_coin'=>'XMR'])}}">
													</div>
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
												<button class="btn btn-custom btn-lg w-100 text-uppercase btn-exchange">{{__('Exchange')}}</button>
											</div>

											<div class="row">
												<div class="col-lg-12">
													<div class="alert-custom alert-custom-success">
														<p class="mb-0">
															{{__('Exchange_notes')}}
														</p>
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

				<section class="py-3">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-lg-4 col-md-6 py-3">
								<div class="feature-wrap">
									<div class="feature-image">
										<img src="{{asset('assets/frontend/images/home/private.png')}}" alt="">
									</div>
									<div class="feature-content">
										<h3 class="fs-4">{{__('Private')}}</h3>
										<p class="mb-0">{{__('No registration, email, or account required—just your crypto address.')}}</p>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-6 py-3">
								<div class="feature-wrap">
									<div class="feature-image">
										<img src="{{asset('assets/frontend/images/home/fast.png')}}" alt="">
									</div>
									<div class="feature-content">
										<h3 class="fs-4">{{__('Fast')}}</h3>
										<p class="mb-0">{{__('Swap over 150+ cryptocurrencies instantly to your wallet.')}}</p>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-6 py-3">
								<div class="feature-wrap">
									<div class="feature-image">
										<img src="{{asset('assets/frontend/images/home/safe.png')}}" alt="">
									</div>
									<div class="feature-content">
										<h3 class="fs-4">{{__('Safe')}}</h3>
										<p class="mb-0">{{__('You retain full control over your funds and data—we prioritize your privacy without tracking.')}}</p>
									</div>
								</div>
							</div>
							<div class="row justify-content-center text-center">
								<div class="col-lg-12 col-md-12 py-3">
									<a href="#" class="btn btn-custom btn-lg rounded-pill">{{__('Start Swap Now')}}</a>
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
							<div class="row d-flex justify-content-center align-items-center text-center">
								<div class="col-lg-12">
									<h2 class="fs-4">{{__('Featured on')}}</h2>
									<div class="partner">
										<div class="partner-content">
											<div class="d-flex">
												@forelse($trusted as $trustedData)
												<div class="partner-single">
													<a href="{{$trustedData->url}}" target="_blank"><img src="{{$trustedData->trusted_img}}" class="img-fluid" alt="{{$trustedData->alt}}"></a>
												</div>
												@empty
												@endforelse
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>

					@if(count($faq) > 0)
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

										@foreach($faq as $value)
										<div class="faq-item">
											<div class="faq-question bg-theme">{{$value->title ?? ''}}<i class="fas fa-chevron-down"></i></div>
											<div class="faq-answer">
												<p>{{$value->description ?? ''}}</p>
											</div>
										</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</section>
					@endif
				</main>
				@endsection
				@section('scripts')
				{!! JsValidator::formRequest('App\Http\Requests\Frontend\ExchangeRequest', '#exchangeForm'); !!}
				<script type="text/javascript">
					var api_code = @json(get_api_code());

					$(function(){

						if(api_code == 200){
							$('.dynamic_rate').addClass('d-none');
						}else{
							$('.dynamic_rate').removeClass('d-none');
						}

						getPairRate();
						getExchangeAmount();
					})

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

					$('#you_send').on('change',function(){
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

		$('#you_send').val(result.min_amount);
		$('#you_get').val(result.to_amount);

		$('#from_amount_id').removeClass('input-busy');
		$('#to_amount_id').removeClass('input-busy');

		$('#send_network').html(result.networks_send);
		$('#received_network').html(result.networks_receive);
		$('#to-main-label').removeAttr('disabled');
		$('#jserror_msg').addClass('d-none');

		$('.from-exchange-section').removeClass('d-none');
		$('.to-exchange-section').removeClass('d-none');
		$('.btn-exchange').removeAttr('disabled');
	}else{

		$('#from_amount_id').removeClass('input-busy');
		$('#to_amount_id').removeClass('input-busy');

		$('#jserror_msg').removeClass('d-none');
		$('#jserror_msg .message').html(result.message);
		$('.from-exchange-section').removeClass('d-none');
		$('.to-exchange-section').removeClass('d-none');
		$('.btn-exchange').attr('disabled','disabled');
	}
}
});
						},3000)
					}

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
		$('.from-exchange-section').removeClass('d-none');
		$('.to-exchange-section').removeClass('d-none');
		$('.btn-exchange').removeAttr('disabled');

	}else{

		$('#jserror_msg').removeClass('d-none');
		$('#jserror_msg .message').html(result.message);
		$('.from-exchange-section').removeClass('d-none');
		$('.to-exchange-section').removeClass('d-none');
		$('.btn-exchange').attr('disabled','disabled');
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

//$('.to-exchange-section').addClass('d-none');

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
	var currency_from = $('.currency_from').val();

	if(to_symbol == currency_from){
		$('#exchange_to').prop('checked', false);
		swapcoin();
		return false;
	}

//$('.from-exchange-section').addClass('d-none');

var to_src = $('.coin_to_img'+key).attr('src');
var to_title = $('.coin_to'+key).attr('title');
$('#exchange_from').prop('checked', false);


$('#to-main-image').attr('src',to_src);
$('#to-main-symbol').html(to_symbol);
$("#to-main-label").attr('data-bs-original-title',to_title);
$('.currency_to').val(to_symbol);
$('#exchange_to').prop('checked', false);
$('.to-exchange-section').addClass('d-none');


getPairRate();
getExchangeAmount();
return false;
}

</script>
@endsection
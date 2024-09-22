<div class="row justify-content-center text-center mt-3">
	<p>Your deposit has been refunded.</p>
	<div class="col-lg-12 my-3">
		<div class="message-image">
			<img src="{{asset('assets/frontend/images/icons/refund.png')}}" alt="Refunded">
		</div>
	</div>
	<div class="col-lg-12">
		<h4 class="fs-5">{{ config('app.name') }} Refunded {{$order_details->from_amount}} {{$order_details->from_currency}}</h4>
	</div>
</div>
@if(!empty($order_details->hash_in))
<div class="row my-3 justify-content-center">
	<div class="col-lg-8">
		<h5 class="mt-3 text-center">Hash In</h5>
		<div class="input-group">
			<input type="text" class="form-control" id="hash_out" value="{{$order_details->hash_in ?? ''}}" readonly="" placeholder="Input group example" aria-label="Input group example" aria-describedby="btnGroupAddon">
			<div class="input-group-prepend">
				<div id="copy_text btnGroupAddon" class="input-group-text">
					<a href="https://blockchair.com/{{strtolower($order_details->get_from_symbol->coin_name)}}/transaction/{{$order_details->hash_in ?? ''}}?from=ChainSwap" target="_blank" class="hide-script hash-out link-custom text-decoration-none d-inline-flex align-items-center"><span class="icon bg-transparent icon-external"></span></a>
				</div>
			</div>
			<div class="input-group-prepend">
				<div id="copy_text btnGroupAddon" class="input-group-text">
					<a href="javascript:void(0);" class="hide-script copy-to-clipboard hash-out link-custom text-decoration-none d-inline-flex align-items-center"><span class="icon bg-transparent icon-copy"></span></a>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

<div class="row justify-content-center text-center mt-3">
	<div class="col-lg-12">
		<a href="{{route('home')}}" class="btn btn-custom btn-lg rounded-pill">Exchange Again!</a>
	</div>
</div>
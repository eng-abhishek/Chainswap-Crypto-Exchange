@extends('backend.layouts.app')
@section('styles')
<style type="text/css">
	.invalid-feedback{
		display: block;
	}
	li[aria-disabled='true'] {
		display: none;
	}
</style>
@endsection
@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title">Exchange</h3>
		</div>
	</div>
</div>
<!-- END: Subheader -->

<div class="m-content">

	@include('backend.layouts.partials.alert-messages')

	@php
	$supported_languages = config('constants.supported_languages');
	@endphp

	<!--begin::Portlet-->
	<div class="m-portlet m-portlet--mobile">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<h3 class="m-portlet__head-text">
						Edit Exchange
					</h3>
				</div>
			</div>
		</div>
		<!--begin::Form-->

		{{ Form::open(array('route' => 'backend.exchange.store', 'id'=>'add-exchange-form', 'class' => 'm-form')) }}
		<div class="m-portlet__body">	
			<div class="m-form__section m-form__section--first">
				
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">From Coin:</label>
					<div class="col-lg-6">
						{{ Form::select('from_coin_symbol', $coins->prepend('Select From Coin',''), null, array('class' => 'form-control m-select2', 'id' => 'from_coin_symbol')) }}
						@error('from_coin_symbol')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				{{--<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Description:</label>
					<div class="col-lg-6">
						{!! Form::textarea('from_coin_des', null, ['class'=>'form-control m-input', 'placeholder' =>'description', 'rows' => 3, 'cols' => 50]) !!}
						@error('from_coin_des')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Whitepaper Url:</label>
					<div class="col-lg-6">
						{!! Form::text('from_coin_whitepaper_url', null, ['class'=>'form-control m-input', 'placeholder' => 'Whitepaper Url']) !!}
						@error('from_coin_whitepaper_url')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Official website Url:</label>
					<div class="col-lg-6">
						{!! Form::text('from_coin_officialsite_url', null, ['class'=>'form-control m-input', 'placeholder' => 'Official website Url']) !!}
						@error('from_coin_officialsite_url')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>--}}

				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">To Coin:</label>
					<div class="col-lg-6">
						{{ Form::select('to_coin_symbol', $coins->prepend('Select To Coin',''), null, array('class' => 'form-control m-select2', 'id' => 'to_coin_symbol')) }}
						@error('to_coin_symbol')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				{{--<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Description:</label>
					<div class="col-lg-6">
						{!! Form::textarea('to_coin_des', null, ['class'=>'form-control m-input', 'placeholder' => 'description', 'rows' => 3, 'cols' => 50]) !!}
						@error('to_coin_des')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Whitepaper Url:</label>
					<div class="col-lg-6">
						{!! Form::text('to_coin_whitepaper_url', null, ['class'=>'form-control m-input', 'placeholder' => 'Whitepaper Url']) !!}
						@error('to_coin_whitepaper_url')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Official website Url:</label>
					<div class="col-lg-6">
						{!! Form::text('to_coin_officialsite_url', null, ['class'=>'form-control m-input', 'placeholder' => 'official website Url']) !!}
						@error('to_coin_officialsite_url')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				@foreach($supported_languages as $key => $value)
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Meta Title in {{$value}}:</label>
					<div class="col-lg-6">
						{{ Form::text('meta_title['.$key.']',null,array('class' => 'form-control m-input', 'placeholder' => 'Meta Title in '.$value, 'autocomplete' => 'off', 'autofocus')) }}
						@error('meta_title')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
				@endforeach

				@foreach($supported_languages as $key => $value)
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Meta Description  in {{$value}}:</label>
					<div class="col-lg-6">
						{!! Form::textarea('meta_description['.$key.']', null, ['class'=>'form-control m-input', 'placeholder' => 'Meta Description in '.$value, 'rows' => 3, 'cols' => 50]) !!}
						@error('meta_description')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
				@endforeach
				--}}
			</div>
		</div>
		<div class="m-portlet__foot m-portlet__foot--fit">
			<div class="m-form__actions m-form__actions">
				<div class="row">
					<div class="col-lg-3"></div>
					<div class="col-lg-6">
						<button class="btn btn-success">Add</button>
						<a href="{{route('backend.exchange.index')}}" class="btn btn-secondary">Cancel</a>
					</div>
				</div>
			</div>
		</div>
		{{ Form::close() }}
		<!--end::Form-->
	</div>
	<!--end::Portlet-->

</div>
@endsection
@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Backend\ExchangeRequest', '#add-exchange-form'); !!}
@endsection
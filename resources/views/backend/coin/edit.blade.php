@extends('backend.layouts.app')
@section('styles')
<style type="text/css">
	.invalid-feedback{
		display: block;
	}
</style>
@endsection
@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title">Coins</h3>
		</div>
	</div>
</div>
<!-- END: Subheader -->

<div class="m-content">

	@include('backend.layouts.partials.alert-messages')

	<!--begin::Portlet-->
	<div class="m-portlet m-portlet--mobile">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<h3 class="m-portlet__head-text">
						Edit
					</h3>
				</div>
			</div>
		</div>
		<!--begin::Form-->
		{{ Form::model($record, array('route' => ['backend.coins.update', $record->id], 'id' => 'edit-coin-form', 'class' => 'm-form')) }}
		@method('PUT')
		<div class="m-portlet__body">	
			<div class="m-form__section m-form__section--first">
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Coin Symbol:</label>
					<div class="col-lg-9">
						{{ Form::text('symbol', null, array('class' => 'form-control m-input', 'placeholder' => 'Title', 'autocomplete' => 'off', 'disabled' => true)) }}
					</div>
				</div>
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Coin Name:</label>
					<div class="col-lg-9">
						{{ Form::text('coin_name', null, array('class' => 'form-control m-input', 'placeholder' => 'slug', 'autocomplete' => 'off', 'disabled' => true)) }}
					</div>
				</div>
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Coin Description:</label>
					<div class="col-lg-9">
						{!! Form::textarea('coin_desc',null,['class'=>'form-control m-input', 'rows' => 15, 'cols' => 40, 'placeholder' => 'Coin description']) !!}
						@error('coin_desc')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Coin Whitepaper Url:</label>
					<div class="col-lg-6">
						{!! Form::text('coin_whitepaper_url', null, ['class'=>'form-control m-input', 'placeholder' => 'Coin whitepaper Url']) !!}
						@error('coin_whitepaper_url')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Coin Official website Url:</label>
					<div class="col-lg-6">
						{!! Form::text('coin_officialsite_url', null, ['class'=>'form-control m-input', 'placeholder' => 'Coin Official website Url']) !!}
						@error('coin_officialsite_url')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
			</div>
		</div>
		<div class="m-portlet__foot m-portlet__foot--fit">
			<div class="m-form__actions m-form__actions">
				<div class="row">
					<div class="col-lg-3"></div>
					<div class="col-lg-6">
						<button class="btn btn-success">Save</button>
						<a href="{{route('backend.coins.index')}}" class="btn btn-secondary">Cancel</a>
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
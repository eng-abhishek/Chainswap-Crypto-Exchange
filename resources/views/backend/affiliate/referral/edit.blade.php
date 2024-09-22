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
			<h3 class="m-subheader__title">Referral Commission</h3>
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
						Update Referral Commission
					</h3>
				</div>
			</div>
		</div>
		<!--begin::Form-->
		{{ Form::model($record, array('route' => ['backend.affiliate.referral-commission.update', $record->user_id], 'id'=>'edit-referral-form', 'class' => 'm-form')) }}
		@method('PUT')
		<div class="m-portlet__body">	
			<div class="m-form__section m-form__section--first">

            <div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Affiliate id:</label>
					<div class="col-lg-6">
						{{ Form::text('affiliate_id', $record->user->affiliate_id, array('class' => 'form-control m-input', 'placeholder' => 'Affiliate Id', 'autocomplete' => 'off', 'autofocus','readonly')) }}
						@error('affiliate_id')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="form-group m-form__group row">

					<label class="col-lg-3 col-form-label">Total Amount:</label>
					<div class="col-lg-6">
						{{ Form::text('total_amount', $record->total_amount, array('class' => 'form-control m-input', 'placeholder' => 'Title', 'autocomplete' => 'off', 'autofocus','readonly')) }}
						@error('total_amount')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

	           <div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Wallet Address:</label>
					<div class="col-lg-6">
						{{ Form::text('wallet_address', $record->user->btc_address, array('class' => 'form-control m-input', 'placeholder' => 'Url', 'autocomplete' => 'off', 'autofocus','readonly')) }}
						@error('wallet_address')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

	           <div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Txn Has:</label>
					<div class="col-lg-6">
						{{ Form::text('txn_has', null, array('class' => 'form-control m-input', 'placeholder' => 'Enter txn has', 'autocomplete' => 'off', 'autofocus')) }}
						@error('txn_has')
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
						<button class="btn btn-success">Submit</button>
						<a href="{{route('backend.trusted-logo.index')}}" class="btn btn-secondary">Cancel</a>
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
{!! JsValidator::formRequest('App\Http\Requests\Backend\ReferralCommissionRequest', '#edit-referral-form'); !!}
@endsection
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
			<h3 class="m-subheader__title">Setting</h3>
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
						Update Setting
					</h3>
				</div>
			</div>
		</div>
		<!--begin::Form-->
		{{ Form::open(array('route' => 'backend.setting.store', 'id'=>'create-setting-form', 'class' => 'm-form', 'files' => true)) }}
		<div class="m-portlet__body">
			<div class="m-form__section m-form__section--first">
				
				{{--<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Enter Commission Precentage:</label>
					<div class="col-lg-6">
						{{ Form::text('commission_precentage', $record->commission_precentage ?? '' , array('class' => 'form-control m-input', 'placeholder' => 'Enter commission precentage', 'autocomplete' => 'off', 'autofocus')) }}
						@error('commission_precentage')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>--}}

				{{--<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Enter your exch api Referral Id:</label>
					<div class="col-lg-6">
						{{ Form::text('exch_referral_id', $record->exch_referral_id ?? '' , array('class' => 'form-control m-input', 'placeholder' => 'Enter exch referral id', 'autocomplete' => 'off', 'autofocus')) }}
						@error('referral_id')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>--}}

				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Enter your Referral Id:</label>
					<div class="col-lg-6">
						{{ Form::text('godex_referral_id', $record->godex_referral_id ?? '' , array('class' => 'form-control m-input', 'placeholder' => 'Enter godex referral id', 'autocomplete' => 'off', 'autofocus')) }}
						@error('referral_id')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Enter your coinranking api key:</label>
					<div class="col-lg-6">
						{{ Form::text('coinranking_api_key', $record->coinranking_api_key ?? '' , array('class' => 'form-control m-input', 'placeholder' => 'Enter your coinranking api key', 'autocomplete' => 'off', 'autofocus')) }}
						@error('coinranking_api_key')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				{{--<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Enable exchange apis:</label>
					<div class="col-lg-6">
						<div class="row">

							<div class="form-check col-sm-4">
								<input class="form-check-input" {{ isset($record->user_api_type) ? (($record->user_api_type == 'exch_api') ? 'checked':'') : ''}} type="radio" name="user_api_type" id="flexRadioDefault1" value="exch_api">
								<label class="form-check-label" for="flexRadioDefault1">
									Exch Apis 
								</label>
							</div>

							<div class="form-check col-sm-4">
								<input class="form-check-input" {{ (isset($record->user_api_type)) ? (($record->user_api_type == 'godex_api') ? 'checked':'') : ''}} type="radio" name="user_api_type" id="flexRadioDefault2" value="godex_api">
								<label class="form-check-label" for="flexRadioDefault2">
									Godex Apis
								</label>
							</div>

							<div class="form-check col-sm-4">
								<input class="form-check-input" {{ (isset($record->user_api_type)) ? (($record->user_api_type == 'both') ? 'checked':'') : ''}} type="radio" name="user_api_type" id="flexRadioDefault3" value="both">
								<label class="form-check-label" for="flexRadioDefault3">
									Both
								</label>
							</div>
						</div>
					</div>
				</div>--}}

			</div>
		</div>
		<div class="m-portlet__foot m-portlet__foot--fit">
			<div class="m-form__actions m-form__actions">
				<div class="row">
					<div class="col-lg-3"></div>
					<div class="col-lg-6">
						<button class="btn btn-success">Submit</button>
						
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
{!! JsValidator::formRequest('App\Http\Requests\Backend\SettingRequest', '#create-setting-form'); !!}
@endsection
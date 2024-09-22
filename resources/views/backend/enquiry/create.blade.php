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
			<h3 class="m-subheader__title">Enquiry</h3>
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
						Create Enquiry
					</h3>
				</div>
			</div>
		</div>
		<!--begin::Form-->
		{{ Form::open(array('route' => 'backend.enquiry.store', 'id'=>'add-enquiry-form', 'class' => 'm-form')) }}
		<div class="m-portlet__body">	
			<div class="m-form__section m-form__section--first">
				
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Name:</label>
					<div class="col-lg-6">
						{{ Form::text('name', null, array('class' => 'form-control m-input', 'placeholder' => 'Name', 'autocomplete' => 'off', 'autofocus')) }}
						@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Email:</label>
					<div class="col-lg-6">
						{{ Form::email('email', null, array('class' => 'form-control m-input', 'placeholder' => 'Email', 'autocomplete' => 'off', 'autofocus')) }}
						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Order Id:</label>
					<div class="col-lg-6">
						{{ Form::text('order_id', null, array('class' => 'form-control m-input', 'placeholder' => 'Order Id', 'autocomplete' => 'off', 'autofocus')) }}
						@error('order_id')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Message:</label>
					<div class="col-lg-6">
						{!! Form::textarea('message', null, ['class'=>'form-control m-input', 'placeholder' => 'Message', 'rows' => 3, 'cols' => 50]) !!}
						@error('message')
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
						<a href="{{route('backend.faq.index')}}" class="btn btn-secondary">Cancel</a>
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
{!! JsValidator::formRequest('App\Http\Requests\Backend\EnquiryRequest', '#add-enquiry-form'); !!}
@endsection
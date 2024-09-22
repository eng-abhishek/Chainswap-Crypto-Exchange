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
						Enquiry
					</h3>
				</div>
			</div>
		</div>
		<!--begin::Form-->
		<div class="m-portlet__body">	
			<div class="m-form__section m-form__section--first">		

				<div class="row">
					<div class="col-sm-3">Name</div>
					<div class="col-sm-6">{{$record->name}}</div>
				</div>

				<div class="row pt-3">
					<div class="col-sm-3">Email</div>
					<div class="col-sm-6">{{$record->email}}</div>
				</div>

				<div class="row pt-3">
					<div class="col-sm-3">Order Id</div>
					<div class="col-sm-6">{{$record->order_id}}</div>
				</div>

				<div class="row pt-3">
					<div class="col-sm-3">Message</div>
					<div class="col-sm-6">{!! $record->message !!}</div>
				</div>

				<div class="row pt-3">
					<div class="col-lg-3"></div>
					<div class="col-lg-6">
						<a href="{{route('backend.faq.index')}}" class="btn btn-secondary float-right">Back</a>
					</div>
				</div>
			</div>
		</div>
		<!--end::Form-->
	</div>
	<!--end::Portlet-->
</div>
@endsection
@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\Backend\EnquiryRequest', '#add-enquiry-form'); !!}
@endsection
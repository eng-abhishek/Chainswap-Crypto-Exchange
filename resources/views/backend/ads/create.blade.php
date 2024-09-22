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
			<h3 class="m-subheader__title">Ads</h3>
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
						Create Ads
					</h3>
				</div>
			</div>
		</div>
		<!--begin::Form-->
		{{ Form::open(array('route' => 'backend.ads.store', 'id'=>'create-ads-form', 'class' => 'm-form', 'files' => true)) }}
		<div class="m-portlet__body">	
			<div class="m-form__section m-form__section--first">
				
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Ads Image:</label>
					<div class="col-lg-6">
						{{ Form::file('image', ['class'=>'form-control m-input', 'data-preview' => '#view-ads-image']) }}
						<span class="m-form__help">Dimensions : 450*450</span>
						@error('image')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
						<div class="image-block">
							<img id="view-ads-image" src="" style="display:none;margin-top:10px;max-height: 150px;width: auto;">
						</div>
					</div>
				 </div>

				 <div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Url:</label>
					<div class="col-lg-6">
						{{ Form::text('url', null, array('class' => 'form-control m-input', 'placeholder' => 'url', 'autocomplete' => 'off', 'autofocus')) }}
						@error('url')
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
						<a href="{{route('backend.ads.index')}}" class="btn btn-secondary">Cancel</a>
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
{!! JsValidator::formRequest('App\Http\Requests\Backend\AdsRequest', '#create-ads-form'); !!}
<script type="text/javascript">
$(document).ready(function(){
        /* Preview Image */
		$('input[name="image"]').change(function(e) {
			var preview = $(this).data('preview');
			var file = $(this).get(0).files[0];

			if(file){
				var reader = new FileReader();

				reader.onload = function(){
					$(preview).attr("src", reader.result).show();
				}

				reader.readAsDataURL(file);
			}	
		});
})
</script>
@endsection
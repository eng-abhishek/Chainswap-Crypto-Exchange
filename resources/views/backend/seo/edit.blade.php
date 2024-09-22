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
			<h3 class="m-subheader__title">SEO</h3>
		</div>
	</div>
</div>
<!-- END: Subheader -->
<div class="m-content">

	@include('backend.layouts.partials.alert-messages')

	@php
	$supported_languages = config('constants.supported_languages');
	@endphp

		@php
		$title = json_decode($record->getRawOriginal('title'), true);
		$meta_title = json_decode($record->getRawOriginal('meta_title'), true);
		$meta_des = json_decode($record->getRawOriginal('meta_des'), true);
		@endphp

	<!--begin::Portlet-->
	<div class="m-portlet m-portlet--mobile">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<h3 class="m-portlet__head-text">
						Edit SEO
					</h3>
				</div>
			</div>
		</div>
		<!--begin::Form-->
		{{ Form::model($record, array('route' => ['backend.seo.update', $record->id], 'id'=>'edit-seo-form', 'class' => 'm-form','files'=>true)) }}
		@method('PUT')
		<div class="m-portlet__body">	
			<div class="m-form__section m-form__section--first">
				
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Slug:</label>
					<div class="col-lg-6">
		            {{ Form::text('slug', null, array('class' => 'form-control m-input', 'placeholder' => 'Title', 'autocomplete' => 'off', 'autofocus','readonly')) }}
					</div>
				</div>

	          @foreach($supported_languages as $key => $value)
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Title  in {{$value}}:</label>
					<div class="col-lg-6">

						{{ Form::text('title['.$key.']',$title[$key] ?? '', array('class' => 'form-control m-input', 'placeholder' => 'Title in '.$value, 'autocomplete' => 'off', 'autofocus')) }}
						@error('title')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
	           @endforeach

		       @foreach($supported_languages as $key => $value)
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Meta Title in {{$value}}:</label>
					<div class="col-lg-6">
						{{ Form::text('meta_title['.$key.']', $meta_title[$key] ?? '', array('class' => 'form-control m-input', 'placeholder' => 'Meta Title in '.$value, 'autocomplete' => 'off', 'autofocus')) }}
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
						{!! Form::textarea('meta_des['.$key.']', $meta_des[$key] ?? null, ['class'=>'form-control m-input', 'placeholder' => 'Meta Description in '.$value, 'rows' => 3, 'cols' => 50]) !!}
						@error('meta_des')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
				@endforeach
				
	             <div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Meta keyword:</label>
					<div class="col-lg-6">
						{{ Form::text('meta_keyword', null, array('class' => 'form-control m-input', 'placeholder' => 'Meta keyword', 'autocomplete' => 'off', 'autofocus')) }}
						@error('meta_keyword')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Featured Image:</label>
					<div class="col-lg-6">
						{{ Form::file('featured_image', ['class'=>'form-control m-input', 'data-preview' => '#view-featured-image']) }}
						<span class="m-form__help">Dimensions : 1280*720</span>
						@error('featured_image')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
						<div class="image-block">
						<img id="view-featured-image" src="{{$record->seo_img}}" style="margin-top:10px;max-height: 150px;width: auto;">
						</div>
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
						<a href="{{route('backend.seo.index')}}" class="btn btn-secondary">Cancel</a>
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
{!! JsValidator::formRequest('App\Http\Requests\Backend\SEORequest','#edit-seo-form'); !!}
<script type="text/javascript">
	      $(function(){

  /* Preview Image */
		$('input[name="featured_image"]').change(function(e) {
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
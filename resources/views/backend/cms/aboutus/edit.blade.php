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
			<h3 class="m-subheader__title">About Us</h3>
		</div>
	</div>
</div>
<!-- END: Subheader -->

<div class="m-content">

	@include('backend.layouts.partials.alert-messages')

    @php
	$supported_languages = config('constants.supported_languages');
	$title = json_decode($record->getRawOriginal('title'),true);
	$description = json_decode($record->getRawOriginal('description'),true);
	@endphp

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
		{{ Form::model($record, array('route' => ['backend.aboutus.update', $record->id], 'id'=>'edit-about-form', 'class' => 'm-form', 'files' => true)) }}
		@method('PUT')
		<div class="m-portlet__body">	
			<div class="m-form__section m-form__section--first">
				@foreach($supported_languages as $key => $value)
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Title in {{$value}}:</label>
					<div class="col-lg-9">
						{{ Form::text('title['.$key.']',($title[$key]) ?? '', array('class' => 'form-control m-input', 'placeholder' => 'Title in '.$value, 'autocomplete' => 'off', 'autofocus')) }}
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
					<label class="col-lg-3 col-form-label">Content in {{$value}}:</label>
					<div class="col-lg-9">
						{!! Form::textarea('description['.$key.']',($description[$key]) ?? '',['class'=>'form-control m-input wysiwyg-editor','placeholder' =>'Content in '.$value, 'rows' => 2, 'cols' => 40]) !!}
						@error('description')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
					@endforeach

			</div>
		</div>
		<div class="m-portlet__foot m-portlet__foot--fit">
			<div class="m-form__actions m-form__actions">
				<div class="row">
					<div class="col-lg-3"></div>
					<div class="col-lg-6">
						<button class="btn btn-success">Submit</button>
						<a href="{{route('backend.aboutus.index')}}" class="btn btn-secondary">Cancel</a>
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
{!! JsValidator::formRequest('App\Http\Requests\Backend\AboutRequest', '#edit-about-form'); !!}
<script src="https://cdn.tiny.cloud/1/osfzf4ofj810coxh50pya87urduo1x63nz41gkdddq6niezh/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
	$(document).ready(function(){

		var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

		tinymce.init({
			selector: 'textarea.wysiwyg-editor',
			plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
			imagetools_cors_hosts: ['picsum.photos'],
			menubar: 'file edit view insert format tools table help',
			toolbar: 'undo redo | bold italic underline strikethrough blockquote| fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media link anchor codesample | ltr rtl',
			toolbar_sticky: true,
			autosave_ask_before_unload: true,
			autosave_interval: '30s',
			autosave_prefix: '{path}{query}-{id}-',
			autosave_restore_when_empty: false,
			autosave_retention: '2m',
			image_advtab: true,
			importcss_append: true,
			images_upload_url: 'postAcceptor.php',
			automatic_uploads: false,
			height: 600,
			image_caption: true,
			quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
			noneditable_noneditable_class: 'mceNonEditable',
			toolbar_mode: 'sliding',
			contextmenu: 'link image imagetools table',
			skin: useDarkMode ? 'oxide-dark' : 'oxide',
			content_css: useDarkMode ? 'dark' : 'default',
			content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
			rel_list: [
			{ title: 'None', value: '' },
			{ title: 'No Follow', value: 'nofollow' },
			{ title: 'Sponsored', value: 'sponsored' }
			]
		});

	});
</script>
@endsection
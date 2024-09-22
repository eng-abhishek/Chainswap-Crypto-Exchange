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
			<h3 class="m-subheader__title">Posts</h3>
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
						Edit Post
					</h3>
				</div>
			</div>
		</div>
		<!--begin::Form-->
		{{ Form::model($record, array('route' => ['backend.posts.update', $record->id], 'id'=>'edit-post-form', 'class' => 'm-form', 'files' => true)) }}
		@method('PUT')
		<div class="m-portlet__body">	
			<div class="m-form__section m-form__section--first">
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Title:</label>
					<div class="col-lg-9">
						{{ Form::text('title', null, array('class' => 'form-control m-input', 'placeholder' => 'Title', 'autocomplete' => 'off', 'autofocus')) }}
						@error('title')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Slug:</label>
					<div class="col-lg-9">
						{{ Form::text('slug', null, array('class' => 'form-control m-input', 'placeholder' => 'Slug', 'autocomplete' => 'off')) }}
						<span>Permalink : <a href="javascript:;">{{url('/blog')}}/<span class="slug-text"></span></a></span>
						@error('slug')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

	            <div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Category:</label>
					<div class="col-lg-6">
						{{ Form::select('blog_category_id', $blogCategory->prepend('Select Category',''), null, array('class' => 'form-control m-select2', 'id' => 'category')) }}
						@error('category')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Featured Image:</label>
					<div class="col-lg-6">
						{{ Form::file('image', ['class'=>'form-control m-input', 'data-preview' => '#view-featured-image']) }}
						<span class="m-form__help">Dimensions : 1280*720</span>
						@error('image')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
						<div class="image-block">
							<img id="view-featured-image" src="{{$record->image_url}}" style="margin-top:10px;max-height: 150px;width: auto;">
						</div>
					</div>
				</div>
				
				<div class="form-group m-form__group row">
					<div class="col-lg-3 offset-lg-3">
						{{ Form::text('image_alt', null, array('class' => 'form-control m-input', 'placeholder' => 'Alt', 'autocomplete' => 'off')) }}
					</div>
					<div class="col-lg-3">
						{{ Form::text('image_title', null, array('class' => 'form-control m-input', 'placeholder' => 'Title', 'autocomplete' => 'off')) }}
					</div>
				</div>
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Content:</label>
					<div class="col-lg-9">
						{!! Form::textarea('content',null,['class'=>'form-control m-input wysiwyg-editor', 'rows' => 2, 'cols' => 40]) !!}
						@error('content')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Status:</label>
					<div class="col-lg-6">
						{{ Form::select('status', collect($post_status), null, array('class' => 'form-control m-select2', 'id' => 'status')) }}
						@error('status')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Tag:</label>
					<div class="col-lg-6">
						{{ Form::select('blog_tag_id[]', $blogTag, $arr, array('class' => 'form-control m-select2', 'id' => 'm_select2_3','multiple'=>'multiple')) }}
						@error('tag')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="form-group m-form__group row post_schedule_date {{(old('status') == 'Publish' || $record->status == 'Publish')?'':'d-none'}}">
					<label class="col-form-label col-lg-3">Publish at</label>
					<div class="col-lg-6">
						<div class="input-group date">
							{{ Form::text('publish_at', null, array('id' => 'publish_at', 'class' => 'form-control m-input m_datetimepicker', 'placeholder' => 'yyyy-mm-dd h:i:s', 'readonly' => true)) }}
							<div class="input-group-append">
								<span class="input-group-text">
									<i class="la la-calendar glyphicon-th"></i>
								</span>
							</div>
							@error('publish_at')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
				</div>
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Meta title:</label>
					<div class="col-lg-9">
						{{ Form::text('meta_title', null, array('class' => 'form-control m-input', 'placeholder' => 'Meta title', 'autocomplete' => 'off', 'maxlength' => 80, 'id' => 'meta_title')) }}
						@error('meta_title')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
				<div class="form-group m-form__group row">
					<label class="col-lg-3 col-form-label">Meta description:</label>
					<div class="col-lg-9">
						{!! Form::textarea('meta_description',null,['class'=>'form-control m-input', 'placeholder' => 'Meta description', 'rows' => 3, 'cols' => 50, 'maxlength' => 200, 'id' => 'meta_description']) !!}
						@error('meta_description')
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
						<a href="{{route('backend.posts.index')}}" class="btn btn-secondary">Cancel</a>
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
{!! JsValidator::formRequest('App\Http\Requests\Backend\PostRequest', '#edit-post-form'); !!}
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

		$(".m_datetimepicker").datetimepicker({
			todayHighlight:!0,
			autoclose:!0,
			todayBtn:!0,
			format: "yyyy-mm-dd hh:ii:ss"
		});

		$('#status').change(function(){
			if($(this).val() == 'Publish'){
				$('.post_schedule_date').removeClass('d-none');
			}else{
				$('.post_schedule_date').addClass('d-none');
			}
		});

		$('input[name="title"]').keyup(function(){
			var slug = slugify($(this).val());
			$('input[name="slug"]').val(slug);
			$('.slug-text').text(slug);
		});

		$('input[name="slug"]').keyup(function(){
			$('.slug-text').text(slugify($(this).val()));
		});

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

$("#m_select2_3").select2({placeholder:"Select a tag"})

	});
</script>
@endsection
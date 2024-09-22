@if(session()->has('status'))
<div class="row">
	<div class="col-lg-12">
		@if(session('status') == 'success')
		<div class="alert-custom alert-custom-success">
			<p class="mb-0">{{session('message')}}</p>
		</div>
		@else
		<div class="alert-custom alert-custom-error">
			<p class="mb-0">{{session('message')}}</p>
		</div>
		@endif
	</div>
</div>
@endif

<div id="jserror_msg" class="row d-none">
	<div class="col-lg-12">
		<div class="alert-custom alert-custom-error">
			<p class="mb-0 message"></p>
		</div>
	</div>
</div>
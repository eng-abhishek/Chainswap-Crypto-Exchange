@extends('backend.layouts.app')

@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title">Exchange</h3>
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
						List
					</h3>
				</div>
			</div>
			<div class="m-portlet__head-tools">
				<ul class="m-portlet__nav">
					<li class="m-portlet__nav-item">
						<a href="{{route('backend.exchange.create')}}" class="btn btn-focus m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
							<span>
								<span>Add New Exchange</span>
							</span>
						</a>
					</li>
					<li class="m-portlet__nav-item"></li>
				</ul>
			</div>
		</div>
		<div class="m-portlet__body">
			
			<!--begin: Search Form -->
			<form class="m-form m-form--fit m--margin-bottom-20">
				<div class="row m--margin-bottom-20">
					<div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
						{{ Form::select('status', collect(config('constants.post.status'))->prepend('Select status', ''), null, array('class' => 'form-control m-input filter_status')) }}
					</div>
					<div class="col-lg-3 offset-md-6 m--margin-bottom-10-tablet-and-mobile">
						<button type="button" class="btn btn-brand m-btn m-btn--icon" id="submit_filters">
							<span>
								<i class="la la-search"></i>
								<span>Search</span>
							</span>
						</button>
						&nbsp;&nbsp;
						<button type="button" class="btn btn-secondary m-btn m-btn--icon" id="reset_filters">
							<span>
								<i class="la la-close"></i>
								<span>Reset</span>
							</span>
						</button>
					</div>
				</div>
			</form>
			<!--end: Search Form -->

			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
				<thead>
					<tr>
						<th>No</th>
						<th>From Coin</th>
						<th>To Coin</th>
						<th>Slug</th>
						<th>Updated At</th>
						<th width="100px">Action</th>
					</tr>
				</thead>
				<tbody>
				</tbody>	
			</table>
			<!--end: Datatable -->
		</div>	
	</div>
	<!--end::Portlet-->

</div>
@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){

		var table = $('#m_table_1').DataTable({
			processing: true,
			serverSide: true,
			ajax:{
				url:"{{ route('backend.exchange.index') }}",
				data: function (d) {
                	d.search = $('input[type="search"]').val(),
					d.status = $('.filter_status').val()
            	}
			},
			columns: [
			{data: 'DT_RowIndex', name:'DT_RowIndex', orderable: false, searchable: false},
			{data: 'from_coin', name: 'from_coin'},
		    {data: 'to_coin', name: 'to_coin'},
			{data: 'slug', name: 'slug'},
			{data: 'updated_at', name: 'updated_at'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});

		/* Filter records */
		$('#submit_filters').click(function(){
			table.draw();
		});

		$('#reset_filters').click(function(){
			$('input[type="search"]').val('');
			$('.filter_status').val('');
			table.draw();
		});

		/* Delete record */
		$(document).on('click', '.delete-record', function (e) {
			var url = $(this).data('url');
			var action = $(this).data('action');

			var message = "Are you sure you want to delete this post";
			if(action == 'trash'){
				message = "Are you sure you want to trash this post";
			}else if(action == 'permanently-delete'){
				message = "Are you sure you want to permanently delete this post";
			}

			swal({ 
				title: "Are you sure?",
				text: message,
				type: "warning",
				showCancelButton: true,
				confirmButtonText: "Yes, delete it!"
			}).then(function (e) {
				if(e.value){
					mApp.blockPage({
						overlayColor: "#000000",
						type: "loader",
						state: "success",
						message: "Please wait..."
					});

					$.ajax({
						headers: {
							'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
						},
						type: "delete",
						url: url,
						success: function (result) {
							mApp.unblockPage();
							if (result.status == 'success') {
								table.draw();
								toastr.success(result.message);
							} else {
								toastr.error(result.message);
							}
						},
						error: function (jqXHR, textStatus, errorThrown) {
							mApp.unblockPage();
						}
					});
				}
			});
		});

		/* Restore trashed record */
		$(document).on('click', '.restore-record', function (e) {
			var url = $(this).data('url');

			swal({ 
				title: "Are you sure?",
				text: "Are you sure you want to restore this post",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: "Yes, restore it!"
			}).then(function (e) {
				if(e.value){
					mApp.blockPage({
						overlayColor: "#000000",
						type: "loader",
						state: "success",
						message: "Please wait..."
					});

					$.ajax({
						headers: {
							'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
						},
						type: "post",
						url: url,
						success: function (result) {
							mApp.unblockPage();
							if (result.status == 'success') {
								table.draw();
								toastr.success(result.message);
							} else {
								toastr.error(result.message);
							}
						},
						error: function (jqXHR, textStatus, errorThrown) {
							mApp.unblockPage();
						}
					});
				}
			});
		});

	});
</script>
@endsection
@extends('backend.layouts.app')

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
						{{-- Department List --}}
					</h3>
				</div>
			</div>
			<div class="m-portlet__head-tools">
				<ul class="m-portlet__nav">
					<li class="m-portlet__nav-item">
						<a href="{{route('backend.enquiry.create')}}" class="btn btn-focus m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
							<span>
								<span>Create Enquiry</span>
							</span>
						</a>
					</li>
					<li class="m-portlet__nav-item">
						<a class="text-white btn btn-danger btn-focus m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air bulk_delete"><i class="la la-trash"></i>Delete All Selected</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="m-portlet__body">
			
			<!--begin: Search Form -->
			{{-- <form class="m-form m-form--fit m--margin-bottom-20">
				<div class="row m--margin-bottom-20">
					<div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
						{{ Form::select('status', collect($status)->prepend('Select status', ''), null, array('class' => 'form-control m-input filter_status')) }}
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
			</form> --}}
			<!--end: Search Form -->
			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
				<thead>
					<tr>
						<th width="50px"><div class="form-check"><input type="checkbox" id="master" class="form-check-input"></div></th>
						<th>No</th>
						<th>Name</th>
						<th>Email</th>
						<th>Order Id</th>
						<th>Description</th>
						<th>Date</th>
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
				url:"{{ route('backend.enquiry.index') }}",
				data: function (d) {
					d.search = $('input[type="search"]').val()
				}
			},
			columns: [
			{data:'delCheckbox',name:'delCheckbox',orderable: false, searchable: false},
			{data: 'DT_RowIndex', name:'DT_RowIndex', orderable: false, searchable: false},
			{data: 'name', name: 'name'},
			{data: 'email', name: 'email'},
			{data: 'order_id', name: 'order_id'},
			{data: 'message', name: 'message'},
			{data: 'created_at', name: 'created_at'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});

		$('#master').on('click', function(e) {
			if($(this).is(':checked',true))  
			{
				$(".enquiry_checkbox").prop('checked', true);

			}else{

				$(".enquiry_checkbox").prop('checked',false);

			}
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


		$(document).on('click', '.bulk_delete', function(){
			var id = [];

			$('.enquiry_checkbox:checked').each(function(){
				id.push($(this).val());
			});

			if(id.length > 0)
			{

				Swal.fire({
					title: 'Are you sure?',
					text: "Once deleted, you will not be able to recover this Inquries!",
					icon: "warning",
					showCancelButton: true,
					confirmButtonText: 'Yes, deleted it!'

				}).then((result) => {
					if (result.value){
						//$.blockUI();

						$('.enquiry_checkbox:checked').each(function(){
							id.push($(this).val());
						});

						$.ajax({
							url:"{{ route('backend.enquiry.removeall')}}",
							headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
							method:"post",
							data:{id:id},
							success:function(data)
							{
								if(data.status=='success'){
									table.draw();
									//$.unblockUI();
									Swal.fire({
										html: data.message,
										icon: "success",
										confirmButtonText: 'Close'
									});
									$('#master').prop('checked',false);
								}else{
									//$.unblockUI();
									Swal.fire({
										html: data.message,
										icon: "error",
										confirmButtonText: 'Close'
									});
								} 
							},
							error: function(data) {
								var errors = data.responseJSON;
								console.log(errors);
							}
						});

					}else if (result.dismiss === 'cancel') {

						//$.unblockUI();
						Swal.fire({
							html: "Something went Wrong!",
							icon: "error",
							confirmButtonText: 'Close'
						});
					}
				});
			}else{
				Swal.fire({
					html: "Please select atleast one item Wrong!",
					icon: "error",
					confirmButtonText: 'Close'
				});
			}
		});

	});
</script>
@endsection
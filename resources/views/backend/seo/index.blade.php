@extends('backend.layouts.app')
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
			</div>
		</div>
		<div class="m-portlet__body">
			<!--begin: Datatable -->
			<table class="table table-striped-table-bordered table-hover table-checkable" id="m_table_seo">
				<thead>
					<tr>
					<th>SI.No</th>
                                            <th>Page Slug</th>
                                            <th>Title</th>
                                            <th>Meta Title</th>
                                            <th>Meta Description</th>
                                            <th>Meta Keyword</th>
                                            <th>Featured Image</th>
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
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		var table = $('#m_table_seo').DataTable({
			processing: true,
			serverSide: true,
			ajax:"{{ route('backend.seo.index') }}",
			columns: [
			
		    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},

            {data: 'slug', name: 'slug'},

            {data: 'title', name: 'title'},

            {data: 'meta_title', name: 'meta_title'},

            {data: 'description', name: 'description'},

            {data: 'meta_keyword', name: 'meta_keyword'},

            {data: 'image', name: 'image'},

            {data: 'updated_at', name: 'updated_at'},

            {data: 'action', name: 'action', orderable: false, searchable: false},

			]
		});

	});
</script>
@endsection
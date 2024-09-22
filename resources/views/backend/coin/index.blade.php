@extends('backend.layouts.app')
@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title">Coins</h3>
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
		</div>
		<div class="m-portlet__body">

			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
				<thead>
					<tr>
						<th>No</th>
						<th>Symbol</th>
						<th>Name</th>
						<th>UUID (Coinranking)</th>
						<th>Desc</th>
						<th>Whitepaper Url</th>
						<th>Officialsite Url</th>
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
		var table = $('#m_table_1').DataTable({
			processing: true,
			serverSide: true,
			ajax:{
				url:"{{ route('backend.coins.index') }}",
				data: function (d) {
                	d.search = $('input[type="search"]').val()
            	}
			},
			columns: [
			{data: 'DT_RowIndex', name:'DT_RowIndex', orderable: false, searchable: false},
			{data: 'symbol', name: 'symbol'},
			{data: 'coin_name', name: 'coin_name'},
			{data: 'coinranking_uuid', name: 'coinranking_uuid'},
			{data: 'coin_desc', name: 'coin_desc'},
			{data: 'coin_whitepaper_url', name: 'coin_whitepaper_url'},
			{data: 'coin_officialsite_url', name: 'coin_officialsite_url'},
			{data: 'action', name: 'action', orderable: false, searchable: false}
			]
		});

		/* Filter records */
		$('#submit_filters').click(function(){
			table.draw();
		});

		$('#reset_filters').click(function(){
			$('input[type="search"]').val('');
			table.draw();
		});
});
</script>
@endsection
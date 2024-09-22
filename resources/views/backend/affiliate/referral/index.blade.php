@extends('backend.layouts.app')
@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title">Referral Commission Request</h3>
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
			<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
				<thead>
					<tr>
						<th>No</th>
						<th>Partner id</th>
						<th>Email id</th>
						<th>Amount</th>
						<th>Wallet Address</th>
						<th>Affiliate id</th>
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
			ajax:"{{ route('backend.affiliate.referral-commission.index') }}",
			columns: [
			{data: 'DT_RowIndex', name:'DT_RowIndex', orderable: false, searchable: false},
			{data: 'partner_id', name: 'partner_id'},
			{data: 'email', name: 'email'},
			{data: 'total_commission', name: 'total_commission'},
			{data: 'wallet_address', name: 'wallet_address'},
	        {data: 'affiliate_id', name: 'affiliate_id'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});

	});
</script>
@endsection
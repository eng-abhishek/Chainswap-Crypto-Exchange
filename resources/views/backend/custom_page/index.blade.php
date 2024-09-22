@extends('backend.layouts.app')
@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title">Custom Page</h3>
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
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="tbl_c_page">
                <thead>
                    <tr>
                        <th>SI.Nos</th>
                        <th>Page Slug</th>
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
        var table = $('#tbl_c_page').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('backend.custom-page.index') }}",
            columns: [
            
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
             
            {data: 'slug', name: 'slug'},

            {data: 'updated_at', name: 'updated_at'},

            {data: 'action', name: 'action', orderable: false, searchable: false},

            ]
        });
    });
    </script>
    @endsection

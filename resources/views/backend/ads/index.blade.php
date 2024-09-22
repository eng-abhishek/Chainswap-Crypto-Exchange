@extends('backend.layouts.app')
@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title">Ads</h3>
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
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="{{route('backend.ads.create')}}" class="btn btn-focus m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                            <span>
                                <span>Add New Ads</span>
                            </span>
                        </a>
                    </li>
                    <li class="m-portlet__nav-item"></li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="tbl_c_page">
                <thead>
                    <tr>
                        <th>SI.Nos</th>
                        <th>Image</th>
                        <th>Url</th>
                        <th>Created At</th>
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
            ajax: "{{ route('backend.ads.index') }}",
            columns: [
            
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},

            {data: 'image', name: 'image'},

            {data: 'url', name: 'url'},

            {data: 'created_at', name: 'created_at'},

            {data: 'action', name: 'action', orderable: false, searchable: false},

            ]
        });

        /* Delete record */
        $(document).on('click', '.delete-record', function (e) {
            var url = $(this).data('url');
            swal({ 
                title: "Are you sure?",
                text: "You won't be able to revert this!",
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

    });
    </script>
    @endsection

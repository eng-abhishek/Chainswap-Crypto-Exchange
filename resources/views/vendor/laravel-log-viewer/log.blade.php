@extends('backend.layouts.app')

@section('styles')
<style type="text/css">
      #table-log {
        font-size: 0.85rem;
    }

    .sidebar {
        font-size: 0.85rem;
        line-height: 1;
    }

    .btn {
        font-size: 0.7rem;
    }

    .stack {
      font-size: 0.85em;
    }

    .date {
      min-width: 75px;
    }

    .text {
      word-break: break-all;
    }

    a.llv-active {
      z-index: 2;
      background-color: #f5f5f5;
      border-color: #777;
    }

    .list-group-item {
      word-break: break-word;
    }

    .folder {
      padding-top: 15px;
    }

    .div-scroll {
      height: 80vh;
      overflow: hidden auto;
    }
    .nowrap {
      white-space: nowrap;
    }
    .list-group {
            padding: 5px;
        }

    /**
    * DARK MODE CSS
    */

    body[data-theme="dark"] {
      background-color: #151515;
      color: #cccccc;
    }

    [data-theme="dark"] a {
      color: #4da3ff;
    }

    [data-theme="dark"] a:hover {
      color: #a8d2ff;
    }

    [data-theme="dark"] .list-group-item {
      background-color: #1d1d1d;
      border-color: #444;
    }

    [data-theme="dark"] a.llv-active {
        background-color: #0468d2;
        border-color: rgba(255, 255, 255, 0.125);
        color: #ffffff;
    }

    [data-theme="dark"] a.list-group-item:focus, [data-theme="dark"] a.list-group-item:hover {
      background-color: #273a4e;
      border-color: rgba(255, 255, 255, 0.125);
      color: #ffffff;
    }

    [data-theme="dark"] .table td, [data-theme="dark"] .table th,[data-theme="dark"] .table thead th {
      border-color:#616161;
    }

    [data-theme="dark"] .page-item.disabled .page-link {
      color: #8a8a8a;
      background-color: #151515;
      border-color: #5a5a5a;
    }

    [data-theme="dark"] .page-link {
      background-color: #151515;
      border-color: #5a5a5a;
    }

    [data-theme="dark"] .page-item.active .page-link {
      color: #fff;
      background-color: #0568d2;
      border-color: #007bff;
    }

    [data-theme="dark"] .page-link:hover {
      color: #ffffff;
      background-color: #0051a9;
      border-color: #0568d2;
    }

    [data-theme="dark"] .form-control {
      border: 1px solid #464646;
      background-color: #151515;
      color: #bfbfbf;
    }

    [data-theme="dark"] .form-control:focus {
      color: #bfbfbf;
      background-color: #212121;
      border-color: #4a4a4a;
  }
  #table-log{
    font-size: 13px !important;
  }
  </style>
@endsection


@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader">
  <div class="d-flex align-items-center">
    <div class="mr-auto">
      <h3 class="m-subheader__title">Logs</h3>
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
      <div class="row">
        <div class="col-12 table-container">
          @if ($logs === null)
          <div>
            Log file >50M, please download it.
          </div>
          @else
          <table class="table table-striped- table-bordered table-hover table-checkable" id="table-log" data-ordering-index="{{ $standardFormat ? 2 : 0 }}">
            <thead>
              <tr>
                @if ($standardFormat)
                <th>Level</th>
                <th>Context</th>
                <th>Date</th>
                @else
                <th>Line number</th>
                @endif
                <th>Content</th>
              </tr>
            </thead>
            <tbody>

              @foreach($logs as $key => $log)
              <tr data-display="stack{{{$key}}}">
                @if ($standardFormat)
                <td class="nowrap text-{{{$log['level_class']}}}">
                  <span class="fa fa-{{{$log['level_img']}}}" aria-hidden="true"></span>&nbsp;&nbsp;{{$log['level']}}
                </td>
                <td class="text">{{$log['context']}}</td>
                @endif
                <td class="date">{{{$log['date']}}}</td>
                <td class="text">
                  @if ($log['stack'])
                  <button type="button"
                  class="float-right expand btn btn-outline-dark btn-sm mb-2 ml-2"
                  data-display="stack{{{$key}}}" id="btnSearch{{$key}}" onclick="btnSearch({{$key}})">
                  <span class="fa fa-search"></span>
                </button>
                @endif
                {{{$log['text']}}}
                @if (isset($log['in_file']))
                <br/>{{{$log['in_file']}}}
                @endif
                @if ($log['stack'])
                <div class="stack d-none" id="stack{{{$key}}}"
                style="white-space: pre-wrap;">{{{ trim($log['stack']) }}}
              </div>
              <br>
              <button type="button"
              class="d-none expand btn btn-outline-dark btn-sm mb-2 ml-2"
              id="btnHide{{$key}}" onclick="btnHide({{$key}})">Hide</button>
              @endif
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
      @endif
      <div class="p-3">
        @if($current_file)
        <a href="?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
          <span class="fa fa-download"></span> Download file
        </a>
        -
        <a id="clean-log" href="?clean={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
          <span class="fa fa-sync"></span> Clean file
        </a>
        -
        <a id="delete-log" href="?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
          <span class="fa fa-trash"></span> Delete file
        </a>
        @if(count($files) > 1)
        -
        <a id="delete-all-log" href="?delall=true{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
          <span class="fa fa-trash-alt"></span> Delete all files
        </a>
        @endif
        @endif
      </div>
    </div>
  </div>
</div>  
</div>
<!--end::Portlet-->
</div>
@endsection
@section('scripts')
<!-- jQuery for Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
crossorigin="anonymous"></script>
<script>

  // dark mode by https://github.com/coliff/dark-mode-switch
  const darkSwitch = document.getElementById('darkSwitch');

  // this is here so we can get the body dark mode before the page displays
  // otherwise the page will be white for a second... 
  initTheme();

  window.addEventListener('load', () => {
    if (darkSwitch) {
      initTheme();
      darkSwitch.addEventListener('change', () => {
        resetTheme();
      });
    }
  });

  // end darkmode js

  $(document).ready(function () {
    $('.table-container tr').on('click', function () {
      $('#' + $(this).data('display')).toggle();
    });
    $('#table-log').DataTable({
      "order": [$('#table-log').data('orderingIndex'), 'desc'],
      "stateSave": true,
      "stateSaveCallback": function (settings, data) {
        window.localStorage.setItem("datatable", JSON.stringify(data));
      },
      "stateLoadCallback": function (settings) {
        var data = JSON.parse(window.localStorage.getItem("datatable"));
        if (data) data.start = 0;
        return data;
      }
    });
    $('#delete-log, #clean-log, #delete-all-log').click(function () {
      return confirm('Are you sure?');
    });
  });

  function btnSearch(id){
    $('#stack'+id).removeClass('d-none');
    $('#btnHide'+id).removeClass('d-none');
  }

  function btnHide(id){
    $('#stack'+id).addClass('d-none');
    $('#btnHide'+id).addClass('d-none');
    
  }

</script>
@endsection
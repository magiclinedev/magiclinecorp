@extends('admin-dash-layout')
@section('title')
  {{ GoogleTranslate::trans('Admin | Types', app()->getLocale()) }}
@endsection
@section('page-active')
  {{ GoogleTranslate::trans('Types', app()->getLocale()) }}
@endsection
@section('links')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="{{asset('plugins/ekko-lightbox/ekko-lightbox.css')}}">
  
  <style>
    @media print {
      #unprintable,#example1_paginate,#example1_info,#example1_filter,.dt-buttons,.card-header {
        display: none;
      }
    }
  </style>
@endsection
@section('main-content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        @if(Session::get('success'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fas fa-check"></i> {{ GoogleTranslate::trans(Session::get('success'), app()->getLocale()) }}
        </div>
        @endif
        @if(Session::get('deleted'))
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fas fa-ban"></i>  {{ GoogleTranslate::trans(Session::get('deleted'), app()->getLocale()) }}
        </div>
        @endif
        <div class="row">
          <div class="col">
            <h3 class="card-title">{{ GoogleTranslate::trans('Types', app()->getLocale()) }}</h3>
            
            
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form method="post" class="form-group" id="trashform" action="{{route('trashtype')}}">
        @csrf
        <div class="row">
          <div class="col-sm-2">
            <div class="input-group">
              <select class="form-control" name="action" aria-placeholder="Bulk Action">
                <option value="" disabled selected hidden>Bulk Action</option>
                <option value="deletetype" >Permanently Delete</option>
                    
              </select>
              <button type="submit" class="btn btn-outline-dark ml-1">{{ GoogleTranslate::trans('Apply', app()->getLocale()) }}</button>
            </div>
          </div>
          <div> <a href="{{route('addtype')}}" class="btn btn-light ml-3"><i class="fa fa-user-plus"></i> {{ GoogleTranslate::trans('Add New Type', app()->getLocale()) }}</a> </div>

        </div>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th><input type="checkbox" id="select-all"></th>
            <th>{{ GoogleTranslate::trans('Type', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Addedby', app()->getLocale()) }}</th>
          </tr>
          </thead>
          <tbody>
      <?php
        foreach ($types as $type) { ?>
          <tr>
            <td><input type="checkbox" value="{{$type->id}}" name="checkbox[]"></td>
            <td><?php echo $type->type; ?></td>
            <td><?php echo $type->addedby.' on '.date("M-d-y", strtotime($type->created_at)).' at '.date("H:i:s", strtotime($type->created_at)); ?></td>
            
          </tr>
      <?php } ?>
          
          
          </tbody>
          <tfoot>
          <tr>
            <th></th>
            <th>{{ GoogleTranslate::trans('Type', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Addedby', app()->getLocale()) }}</th>
          </tr>
          </tfoot>
        </table>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
@endsection
@section('scripts')
<!-- DataTables  & Plugins -->
<script src="{{asset('/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- Ekko Lightbox -->
<script src="{{asset('plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>
<script type="text/javascript">  
  // Add this code in a script tag or external JavaScript file

  // Get the "Select All" checkbox element
  const selectAllCheckbox = document.getElementById('select-all');

  // Get all the checkboxes within the form
  const checkboxes = document.querySelectorAll('#trashform input[type="checkbox"]');

  // Add event listener to the "Select All" checkbox
  selectAllCheckbox.addEventListener('change', function () {
      // Loop through all the checkboxes
      checkboxes.forEach(function (checkbox) {
          // Check/uncheck each checkbox based on the state of the "Select All" checkbox
          checkbox.checked = selectAllCheckbox.checked;
      });
  });           
</script>
@endsection

@extends('admin-dash-layout')
@section('title')
{{ GoogleTranslate::trans('Product Trash', app()->getLocale()) }}
@endsection
@section('page-back')
@if ($company)
<li class="breadcrumb-item"><a href="{{url('admin/partnerproduct/'.$company)}}">{{strtoupper($company)}}</a></li>
@endif
@endsection
@section('page-active')
  {{ GoogleTranslate::trans('Product Trash', app()->getLocale()) }}
@endsection
@section('links')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
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
          <div class="col-md-1">
            <h3 class="card-title">{{ GoogleTranslate::trans('Trash', app()->getLocale()) }}</h3>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form method="post" class="form-group" id="trashform" action="{{route('trashproductaction')}}">
          @csrf
          <div class="row">
            <div class="col-sm-2">
              <div class="input-group">
                <select class="form-control" name="action" aria-placeholder="Bulk Action">
                  <option value="" disabled selected hidden>Bulk Action</option>
                  <option value="restoreproduct" >Restore</option>
                  <option value="deleteproduct" >Permanently Delete</option>
                      
                </select>
                <button type="submit" class="btn btn-outline-dark ml-1">{{ GoogleTranslate::trans('Apply', app()->getLocale()) }}</button>
              </div>
            </div>
          </div>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th><input type="checkbox" id="select-all"></th>
            <th>{{ GoogleTranslate::trans('Image', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Purchase Order', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Item Reference', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Company', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Category', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Type', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Added By', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Modified By', app()->getLocale()) }}</th>
          </tr>
          </thead>
          <tbody>
            <?php 
              $products=DB::table('products')->where('archived','=',1)->get();
              $checkrole = DB::table('users')->where('id','=',session()->get('LoggedUser'))->get();
              foreach ($checkrole as $check) {
                $userrole = $check->role;
              }
              foreach ($products as $product) { 
                $delimiter = ",";
                $image_array = [];
                foreach (explode(",",$product->images) as $value) {
                    $image_array[] = $value;
                }
                sort($image_array);
                $first_image = $image_array[0];
              ?>
              <tr>
                <td><input type="checkbox" value="{{$product->id}}" name="checkbox[]"></td>
                <td><img src="{{asset('storage/product_images/'.$first_image)}}" alt="<?php echo $first_image;?>" style="height: 100px"></td>
                <td><?php echo $product->po; ?></td>
                <td><?php echo $product->itemref; ?></td>
                <td><?php echo $product->company; ?></td>
                <td><?php echo $product->category; ?></td>
                <td><?php echo $product->type; ?></td>
                <td><?php echo $product->addedby; ?></td>
                <td><?php echo $product->updatedby; ?></td>
              </tr>
        
            <?php } ?>
          
          </tbody>
          <tfoot>
          <tr>
            <th></th>
            <th>{{ GoogleTranslate::trans('Image', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Purchase Order', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Item Reference', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Company', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Category', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Type', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Added By', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Modified By', app()->getLocale()) }}</th>
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
<script src="{{asset('/plugins/datatables/jquery.dataTables.min2.js')}}"></script>
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
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
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

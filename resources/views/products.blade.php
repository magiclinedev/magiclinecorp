@extends('dash-layout')
@section('title')
  {{ GoogleTranslate::trans('ALL PRODUCTS', app()->getLocale()) }}
@endsection
@section('page-active')
{{ GoogleTranslate::trans('ALL PRODUCTS', app()->getLocale()) }}
@endsection
@section('links')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="{{asset('plugins/ekko-lightbox/ekko-lightbox.css')}}">
@endsection
@section('main-content')
<div class="row" >
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
        <h3 class="card-title">{{ GoogleTranslate::trans('ALL PRODUCTS', app()->getLocale()) }}</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
            <?php
            $CurrentUser = session()->get('LoggedUser');
            $checkrole = DB::table('users')->where('id','=',$CurrentUser)->get();
            $producttrash = DB::select('select * from products where archived = 1');
            $showprice = false;
            $checkrole = DB::select('select * from users where id = ?', [session()->get('LoggedUser')]);
            foreach ($products as $product) {
              $priceaccesslists = DB::select('select * from prices where itemref = ?', [$product->itemref]);
            }
            
            foreach ($checkrole as $role) {
              $userrole = $role->role;
            }
            $company = DB::select('select * from partners where archived is null');
          ?>
        
        
        <div class="col-sm-4">
            

         


            <form method="get" class="form-group" action="{{url('admin/products')}}">
              <div class="input-group">
            
                  <?php $categories = DB::select('select * from categories') ?>
                  
                    <select  name="category" id="category" class="form-control"  aria-placeholder="Category">
                      <option value="" disabled selected hidden>Category</option>
                      @foreach ($categories as $categ)
                      <option value="{{$categ->category}}" <?php if(old('category')==$categ->category){ echo 'selected';} ?>>{{$categ->category}}</option>
                      @endforeach
                    </select>


                <select class="form-control ml-1" name="comp_filter" aria-placeholder="Company">
                  <option value="" disabled selected hidden>Company</option>
                  @foreach ($company as $comp)
                  <option value="{{$comp->company}}" <?php if($selected_comp=="$comp->company"){echo 'selected';} ?> >{{$comp->company}}</option>
                  @endforeach  
                </select>
                <button type="submit" class="btn btn-outline-dark ml-1">{{ GoogleTranslate::trans('Filter', app()->getLocale()) }}</button>
                <a href="{{url('admin/products')}}" class="btn btn-outline-dark ml-2">{{ GoogleTranslate::trans('Show All', app()->getLocale()) }}</a>
              </div>
            </form>
          </div>
          <div class="col-sm-3">
            @if ($userrole=='admin1'||$userrole=='owner' || $userrole == 'admin2')
              <a href="{{route('addproduct')}}" class="btn btn-light"><i class="fas fa-file-upload"></i><span class="ml-2">{{ GoogleTranslate::trans('Add Product', app()->getLocale()) }}</span></a>
            @endif
            @if ($userrole=='admin1'||$userrole=='owner')
              @if (count($producttrash)>0)
              <a href="{{route('trashproduct')}}" class="btn btn-light"><i class="fas fa-trash"></i> {{ GoogleTranslate::trans('Trash', app()->getLocale()) }}
                <span class="right badge badge-danger">{{count($producttrash)}}</span>
              </a>
              @endif
            @endif
            
          </div>
        <div class="col-12">
        <form action="{{route('trashproducts')}}" id="productform" method="post">
          @if ($userrole == 'admin1' || $userrole == 'owner')
          <div class="col-sm-2 p-0">
            <div class="input-group">
              <select class="form-control" name="actions" aria-placeholder="Bulk Action">
                <option value="" disabled selected hidden>Bulk Action</option>
                <option value="Move to Trash">Move to Trash</option>
                    
              </select>
              <button type="submit" class="btn btn-outline-dark ml-1">{{ GoogleTranslate::trans('Apply', app()->getLocale()) }}</button>
            </div>
          </div>
          @endif
          @csrf
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            @if ($userrole == 'admin1' || $userrole == 'owner')
            <th><input type="checkbox" id="select-all"></th>
            @endif
            <th>{{ GoogleTranslate::trans('Image', app()->getLocale()) }}</th>
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
        
        
        foreach ($products as $key => $product) {
          $image_array = [];
          foreach (explode(",",$product->images) as $value) {
              $image_array[] = $value;
          }
          sort($image_array);
          $first_image = $image_array[0];
        ?>
        <tr>
          <td><input type="checkbox" value="{{$product->id}}" name="checkbox[]"></td>
          <td>
            <a href="{{asset('storage/product_images/'.$first_image)}}" data-toggle="lightbox" data-title="<?php echo $product->itemref;?>" data-gallery="product">
              <img src="{{asset('storage/product_images/'.$first_image)}}" alt="<?php echo $first_image;?>" style="height: 100px">
            </a>
          </td>
          <td>
            <p onmouseover="document.getElementById('actions{{$key}}').style.display = 'block';" class="text-md"><?php echo $product->itemref; ?></p>
            <span id="actions{{$key}}" style="display: none;" class="text-sm" onmouseleave="document.getElementById('actions{{$key}}').style.display = 'none';">
              <a href="{{route('product_detail',$product->id)}}" class="text-dark">
                <i class="fas fa-eye"></i> {{ GoogleTranslate::trans('View', app()->getLocale()) }}
              </a>
              @if ($userrole=='admin1' || $userrole=='owner' || $userrole=='admin2') | 
              <a href="{{route('editproduct',$product->id)}}" class="text-dark">
                <i class="fa fa-edit"></i> {{ GoogleTranslate::trans('Edit', app()->getLocale()) }}
              </a>
              @endif 
              @if ($userrole=='admin1' || $userrole=='owner') | 
              <a href="{{route('trashproducts',['id'=>$product->id])}}" class="text-dark">
                <i class="fa fa-trash"></i> {{ GoogleTranslate::trans('Trash', app()->getLocale()) }}
              </a>
              @endif 
              @if ($userrole=='admin1' || $userrole=='owner' || $userrole=='admin2') | 
              <a href="{{route('duplicateproduct',['id'=>$product->id])}}" class="text-dark">
                <i class="fas fa-clone"></i> {{ GoogleTranslate::trans('Duplicate', app()->getLocale()) }}
              </a>
              @endif 
            </span>
          </td>
          <td class="text-md"><?php echo $product->company; ?></td>
          <td class="text-md"><?php echo $product->category; ?></td>
          <td class="text-md"><?php echo $product->type; ?></td>
          <td class="text-md"><?php echo $product->addedby.' on '.date("M-d-y", strtotime($product->created_at)).' at '.date("H:i:s", strtotime($product->created_at)); ?></td>
          <td class="text-md">
            <?php if ($product->updatedby) {
              echo $product->updatedby.' on '.date("M-d-y", strtotime($product->updated_at)).' at '.date("H:i:s", strtotime($product->updated_at));
            } ?>
          </td>
        </tr>
  
        
        
      <?php } ?>
          
          
          </tbody>
          <tfoot>
          <tr>
            <th></th>
            <th>{{ GoogleTranslate::trans('Image', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Item Reference', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Company', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Category', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Type', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Added By', app()->getLocale()) }}</th>
            <th>{{ GoogleTranslate::trans('Modified By', app()->getLocale()) }}</th>
          </tr>
          </tfoot>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-m" role="document">
            <div class="modal-content">
              <div class="modal-header bg-warning">
                <h4 class="modal-title" id="myModalLabel"><i class="fas fa-exclamation-triangle"></i> {{ GoogleTranslate::trans('Warning!', app()->getLocale()) }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h5>{{ GoogleTranslate::trans('Are you sure to delete this product?', app()->getLocale()) }}</h5>
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i>  {{ GoogleTranslate::trans('Delete', app()->getLocale()) }}</button>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ GoogleTranslate::trans('Close', app()->getLocale()) }}</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      </div>
      </div>
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
<!-- Ekko Lightbox -->
<script src="{{asset('/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>
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
      
    $('#my-filter').on('change',function(){
      var filterValue = $(this).val();
      $("#example1").column(0).search(filterValue).draw();
    });
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
@endsection

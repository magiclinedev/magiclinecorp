@extends('admin-dash-gen')
@section('title')
{{ GoogleTranslate::trans('Edit Product', app()->getLocale()) }}
@endsection
@section('page-back')
<li class="breadcrumb-item"><a href="{{url('admin/partnerproduct/'.$product->company)}}">{{$product->company}}</a></li>
@endsection
@section('page-active')
{{ GoogleTranslate::trans('Edit Product', app()->getLocale()) }}
@endsection
@section('links')
    
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<!-- Filepond -->
<link href="{{asset('filepond/dist/filepond.css')}}" rel="stylesheet" />
<link href="{{asset('filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js')}}" rel="stylesheet" />
<!-- summernote -->
<link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
@endsection
@section('main-content')
<div class="container">
  <div class="card">
      <div class="card-body">
        <h3 class="login-box-msg"><b>{{ GoogleTranslate::trans('Edit Product', app()->getLocale()) }}</b></h3>
        <form method="POST" action="{{ route('storeupdateproduct') }}" enctype="multipart/form-data">
          @if(Session::get('success'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fas fa-check"></i> {{ GoogleTranslate::trans(Session::get('success'), app()->getLocale()) }}
          </div>
          @endif
          @if(Session::get('fail'))
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fas fa-ban"></i>  {{ GoogleTranslate::trans(Session::get('fail'), app()->getLocale()) }}
          </div>
          @endif
          @csrf
          <div class="form-group">
              <label for="po">{{ GoogleTranslate::trans('Purchase Order:', app()->getLocale()) }}</label>
              <input type="hidden" name="id" id="id" class="form-control" value="{{$product->id}}">
              <input type="text" name="po" id="po" class="form-control" value="{{$product->po}}">
          </div>
          <div>
              <span class="text-danger">@error('po'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
              <label for="itemref">{{ GoogleTranslate::trans('Item Reference:', app()->getLocale()) }}</label>
              <input type="text" name="itemref" id="itemref" class="form-control" value="{{$product->itemref}}">
          </div>
          <div>
              <span class="text-danger">@error('itemref'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
              <label for="company">{{ GoogleTranslate::trans('Company:', app()->getLocale()) }}</label>
              <?php
                    $comps = DB::select('select company from partners');
              ?> 
              <select name="company" id="company" class="form-control">
                @php
                  foreach ($comps as $comp) {
                    if($product->company == $comp->company){
                      echo '<option value="'.$comp->company.'" selected>'.$comp->company. '</option>';
                    } else {
                      echo '<option value="'.$comp->company.'">'.$comp->company. '</option>';
                    }
                  }
                @endphp
              </select>
          </div>
          <div>
              <span class="text-danger">@error('company'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
              <label for="category">{{ GoogleTranslate::trans('Category:', app()->getLocale()) }}</label>
              <select  name="category" id="category" class="form-control">
                @if ($product->category=='Bust & Torso')
                <option value="Bust & Torso" selected>Bust & Torso</option>
                <option value="Mannequin">Mannequin</option>
                <option value="Props">Props</option>
                <option value="Accessories">Accessories</option>
                @elseif ($product->category=='Mannequin')
                <option value="Bust & Torso">Bust & Torso</option>
                <option value="Mannequin" selected>Mannequin</option>
                <option value="Props">Props</option>
                <option value="Accessories">Accessories</option>
                @elseif ($product->category=='Props')
                <option value="Bust & Torso">Bust & Torso</option>
                <option value="Mannequin">Mannequin</option>
                <option value="Props" selected>Props</option>
                <option value="Accessories">Accessories</option>
                @else
                <option value="Bust & Torso">Bust & Torso</option>
                <option value="Mannequin">Mannequin</option>
                <option value="Props">Props</option>
                <option value="Accessories" selected>Accessories</option>
                @endif
                
              </select>
          </div>
          <div>
              <span class="text-danger">@error('category'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
              <label for="type">{{ GoogleTranslate::trans('Type:', app()->getLocale()) }}</label>
              <select  name="type" id="type" class="form-control">
                @if ($product->type=='Standard')
                <option value="Standard" selected>Standard</option>
                <option value="Special">Special</option>
                @else
                <option value="Standard">Standard</option>
                <option value="Special" selected>Special</option>
                @endif
              </select>
          </div>
          <div>
              <span class="text-danger">@error('type'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
              <label for="price">{{ GoogleTranslate::trans('Price:', app()->getLocale()) }}</label>
              <input type="text" name="price" id="price" class="form-control" value="{{$product->price}}">
          </div>
          <div>
              <span class="text-danger">@error('price'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
              <label for="description">{{ GoogleTranslate::trans('Description:', app()->getLocale()) }}</label>
              <div class="card-body p-0">
              <textarea name="description" id="summernote" class="form-control">{{$product->description}}</textarea>
              </div>
          </div>
          <div>
              <span class="text-danger">@error('description'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
                <label for="images">{{ GoogleTranslate::trans('Images:', app()->getLocale()) }}</label>
                @foreach (explode(",",$product->images) as $image)
                <img src="{{asset('storage/product_images/'.$image)}}" alt="<?php echo $image;?>" style="height: 100px">
                
                @endforeach
                <div style="cursor: pointer;">
                  <input type="file" name="images" id="images" class="filepond mt-1" multiple>
                </div>
          </div>
          <div>
              <span class="text-danger">@error('images'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
              <label for="costing">{{ GoogleTranslate::trans('Costing:', app()->getLocale()) }}</label> <span class="text-muted">({{ GoogleTranslate::trans('optional', app()->getLocale()) }})</span>
              @if (!empty($product->file))
              <a href="{{asset('storage/product_files/'.$product->file)}}"  download="{{$product->file}}">{{$product->file}}</a> 
              @endif
              <input type="hidden" name="old_costing" id="old_costing" class="form-control" value="{{$product->file}}">
              <input type="file" name="costing" id="costing" class="form-control">
          </div>
          <div>
              <span class="text-danger">@error('costing'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
              <label for="pdf">{{ GoogleTranslate::trans('PDF:', app()->getLocale()) }}</label> <span class="text-muted">({{ GoogleTranslate::trans('optional', app()->getLocale()) }})</span>
              @if (!empty($product->pdf))
              <a href="{{asset('storage/product_pdfs/'.$product->pdf)}}"  download="{{$product->pdf}}">{{$product->pdf}}</a> 
              @endif
              <input type="hidden" name="old_pdf" id="old_pdf" class="form-control" value="{{$product->pdf}}">
              <input type="file" name="pdf" id="pdf" class="form-control">
          </div>
          <div>
              <span class="text-danger">@error('pdf'){{ $message }}@enderror</span>
          </div>
          <div class="form-group" id="priceaccess">
            <div><label for="">{{ GoogleTranslate::trans('Price Access Lists:', app()->getLocale()) }}</label> <span>({{ GoogleTranslate::trans('optional', app()->getLocale()) }})</span> </div>
            @php
            $users = DB::select('select * from users where archived is null and role = "admin2" or role = "user" order by username asc');
            $lists = DB::select('select * from prices where itemref=?',[$product->itemref]);
            foreach ($lists as $list) {
              $list = $list->user_id;
            }
            if (!isset($list)) {
              $list = '';
            }
            //<script>alert({{count($lists)}});</script>
            @endphp
            <select class="select2" name="priceaccess[]" multiple="multiple" data-placeholder="Price Access Lists" style="width: 100%;">
              @php
                if(isset($lists)){
                  foreach ($users as $item1) {
                    $matched = false;
                    foreach (explode(',',$list) as $item2) {
                      if ($item1->id == $item2) {
                        echo '<option value="'.$item1->id.'" selected>'.$item1->username. '</option>';
                        $matched = true;
                        break;
                      }
                    }
                    if (!$matched) {
                      echo '<option value="'.$item1->id.'">'.$item1->username. '</option>';
                    }
                  }
                }
              @endphp
            </select>
          </div>
          <div>
            <span class="text-danger">@error('accesslists'){{ $message }}@enderror</span>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
      </form>
      
      
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
</div>
@endsection
@section('scripts')

<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function () {
      $('.select2').select2()
    });
</script>
<!-- Load FilePond library -->
<script src="{{asset('filepond/dist/filepond.js')}}"></script>
<script src="{{asset('filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
  // JavaScript
  FilePond.registerPlugin(
    FilePondPluginFileValidateType
  );
  // Get a reference to the file input element
  const inputElement = document.querySelector('input[type="file"]');

  // Create a FilePond instance
  const pond = FilePond.create(inputElement, {
  acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
  labelFileTypeNotAllowed: 'Invalid file type, please upload a PNG, JPG, or JPEG image'
  });
  
  FilePond.setOptions({
    server: {
        process: '/admin/tmp-upload',
        revert: '/admin/tmp-delete',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    },
  });
</script>
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()
  })
</script>
@endsection
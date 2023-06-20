@extends('admin-dash-gen')
@section('title')
{{ GoogleTranslate::trans('Add New Product', app()->getLocale()) }}
@endsection
@if ($company)
@section('page-back')
<li class="breadcrumb-item"><a href="{{url('admin/partnerproduct/'.$company)}}">{{strtoupper($company)}}</a></li>
@endsection
@endif
@section('page-active')
 {{ GoogleTranslate::trans('Add New Product', app()->getLocale()) }}
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
        <h3 class="login-box-msg"><b>{{ GoogleTranslate::trans('Add New Product', app()->getLocale()) }}</b></h3>
        <form method="POST" action="{{ route('storeproduct') }}" enctype="multipart/form-data">
          @if(Session::get('success'))
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="icon fas fa-check"></i> {{ GoogleTranslate::trans(Session::get('success'), app()->getLocale()) }}
            </div>
          @endif
          @if(Session::get('fail'))
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="icon fas fa-ban"></i> {{ GoogleTranslate::trans(Session::get('fail'), app()->getLocale()) }}
            </div>
          @endif
          @csrf
          <div class="form-group">
              <label for="po">{{ GoogleTranslate::trans('Purchase Order:', app()->getLocale()) }}</label>
              <input type="text" name="po" id="po" class="form-control" value="{{old('po')}}">
          </div>
          <div>
              <span class="text-danger">@error('po'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
              <label for="itemref">{{ GoogleTranslate::trans('Item Reference:', app()->getLocale()) }}</label>
              <input type="text" name="itemref" id="itemref" class="form-control" value="{{old('itemref')}}">
          </div>
          <div>
              <span class="text-danger">@error('itemref'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
              <label for="company">{{ GoogleTranslate::trans('Company:', app()->getLocale()) }}</label>
              <select name="company" id="company" class="form-control">
                @php
                $id = session()->get('LoggedUser');
                $checkaccess = DB::select('select * from access_lists where user_id = ?',[$id]);
                $users = DB::select('select * from users where archived is null and role = "admin2" or role = "user" order by username asc');
                foreach ($checkaccess as $access) {
                  $givenaccess = $access->accesslists;
                  if($givenaccess == 'ALL'){
                    $comps = DB::select('select company from partners where archived is null');
                    sort($comps);
                    foreach ($comps as $comp) {
                      if ($comp->company==strtoupper($company)) {
                        echo '<option value="'.$comp->company.'" selected>'.$comp->company. '</option>';
                      } else {
                        echo '<option value="'.$comp->company.'">'.$comp->company. '</option>';
                      }
                    }
                  } else {
                    $lists = DB::select('select * from access_lists where user_id=?',[$id]);
                    foreach ($lists as $list) {
                      foreach (explode(',',$list->accesslists) as $access) {
                        if ($access==strtoupper($company)) {
                          echo '<option value="'.$access.'" selected>'.$access. '</option>';
                        } else{
                          echo '<option value="'.$access.'">'.$access. '</option>';
                        }
                      }
                    }
                  }
                }
                  
                @endphp
              </select>
          </div>
          <div>
              <span class="text-danger">@error('company'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
            <?php $categories = DB::select('select * from categories') ?>
              <label for="category">Category:</label>
              <select  name="category" id="category" class="form-control">
                @foreach ($categories as $categ)
                <option value="{{$categ->category}}" <?php if(old('category')==$categ->category){ echo 'selected';} ?>>{{$categ->category}}</option>
                @endforeach
              </select>
          </div>
          <div>
              <span class="text-danger">@error('category'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
            <?php $types = DB::select('select * from types') ?>
              <label for="type">Type:</label>
              <select  name="type" id="type" class="form-control">
                @foreach ($types as $type)
                <option value="{{$type->type}}" <?php if(old('type')==$type->type){ echo 'selected';} ?>>{{$type->type}}</option>
                @endforeach
              </select>
          </div>
          <div>
              <span class="text-danger">@error('type'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
              <label for="price">Price:</label>
              <input type="text" name="price" id="price" class="form-control" value="{{old('price')}}">
          </div>
          <div>
              <span class="text-danger">@error('price'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
              <label for="description">Description:</label>
              <div class="card-body p-0">
              <textarea name="description" id="summernote" class="form-control">{{old('description')}}</textarea>
            </div>
          </div>
          <div>
              <span class="text-danger">@error('description'){{ $message }}@enderror</span>
          </div>
          <div class="form-group" style="cursor: pointer;">
                <label for="images">Images:</label>
                <input type="file" name="images" id="images" class="filepond" multiple>
          </div>
          <div>
              <span class="text-danger">@error('images'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
              <label for="costing">Costing:</label> <span class="text-muted">(optional)</span>
              <input type="file" name="costing" id="costing" class="form-control" value="{{old('costing')}}">
          </div>
          <div>
              <span class="text-danger">@error('costing'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
              <label for="pdf">PDF:</label> <span class="text-muted">(optional)</span>
              <input type="file" name="pdf" id="pdf" class="form-control" value="{{old('pdf')}}">
          </div>
          <div>
              <span class="text-danger">@error('pdf'){{ $message }}@enderror</span>
          </div>

          <div class="form-group">
            <label for="3df">3D File:</label> <span class="text-muted">(optional)</span>
            <input type="file" name="3df" id="3df" class="form-control" value="{{old('3df')}}">
        </div>
        <div>
            <span class="text-danger">@error('3df'){{ $message }}@enderror</span>
        </div>

          <div class="form-group" id="access">
            <div><label for="priceaccess">Price Accesslists</label></div>
            <select class="select2" name="priceaccess[]" multiple="multiple" data-placeholder="Access Lists" style="width: 100%;">
              @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->username}}</option>
              @endforeach
            </select>
          </div>
          <div>
            <span class="text-danger">@error('priceaccess'){{ $message }}@enderror</span>
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
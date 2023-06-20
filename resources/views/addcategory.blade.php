@extends('admin-dash-layout')
@section('title')
  {{ GoogleTranslate::trans('Add New Category', app()->getLocale()) }}
@endsection
@section('page-back')
<li class="breadcrumb-item"><a href="{{url('admin/categories/')}}">{{ GoogleTranslate::trans('Categories', app()->getLocale()) }}</a></li>
@endsection
@section('page-active')
  {{ GoogleTranslate::trans('Add New Category', app()->getLocale()) }}
@endsection
@section('main-content')
<div class="container">
    <div class="card">
        <div class="card-body register-card-body">
          <h3 class="login-box-msg">{{ GoogleTranslate::trans('Add New Category', app()->getLocale()) }}</h3>
    
          <form action="{{route('storecateg')}}" method="post" enctype="multipart/form-data">
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
            <div><label for="category">{{ GoogleTranslate::trans('Category:', app()->getLocale()) }}</label></div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="category" name="category" autofocus placeholder="Enter Category" value="{{old('category')}}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-briefcase"></span>
                </div>
              </div>
            </div>
            <div>
                <span class="text-danger">@error('category'){{ $message }}@enderror</span>
            </div>
            
            <div class="row">
              <!-- /.col -->
              <div class="col">
                <button type="submit" class="btn btn-primary btn-block">{{ GoogleTranslate::trans('Add', app()->getLocale()) }}</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
</div>
@endsection
@extends('admin-dash-gen')
@section('title')
{{ GoogleTranslate::trans('Admin | Dashboard', app()->getLocale()) }}
@endsection
@section('page-header')
{{ GoogleTranslate::trans('Dashboard', app()->getLocale()) }}
@endsection
@section('page-active')
{{ GoogleTranslate::trans('Dashboard', app()->getLocale()) }}
@endsection
@section('main-content')
@php
    $checks = DB::table('users')->where('id','=',session()->get('LoggedUser'))->get();
    foreach ($checks as $check) {
      $userrole = $check->role;
    }
    if($userrole=='admin1'){
      echo "<script>location.replace('/admin/dashboard')</script>";
    }
    $lists = [];
    $accesslists = DB::table('access_lists')->where('user_id','=',session()->get('LoggedUser'))->get();
    $company = DB::table('partners')->whereNull('archived')->get();
    //$products = DB::table('products')->get();
    foreach ($accesslists as $key => $access) {
      foreach (explode(',',$access->accesslists) as $key => $list) {
        if ($list=='ALL') {
          foreach ($company as $key => $comp) {
            $lists[] = $comp->company;
          }
        } else {
          $lists[] = $list;
        }
      }
    }
@endphp 
<div class="row">
  <!-- ./col -->
  <div class="col-lg-3 col-6 col-sm-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3><?php echo count($lists); ?></h3>

        <p>{{ GoogleTranslate::trans('All Company Products', app()->getLocale()) }}</p>
      </div>
      <div class="icon">
        <i class="fas fa-shopping-bag"></i>
      </div>
      <a href="{{route('adminaccesslists')}}" class="small-box-footer">{{ GoogleTranslate::trans('More info', app()->getLocale()) }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
    
    
</div>
@endsection
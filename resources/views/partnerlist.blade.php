@extends('admin-dash-layout')
@section('title')
{{ GoogleTranslate::trans('Partnered Companies', app()->getLocale()) }}
@endsection
@section('page-active')
{{ GoogleTranslate::trans('Partnered Companies', app()->getLocale()) }}
@endsection
@section('main-content')
<div class="row">
  <div class="container mt-5">
      <h1 class="text-center">{{ GoogleTranslate::trans('Partnered Companies', app()->getLocale()) }}</h1>
      <div class="row mt-5 d-flex justify-content-center">
        @php
            $comps = DB::select('select * from partners where archived is null order by logo asc');
        @endphp
        @foreach($comps as $comp)
        <div class="col-lg-2 col-md-2 col-sm-3 text-center">
          <a href="{{url('admin/partnerproduct/'.strtolower($comp->company))}}">
            <img src="{{asset('storage/company_logos/'.$comp->logo)}}" class="img-fluid mb-2" alt="{{$comp->logo}}"/>
          </a>
          
        </div>
        @endforeach
      </div>
  </div>
  
</div>
@endsection
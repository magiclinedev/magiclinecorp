@extends('dash-layout')
@section('title')
{{ GoogleTranslate::trans('Partners', app()->getLocale()) }}
@endsection
@section('page-active')
  {{ GoogleTranslate::trans('Partners', app()->getLocale()) }}
@endsection
@section('main-content')
<div class="row">
  <div class="container mt-5">
      <h1 class="text-center">{{ GoogleTranslate::trans('PARTNERS', app()->getLocale()) }}</h1>
      <div class="row mt-5 d-flex justify-content-center">
        @foreach($accesslists as $access)
        <?php
        if ($access=='ALL') {
          $comps = DB::select('select * from partners where archived is null');
        } else {
          $comps = DB::select('select * from partners where company = ?',[$access]);
        }
        
        foreach($comps as $comp){
        }
        ?>
        <div class="col-sm-3 col-md-2 col-lg-2">
          <a href="{{url('company/'.strtolower($comp->company))}}">
            <img src="{{asset('storage/company_logos/'.$comp->logo)}}" class="img-fluid mb-2" alt="{{$comp->logo}}"/>
          </a>
          
        </div>
        @endforeach
      </div>
  </div>
  
</div>
@endsection
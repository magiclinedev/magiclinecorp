@extends('admin-dash-gen')
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
        <?php 
        $comps = DB::select('select * from partners where archived is null order by logo asc');
        $accesslists = [];
        $lists = DB::table('access_lists')->where('user_id','=',session()->get('LoggedUser'))->get();
        //$products = DB::table('products')->get();
        foreach ($lists as $access) {
            foreach (explode(',',$access->accesslists) as $list) {
                if ($list=='ALL') {
                  foreach ($comps as $key => $comp) {
                    $accesslists[] = $comp->company;
                  }
                } else {
                  $accesslists[] = $list;
                }
                
            }
        } 
        ?>
        @foreach($comps as $comp)
            @foreach ($accesslists as $access)
            @if ($access==$comp->company)
            <div class="col-sm-3 col-md-2 col-lg-2">
                <a href="{{url('admin/partnerproduct/'.strtolower($access))}}">
                  <img src="{{asset('storage/company_logos/'.$comp->logo)}}" class="img-fluid mb-2" alt="{{$comp->logo}}"/>
                </a>
                
              </div>
            @endif
            @endforeach
        @endforeach
      </div>
  </div>
  
</div>
@endsection
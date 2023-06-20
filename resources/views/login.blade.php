<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ GoogleTranslate::trans('Log in', app()->getLocale()) }}</title>
  <link rel="icon" href="{{asset('images/MAGICLINE-ICON.png')}}" type="image/png" sizes="any">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="{{asset('images/MAGICLINE-2.png')}}" class="w-75" alt="Magic Line Logo">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">{{ GoogleTranslate::trans('Sign in to gain access', app()->getLocale()) }}</p>

      <form action="{{ route('loginprocess')}}" method="post">
          @if(Session::get('fail'))
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fas fa-ban"></i>  {{ Session::get('fail') }}
          </div>
          @endif
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" value="{{old('username')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div>
            <span class="text-danger">@error('username'){{ $message }}@enderror</span>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="fas fa-eye mr-2" id="togglePassword"></i><span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div>
            <span class="text-danger">@error('password'){{ $message }}@enderror</span>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12 mx-auto">
            <p class="text-center">
              <a href="{{route('forgotpassword')}}" class="text-gray">{{ GoogleTranslate::trans('Forgot the password? Request to the admin', app()->getLocale()) }}</a>
            </p>
            <button type="submit" class="btn btn-primary btn-block mb-1 ">{{ GoogleTranslate::trans('Sign In', app()->getLocale()) }}</button>
          </div>
          <!-- /.col -->
        </div>
        <select class="form-select changeLang">
          <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
          <option value="fr" {{ session()->get('locale') == 'fr' ? 'selected' : '' }}>French</option>
        </select>
      </form>
      
    </div>
    <!-- /.login-card-body -->
    
  </div>
</div>
<!-- /.login-box --><!-- 
<form action="" method="post">
  <div class="form-group">
    <select name="lang" id="lang" class="form-control">
      <option value="en">English</option>
      <option value="fr">French</option>
    </select>
  </div>
</form> -->
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
  });
</script>
<script type="text/javascript">
    
  var url = "{{ route('changeLang') }}";
  
  $(".changeLang").change(function(){
      window.location.href = url + "?lang="+ $(this).val();
  });
  
</script>
</body>
</html>

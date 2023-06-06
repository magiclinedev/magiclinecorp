<?php $LoggedUser = session()->get('LoggedUser');
	if(isset($LoggedUser)){
		$users = DB::select('select * from users where id = ?',[$LoggedUser]);
        foreach($users as $user){
            $user_role = $user->role;
            if($user_role=='user'){
              echo '<script>location.replace("/");</script>';
            }

        }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
   <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  @yield('links')
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <?php if($user_role=='admin1' || $user_role=='owner'){ ?>
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('58c05efac386635819db', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('magic-channel');
    channel.bind('user-login', function(data) {
      toastr.info(JSON.stringify(data.username) + " has logged in.");
      //alert(JSON.stringify(data));
    });
  </script>
  <?php } ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        @if ($user_role=='admin1' || $user_role=='owner')
          <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link">
              @if (app()->getLocale()=='fr')
                ACCUEIL
              @else
                HOME
              @endif
            </a>
          </li>
          @elseif ($user_role=='admin2')
          <li class="nav-item">
            <a href="{{route('admin.dashboard2')}}" class="nav-link">
              @if (app()->getLocale()=='fr')
                ACCUEIL
              @else
                HOME
              @endif
            </a>
          </li>
          @else
          <li class="nav-item">
            <a href="{{url('/')}}" class="nav-link">
              @if (app()->getLocale()=='fr')
                ACCUEIL
              @else
                HOME
              @endif
            </a>
          @endif
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <div class="nav-link">
          <select class="form-select changeLang">
            <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
            <option value="fr" {{ session()->get('locale') == 'fr' ? 'selected' : '' }}>French</option>
          </select>
        </div>
      </li>  
      @if ($user_role == 'admin1' ||  $user_role=='owner')
      <!-- Notifications Dropdown Menu -->
      @php
        $user_requests = DB::select('select * from reset_requests');
      @endphp
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          @if (count($user_requests)>0)
          <span class="badge badge-warning navbar-badge">{{count($user_requests)}}</span>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          @if (count($user_requests)>0)
          <span class="dropdown-item dropdown-header">{{ GoogleTranslate::trans('Notifications', app()->getLocale()) }}</span>
          <div class="dropdown-divider"></div>
          <a href="{{route('userrequest')}}" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> {{count($user_requests)}} {{ GoogleTranslate::trans('Reset password request(s)', app()->getLocale()) }}
          </a>
          @else
          <div class="dropdown-divider"></div>
          <p class="dropdown-item dropdown-footer">{{ GoogleTranslate::trans('No Notification', app()->getLocale()) }}</p>
          @endif
        </div>
      </li>
      @endif
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-cog"></i> {{ GoogleTranslate::trans('Settings', app()->getLocale()) }}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="{{route('edituser')}}" class="dropdown-item">
            <i class="fas fa-user"></i> {{ GoogleTranslate::trans('Edit User Info', app()->getLocale()) }}
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{route('bugreport')}}" class="dropdown-item">
            <i class="fas fa-bug"></i> {{ GoogleTranslate::trans('Bug Report', app()->getLocale()) }}
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> 
      @if ($user_role=='admin1' || $user_role=='owner')
      <!--<li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>  -->
      @endif
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{asset('images/MAGICLINE-3.png')}}" alt="Magic Line Logo" class="img-fluid w-100">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('avatars/'.$user->avatar)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <p class="d-block text-light"><?php echo $user->fname.' '.$user->lname ?></p>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            @if ($user_role=='admin1' || $user_role=='owner')
            <a href="{{route('admin.dashboard')}}" class="nav-link">
            @elseif ($user_role=='admin2')
            <a href="{{route('admin.dashboard2')}}" class="nav-link">
            @else
            <a href="{{url('/')}}" class="nav-link">
            @endif
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                {{ GoogleTranslate::trans('Dashboard', app()->getLocale()) }}
              </p>
            </a>
          </li>
          @if ($user_role=='admin1' || $user_role=='owner')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                {{ GoogleTranslate::trans('Users', app()->getLocale()) }}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('users')}}" class="nav-link">
                  <i class="fa fa-users"></i>
                  <p>{{ GoogleTranslate::trans('All Users', app()->getLocale()) }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('adduser')}}" class="nav-link">
                  <i class="fa fa-user-plus"></i>
                  <p>{{ GoogleTranslate::trans('Add New User', app()->getLocale()) }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('activitylogs')}}" class="nav-link">
                  <i class="fa fa-history"></i>
                  <p>{{ GoogleTranslate::trans('Activity Logs', app()->getLocale()) }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('trash')}}" class="nav-link">
                  <i class="fa fa-trash"></i>
                  <p>{{ GoogleTranslate::trans('Trash', app()->getLocale()) }}</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @php
            $companylists = DB::select('select * from partners where archived is null order by company asc');
          @endphp
          @if ( $user_role=='owner' || $user_role=='admin1')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-store"></i>
              <p>
                {{ GoogleTranslate::trans('Products', app()->getLocale()) }}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if ($user_role=='admin1' ||  $user_role=='owner')
              <li class="nav-item">
                <a href="{{route('products')}}" class="nav-link">
                  <i class="fa fa-briefcase"></i>
                  <p>{{ GoogleTranslate::trans('All Products', app()->getLocale()) }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                    {{ GoogleTranslate::trans('List of Partners', app()->getLocale()) }}
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">{{count($companylists)}}</span>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  @foreach ($companylists as $companylist)
                  <li class="nav-item">
                    <a href="{{route('partnerproduct',strtolower($companylist->company))}}" class="nav-link">
                      <i class="fa fa-briefcase"></i>
                      <p>{{$companylist->company}}</p>
                    </a>
                  </li>
                  @endforeach
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{route('addproduct')}}" class="nav-link">
                  <i class="nav-icon fas fa-file-upload"></i>
                  <p>
                    {{ GoogleTranslate::trans('Add New Product', app()->getLocale()) }}
                  </p>
                </a>
              </li>
            @endif
            </ul>
          </li>
          @endif
          @if ($user_role == 'admin2')
          <?php
              $accesslists = DB::table('access_lists')->where('user_id','=',$LoggedUser)->get();
              foreach ($accesslists as $accesslist) {
                $lists = $accesslist->accesslists;
              }
          ?>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-store"></i>
              <p>
                {{ GoogleTranslate::trans('Products', app()->getLocale()) }}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @foreach (explode(',',$lists) as $access)
              @if ($access=='ALL')
              <li class="nav-item">
                <a href="{{route('products')}}" class="nav-link">
                  <i class="fa fa-briefcase"></i>
                  <p>{{ GoogleTranslate::trans('All Products', app()->getLocale()) }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                    {{ GoogleTranslate::trans('List of Partners', app()->getLocale()) }}
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">{{count($companylists)}}</span>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  @foreach ($companylists as $companylist)
                  <li class="nav-item">
                    <a href="{{route('partnerproduct',strtolower($companylist->company))}}" class="nav-link">
                      <i class="fa fa-briefcase"></i>
                      <p>{{$companylist->company}}</p>
                    </a>
                  </li>
                  @endforeach
                </ul>
              </li>
              @else
              <li class="nav-item">
                <a href="{{route('partnerproduct',strtolower($access))}}" class="nav-link">
                  <i class="fa fa-warehouse"></i>
                  <p>{{$access}}</p>
                </a>
              </li>
              @endif   
            @endforeach
            <li class="nav-item">
              <a href="{{route('addproduct')}}" class="nav-link">
                <i class="nav-icon fas fa-file-upload"></i>
                <p>
                  {{ GoogleTranslate::trans('Add New Product', app()->getLocale()) }}
                </p>
              </a>
            </li>
            </ul>
          </li>
          @endif
          @if ($user_role=='admin1' || $user_role=='owner')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                {{ GoogleTranslate::trans('Companies', app()->getLocale()) }}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('partners')}}" class="nav-link">
                  <i class="fa fa-briefcase"></i>
                  <p>{{ GoogleTranslate::trans('All Partnered Company', app()->getLocale()) }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('addcompany')}}" class="nav-link">
                  <i class="fa fa-user-plus"></i>
                  <p>{{ GoogleTranslate::trans('Add New Company', app()->getLocale()) }}</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          <li class="nav-item">
            <a href="/lockscreen" class="nav-link">
              <i class="nav-icon fa fa-sign-out-alt"></i>
              <p>
                {{ GoogleTranslate::trans('Lock the screen', app()->getLocale()) }}
              </p>
            </a>
          </li>
          @if ($user_role=='admin1')
          <li class="nav-item">
            <?php $reports = DB::select('select * from bug_reports where archived is null'); ?>
            <a href="{{route('reportedbugs')}}" class="nav-link">
              <i class="nav-icon fa fa-bug"></i>
              <p>
                {{ GoogleTranslate::trans('Reported Bugs', app()->getLocale()) }}
              </p>
              @if (count($reports)!=0)
              <span class="badge badge-info right">{{count($reports)}}</span>
              @endif
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="/logout" class="nav-link">
              <i class="nav-icon fa fa-sign-out-alt"></i>
              <p>
                {{ GoogleTranslate::trans('Logout', app()->getLocale()) }}
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('page-header')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="/">
                @if (app()->getLocale()=='fr')
                  ACCUEIL
                @else
                  HOME
                @endif
                </a>
              </li>
              @yield('page-back')
              <li class="breadcrumb-item active">@yield('page-active')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @yield('main-content')
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
@yield('scripts')
<script type="text/javascript">
    
  var url = "{{ route('changeLang') }}";
  
  $(".changeLang").change(function(){
      window.location.href = url + "?lang="+ $(this).val();
  });
  
</script>
</body>
</html>

{{-- <!DOCTYPE html>
<html>
<head>
	<title>Admin page</title>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href= "{{ asset('frontend/images/icons/favicon.ico') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/fontawesome/css/fontawesome.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/fontawesome/css/solid.min.css')}}">
  <!-- load thu vien jquery -->
  
  <script type="text/javascript" src="{{ asset('backend/js/jquery-3.3.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <a class="navbar-brand" href="#">Project name</a> -->
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Xin chào, {{ Auth::user()->name }}</a></li>
            <li class="active"><a href="{{ url('index/exam') }}">Trang bài làm</a></li>
            <li class="active"><a href="{{ url('admin/thread') }}">Quản lý đề</a></li>
            <li class="active"><a href="{{ url('admin/detail') }}">Chi tiết đề</a></li>
            <li class="active"><a href="{{ url('admin/question') }}">Quản lý câu hỏi</a></li>
            <li class="active"><a href="{{ url('admin/answer') }}">Câu trả lời</a></li>
            <li class="active"><a href="{{ url('admin/result') }}">Quản lý điểm</a></li>
            <li class="active"><a href="{{ url('admin/user') }}">Quản lý user</a></li>
            <li class="active"><a href="{{ url('logout') }}">Đăng xuất</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

   <div class="container-fluid" style="margin-top:70px;">
   	@yield('do-du-lieu')
   </div>

</body>
</html> --}}


<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{ asset('backend/img/favicon.ico') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Light Bootstrap Dashboard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{ asset('backend/css/animate.min.css') }}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ asset('backend/css/light-bootstrap-dashboard.css?v=1.4.0') }}" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('backend/css/demo.css') }}assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="{{ asset('backend/fontawesome/css/fontawesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('backend/fontawesome/css/solid.min.css')}}" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('backend/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="azure" data-image="{{ asset('backend/img/sidebar-4.jpg')}}">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                  {{ Auth::user()->name }}
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="{{ url('index/exam') }}">
                        <i class="pe-7s-browser"></i>
                        <p>Trang bài làm</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/user') }}">
                        <i class="pe-7s-user"></i>
                        <p>User</p>
                    </a>
                </li>
                <li>
                  <a href="{{ url('admin/thread') }}">
                      <i class="pe-7s-folder"></i>
                      <p>Quản lý đề</p>
                  </a>
              </li>
                <li>
                    <a href="{{ url('admin/detail') }}">
                        <i class="pe-7s-note2"></i>
                        <p>Chi tiết đề</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/question') }}">
                        <i class="pe-7s-news-paper"></i>
                        <p>Quản lý câu hỏi</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/answer') }}">
                        <i class="pe-7s-science"></i>
                        <p>Câu trả lời</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/result') }}">
                        <i class="pe-7s-diskette"></i>
                        <p>Kết quả</p>
                    </a>
                </li>
                <li>
                  <a href="{{ url('logout') }}">
                    <i class="pe-7s-power"></i>
                      <p>Log out</p>
                  </a>
              </li>
				
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        {{-- <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        
						            <li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div> --}}
        </nav>


        <div class="content">
            <div class="container-fluid">
              @yield('do-du-lieu')
            </div>
        </div>

    </div>
</div>


</body>

  <!--   Core JS Files   -->
  <script src="{{ asset('backend/js/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('backend/js/bootstrap.min.js') }}" type="text/javascript"></script>

	<!--  Charts Plugin -->
	{{-- <script src="assets/js/chartist.min.js"></script> --}}

    <!--  Notifications Plugin    -->
    <script src="{{ asset('backend/js/bootstrap-notify.js') }}"></script>

    <!--  Google Maps Plugin    -->
    {{-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="{{ asset('backend/js/light-bootstrap-dashboard.js?v=1.4.0') }}"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="{{ asset('backend/js/demo.js') }}"></script>

	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-gift',
            	message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer."

            },{
                type: 'info',
                timer: 4000
            });

    	});
	</script>

</html>

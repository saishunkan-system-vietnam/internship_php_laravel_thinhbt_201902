<!DOCTYPE html>
<html>
<head>
	<title>Admin page</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/fontawesome.min.css')}}">
  <!-- load thu vien jquery -->
  <script type="text/javascript" src="{{ asset('backend/ckeditor/ckeditor.js') }}"></script>
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
            <li class="active"><a href="{{ url('') }}">Trang bài làm</a></li>
            <li class="active"><a href="{{ url('admin/thread') }}">Quản lý đề</a></li>
            <li class="active"><a href="{{ url('admin/question') }}">Quản lý câu hỏi</a></li>
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
</html>
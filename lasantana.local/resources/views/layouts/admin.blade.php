<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, maximum-scale=1">
<title>{{$title}}</title>
<link href="{{asset('adm/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('adm/css/style.css')}}" rel="stylesheet" type="text/css"> 
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/custom.css') }}" />

<script type="text/javascript" src="{{asset('adm/js/jquery-1.11.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('adm/js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('adm/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('adm/js/bootstrap-filestyle.min.js')}}"></script>

 
</head>
<body>

<header id="header_wrapper">
    @yield('header') 
</header>

    @yield('content')
    
    <div class="wrapper container-fluid">&nbsp;</div>
    
</body>
</html>

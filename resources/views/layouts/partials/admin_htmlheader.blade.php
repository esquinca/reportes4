<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Sitwifi') }}</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/bower_components/font-awesome-4.7.0/css/font-awesome.min.css') }}" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('/bower_components/Ionicons/css/ionicons.min.css') }}" />
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
  <!--Skins. -->
  <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-orange.css') }}"  />
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('/plugins/iCheck/square/_all.css') }}" />
  <!--Toast. -->
  <link rel="stylesheet" href="{{ asset('bower_components/toast-master/css/jquery.toast.css') }}"/>
  <!--Bootstrap Datepicker. -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" type="text/css" />
  <!--DataTables. -->
  <link rel="stylesheet" href="{{ asset('bower_components/datatables-bootstrap/datatables.css') }}" type="text/css" />
  <!--Select2-->
  <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" type="text/css" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('/images/users/favicon.ico') }}" type='image/x-icon'/>
</head>

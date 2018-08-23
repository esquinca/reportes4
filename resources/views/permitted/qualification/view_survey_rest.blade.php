<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Encuesta</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,500,600" rel="stylesheet">
  <!-- Linear icons -->
  <link rel="stylesheet" href="{{ asset('/survey/css/linearicons.css') }}" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/bower_components/font-awesome-4.7.0/css/font-awesome.min.css') }}" />
  <!-- Magnific-popup -->
  <link rel="stylesheet" href="{{ asset('/survey/css/magnific-popup.css') }}" />
  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('/survey/css/bootstrap.css') }}" />
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/survey/css/main.css') }}" />
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('/images/users/favicon.ico') }}" type='image/x-icon'/>

  <script src="{{ asset('js/admin/qualification/clientsurvey.js')}}"></script>
</head>

<body>
  <div class="main-wrapper-first">
    <!-- Start Feature Area -->
    <section class="featured-area">
      <div class="container">

        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="section-title text-center">
              <div class="icon">
                <img src="http://i63.tinypic.com/15gqjb8.jpg" alt="" class="hidden-sm hidden-xs">
                <hr>
              </div>
              <div class="desc">
                <h2 class="text-left pt-15">{{ $title }}.</h2>
              </div>
            </div>


            <div class="section-title text-center">
              <p class="mb-0 mt-10 text-left">
                {{ $message }}.
                <br><br><br>
                Tiempo de espera: <span style="font-family: Courier;" id="segundos"></span>
                <br><br>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="main-wrapper">
    <footer class="footer-area">
      <div class="container">
        <div class="footer-content d-flex flex-column align-items-center">
          <div class="copy-right-text">
            Copyright Sitwifi &copy; All rights reserved. <br><br>
          </div>
        </div>
      </div>
    </footer>
  </div>
</body>
</html>

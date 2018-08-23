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
</head>

<body>
  <div class="main-wrapper-first">
    <!-- <header>
      <div class="container">
        <div class="header-wrap">
          <div class="header-top d-flex justify-content-between align-items-center">
            <div class="logo">
              <img src="http://i63.tinypic.com/15gqjb8.jpg" alt="">
            </div>
            <span class="navbar-text">
              Fecha actual:<br>
              @php
                $mytime = Carbon\Carbon::now();
                echo $mytime->toDateTimeString();
              @endphp
            </span>
          </div>
        </div>
      </div>
    </header> -->
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
                <h2 class="text-left pt-15">Encuesta</h2>
              </div>
            </div>


          <form method="post" action="{{url('create_record')}}">
            {{ csrf_field() }}
            <div class="section-title text-center">
              <p class="mb-0 mt-10 text-left">
<!--                 Apreciado usuario.<br>
                Queremos saber su nivel de satisfacción.<br>
                Dedíquenos un minuto de su valioso tiempo, para contestar esta encuesta que será de manera confidencial y anónima. -->
              </p>
              <input type="hidden" id="token_form" name="token_form" value="{{$encrypted_form}}">
              @foreach ($sacar_preg as $preguntithas)
                <h5 class="mb-0 mt-10 text-left">-.{{ $preguntithas->name }}<h5>

                <label class="custom-control custom-radio">
                  <input name="radio{{ $loop->iteration }}" type="radio" value="10" required class="custom-control-input">
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-description"><i class="fa fa-smile-o text-success emotion"></i><br> <small>Si</small> </span>
                </label>
                <label class="custom-control custom-radio">
                  <input name="radio{{ $loop->iteration }}" type="radio" value="7" class="custom-control-input">
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-description"><i class="fa fa-meh-o text-warning emotion"></i><br> <small>Tal vez</small> </span>
                </label>
                <label class="custom-control custom-radio">
                  <input name="radio{{ $loop->iteration }}" type="radio" value="5" class="custom-control-input">
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-description"><i class="fa fa-frown-o text-danger emotion"></i><br> <small>No</small> </span>
                </label>
              @endforeach

            </div>
            <div class="container">
              <div class="row">
                <div class="col-xl-12">
                  <h5>Comentario o sugerencia.</h5>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="form-row">
                      <div class="col-12 col-md-12 mb-12">
                        <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Opcional" maxlength="1024"></textarea>
                      </div>
                      <div class="col-12 col-md-12">
                        <br>
                        <button type="submit" class="btn btn-block btn-lg btn-primary"><i class="fa fa-send-o"></i> Enviar!</button>
                      </div>
                    </div>
                </div>
              </div>
            </div>

          </form>


          </div>
        </div>


      </div>
    </section>
  </div>
  <div class="main-wrapper">
    <!-- <section class="subscription-area">

    </section> -->
    <footer class="footer-area">
      <div class="container">
        <div class="footer-content d-flex flex-column align-items-center">
          <div class="copy-right-text">
            Fecha de expiración: {{ $fecha_fin }} <br>
            Copyright Sitwifi &copy; All rights reserved. <br><br>
          </div>
          <!-- <div class="footer-social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-google-plus-square"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
          </div> -->
        </div>
      </div>
    </footer>
  </div>
</body>
</html>

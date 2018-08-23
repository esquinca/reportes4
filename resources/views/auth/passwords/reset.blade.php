@extends('layouts.auth')

@section('content')
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <img alt="thumbnail" src="{{ asset('/images/users/logo.svg') }}">
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">{{ trans('auth.resetpassword') }}</p>


      <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
          {{ csrf_field() }}
          <input type="hidden" name="token" value="{{ $token }}">
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
              <!-- <label for="email" class="col-md-4 control-label">E-Mail Address</label> -->
              <div class="col-md-12">
                  <input id="email" type="email" class="form-control" name="email" placeholder="{{ trans('auth.email') }}" value="{{ $email or old('email') }}" required autofocus>
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
              <!-- <label for="password" class="col-md-4 control-label">Password</label> -->
              <div class="col-md-12">
                  <input id="password" type="password" class="form-control" name="password" placeholder="{{ trans('auth.password') }}" required>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} has-feedback">
              <!-- <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label> -->
              <div class="col-md-12">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ trans('auth.retrypepassword') }}" required>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  @if ($errors->has('password_confirmation'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password_confirmation') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-12">
                  <button type="submit" class="btn bg-navy btn-block btn-flat">
                    <i class="fa fa-repeat"></i> {{ trans('auth.resetpassword') }}
                  </button>
              </div>
          </div>

      </form>
    </div>

  </div>
</body>
@endsection

@extends('layouts.auth')

@section('content')
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <img alt="thumbnail" src="{{ asset('/images/users/logo.svg') }}">
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">{{ trans('auth.resetpassword') }}</p>

      @if (session('status'))
      <div class="alert alert-warning">
        <i class="fa fa-fw fa-mail-forward"></i> {{ session('status') }}
      </div>
      @endif

      <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
          <!-- <label for="email" class="col-md-4 control-label">E-Mail Address</label> -->
          <div class="col-md-12">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ trans('auth.email') }}" required autofocus>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <button type="submit" class="btn bg-navy btn-block btn-flat">
              <span class="glyphicon glyphicon-send"></span> {{ trans('auth.sendresetpassword') }}
            </button>
            <a href="{{ url('/login') }}">{{ trans('auth.return') }}</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
@endsection

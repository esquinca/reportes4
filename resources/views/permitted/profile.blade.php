@extends('layouts.app')

@section('contentheader_title')
  {{ trans('message.profile') }}
@endsection

@section('contentheader_description')
  {{ trans('message.infouser') }}
@endsection

@section('breadcrumb_ubication')
  {{ trans('message.profile') }}
@endsection

@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-4 col-xs-12">
      <div class="box box-warning">
        <div class="box-body box-profile">
          @if (Auth::user()->avatar == null)
            <img src="dist/img/user.jpg" class="profile-user-img img-responsive img-circle" alt="User Image">
          @else
            <img src="{{Auth::user()->avatar}}" class="profile-user-img img-responsive img-circle" alt="User Image">
          @endif
          <h3 class="profile-username text-center">
            @if (Auth::user()->social_name == null)
              {{ Auth::user()->name}}
            @else
              {{ Auth::user()->social_name}}
            @endif
          </h3>
          <p class="text-muted text-center">{{ trans('auth.privilegio') }}: {{ auth()->user()->roles->first()->name }}</p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>{{ trans('auth.email') }}</b> <a class="pull-right"> {{ auth()->user()->email }}</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">{{ trans('auth.aboutme') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong><i class="fa fa-certificate margin-r-5"></i> {{ trans('auth.privilegio') }}</strong>
          <p class="text-muted">
            {{ auth()->user()->roles->first()->name }}
          </p>
          <hr>

          <strong><i class="fa fa-map-marker margin-r-5"></i> {{ trans('auth.location') }}</strong>
          <p class="text-muted">{{ auth()->user()->city }}</p>

          <hr>

          <strong><i class="fa fa-list-alt margin-r-5"></i> {{ trans('auth.permisos') }}</strong>
          <p class="text-muted">
            @if (auth()->user()->getAllPermissions()->count())
              {{ auth()->user()->getAllPermissions()->pluck('name')->implode(', ') }}
            @else
              Sin permisos asociados
            @endif
          </p>

        </div>
        <!-- /.box-body -->
      </div>

    </div>

    <div class="col-md-8 col-xs-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#settings" data-toggle="tab">{{ trans('auth.editar') }}</a></li>
          <li><a href="#settings2" data-toggle="tab">Actualizar Contraseña</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="settings">
            <form class="form-horizontal formprofile" method="POST" action="/profile_up" accept-charset="UTF-8">
              {{ csrf_field() }}

              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">{{ trans('auth.nombre') }}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name" value="{{ old('name')}}">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail" placeholder="Email" value="{{ auth()->user()->email }}" disabled>
                </div>
              </div>
              <div class="form-group">
                <label for="city" class="col-sm-2 control-label">{{ trans('auth.location') }}</label>

                <div class="col-sm-10">
                   <input type="text" name="city" placeholder="City" class="form-control" value="{{ old('city,  auth()->user()->city') }}" id="city">
                </div>
              </div>

              <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> Puntos que debe de tomar en cuenta!</h4>
                <ol>
                  <li> La cantidad de caracteres de la contraseña debe de ser igual o mayor que 6. </li>
                  <li> La contraseña y la confirmación deben de ser iguales. </li>
                  <li> En caso que desee cambiar el nombre o la localizacion basta con llenar el campo deseado.</li>
                </ol>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="button" class="btn bg-olive btneditprof"><i class="fa fa-pencil-square margin-r-5"></i>Click Actualizar información</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="settings2">
            <form class="form-horizontal formprofiletwo" method="POST" action="/profile_up_pass" accept-charset="UTF-8">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="password" class="col-sm-2 control-label">{{ trans('auth.password') }}</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
              </div>

              <div class="form-group">
                <label for="password_confirmation" class="col-sm-2 control-label">{{ trans('auth.retrypepassword') }}</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="button" class="btn btn-danger btneditprofpass"><i class="fa fa-key"></i>Click Actualizar Contraseña</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.tab-pane -->

        </div>
        <!-- /.tab-content -->
      </div>
    </div>
    <div class="col-md-8 col-xs-12">
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
    </div>

  </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('js/admin/profile.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7LGUHYSQjKM4liXutm2VilsVK-svO1XA&libraries=places"></script>
<script type="text/javascript">
    function initialize() {
        var options = {
            types: ['(cities)'],
            componentRestrictions: {country: "mx"}
        };
        var input = document.getElementById('city');
        var autocomplete = new google.maps.places.Autocomplete(input, options);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
@endpush

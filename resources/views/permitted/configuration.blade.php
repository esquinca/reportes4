@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View Configuration') )
    {{ trans('message.configuration') }}
  @else
    {{ trans('message.configuration') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View Configuration') )
    {{ trans('message.general') }}
  @else
    {{ trans('message.general') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View Configuration') )
    {{ trans('message.configuration') }}
  @else
    {{ trans('message.configuration') }}
  @endif
@endsection

@section('content')
  @if( auth()->user()->can('View Configuration') )
    <div class="modal modal-default fade" id="modal-CreatUser" data-backdrop="static">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"><i class="fa fa-id-card-o" style="margin-right: 4px;"></i>{{ trans('message.creatusers') }}</h4>
            </div>
            <div class="modal-body">
              <div class="box-body table-responsive">
                <div class="box-body">
                  <div class="row">
                  @if( auth()->user()->can('Create user') )
                    <div class="col-xs-12">
                      <form id="creatusersystem" name="creatusersystem" action="">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="inputCreatName" class="col-sm-4 control-label">{{ trans('auth.nombre')}}<span style="color: red;">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputCreatName" name="inputCreatName" placeholder="{{ trans('auth.nombre') }}" maxlength="60" title=""/>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputCreatEmail" class="col-sm-4 control-label">{{ trans('auth.email') }}<span style="color: red;">*</span></label>
                          <div class="col-sm-8">
                            <input type="email" class="form-control" id="inputCreatEmail" name="inputCreatEmail" placeholder="{{ trans('auth.email') }}" maxlength="60" title="{{ trans('message.maxcarname')}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputCreatLocation" class="col-sm-4 control-label">{{ trans('auth.location')}}<span style="color: red;">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" id="inputCreatLocation" name="inputCreatLocation" class="form-control"  placeholder="{{ trans('auth.location') }}" maxlength="20">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="selectCreatRole" class="col-sm-4 control-label">{{ trans('message.role') }}<span style="color: red;">*</span></label>
                          <div class="col-sm-8">
                            <select id="selectCreatRole" name="selectCreatRole"  class="form-control" required>
                              <option value="">{{ trans('message.selectopt') }}</option>
                              @forelse ($roles as $id => $name)
                              <option value="{{ $id }}"> {{ $name }} </option>
                              @empty
                              @endforelse
                            </select>
                          </div>
                        </div>
                      </form>
                    </div>
                  @else
                    <div class="col-xs-12">
                      @include('default.deniedmodule')
                    </div>
                  @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              @if( auth()->user()->can('Create user') )
                <button type="button" class="btn bg-navy create_user_data"><i class="fa fa-plus-square-o" style="margin-right: 4px;"></i>{{ trans('message.create') }}</button>
              @endif
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.ccmodal') }}</button>
            </div>
          </div>
        </div>
    </div>

    <div class="modal modal-default fade" id="modal-editUser" data-backdrop="static">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"><i class="fa fa-id-card-o" style="margin-right: 4px;"></i>{{ trans('message.editusers') }}</h4>
            </div>
            <div class="modal-body">
              <div class="box-body table-responsive">
                <div class="box-body">
                  <div class="row">
                    @if( auth()->user()->can('Edit user') )
                    <div class="col-xs-12">
                        <form id="editusersystem" name="editusersystem" action="">
                          {{ csrf_field() }}
                           <input id='id_recibido' name='id_recibido' type="hidden" class="form-control" placeholder="">
                            <div class="form-group">
                              <label for="inputEditName" class="col-sm-4 control-label">{{ trans('auth.nombre')}}<span style="color: red;">*</span></label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEditName" name="inputEditName" placeholder="{{ trans('auth.nombre') }}" maxlength="60" title=""/>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEditEmail" class="col-sm-4 control-label">{{ trans('auth.email') }}</label>
                              <div class="col-sm-8">
                                <input type="email" class="form-control" id="inputEditEmail" name="inputEditEmail" placeholder="{{ trans('auth.email') }}" maxlength="60" title="{{ trans('message.maxcarname')}}" readonly>
                              </div>
                            </div>
                            <div class="form-group">
                               <label for="inpuEditlocation" class="col-sm-4 control-label">{{ trans('auth.location')}}</label>
                               <div class="col-sm-8">
                                 <input type="text" id="inpuEditlocation" name="inpuEditlocation" class="form-control"  placeholder="{{ trans('auth.location') }}" maxlength="20">
                               </div>
                             </div>
                            <div class="form-group">
                              <label for="selectEditPriv" class="col-sm-4 control-label">{{ trans('message.role') }}<span style="color: red;">*</span></label>
                              <div class="col-sm-8">
                                <select id="selectEditPriv" name="selectEditPriv"  class="form-control" required>
                                    <option value="">{{ trans('message.selectopt') }}</option>
                                  @forelse ($roles as $id => $name)
                                    <option value="{{ $id }}"> {{ $name }} </option>
                                  @empty
                                  @endforelse
                                </select>
                              </div>
                            </div>
                        </form>
                    </div>
                    @else
                      <div class="col-xs-12">
                        @include('default.deniedmodule')
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              @if( auth()->user()->can('Edit user') )
                <button type="button" class="btn bg-navy update_user_data"><i class="fa fa-pencil-square-o" style="margin-right: 4px;"></i>{{ trans('message.actualizar') }}</button>
              @endif
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.ccmodal') }}</button>
            </div>
          </div>
        </div>
    </div>

    <div class="modal modal-default fade" id="modal-menu" data-backdrop="static">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"><i class="fa fa-id-card-o" style="margin-right: 4px;"></i>{{ trans('message.confMenu') }}</h4>
            </div>
            <div class="modal-body">
              <div class="box-body table-responsive">
                <div class="box-body">
                  <div class="row">
                    <input id='id_recibido' name='id_recibido' type="hidden" class="form-control" placeholder="">
                    @if( auth()->user()->can('View Configuration') )
                      <div class="col-md-6">
                        <b><h4>Asignar Menu</h4></b>
                        <form id="menuusersystem" name="menuusersystem" action="">
                          {{ csrf_field() }}
                          <div class="checkbox"><label><input type="checkbox" value="default" checked disabled title="Seleccionado por default"> Dashboard</label></div>
                          <div class="checkbox"><label><input type="checkbox" value="default" checked disabled title="Seleccionado por default"> Perfil</label></div>
                          @forelse ($menus as $id => $display_name)
                          <div class="checkbox">
                            <label>
                              <input id="{{$id}}" name="menu[]" type="checkbox" value="{{$id}}"> {{ $display_name }}
                              <!-- <input id="{{$id}}" name="menu[]" type="checkbox" value="{{$id}}"> {{ $display_name }} -->
                            </label>
                          </div>
                          @empty
                          @endforelse

                          @if( auth()->user()->can('Edit Configuration') )
                            <button type="button" class="btn btn-info btnconsumptiontopday"><i class="fa fa-floppy-o margin-r5"></i> Guardar Cambios</button>
                          @endif

                        </form>
                      </div>

                      <div class="col-md-6">
                        <b><h4>Dar permisos</h4></b>
                        <form id="permisosusersystem" name="permisosusersystem" action="">
                          {{ csrf_field() }}
                          @forelse ($permisos as $id => $name)
                          <div class="checkbox">
                            <label>
                              <input id="{{$id}}" name="permissions[]" type="checkbox" value="{{$name}}"> {{ $name }}
                            </label>
                          </div>
                          @empty
                          @endforelse

                          @if( auth()->user()->can('Edit Configuration') )
                            <button type="button" class="btn btn-info btnprivilege"><i class="fa fa-floppy-o margin-r5"></i> Guardar Cambios</button>
                          @endif
                        </form>
                      </div>
                    @else
                      <div class="col-xs-12">
                        @include('default.deniedmodule')
                      </div>
                    @endif

                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn bg-navy create_user_data"><i class="fa fa-plus-square-o" style="margin-right: 4px;"></i>{{ trans('message.create') }}</button> -->
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.ccmodal') }}</button>
            </div>
          </div>
        </div>
    </div>

    <div class="modal modal-default fade" id="modal-delUser" data-backdrop="static">
      <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-bookmark" style="margin-right: 4px;"></i>{{ trans('message.confirmacion') }}</h4>
          </div>
          <div class="modal-body">
            <div class="box-body table-responsive">
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-12">
                    @if( auth()->user()->can('Delete user') )
                    <form id="deleteusersystem" name="deleteusersystem" action="">
                      {{ csrf_field() }}
                      <input id='recibidoconf' name='recibidoconf' type="hidden" class="form-control" placeholder="">
                      <h4 style="font-weight: bold;">{{ trans('message.preguntaconf') }}</h4>
                    </form>
                    @else
                        @include('default.deniedmodule')
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            @if( auth()->user()->can('Delete user') )
              <button type="button" class="btn btn-danger btndelete"><i class="fa fa-trash" style="margin-right: 4px;"></i>{{ trans('message.eliminar') }}</button>
            @endif
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.ccmodal') }}</button>

          </div>
        </div>
      </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-users"></i>
                  <h3 class="box-title">Configuración - Usuario</h3>
                </div>
                <div class="box-body">
                  <div class="row">                    
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                      <div class="table-responsive">
                        <table id="example_conf_user" name='example_conf_user' class="display nowrap table table-bordered table-hover" width="100%" cellspacing="0">
                          <input type='hidden' id='_tokenb' name='_tokenb' value='{!! csrf_token() !!}'>
                          <thead>
                              <tr class="bg-primary" style="background: #789F8A; font-size: 11.5px; ">
                                  <th> <small>Nombre</small> </th>
                                  <th> <small>Email</small> </th>
                                  <th> <small>Localización</small> </th>
                                  <th> <small>Opciones</small> </th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>

                  </div>

                </div>
              </div>
            </div>
        </div>
    </div>

  @else
    @include('default.denied')
  @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View Configuration') )
    <script src="{{ asset('js/admin/configuration.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7LGUHYSQjKM4liXutm2VilsVK-svO1XA&libraries=places"></script>
    <script type="text/javascript">
        function initialize() {
            var options = {
                types: ['(cities)'],
                componentRestrictions: {country: "mx"}
            };
            if (document.getElementById("inpuEditlocation")) {
              var input = document.getElementById('inpuEditlocation');
              var autocomplete = new google.maps.places.Autocomplete(input, options);
            }

            if (document.getElementById("inputCreatLocation")) {
              var input_two = document.getElementById('inputCreatLocation');
              var autocomplete_two = new google.maps.places.Autocomplete(input_two, options);
            }
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <style>
      .pac-container {  z-index: 1051 !important;  }
    </style>
  @else
  @endif
@endpush

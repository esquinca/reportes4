@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View survey nps configuration') )
    {{ trans('message.title_survey') }}
  @else
    {{ trans('message.title_survey') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View survey nps configuration') )
    {{ trans('message.subtitle_configuration_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View survey nps configuration') )
    {{ trans('message.breadcrumb_configuration_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View survey nps configuration') )


    <!--Modal confirmación-->
     <div class="modal modal-default fade" id="modal-confirmation" data-backdrop="static">
       <div class="modal-dialog" >
         <div class="modal-content">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             <h4 class="modal-title"><i class="fa fa-bookmark" style="margin-right: 4px;"></i>Confirmación</h4>
           </div>
           <div class="modal-body">
             <div class="box-body">
               <div class="row">
                 <div class="col-xs-12">
                   <h4 style="font-weight: bold;">¿Are you sure you want to resend all surveys?</h4>
                 </div>
               </div>
             </div>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-success btn-conf-action"><i class="fa fa-check" style="margin-right: 4px;"></i>Confirmar</button>
             <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.ccmodal') }}</button>
           </div>
         </div>
       </div>
     </div>
    <!--Modal confirmación-->


    <div class="modal modal-default fade" id="modal-delrelacion" data-backdrop="static">
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
                    @if( auth()->user()->can('Delete assign hotel user') )
                    <form id="deleteuserhotel" name="deleteuserhotel" action="">
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
            @if( auth()->user()->can('Delete assign hotel user') )
              <button type="button" class="btn btn-danger btndeletereluser"><i class="fa fa-trash" style="margin-right: 4px;"></i>{{ trans('message.eliminar') }}</button>
            @endif
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.ccmodal') }}</button>

          </div>
        </div>
      </div>
    </div>

    <div class="modal modal-default fade" id="modal-searchhotel" data-backdrop="static">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"><i class="fa fa-building-o" style="margin-right: 4px;"></i>Ver {{ trans('message.hotel') }}</h4>
            </div>
            <div class="modal-body">
              <div class="box-body table-responsive">
                <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12">
                        <form id="hotel_of_user" name="hotel_of_user" action="">
                          {{ csrf_field() }}
                            <div class="form-group">
                               <label for="search_hotel_text" class="col-sm-4 control-label">{{ trans('message.hotel')}}</label>
                               <div class="col-sm-12">
                                 <textarea id="search_hotel_text" name="search_hotel_text" disabled style="width:100%" class="form-control" rows="5" ></textarea>
                               </div>
                             </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.ccmodal') }}</button>
            </div>
          </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                  <li><a href="#tab_3-2" data-toggle="tab">Option - Delete</a></li>
                  <li><a href="#tab_3-1" data-toggle="tab">Step 3 - See assignments</a></li>
                  <li><a href="#tab_2-2" data-toggle="tab">Step 2 - Assign</a></li>
                  <li class="active"><a href="#tab_1-1" data-toggle="tab">Step 1 - Add</a></li>
                  <li class="pull-left header"><i class="fa fa-th"></i> Basic User Configuration</li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1-1">
                    <div class="row">
                    @if( auth()->user()->can('Create user') )
                      <div class="col-xs-12">
                        <form id="creatusersystem" name="creatusersystem" class="form-horizontal" method="POST" data-toggle="validator" action="{{ url('data_create_client_config') }}">
                          <b class="text-center" style="text-decoration: underline;"><i class="fa fa-user-plus"></i> Añadir cliente</b>
                          {{ csrf_field() }}
                          <div class="form-group">
                            <label for="inputCreatName" class="col-sm-2 control-label">{{ trans('auth.nombre')}}<span style="color: red;">*</span></label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputCreatName" name="inputCreatName" placeholder="{{ trans('auth.nombre') }}" maxlength="60" title="" data-minlength="4" required data-error="Por favor ingrese al menos 4 caracteres"/>
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputCreatEmail" class="col-sm-2 control-label">{{ trans('auth.email') }}<span style="color: red;">*</span></label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" id="inputCreatEmail" name="inputCreatEmail" placeholder="{{ trans('auth.email') }}" maxlength="60" title="{{ trans('message.maxcarname')}}" required data-error="Por favor ingrese un correo valido.">
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputCreatLocation" class="col-sm-2 control-label">{{ trans('auth.location')}}<span style="color: red;">*</span></label>
                            <div class="col-sm-10">
                              <input type="text" id="inputCreatLocation" name="inputCreatLocation" class="form-control"  placeholder="{{ trans('auth.location') }}" maxlength="20" data-minlength="4" required data-error="Por favor ingrese al menos 4 caracteres">
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <div class="col-sm-12 text-center">
                                <button class="btn bg-navy" type="submit" id="capture_cu"><i class="fa fa-plus-square-o"></i> {{ trans('message.create')}}</button>
                                <a id="cancela_cu" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                              </div>
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
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2-2">
                    <div class="row">
                      @if( auth()->user()->can('View assign hotel user') )
                      <div class="col-xs-12">
                        <form id="assign_hotel_client" name="assign_hotel_client" class="form-horizontal" method="POST" action="{{ url('creat_assign_surveyed') }}">
                          <b class="text-center" style="text-decoration: underline;"><i class="fa fa-handshake-o"></i> Asignar hotel a cliente</b>
                          {{ csrf_field() }}
                          <div class="form-group">
                            <label for="select_clients" class="col-md-2 control-label">{{ trans('message.client') }}</label>
                            <div class="col-md-10 selectContainer">
                              <select id="select_clients" name="select_clients"class="form-control select2">
                                <option value="" selected> Elija </option>
                                @forelse ($users as $data_users)
                                <option value="{{ $data_users->id }}"> {{ $data_users->name }} </option>
                                @empty
                                @endforelse
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="select_hotels" class="col-md-2 control-label">{{ trans('message.hotel') }}</label>
                            <div class="col-md-10">
                              <select id="select_hotels" name="select_hotels[]" multiple="multiple" class="form-control">
                                @forelse ($hotels as $data_hotel)
                                <option value="{{ $data_hotel->id }}"> {{ $data_hotel->Nombre_hotel }} </option>
                                @empty
                                @endforelse
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="row">
                              <div class="col-sm-12 text-center">
                                @if( auth()->user()->can('Create assign hotel user') )
                                <button id="capture_hc" type="submit" class="btn bg-navy" ><i class="fa fa-plus-square-o"></i> {{ trans('message.create')}}</button>
                                @endif
                                <!-- <a id="capture_hc" class="btn bg-navy create_user_data"><i class="fa fa-plus-square-o"></i> {{ trans('message.create')}}</a> -->
                                <a id="cancela_hc" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                              </div>
                            </div>
                          </div>
                        </form>

                        <div class="alert alert-info alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-info"></i> Info!</h4>
                          Nota: Si usted selecciona un lugar ya asignado a dicho usuario, no se le volvera añadir.
                        </div>

                      </div>
                      @else
                        <div class="col-xs-12">
                          @include('default.deniedmodule')
                        </div>
                      @endif
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3-1">
                    <div class="row">
                      @if( auth()->user()->can('View list assign hotel user') )
                        <div class="col-xs-12">
                          <div class="table-responsive">
                            <table id="see_venue_client" name='see_venue_client' class="display nowrap table table-bordered table-hover" width="100%" cellspacing="0">
                              <input type='hidden' id='_tokenb' name='_tokenb' value='{!! csrf_token() !!}'>
                              <thead>
                                <tr class="bg-primary" style="background: #789F8A; font-size: 11.5px; ">
                                  <th> <small>Name User</small> </th>
                                  <th> <small>Venue</small> </th>
                                  <th> <small>Operación A</small> </th>
                                </tr>
                              </thead>
                              <tbody>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      @else
                        <div class="col-xs-12">
                          @include('default.deniedmodule')
                        </div>
                      @endif
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3-2">
                    <div class="row">
                      @if( auth()->user()->can('View assign delete client') )
                      <div class="col-xs-12">
                        <form id="delete_all_client" name="delete_all_client" class="form-horizontal" method="POST" action="{{ url('data_delete_client_config') }}">
                          <b class="text-center" style="text-decoration: underline;"><i class="fa fa-user-times"></i> Eliminar cliente:</b>
                          {{ csrf_field() }}
                          <div class="form-group">
                            <label for="delete_clients" class="col-md-2 control-label">{{ trans('message.client') }}</label>
                            <div class="col-md-10 selectContainer">
                              <select id="delete_clients" name="delete_clients"class="form-control" required>
                                <option value="" selected> Elija </option>
                                @forelse ($users as $data_users)
                                  <option value="{{ $data_users->id }}"> {{ $data_users->name }} </option>
                                @empty
                                @endforelse
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <div class="col-sm-12 text-center">
                                @if( auth()->user()->can('Delete user') )
                                <button id="capture_dc" type="submit" class="btn bg-navy" ><i class="fa fa-user-times"></i> {{ trans('message.eliminar')}}</button>
                                @endif
                                <a id="cancela_dc" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                              </div>
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
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
            </div>


            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                  <!-- <li><a href="#tabs_two" data-toggle="tab">Option 2 - Automatic</a></li> -->
                  <li class="active"><a href="#tab_one" data-toggle="tab"> Option 1 - Individual</a></li>
                  <li class="pull-left header"><i class="fa fa-th"></i> Sending of surveys </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_one">
                    <div class="row">
                      @if( auth()->user()->can('View config nps individual') )
                      <div class="col-xs-12">
                        <form id="form_reg_survey" name="form_reg_survey" class="form-horizontal" method="POST" action="{{ url('create_data_client') }}">
                          {{ csrf_field() }}
                          <div class="form-group">
                            <label for="select_ind_one" class="col-md-2 control-label">{{ trans('message.vertical') }}</label>
                            <div class="col-md-10 selectContainer">
                              <select id="select_ind_one" name="select_ind_one"class="form-control">
                                <option value="" selected> Elija </option>
                                @forelse (  App\Vertical::select('id', 'name')->get(); as $verticals)
                                  <option value="{{ $verticals->id }}"> {{ $verticals->name }} </option>
                                @empty
                                @endforelse
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="select_ind_two" class="col-md-2 control-label">{{ trans('message.user') }}</label>
                            <div class="col-md-10 selectContainer">
                              <select id="select_ind_two" name="select_ind_two[]" multiple="multiple" class="form-control">
                              </select>
                            </div>
                          </div>


                          <div class="form-group">
                            <label class="col-md-2 control-label" for="month_upload_band">{{ trans('message.periodactive')}} </label>
                            <div class="col-md-10">
                              <div class="input-group input-daterange">
                                  <input name="date_start"  type="text" class="form-control" value="">
                                  <div class="input-group-addon">to</div>
                                  <input name="date_end"  type="text" class="form-control" value="">
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-2 control-label" for="month_evaluate">{{ trans('message.monthtoevaluate')}} </label>
                            <div class="col-md-10">
                              <input id="month_evaluate" name="month_evaluate"  type="text"  maxlength="10" placeholder="" class="form-control input-md">
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="row">
                              <div class="col-sm-12 text-center">
                                @if( auth()->user()->can('Create config nps individual') )
                                <button id="capture" type="submit" class="btn btn-success" ><i class="fa fa-bookmark-o"></i> {{ trans('message.capturar')}}</button>
                                @endif
                                <a id="clear" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                              </div>
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
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tabs_two">
                    <div class="row">
                      @if( auth()->user()->can('View config nps automatic') )
                      <div class="col-xs-12">
                        <form id="form_auto_survey" name="form_auto_survey" class="form-horizontal" method="POST" action="{{ url('create_data_auto_client') }}">
                          {{ csrf_field() }}
                          <div class="form-group">
                            <label for="select_one_v" class="col-md-2 control-label">{{ trans('message.vertical') }}</label>
                            <div class="col-md-10 selectContainer">
                              <select id="select_one_v" name="select_one_v"class="form-control">
                                <option value="" selected> Elija </option>
                                @forelse (  App\Vertical::select('id', 'name')->get(); as $verticals)
                                  <option value="{{ $verticals->id }}"> {{ $verticals->name }} </option>
                                @empty
                                @endforelse
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="select_clients_auto" class="col-md-2 control-label">{{ trans('message.user') }}</label>
                            <div class="col-md-10 selectContainer">
                              <select id="select_clients_auto" name="select_clients_auto[]" multiple="multiple" class="form-control">
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="row">
                              <div class="col-sm-12 text-center">
                                @if( auth()->user()->can('Create config nps automatic') )
                                <button id="capture_auto" type="submit" class="btn btn-success" ><i class="fa fa-bookmark-o"></i> {{ trans('message.capturar')}}</button>
                                @endif
                                <a id="clear" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                              </div>
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
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
            </div>

            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="box box-solid">
                <div class="box-body">
                  <div class="media">
                    <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                      Reenviar encuesta
                    </h4>
                    <div class="media">
                        <div class="media-body">
                            <div class="clearfix">
                              <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                  <div class="box box-solid">
                                    <div class="box-body">
                                      <div class="form-inline">
                                          {{ csrf_field() }}

                                          <div class="form-group">
                                            <label class="col-md-5 control-label" for="month_correspond_mail">{{ trans('message.monthtocorrespond')}} </label>
                                            <div class="col-md-7">
                                              <input id="month_correspond_mail" name="month_correspond_mail"  type="text"  maxlength="10" placeholder=""
                                                class="form-control input-md">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                              <button type="button" id="btn-send_reenv_mail" class="btn btn-info btn-send_reenv_mail"><i class="fa fa-bullseye margin-r5"></i> {{ trans('message.send_c') }}</button>
                                          </div>
                                      </div>
                                     </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="box box-solid">
                <div class="box-body">
                  <div class="media">
                    <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                      Ver usuarios encuestados
                    </h4>
                    <div class="form-inline">
                        <div class="form-group">
                          <label for="calendar_fecha_nps" class="control-label">Buscar por mes:</label>
                          <input type="text" class="form-control datepickermonth" id="calendar_fecha_nps" placeholder="Example: 2017-12">
                        </div>
                        <div class="form-group">
                            <button type="button" id="btn_filter_nps" class="btn btn-info btngeneral"><i class="fa fa-bullseye margin-r5"></i> Filtrar</button>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <div class="clearfix">
                                {{ csrf_field() }}
                                <div class="table-responsive">
                                  <table id="example_survey" name='example_survey' class="display nowrap table table-bordered table-hover" width="100%" cellspacing="0">
                                    <input type='hidden' id='_tokenb' name='_tokenb' value='{!! csrf_token() !!}'>
                                    <thead>
                                        <tr class="bg-primary" style="background: #789F8A; font-size: 11.5px; ">
                                            <th> <small>Nombre</small> </th>
                                            <th> <small>Email</small> </th>
                                            <th> <small>Estatus</small> </th>
                                            <th> <small>Estado</small> </th>
                                            <th> <small>Fecha corresponde</small> </th>
                                            <th> <small>Fecha inicio</small> </th>
                                            <th> <small>Fecha fin</small> </th>
                                            <th> <small>Operación A</small> </th>
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

        </div>
    </div>
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View survey nps configuration') )
    <script src="{{ asset('js/form-validator.min.js')}}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery-wizard-master/libs/formvalidation/formValidation.min.css')}}" >
    <script src="{{ asset('plugins/jquery-wizard-master/libs/formvalidation/formValidation.min.js')}}"></script>
        <script src="{{ asset('plugins/jquery-wizard-master/libs/formvalidation/bootstrap.min.js')}}"></script>

    <script src="{{ asset('js/admin/qualification/configurationsurveynps.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-multiselect-master/dist/css/bootstrap-multiselect.css') }}" type="text/css" />
    <script src="{{ asset('../bower_components/bootstrap-multiselect-master/dist/js/bootstrap-multiselect.js') }}"></script>
    <style media="screen">
    .multiselect-container {
        width: 100% !important;
        position: relative !important;
    }
    .select2-container {
      width: 100% !important;
    }
    </style>
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
    <script type="text/javascript">
      $(document).ready(function() {
        $('#assign_hotel_client')
          .formValidation({
              framework: 'bootstrap',
              excluded: ':disabled',
              icon: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                  'select_hotels[]': {
                      validators: {
                          callback: {
                              message: 'Please choose 1 to 12 hotels that you can assign',
                              callback: function(value, validator, $field) {
                                  // Get the selected options
                                  var options = validator.getFieldElements('select_hotels[]').val();
                                  return (options != null
                                          && options.length >= 1 && options.length <= 12);
                              }
                          }
                      }
                  },
                  select_clients: {
                      validators: {
                          notEmpty: {
                              message: 'Please select a client.'
                          }
                      }
                  }
              }
          })
          .find('[name="select_clients"]')
              .select2({
                placeholder: "Elije",
                  // dropdownAutoWidth : true,
                  // width: 'auto'
              })
              .change(function(e) {
                  /* Revalidate the language when it is changed */
                  $('#assign_hotel_client').formValidation('revalidateField', 'select_clients');
              })
              .end()
          .find('[name="select_hotels[]"]')
              .multiselect({
                  buttonWidth: '100%',
                  nonSelectedText: 'Elija uno o más',
                  maxHeight: 100,
                  // Re-validate the multiselect field when it is changed
                  onChange: function(element, checked) {
                      $('#assign_hotel_client').formValidation('revalidateField', 'select_hotels[]');
                      adjustByScrollHeight();
                  },
                  onDropdownShown: function(e) {
                      adjustByScrollHeight();
                  },
                  onDropdownHidden: function(e) {
                      adjustByHeight();
                  }
              })
              .end();
          // You don't need to care about these methods
          function adjustByHeight() {
              var $body   = $('body'),
                  $iframe = $body.data('iframe.fv');
              if ($iframe) {
                  // Adjust the height of iframe when hiding the picker
                  $iframe.height($body.height());
              }
          }
          function adjustByScrollHeight() {
              var $body   = $('body'),
                  $iframe = $body.data('iframe.fv');
              if ($iframe) {
                  // Adjust the height of iframe when showing the picker
                  $iframe.height($body.get(0).scrollHeight);
              }
          }
      });
    </script>

    <script type="text/javascript">
      $(document).ready(function() {
        $('#form_auto_survey')
          .formValidation({
              framework: 'bootstrap',
              excluded: ':disabled',
              icon: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                  'select_clients_auto[]': {
                      validators: {
                          callback: {
                              message: 'Please choose 1 to 12 hotels that you can assign',
                              callback: function(value, validator, $field) {
                                  // Get the selected options
                                  var options = validator.getFieldElements('select_clients_auto[]').val();
                                  return (options != null
                                          && options.length >= 1 && options.length <= 12);
                              }
                          }
                      }
                  },
                  select_one_v: {
                      validators: {
                          notEmpty: {
                              message: 'Please select a client.'
                          }
                      }
                  }
              }
          })
          .find('[name="select_one_v"]')
              .select2({
                placeholder: "Elije",
                  // dropdownAutoWidth : true,
                  // width: 'auto'
              })
              .change(function(e) {
                  /* Revalidate the language when it is changed */
                  $('#form_auto_survey').formValidation('revalidateField', 'select_one_v');
              })
              .end()
          .find('[name="select_clients_auto[]"]')
              .multiselect({
                  buttonWidth: '100%',
                  nonSelectedText: 'Elija uno o más',
                  maxHeight: 100,
                  // Re-validate the multiselect field when it is changed
                  onChange: function(element, checked) {
                      $('#form_auto_survey').formValidation('revalidateField', 'select_clients_auto[]');
                      adjustByScrollHeight();
                  },
                  onDropdownShown: function(e) {
                      adjustByScrollHeight();
                  },
                  onDropdownHidden: function(e) {
                      adjustByHeight();
                  }
              })
              .end();
          // You don't need to care about these methods
          function adjustByHeight() {
              var $body   = $('body'),
                  $iframe = $body.data('iframe.fv');
              if ($iframe) {
                  // Adjust the height of iframe when hiding the picker
                  $iframe.height($body.height());
              }
          }
          function adjustByScrollHeight() {
              var $body   = $('body'),
                  $iframe = $body.data('iframe.fv');
              if ($iframe) {
                  // Adjust the height of iframe when showing the picker
                  $iframe.height($body.get(0).scrollHeight);
              }
          }
      });
    </script>





  @else
    <!--NO VER-->
  @endif
@endpush

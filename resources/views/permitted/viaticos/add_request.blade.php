@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View add request of travel expenses') )
    {{ trans('message.viaticos_add_request') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View add request of travel expenses') )
    {{ trans('message.viaticos') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View add request of travel expenses') )
    {{ trans('message.breadcrumb_viaticos_add') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View add request of travel expenses') )
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="row">
            <form id="search_info" name="search_info" class="form-inline" method="post">
              {{ csrf_field() }}
              <div class="col-sm-2">
                <button id="boton-aplica-filtro" type="button" class="btn btn-info filtrarDashboard">
                  <i class="glyphicon glyphicon-triangle-right" aria-hidden="true"></i>  Nueva
                </button>
              </div>
            </form>
          </div>
        </div>

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pt-10 data_equipament">
          <div class="row">
            <div class="col-md-7">
              <div class="box box-solid">
                <div class="box-body">
                  <form class="form-horizontal" id='add_equipitho'>
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="input-group">
                          <span class="input-group-addon">Folio <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                          <input id="folio_id" name="folio_id" maxlength="150" type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="input-group">
                          <span class="input-group-addon">Id Proyecto <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                          <input id="proyect_id" name="proyect_id" maxlength="150" type="text" class="form-control">
                        </div>
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="input-group">
                          <span class="input-group-addon">Servicio <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                          <select class="form-control select2" id="service_id" name="service_id">
                            <option value="" selected> Elija </option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="input-group">
                          <span class="input-group-addon">Proyecto <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                          <select class="form-control select2" id="cadena_id" name="cadena_id">
                            <option value="" selected> Elija </option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="input-group">
                          <span class="input-group-addon">Solicitante <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                          <select class="form-control select2" id="user_id" name="user_id">
                            <option value="" selected> Elija </option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="input-group">
                          <span class="input-group-addon">Gerente <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                          <select class="form-control select2" id="gerente_id" name="gerente_id">
                            <option value="" selected> Elija </option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-lg-12">
                        <div class="input-group">
                          <span class="input-group-addon">Tipo de beneficiario <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                          <select class="form-control select2" id="beneficiario_id" name="beneficiario_id">
                            <option value="" selected> Elija </option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="input-group">
                          <span class="input-group-addon">Fecha Inicio: <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                          <input id="date_start" name="date_start" maxlength="150" type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="input-group">
                          <span class="input-group-addon">Fecha Fin: <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                          <input id="date_end" name="date_end" maxlength="150" type="text" class="form-control">
                        </div>
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="input-group">
                          <span class="input-group-addon">Lugar Origen: <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                          <input id="place_o" name="place_o" maxlength="150" type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="input-group">
                          <span class="input-group-addon">Lugar Destino: <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                          <input id="place_d" name="place_d" maxlength="150" type="text" class="form-control">
                        </div>
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="input-group">
                          <span class="input-group-addon">Descripción <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                          <input id="descripcion" name="descripcion" maxlength="150" type="text" class="form-control">
                        </div>
                      </div>
                      <!-- <div class="col-lg-6">
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-save"><i class="fa fa-save"></i> Guardar</button>
                          <button type="button" class="btn btn-default btn-clear"><i class="fa fa-eraser"></i> Limpiar</button>
                          <button type="button" class="btn btn-danger btn-cancel"><i class="fa fa-times"></i> Cancelar</button>
                        </div>
                      </div> -->
                    </div>
                    <br>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-4">
              <div class="box box-solid">
                <div class="box-body">
                  <form class="form-horizontal" id='add_equipitho'>
                    {{ csrf_field() }}

                    <div class="row">
                      <div class="col-lg-12">
                        <div class="input-group">
                          <span class="input-group-addon">Concepto <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                          <select class="form-control select2" id="concepto_id" name="concepto_id">
                            <option value="" selected> Elija </option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-lg-12">
                        <div class="input-group">
                          <span class="input-group-addon">Monto: <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                          <input id="amount" name="amount" maxlength="150" type="text" class="form-control">
                        </div>
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-lg-12">
                        <div class="input-group">
                          <span class="input-group-addon">Lugar Origen: <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                          <input id="place_conc_o" name="place_conc_o" maxlength="150" type="text" class="form-control">
                        </div>
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-lg-12">
                        <div class="input-group">
                          <span class="input-group-addon">Lugar Destino: <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                          <input id="place_conc_d" name="place_conc_d" maxlength="150" type="text" class="form-control">
                        </div>
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-lg-12">
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-save"><i class="fa fa-save"></i> Guardar</button>
                          <button type="button" class="btn btn-default btn-clear"><i class="fa fa-eraser"></i> Limpiar</button>
                        </div>
                      </div>
                    </div>
                    <br>

                  </form>
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
  @if( auth()->user()->can('View add request of travel expenses') )
  <style media="screen">
    .pt-10 {
      padding-top: 10px;
    }
  </style>
  @else
    <!--NO VER-->
  @endif
@endpush

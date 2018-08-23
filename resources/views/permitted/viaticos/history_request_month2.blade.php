@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View history all viatic') )
    {{ trans('message.history') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View history all viatic') )
    {{ trans('message.history_viat_month') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View history all viatic') )
    {{ trans('message.breadcrumb_history_viat_month') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View history all viatic') )
    <div class="modal modal-default fade" id="modal-view-concept" data-backdrop="static">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"><i class="fa fa-id-card-o" style="margin-right: 4px;"></i>Lista de conceptos</h4>
            </div>
            <div class="modal-body">
              <div class="box-body table-responsive">
                <div class="box-body">
                  <div class="row">
                      <!------------------------------------------------------------------------------------------------------------------------------------------------------->
                      <div id="captura_pdf_general" class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="hojitha"   style="background-color: #fff; /*border:1px solid #ccc;*/ border-bottom-style:hidden; padding:10px; padding-top: 0px; width: 95%">
                            <div class="row pad-top-botm ">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                  <h2> <small>Solicitud de viaticos</small></h2>
                                </div>
                            </div>

                            <div class="row text-center contact-info">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr />
                                    <span>
                                        <strong>Email: </strong><small id="email"></small>
                                    </span>
                                    <span>
                                        <strong>Telf: </strong><small id="tel"></small>
                                    </span>
                                    <hr />
                                </div>
                            </div>

                            <div  class="row pad-top-botm client-info">
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                <p class="text-center" style="border: 1px solid #FF851B" >Solicitante</p>
                                <strong>Nombre: </strong><small id="name_user"></small>
                                <br />
                                <strong>Correo: </strong><small id="correo_user"></small>
                                <br />
                                <strong>Beneficiario: </strong><small id="tipo_beneficiario"></small>
                                <br />
                                <strong>Gerente aprobar: </strong><small id="responsable"></small>
                                <br />
                                <strong>Folio del viaticos: </strong><small id="folio_solicitud"></small>
                                <br />
                                <strong>Estatus de Solicitud: </strong><small id="status_solicitud"></small>
                                <br />
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                <p class="text-center" style="border: 1px solid #007bff" >Periodo</p>
                                <strong>Fecha de inicio: </strong><small id="fecha_ini"></small>
                                <br />
                                <strong>Fecha de termino:</strong><small id="fecha_fin"></small>
                                <br />
                              </div>
                            </div>

                            <div class="row pad-top-botm client-info">
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                <p class="text-center" style="border: 1px solid #3D9970" >Conceptos</p>
                                <div class="clearfix">
                                  <table id="table_concept" class="table table-striped table-bordered table-hover">
                                    <thead>
                                      <tr>
                                        <th>Concepto</th>
                                        <th>Monto</th>
                                        <th>Estatus</th>
                                        <th>Hotel</th>
                                      </tr>
                                    </thead>
                                    <tbody style="font-size: 10px;">

                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>

                            <div class="row pad-top-botm client-info">
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="clearfix">
                                    <div id="comentarios" style="width: 100%; min-height: 80px; border:1px solid #ccc;padding:10px;">Observaciones o comentarios:
                                      <small id="observaciones_a"></small>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                      </div>
                      <!------------------------------------------------------------------------------------------------------------------------------------------------------->
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-export"><i class="fa fa-save"></i> Exportar PDF</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.ccmodal') }}</button>
            </div>
          </div>
        </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="row">
            <form id="search_info" name="search_info" class="form-inline" method="post">
              {{ csrf_field() }}
              <div class="col-sm-2">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  <input id="date_to_search" type="text" class="form-control" name="date_to_search">
                </div>
              </div>
              <div class="col-sm-10">
                <button id="boton-aplica-filtro" type="button" class="btn btn-info filtrarDashboard">
                  <i class="glyphicon glyphicon-filter" aria-hidden="true"></i>  Filtrar
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pt-10">
          <div class="table-responsive">
            <table id="table_viatics" class="table table-striped table-bordered table-hover">
              <thead>
                <tr class="bg-primary" style="background: #088A68;">
                  <th> <small>Folio</small> </th>
                  <th> <small>Servicio</small> </th>
                  <th> <small>Fecha Inicio</small> </th>
                  <th> <small>Fecha Fin</small> </th>
                  <th> <small>Monto Solicitado</small> </th>
                  <th> <small>Monto Aprobado</small> </th>
                  <th> <small>Estatus</small> </th>
                  <th> <small>Usuario</small> </th>
                  <th> <small></small> </th>
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot id='tfoot_average'>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>

    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View history all viatic') )
  <link rel="stylesheet" type="text/css" href="{{ asset('css/pdf2.css')}}" >
  <script src="{{ asset('bower_components/jsPDF/dist/jspdf.min.js')}}"></script>
  <script src="{{ asset('bower_components/html2canvas/html2canvas.js')}}"></script>
  <script src="{{ asset('plugins/momentupdate/moment.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/momentupdate/moment-with-locales.js') }}" type="text/javascript"></script>
  <style media="screen">
    .pt-10 {
      padding-top: 10px;
    }
  </style>
  <script src="{{ asset('js/admin/viaticos/requests_viaticos_all.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush

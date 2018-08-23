@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View history of payment') )
    {{ trans('message.pay_hist_request') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View history of payment') )
    {{ trans('message.subtitle_pay_hist') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View history of payment') )
    {{ trans('message.breadcrumb_pay_hist') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View history of payment') )
      <div class="modal modal-default fade" id="modal-view-concept" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"><i class="fa fa-eye" style="margin-right: 4px;"></i>Preview</h4>
            </div>
            <div class="modal-body table-responsive">
              <div class="box-body">
                <div class="box-body">
                  <div class="row">
                      <!------------------------------------------------------------------------------------------------------------------------------------------------------->
                      <div id="captura_pdf_general" style="margin-left:3em;font-size:1.1em;" class="">
                        <div class="hojitha">
                          <div class="header-pays">
                            <div class="row">
                              <input type="hidden" id="id_xs" name="id_xs" class="text">
                              <div class="col-md-2">
                                <img class="logo-sit" src="{{ asset('/images/users/logo.svg') }}" style="padding-bottom:20px;width:100px" />
                              </div>
                              <div class="col-md-3">
                                <h3>{{ trans('pay.title') }}</h3>
                              </div>
                              <div style="padding-top:1.1em;" class="col-md-4">
                                <p class="text-left">
                                  {{ trans('pay.date_solicitude') }}:
                                  <span id="fecha_ini"></span>
                                </p>
                                <p class="text-left">
                                  {{ trans('pay.date_pay') }}: {{ trans('pay.no_data') }}
                                </p>
                              </div>
                              <div class="col-md-3">
                                <input class="form-control" type="text" id="folio" name="folio" value="" disabled="true">
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group">
                                <label for="factura" class="col-md-2 control-label">{{ trans('pay.factura') }}</label>
                                <div class="col-md-6">
                                  <input style="font-size:22px;font-weight: bold;" disabled class="form-control" type="text" name="numfact" id="numfact" value="">
                                </div>
                                <label for="" class="col-md-1 control-label">{{ trans('pay.prioridad') }}:</label>
                                  <div class="col-md-2">
                                    <input disabled class="form-control" id="rec_priority" type="text" name="" value="">
                                  </div>
                              </div>
                            </div>
                            <div class="row margin-top-short">
                                <div class="form-group">
                                  <label for="customer" class="col-md-2 control-label">{{ trans('pay.sitio') }}</label>
                                    <div class="col-md-6">
                                      <input style="font-size:22px" disabled class="form-control" id="rec_sitio" type="text" name="rec_sitio" value="">
                                    </div>
                                </div>
                            </div>

                          <div class="row margin-top-short">
                            <div class="form-group">
                              <label for="provider" class="col-md-2 control-label">{{ trans('pay.proveedor') }}</label>
                              <div class="col-md-9">
                                <input style="font-size:22px" id="rec_proveedor" disabled class="form-control" type="text" name="" value="">
                              </div>
                            </div>
                          </div>
                          <div class="row margin-top-short">
                            <div class="form-group">
                              <label for="amount" class="col-md-2 control-label">{{ trans('pay.amount') }}</label>
                              <div class="col-md-9">
                                <input style="font-size:22px" disabled class="form-control" type="text" name="rec_monto" id="rec_monto" >
                              </div>
                            </div>
                          </div>
                          <div class="row margin-top-short">
                            <div class="form-group">
                              <div class="col-md-9 col-md-offset-2">
                                <input style="font-size:16px;" class="form-control" type="text" disabled="true" name="amountText" id="amountText" value="">
                              </div>
                            </div>
                          </div>
                        <!--  Fin del header de pago -->

                          <div class="row">
                            <div class="form-group">
                              <label for="description" class="col-md-2 control-label">{{ trans('pay.concept_pay') }}</label>
                              <div class="col-md-9">
                                <textarea style="resize:none;" disabled class="form-control" id="rec_description" name="rec_description" rows="4" cols="40"></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row margin-top-short">
                            <div class="form-group">
                              <label for="method-pay" class="col-md-2 control-label">{{ trans('pay.way_pay') }}</label>
                              <div class="col-md-9">
                                <input id="rec_way_pay" disabled class="form-control" type="text" name="" value="">
                              </div>
                            </div>

                            <div class="row margin-top-short">
                              <div class="col-md-12">
                                  <div class="form-group margin-top-short">
                                    <label for="" class="col-md-12 control-label">{{ trans('pay.data_bank') }}</label>
                                  </div>
                                    <div class="form-group margin-top-short">
                                      <label for="bank" class="col-md-3 control-label">{{ trans('pay.bank') }}</label>
                                      <div class="col-md-8">
                                        <input style="font-size:22px" id="rec_bank" disabled class="form-control" type="text" name="rec_bank" value="">
                                      </div>
                                    </div>
                                    <div class="form-group margin-top-short">
                                      <label for="account" class="col-md-3 control-label">{{ trans('pay.cuenta') }}</label>
                                        <div class="col-md-8">
                                          <input style="font-size:22px" id="rec_cuenta" disabled class="form-control" type="text" name="rec_cuenta" value="">
                                        </div>
                                    </div>
                                    <div class="form-group margin-top-short">
                                      <label for="clabe" class="col-md-3 control-label">{{ trans('pay.clabe') }}</label>
                                      <div class="col-md-8">
                                        <input style="font-size:22px" type="text" class="form-control" id="rec_clabe" name="rec_clabe" placeholder="{{ trans('pay.clabe_int') }}" disabled>
                                      </div>
                                    </div>
                                    <div class="form-group margin-top-short">
                                      <label for="reference_banc" class="col-md-3 control-label">{{ trans('pay.reference') }}</label>
                                      <div class="col-md-8">
                                        <input style="font-size:22px" type="text" class="form-control" id="rec_reference" name="rec_reference" placeholder="{{ trans('pay.reference_bank') }}" disabled>
                                      </div>
                                    </div>

                               </div>
                            </div>
                          </div>
                          <hr>

                          <div class="row">
                            <div class="form-group col-md-5">
                              <p><strong>{{ trans('pay.area') }}</strong></p>
                              <div id="areas">
                                @forelse ($area as $id => $name)
                                <div class="checkbox">
                                  <label>
                                    <input id="{{$id}}" disabled name="areas[]" type="checkbox" value="{{$name}}"> {{ $name }}
                                  </label>
                                </div>
                                @empty
                                @endforelse
                              </div>
                            </div>
                            <div class="form-group col-md-4 col-md-offset-2">
                              <p><strong>{{ trans('pay.application') }}</strong></p>
                              @forelse ($application as $id => $name)
                              <div class="radio">
                                <label>
                                  <input type="radio" disabled name="opt_application[]" value="{{$name}}" > {{ $name }}
                                </label>
                              </div>
                              @empty
                              @endforelse
                            </div>
                          </div>
                          <div class="row margin-top-short">
                            <div class="form-group">
                              <label for="project-name" class="col-md-3 control-label">{{ trans('pay.name_project') }}</label>
                                <div class="col-md-8">
                                  <input disabled class="form-control" type="text" id="rec_name_project" name="rec_name_project" value="">
                                </div>
                            </div>
                         </div>


                        <div class="row">
                          <div class="form-group">
                                @forelse ($options as $id => $name)
                                  <div class="col-md-4 col-md-offset-1">
                                    <div class="radio">
                                      <label>
                                          <input type="radio" disabled name="options[]" value="{{$name}}" > {{ $name }}
                                      </label>
                                    </div>
                                  </div>
                                @empty
                               @endforelse
                          </div>
                          <!-- -->
                        </div>

                        <div class="row">
                          <div class="form-group col-md-5">
                            <p><strong>{{ trans('pay.type_project') }}</strong></p>
                            @forelse ($vertical as $id => $name)
                              <div class="checkbox">
                                <label>
                                  <input id="{{$id}}" disabled name="verticals[]" type="checkbox" value="{{$name}}"> {{ $name }}
                                </label>
                              </div>
                            @empty
                            @endforelse
                          </div>
                          <!-- -->
                          <div class="form-group col-md-5 col-md-offset-1">
                            <p><strong>{{ trans('pay.class_cost') }}</strong></p>
                            <input disabled required class="form-control" type="text" id="rec_class_cost" name="rec_class_cost" value="">

                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <label for="observaciones" class="col-md-3 control-label">{{ trans('pay.observation') }}</label>
                            <div class="col-md-8">
                              <textarea disabled style="resize:none;" class="form-control" id="rec_observation" name="rec_observation" rows="5" cols="40"></textarea>
                            </div>
                          </div>
                        </div>
                        <br>
                        <div class="row margin-top-large text-center">
                          <div class="col-sm-offset-2">
                            <div class="col-xs-3 border-top margin-left-short">
                              <img id="firma_1" name="firma_1" class="img-responsive" src="{{ asset('/images/hotel/Default.svg') }}" />
                              <hr>
                              <p id="persona_1">{{ trans('pay.no_data') }}</p>
                              <hr>
                              <p style="font-weight: bold;">{{ trans('pay.elaboro') }}</p>
                            </div>
                            <div class="col-xs-3 border-top margin-left-short">
                              <img id="firma_2" name="firma_2" class="img-responsive" src="{{ asset('/images/hotel/Default.svg') }}" />
                              <hr>
                              <p id="persona_2">{{ trans('pay.no_data') }}</p>
                              <hr>
                              <p style="font-weight: bold;">{{ trans('pay.reviso') }}</p>
                            </div>
                            <div class="col-xs-3 border-top margin-left-short">
                              <img id="firma_3" name="firma_2" class="img-responsive" src="{{ asset('/images/hotel/Default.svg') }}" />
                              <hr>
                              <p id="persona_3">{{ trans('pay.no_data') }}</p>
                              <hr>
                              <p style="font-weight: bold;">{{ trans('pay.autorizo') }}</p>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <p><strong>{{ trans('pay.confpay') }}: </strong> <small id="rec_name_conf">{{ trans('pay.no_data') }}</small></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <p><strong>{{ trans('pay.delconfpay') }}: </strong> <small id="rec_name_conf_del">{{ trans('pay.no_data') }}</small></p>
                          </div>
                        </div>
                      </div>

                      <!------------------------------------------------------------------------------------------------------------------------------------------------------->
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              @if ( auth()->user()->can('View level three payment notification') )
                <button type="button" class="btn btn-warning btn-aprobar"><i class="fa fa-check"></i> Aprobar</button>
              @endif
              <button type="button" class="btn btn-success btn-print-invoice"><i class="fa fa-file-pdf-o"></i> Imprimir Factura</button>
              <button type="button" class="btn btn-primary btn-export"><i class="fa fa-save"></i> Exportar PDF</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.ccmodal') }}</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


      <!---   MODAL WINDOW   -->
      <div class="modal modal-default fade" id="modal-view-concept2" data-backdrop="static">
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-id-card-o" style="margin-right: 4px;"></i>Preview</h4>
              </div>
              <div class="modal-body">
                <div class="box-body table-responsive">
                  <div class="box-body">
                    <div class="row">
                        <!------------------------------------------------------------------------------------------------------------------------------------------------------->
                        <div id="captura_pdf_general" class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                          <div class="hojitha"   style="background-color: #fff; /*border:1px solid #ccc;*/ border-bottom-style:hidden; padding:10px; padding-top: 0px; width: 95%">
                              <div class="row pad-top-botm ">
                                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-center">
                                      <img class="logo-sit" src="{{ asset('/images/users/logo.svg') }}" style="padding-bottom:20px;width:70px" />
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <h4>Solicitud de pago</h4>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
                                      <strong>Fecha de solicitud: </strong><small id="day-request"></small><br>
                                      <strong>Fecha de pago: </strong><small id="day-pay"></small>
                                  </div>
                              </div>

                              <div class="row  contact-info">
                                  <div class="col-lg-12 col-md-12 col-sm-12">
                                      <hr />
                                      <span>
                                          <strong>Folio: </strong><small id="folio"></small>
                                      </span>
                                      <br>
                                      <span>
                                          <strong>Proyecto: </strong><small id="project"></small>
                                      </span>
                                      <br>
                                      <span>
                                          <strong>Sitio: </strong><small id="site"></small>
                                      </span>
                                      <br>
                                      <span>
                                          <strong>Proveedor: </strong><small id="prov"></small>
                                      </span>
                                      <br>
                                      <hr />
                                  </div>
                              </div>

                              <div class="row pad-top-botm client-info">
                                <div class="col-lg-12 col-md-12 col-sm-12">

                                  <div class="col-lg-12 col-md-12 col-sm-12">
                                    <span>
                                        <strong>Monto: $ </strong><small id="amount"></small><br>
                                        <strong> </strong><small id="">DIEZ MIL QUINIENTOS PESOS M.N 00/100 MXN </small>
                                    </span>
                                    <br>
                                    <span>
                                        <strong>Forma de pago: </strong><small id="wayPayment"></small>
                                    </span>
                                    <br>
                                    <span>
                                        <strong>Banco: </strong><small id="bank"></small>
                                    </span>
                                    <br>
                                    <span>
                                        <strong>Cuenta: </strong><small id="bank"></small>
                                    </span>
                                    <br>
                                    <span>
                                        <strong>Clabe: </strong><small id="bank"></small>
                                    </span>
                                    <br>
                                    <span>
                                        <strong>Concepto: </strong><small id="bank"></small>
                                    </span>
                                    <br>
                                    <span>
                                        <strong>Estatus: </strong><small id="bank"></small>
                                    </span>
                                  </div>

                                </div>
                              </div>
                              <hr>
                              <!---  FIN CONCEPTOS ---->
                              <div class="row pad-top-botm client-info">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                  <div class="row form-group">

                                    <div class="col-md-4 col-md-offset-2">
                                      <div class="radio">
                                        <label>
                                          <input type="radio" name="installation" value="" > Instalación
                                        </label>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-md-offset-2">
                                      <div class="radio">
                                        <label>
                                          <input type="radio" name="operation" value="" > Operación
                                        </label>
                                      </div>
                                    </div>

                                  </div>
                                  <div class="col-lg-12 col-md-12 col-sm-12">
                                    <span>
                                        <strong>Area:</strong><small id="area"></small>
                                    </span><br>
                                    <span>
                                        <strong>Aplicación: </strong><small id="wayPayment"></small>
                                    </span><br>
                                    <span>
                                        <strong>Tipo de proyecto: </strong><small id="typeProject"></small>
                                    </span><br>
                                    <span>
                                        <strong>Clasificación del gasto: </strong><small id="typeSpend"></small>
                                    </span><br>
                                    <span>
                                        <strong>Financiamiento: </strong><small id="financing"></small>
                                    </span><br>
                                  </div>
                                </div>
                              </div>

                              <div class="row pad-top-botm client-info">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                  <div class="clearfix">
                                      <div id="comentarios" style="width: 100%; min-height: 80px; border:1px solid #ccc;padding:10px;">Observaciones:
                                        <small id="observaciones_a"></small>
                                      </div>
                                    </div>
                                </div>
                              </div>
                              <br>
                              <div class="row margin-top-large text-center">
                                <div class="col-xs-12">
                                  <div class="col-xs-4 border-top margin-left-short"><p >{{ Auth::user()->name}}</p><p>{{ trans('pay.elaboro') }}</p></div>
                                  <div class="col-xs-4 border-top margin-left-short"><p >René Gonzalez Sánchez</p><p>{{ trans('pay.reviso') }}</p></div>
                                  <div class="col-xs-4 border-top margin-left-short"><p >Alejandro Espejo Sokol</p><p>{{ trans('pay.autorizo') }}</p></div>
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
     @if( auth()->user()->can('View level zero payment notification') )
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
             <table id="table_pays" class="table table-striped table-bordered table-hover">
               <thead>
                 <tr class="bg-primary" style="background: #088A68;">
                   <th> <small>Factura</small> </th>
                   <th> <small>Nombre del proyecto</small> </th>
                   <th> <small>Proveedor</small> </th>
                   <th> <small>Monto</small> </th>
                   <th> <small>Estatus</small> </th>
                   <th> <small>Elaboró</small> </th>
                   <th> <small>Conceptos</small> </th>
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
                 </tr>
               </tfoot>
             </table>
           </div>
         </div>
       </div>
     </div>
     @elseif ( auth()->user()->can('View level one payment notification') )
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
             <table id="table_pays" class="table table-striped table-bordered table-hover">
               <thead>
                 <tr class="bg-primary" style="background: #088A68;">
                   <th> <small></small> </th>
                   <th> <small>Factura</small> </th>
                   <th> <small>Nombre del proyecto</small> </th>
                   <th> <small>Proveedor</small> </th>
                   <th> <small>Monto</small> </th>
                   <th> <small>Estatus</small> </th>
                   <th> <small>Elaboró</small> </th>
                   <th> <small>Conceptos</small> </th>
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
                 </tr>
               </tfoot>
             </table>
           </div>
         </div>
       </div>
     </div>
     @elseif ( auth()->user()->can('View level two payment notification') )
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
             <table id="table_pays" class="table table-striped table-bordered table-hover">
               <thead>
                 <tr class="bg-primary" style="background: #088A68;">
                   <th> <small></small> </th>
                   <th> <small>Factura</small> </th>
                   <th> <small>Nombre del proyecto</small> </th>
                   <th> <small>Proveedor</small> </th>
                   <th> <small>Monto</small> </th>
                   <th> <small>Estatus</small> </th>
                   <th> <small>Elaboró</small> </th>
                   <th> <small>Conceptos</small> </th>

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
                 </tr>
               </tfoot>
             </table>
           </div>
         </div>
       </div>
     </div>
     @elseif ( auth()->user()->can('View level three payment notification') )
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
             <table id="table_pays" class="table table-striped table-bordered table-hover">
               <thead>
                 <tr class="bg-primary" style="background: #088A68;">
                   <th> <small></small> </th>
                   <th> <small>Factura</small> </th>
                   <th> <small>Nombre del proyecto</small> </th>
                   <th> <small>Proveedor</small> </th>
                   <th> <small>Monto</small> </th>
                   <th> <small>Estatus</small> </th>
                   <th> <small>Elaboró</small> </th>
                   <th> <small>Conceptos</small> </th>
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
                 </tr>
               </tfoot>
             </table>
           </div>
         </div>
       </div>
     </div>
     @endif
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
    <style media="screen">
      .pt-10 {
        padding-top: 10px;
      }

      .margin-top-short{
        margin-top: 7px;
      }

      .modal-content{
        width: 160%;
        margin-left: -30%;
      }
    </style>
  @if( auth()->user()->can('View history of payment') )
    <script src="{{ asset('plugins/momentupdate/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/momentupdate/moment-with-locales.js') }}" type="text/javascript"></script>
    <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/css/dataTables.checkboxes.css" rel="stylesheet" />
    <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/js/dataTables.checkboxes.min.js"></script>
    <link href="/plugins/sweetalert-master/dist/sweetalert.css" rel="stylesheet" type="text/css" />
    <script src="/plugins/sweetalert-master/dist/sweetalert-dev.js"></script>

    <script src="{{ asset('js/admin/payments/request_modal_payment.js')}}"></script>
    <script src="{{ asset('bower_components/jsPDF/dist/jspdf.min.js')}}"></script>
    <script src="{{ asset('bower_components/html2canvas/html2canvas.js')}}"></script>
    @if( auth()->user()->can('View level zero payment notification') )
    <script src="{{ asset('js/admin/payments/request_payment_0.js')}}"></script>
    @elseif ( auth()->user()->can('View level one payment notification') )
    <script src="{{ asset('js/admin/payments/request_payment_1.js')}}"></script>
    @elseif ( auth()->user()->can('View level two payment notification') )
    <script src="{{ asset('js/admin/payments/request_payment_2.js')}}"></script>
    @elseif ( auth()->user()->can('View level three payment notification') )
    <script src="{{ asset('js/admin/payments/request_payment_3.js')}}"></script>
    @endif
  @else
    <!--NO VER-->
  @endif
@endpush

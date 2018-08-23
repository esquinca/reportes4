@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View cover') )
    {{ trans('message.title_cover') }}
  @else
    {{ trans('message.title_cover') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View cover') )
    {{ trans('message.subtitle_detailed_cover') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View cover') )
    {{ trans('message.breadcrumb_detailed_cover') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View cover') )
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="box box-solid">
                <div class="box-body">
                  <div class="form-inline">
                      {{ csrf_field() }}

                      <div class="form-group">
                        <label for="select_one" class="control-label">{{ trans('message.hotel') }}: </label>
                        <select id="select_one" name="select_one"  class="form-control select2" required>
                          <option value="" selected> Elija </option>
                          @forelse ($hotels as $data_hotel)
                            <option value="{{ $data_hotel->id }}"> {{ $data_hotel->Nombre_hotel }} </option>
                          @empty
                          @endforelse
                        </select>
                      </div>
                      <div class="form-group">
                          <button type="button" id="btn_generar" class="btn btn-info btngeneral"><i class="fa fa-bullseye margin-r5"></i> {{ trans('message.generate') }}</button>
                          <button type="button" class="btn btn-success btn-export hidden-xs"><i class="fa fa-file-pdf-o  margin-r5"></i> {{ trans('message.export') }} Portada</button>
                      </div>
                  </div>
                 </div>
              </div>
            </div>


            <div id="captura_pdf_general" class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="hojitha"   style="background-color: #fff; border:1px solid #ccc; border-bottom-style:hidden; padding:10px; width: 100%">
                  <div class="row pad-top-botm ">
                      <div class="col-lg-3 col-md-3 col-sm-3 ">
                         <img class="logo-sit" src="{{ asset('/images/users/logo.svg') }}" style="padding-bottom:20px;" />
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                        <h2> <small>Carta de entrega</small></h2>
                        <strong id="name_htl"></strong>
                        <br />
                        <strong>ID Proyecto:</strong> <small id="id_proyect"></small>
                        <br />
                        <strong>Equipo activo</strong>
                        <br />
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3 ">
                         <img class="logo-sit" id="client_img" src="{{ asset('images/hotel/Hard_Rock_Punta_Cana.svg') }}" style="padding-bottom:20px;" />
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
                           <span>
                              <strong>Expedición: </strong>  @php
                                $mytime = Carbon\Carbon::now();
                                echo $mytime->toDateTimeString();
                              @endphp
                          </span>
                          <hr />
                      </div>
                  </div>

                  <div  class="row pad-top-botm client-info">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <p class="text-center" style="border: 1px solid #FF851B" >Empresa</p>
                      <strong>Nombre: </strong><small id="empresa"></small>
                      <br />
                      <strong>Responsable: </strong><small id="responsable"></small>
                      <br />
                      <strong>Área de trabajo: </strong><small id="area"></small>
                      <br />
                      <strong>Dirección: </strong><small id="dir"></small>
                      <br />
                      <strong>Teléfono: </strong><small id="tel_empresa"></small>
                      <br />
                      <strong>Correo: </strong><small id="correo_empresa"></small>
                      <br />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <p class="text-center" style="border: 1px solid #007bff" >Cliente</p>
                      <strong>Nombre: </strong><small id="cliente_nombre"></small>
                      <br />
                      <strong>Responsable: </strong><small id="cliente_responsable"></small>
                      <br />
                      <strong>Ubicación: </strong><small id="cliente_ubi"></small>
                      <br />
                      <strong>Dirección: </strong><small id="cliente_dir"></small>
                      <br />
                      <strong>Teléfono: </strong><small id="cliente_tel"></small>
                      <br />
                      <strong>Correo: </strong><small id="cliente_email"></small>
                      <br />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <br />
                      <p class="text-center" style="border: 1px solid #3D9970" >Información</p>
                      Las instalaciones de los equipos se realizaron acorde a cada uno de los términos y condiciones, respetando así el tiempo estipulado para las instalaciones.
                      <br />
                      <strong>Fecha de inicio del proyecto: </strong><small id="fecha_ini"></small>
                      <br />
                      <strong>Fecha de termino del proyecto:</strong><small id="fecha_fin"></small>
                      <br />
                    </div>

                  </div>

                  <div  class="row text-center contact-info">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <hr />
                        <span>
                            <strong>Equipamiento</strong>
                        </span>
                      <hr />
                    </div>
                  </div>

                  <div class="row pad-top-botm client-info">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="clearfix">
                          <div id="main_equipos" style="width: 100%; min-height: 500px; border:1px solid #ccc;padding:10px;"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="clearfix">
                          <div id="main_modelos" style="width: 100%; min-height: 500px; border:1px solid #ccc;padding:10px;"></div>
                        </div>
                    </div>
                  </div>
                  <div class="row pad-top-botm client-info">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="clearfix">
                          <div id="comentarios" style="width: 100%; min-height: 80px; border:1px solid #ccc;padding:10px;">Observaciones o comentarios:</div>
                        </div>
                    </div>
                  </div>

                  <div class="row pad-top-botm client-info text-center">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="clearfix">
                          <hr>
                          <strong>Nombre y Firma del responsable del proyecto.</strong>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="clearfix">
                          <hr>
                          <strong>Nombre y Firma del cliente.</strong>
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
  @if( auth()->user()->can('View cover') )
    <script src="{{ asset('bower_components/jsPDF/dist/jspdf.min.js')}}"></script>
    <script src="{{ asset('bower_components/html2canvas/html2canvas.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pdf.css')}}" >
    <script src="{{ asset('js/admin/inventory/cover.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush

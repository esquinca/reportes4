@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View admin approval') )
    {{ trans('message.title_admin_approval') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View admin approval') )
    {{ trans('message.subtitle_admin_approval') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View admin approval') )
    {{ trans('message.breadcrumb_admin_approval') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View admin approval') )
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

              <div class="box box-solid">
                <div class="box-body">
                  <form id="filasasw" name="filasasw" action="/result_filter_comments" method="post">
                    <!--...................................................................................-->
                    <div id="filtration_container" name="filtration_container">
                      <div id="filter_year" name="filter_year" class="row row-separation control-filter">
                        <div class="nowrap col-xs-4 col-sm-2 col-md-1 col-lg-1">
                           <button id='' type="button" class="boton-mini btn btn-warning" ><i class="fa fa-minus-square" aria-hidden="true"></i></button> <strong>{{ trans('message.year')}}</strong>
                        </div>
                        <div class="col-xs-8 col-sm-2 col-md-11 col-lg-1">
                          <select id="searchyear" name="searchyear" class="form-control">
                            <option value="" selected> Elija </option>
                          </select>
                        </div>
                      </div>

                      <div id="filter_status" name="filter_status" class="row row-separation control-filter">
                        <div class="nowrap col-xs-4 col-sm-2 col-md-1 col-lg-1">
                           <button id='' type="button" class="boton-mini btn btn-warning" ><i class="fa fa-minus-square" aria-hidden="true"></i></button> <strong>{{ trans('message.estatus')}}</strong>
                        </div>
                        <div class="col-xs-8 col-sm-2 col-md-11 col-lg-1">
                          <select id="searchestatus" name="searchestatus" class="form-control" style="width: 100%;">
                            <option value="" selected> Elija </option>
                            <option value="0">{{ trans('message.pendiente')}}</option>
                            <option value="1">{{ trans('message.aprobado')}}</option>
                          </select>
                        </div>
                      </div>

                      <div id="filter_hotel" name="filter_hotel" class="row row-separation control-filter">
                        <div class="nowrap col-xs-4 col-sm-2 col-md-1 col-lg-1">
                           <button id='' type="button" class="boton-mini btn btn-warning" ><i class="fa fa-minus-square" aria-hidden="true"></i></button> <strong>{{ trans('message.hotel')}}</strong>
                        </div>
                        <div class="col-xs-8 col-sm-2 col-md-11 col-lg-1">
                          <select id="searchhotel" name="searchhotel" class="form-control" style="width: 100%;">
                            <option value="" selected> Elija </option>
                            @forelse ($hotels as $data_hotel)
                              <option value="{{ $data_hotel->id }}"> {{ $data_hotel->Nombre_hotel }} </option>
                            @empty
                            @endforelse
                          </select>
                        </div>
                      </div>
                    </div>
                    <!--...................................................................................-->
                    <div class="form-inline row-separation">
                      <button id="boton-aprobar_todopendientes" type="button" class="btn bg-olive">
                        <span id="buttonpendientes" class="badge bg-teal">0</span>
                        <i class="fa fa-exclamation"></i>{{ trans('message.approvalpend')}}
                      </button>
                      <button id="boton-aplica-filtro-visitantes" type="button" class="btn bg-orange">
                        <i class="glyphicon glyphicon-filter" aria-hidden="true"></i> {{ trans('message.approvalfilt')}}
                      </button>
                      <button id='boton_muestra_selectfiltro' type="button" class="btn bg-navy">
                        <i class="fa fa-plus-square" aria-hidden="true"></i> {{ trans('message.addapprovalfilt')}}
                      </button>
                      <select id='selectfiltro'class ='selectFiltro' class="form-control">
                        <option value="" selected> Elija </option>
                        <option value="filter_year">{{ trans('message.year')}}</option>
                        <option value="filter_status">{{ trans('message.estatus')}}</option>
                        <option value="filter_hotel">{{ trans('message.hotel')}}</option>
                      </select>
                    </div>
                    <!--...................................................................................-->
                  </form>

                  <div class="row">
                    <div class="col-sm-12">
                      </br>
                      <div class="table-responsive">
                        <table class="table" id="table_approval_a" name='table_approval_a' class="hover" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th> <small>Hotel</small> </th>
                                  <th> <small>Tipo</small> </th>
                                  <th> <small>Mes</small> </th>
                                  <th> <small>Estatus</small> </th>
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
  @if( auth()->user()->can('View admin approval') )
  <link rel="stylesheet" type="text/css" href="{{ asset('css/filter.css')}}" >
  <script src="{{ asset('js/admin/report/approval_admin.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush

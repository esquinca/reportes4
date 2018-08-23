@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View search equipment') )
    {{ trans('message.title_equipment') }}
  @else
    {{ trans('message.title_equipment') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View search equipment') )
    {{ trans('message.subtitle_search_equipment') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View search equipment') )
    {{ trans('message.breadcrumb_search_equipment') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View search equipment') )
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="box box-solid">
            <div class="box-body">
              <div class="form-horizontal">
                  {{ csrf_field() }}
                 <div class="form-group">
                     <label class="col-md-1 control-label" for="month_upload_band">Periodo: </label>
                     <div class="col-md-11">
                      <div class="input-group input-daterange">
                        <input name="date_start"  type="text" class="form-control" value="">
                        <div class="input-group-addon">to</div>
                        <input name="date_end"  type="text" class="form-control" value="">
                      </div>
                     </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2 text-right">
                    <button type="button" class="btn btn-info btn-search-range">Buscar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="table-responsive">
               <table id="table_equipament" cellspacing="0" class="table table-striped table-bordered table-hover">
                 <thead>
                   <tr class="bg-primary" style="background: #088A68;">
                     <th> <small>Cliente.</small> </th>
                     <th> <small>Equipo.</small> </th>
                     <th> <small>Marca.</small> </th>
                     <th> <small>Mac.</small> </th>
                     <th> <small>Serie.</small> </th>
                     <th> <small>Modelo.</small> </th>
                     <th> <small>Estado.</small> </th>
                     <th> <small>Fecha Baja.</small> </th>
                   </tr>
                 </thead>
                 <tbody>
                 </tbody>
                 <tfoot id='tfoot_average'>
                   <tr>
                   </tr>
                 </tfoot>
               </table>
          </div>
        </div>

      </div>


      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="box box-solid">
            <div class="box-body">
              <div class="form-horizontal">
                  {{ csrf_field() }}
                 <div class="form-group">
                     <label class="col-md-2 control-label" for="mac_input">Mac o serie: </label>
                     <div class="col-md-10">
                      <div class="input-group ">
                        <input name="mac_input" id="mac_input" placeholder="Minimo 4 digitos." minlength="4" type="text" class="form-control" value="">
                      </div>
                     </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2 text-right">
                    <button type="button" id="btn_search_mac" class="btn btn-info">Buscar Mac</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="table-responsive">
               <table id="table_buscador" cellspacing="0" class="table table-striped table-bordered table-hover">
                 <thead>
                   <tr class="bg-primary" style="background: #088A68;">
                     <th> <small>Cliente.</small> </th>
                     <th> <small>Equipo.</small> </th>
                     <th> <small>Marca.</small> </th>
                     <th> <small>Mac.</small> </th>
                     <th> <small>Serie.</small> </th>
                     <th> <small>Modelo.</small> </th>
                     <th> <small>Estado.</small> </th>
                     <th> <small>Fecha Registro.</small> </th>
                   </tr>
                 </thead>
                 <tbody>
                 </tbody>
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
  @if( auth()->user()->can('View search equipment') )
    <script src="{{ asset('js/admin/equipment/search_equipment.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush

@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View equipment group') )
    {{ trans('message.title_equipment') }}
  @else
    {{ trans('message.title_equipment') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View equipment group') )
    {{ trans('message.subtitle_group_equipment') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View equipment group') )
    {{ trans('message.breadcrumb_group_equipment') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
  @if( auth()->user()->can('View equipment group') )
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="box box-solid">
          
          <div class="box-body">
            <div class="form-inline">
              <label for="" class="control-label">{{ trans('message.gruponew') }}: </label>
              <input type="text" id="new_group" name="new_group" minlength="4" placeholder="Min 4 caracteres."></input>
              <button type="button" id="btn_create_group" class="btn btn-info btncreate" style="width: 10%"><i class="fa fa-bullseye margin-r5"></i> {{ trans('message.create') }}</button>

              <div style="padding-top: 1%">
                {{ csrf_field() }}
            
                <label for="select_one" class="control-label">{{ trans('message.grupoex') }}: </label>
                <select id="select_one" name="select_one"  class="form-control select2" style="width: 60%" required>
                  <option value="" selected> Elija </option>
                  @forelse ($grupos as $data_grupos)
                    <option value="{{ $data_grupos->id }}">{{ $data_grupos->name }}</option>
                  @empty
                  @endforelse
                </select>
                <label for="mac_input" class="control-label">{{ trans('message.ingmac') }}: </label>
                <input type="text" id="mac_input" name="mac_input" minlength="14" maxlength="17" placeholder="Mínimo 14 caracteres."></input>
                <button type="button" id="btn_update_group" class="btn btn-info btngeneral" style="width: 10%"><i class="fa fa-bullseye margin-r5"></i> {{ trans('message.aplicar') }}</button>
              </div> 
            </div>

            <div style="padding-top: 2%">
              <table id="table_group" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                  <th>Equipo.</th>
                  <th>MAC</th>
                  <th>Serie.</th>
                  <th>Marca</th>
                  <th>Modelo</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>


            <!-- Vista para el movimiento de grupos a hoteles. -->
            <div class="form-inline" style="padding-top: 2%">
              <h5><strong>Mover grupos enteros.</strong></h5>
              <label for="select_hotels" class="control-label">{{ trans('message.hotel') }}: </label>
              <select id="select_hotels" name="select_hotels"  class="form-control select2">
                <option value="" selected> Elija </option>
                @forelse ($hotels as $data_hotels)
                  <option value="{{ $data_hotels->id }}">{{ $data_hotels->Nombre_hotel }}</option>
                @empty
                @endforelse
              </select>

              <label for="select_estados" class="control-label">{{ trans('message.estatus') }}: </label>
              <select id="select_estados" name="select_estados"  class="form-control select2">
                <option value="" selected> Elija </option>
                @forelse ($estados as $data_estados)
                  <option value="{{ $data_estados->id }}">{{ $data_estados->Nombre_estado }}</option>
                @empty
                @endforelse
              </select>
              
              <button type="button" id="btn_change_group" class="btn btn-info btngeneral" style="width: 10%"><i class="fa fa-bullseye margin-r5"></i> {{ trans('message.aplicar') }}</button>

            </div>

          </div>

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
                         <h4 style="font-weight: bold;">¿Are you sure you want to continue?</h4>
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

        </div>
      </div>
    </div>
  </div>

  @else
    @include('default.denied')
  @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View equipment group') )
    <script src="{{ asset('js/admin/equipment/group_equipment.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush

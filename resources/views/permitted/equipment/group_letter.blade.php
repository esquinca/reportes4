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
<!--     <script src="{{ asset('js/admin/equipment/group_equipment.js')}}"></script> -->
  @else
    <!--NO VER-->
  @endif
@endpush

@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View concierge approval') )
    {{ trans('message.title_concierge_approval') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View concierge approval') )
    {{ trans('message.subtitle_concierge_approval') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View concierge approval') )
    {{ trans('message.breadcrumb_concierge_approval') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View concierge approval') )
    <div class="modal modal-default fade" id="add_approval" data-backdrop="static">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"><i class="fa fa-id-card-o" style="margin-right: 4px;"></i>{{ trans('message.title_admin_approval') }}</h4>
            </div>
            <div class="modal-body">
              <div class="box-body table-responsive">
                <div class="box-body">
                  <div class="row">
                  @if( auth()->user()->can('Create concierge approval') )
                    <div class="col-xs-12">
                      <form id="creatapprovalconcierge" name="creatapprovalconcierge"  class="form-horizontal" action="">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="select_one_hotel" class="col-md-2 control-label">{{ trans('message.hotel') }}</label>
                          <div class="col-md-10 selectContainer">
                            <select id="select_one_hotel" name="select_one_hotel" class="form-control select2">
                              <option value="" selected> Elija </option>
                              @forelse ($hotels as $data_hotel)
                                <option value="{{ $data_hotel->id }}"> {{ $data_hotel->Nombre_hotel }} </option>
                              @empty
                              @endforelse
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="select_one_type_rep" class="col-md-2 control-label">{{ trans('message.type') }}</label>
                          <div class="col-md-10 selectContainer">
                            <select id="select_one_type_rep" name="select_one_type_rep" class="form-control select2">
                              <option value="" selected> Elija </option>
                              @forelse ($types as $type)
                                <option value="{{ $type->id }}"> {{ $type->name }} </option>
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
              @if( auth()->user()->can('Create concierge approval') )
                <button type="button" class="btn bg-navy create_user_data"><i class="fa fa-plus-square-o" style="margin-right: 4px;"></i>{{ trans('message.create') }}</button>
              @endif
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.ccmodal') }}</button>
            </div>
          </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="box box-solid">
                <div class="box-body">
                  <div class="pull-right">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_approval">
                      <i class="fa fa-plus-square margin-r5"></i> Nueva Aprobación
                    </button>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      </br>
                      <div class="table-responsive">
                        <table class="table" id="table_approval_c" name='table_approval_c' class="hover" width="100%" cellspacing="0">
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
  @if( auth()->user()->can('View concierge approval') )
    <script src="{{ asset('js/admin/report/approval_concierge.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush

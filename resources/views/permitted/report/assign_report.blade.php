@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View assign report') )
    {{ trans('message.title_reports') }}
  @else
    {{ trans('message.title_reports') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View assign report') )
    {{ trans('message.subtitle_assign_report') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View assign report') )
    {{ trans('message.breadcrumb_assign_report') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View assign report') )
      <div class="container">
          <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="box box-solid">
                  <div class="box-body">
                    <form class="form-inline" id="re_data_type">
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
                          <label for="select_two" class="control-label">{{ trans('message.type') }}: </label>
                          <select id="select_two" name="select_two"  class="form-control select2" required>
                            <option value="" selected> Elija </option>
                            @forelse ($types as $data_types)
                              <option value="{{ $data_types->id }}"> {{ $data_types->name }} </option>
                            @empty
                            @endforelse
                          </select>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-info btngeneral"><i class="fa fa-bullseye margin-r5"></i> {{ trans('message.generate') }}</button>
                        </div>
                    </form>
                   </div>
                </div>
              </div>


              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="box box-solid">
                  <div class="box-body">
                    <div class="media">
                      <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                          Generado el día @php
                            $mytime = Carbon\Carbon::now();
                            echo $mytime->toDateTimeString();
                          @endphp
                      </h4>
                      <div class="media">
                          <div class="media-body">
                              <div class="clearfix">
                                  <div style="margin-top: 0">
                                    <div id="main_nationality" style="width: 100%;">

                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                      <div class="table-responsive">
                                        <table class="table" id="example_up" name='example_up' class="hover" width="100%" cellspacing="0">
                                          <thead>
                                              <tr class="bg-primary" style="background: #F0AD4E; font-size: 11.5px; ">
                                                  <th> <small>{{ trans('message.hotel') }}</small> </th>
                                                  <th> <small>Tipo</small> </th>
                                                  <th> <small>Acciones</small> </th>
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

          </div>
      </div>
      <div class="modal modal-default fade" id="modal-del" data-backdrop="static">
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
                      @if( auth()->user()->can('Delete assign report') )
                      <form id="delete_type" name="delete_type" action="">
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
              @if( auth()->user()->can('Delete assign report') )
                <button type="button" class="btn btn-danger btndelete"><i class="fa fa-trash" style="margin-right: 4px;"></i>{{ trans('message.eliminar') }}</button>
              @endif
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.ccmodal') }}</button>

            </div>
          </div>
        </div>
      </div>


    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View assign report') )
    <script src="{{ asset('js/admin/report/assign_report_one.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush

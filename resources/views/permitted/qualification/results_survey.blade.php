@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View results survey') )
    {{ trans('message.title_survey') }}
  @else
    {{ trans('message.title_survey') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View results survey') )
    {{ trans('message.subtitle_results_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View results survey') )
    {{ trans('message.breadcrumb_results_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View results survey') )
    <div class="modal modal-default fade" id="modal-comments" data-backdrop="static">
      <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-id-card-o" style="margin-right: 4px;"></i>Comentario</h4>
          </div>
          <div class="modal-body">
            <div class="box-body table-responsive">
              <div class="box-body">
                <div class="row">

                  <div class="col-xs-12">
                    <div class="form-group">
                      <label for="inputEditEmail" class="col-sm-12 control-label">Texto</label>
                      <div class="col-sm-12">
                        <textarea id="comment_a" name="comment_a"  class="form-control" style="min-width: 100%"readonly></textarea>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
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
            <table id="table_qualification" class="table table-striped table-bordered table-hover">
              <thead>
                <tr class="bg-primary" style="background: #088A68;">
                  <th> <small>Vertical</small> </th>
                  <th> <small>Sitio</small> </th>
                  <th> <small></small> </th>
                  <th> <small></small> </th>
                  <th> <small></small> </th>
                  <th> <small></small> </th>
                  <th> <small></small> </th>
                  <th> <small></small> </th>
                  <th> <small></small> </th>
                  <th> <small></small> </th>
                  <th> <small></small> </th>
                  <th> <small></small> </th>
                  <th> <small></small> </th>
                  <th> <small></small> </th>
                  <th> <small>Año.</small> </th>
                  <th> <small>NPS.</small> </th>
                  <th> <small>Ind.</small> </th>
                  <th> <small>Ingeniero</small> </th>
                  <th> <small>Comentario</small> </th>
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
                  <th></th>
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
  @if( auth()->user()->can('View results survey') )
    <script src="{{ asset('plugins/momentupdate/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/momentupdate/moment-with-locales.js') }}" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/filter.css')}}" >
    <script src="{{ asset('js/admin/qualification/resultssurvey.js')}}"></script>
    <style media="screen">
      .pt-10 {
        padding-top: 10px;
      }
    </style>
  @else
    <!--NO VER-->
  @endif
@endpush

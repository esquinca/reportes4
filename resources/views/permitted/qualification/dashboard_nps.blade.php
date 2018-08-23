@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View dashboard survey nps') )
    {{ trans('message.dashboard') }}
  @else
    {{ trans('message.dashboard') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View dashboard survey nps') )
    {{ trans('message.subtitle_survey_nps') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View dashboard survey nps') )
    {{ trans('message.breadcrumb_survey_nps') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View dashboard survey nps') )
      <div class="modal modal-default fade" id="modal-view-encuestas" data-backdrop="static">
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-id-card-o" style="margin-right: 4px;"></i>Encuestas.</h4>
              </div>
              <div class="box-body table-responsive">
              <div class="box-body">
                <div class="row">
                  <div id="captura_pdf_general" class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="row pad-top-botm client-info">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <p class="text-center" style="border: 1px solid #3D9970" >Información de encuestas.</p>
                        <div class="clearfix">
                          <table id="table_encuestas_boxes" class="table table-striped table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Cliente</th>
                                <th>Sitio</th>
                                <th>Ing. Asignado</th>
                                <th>Estado</th>
                                <th>Calificación</th>
                                <th>Fecha de registro</th>
                              </tr>
                            </thead>
                            <tbody style="font-size: 11px;">

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    </div>
                </div>
              </div>
            </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-primary btn-export"><i class="fa fa-save"></i> Exportar PDF</button> -->
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.ccmodal') }}</button>
              </div>
            </div>
          </div>
      </div>


      <div class="modal modal-default fade" id="modal-view-ppd" data-backdrop="static">
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-id-card-o" style="margin-right: 4px;"></i>Calificaciones.</h4>
              </div>
              <div class="box-body table-responsive">
              <div class="box-body">
                <div class="row">
                  <div id="captura_pdf_general" class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="row pad-top-botm client-info">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <p class="text-center" style="border: 1px solid #3D9970" >Calificaciones.</p>
                        <div class="clearfix">
                          <table id="table_boxes_ppd" class="table table-striped table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Cliente</th>
                                <th>Sitio</th>
                                <th>Ing. Asignado</th>
                                <th>Fecha de registro</th>
                                <th>Calificación</th>
                              </tr>
                            </thead>
                            <tbody style="font-size: 11px;">

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    </div>
                </div>
              </div>
            </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-primary btn-export"><i class="fa fa-save"></i> Exportar PDF</button> -->
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
            <!------------------------------------------------------------------------>
            <div class="row">
              <div class="col-md-3">
                <div class="row">
                  <div class="col-sm-12 col-xs-12">
                    <div class="box box-solid" id="box_total_survey" style="cursor: pointer;">
                      <div class="description-block box-body">
                        <h3 id="total_survey" class="description-header text-blue">0</h3>
                        <b><span class="description-text">Total encuestas</span></b>
                      </div>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-12 col-xs-12">
                    <div class="box box-solid" id="box_response" style="cursor: pointer;">
                      <div class="description-block box-body">
                        <h3 id="answered" class="description-header text-green">0</h3>
                        <b><span class="description-text">Respondieron</span></b>
                      </div>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-12 col-xs-12">
                    <div class="box box-solid" id="box_sin_response" style="cursor: pointer;">
                      <div class="description-block box-body">
                        <h3 id="unanswered" class="description-header text-red">0</h3>
                        <b><span class="description-text">Sin respuesta</span></b>
                      </div>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
              </div>

              <div class="col-md-9">
                <div class="row">
                  <div class="col-md-6">
                    <div class="clearfix" style="background: #ffffff;">
                      <div id="main_nps" style="width: 100%; min-height: 320px; border:1px solid #ccc;"></div>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-md-3">
                    <div class="row pt-10">
                      <div class="col-sm-12 col-xs-12">
                        <div class="info-box" id="box_promotores" style="cursor: pointer;">
                          <span class="info-box-icon bg-green"><i class="fa fa-smile-o"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text pt-10">Promotores</span>
                            <span class="info-box-number" id="total_promotores">0</span>

                          </div>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-12 col-xs-12">
                        <div class="info-box" id="box_pasivos" style="cursor: pointer;">
                          <span class="info-box-icon bg-yellow"><i class="fa fa-meh-o"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text pt-10">Pasivos</span>
                            <span class="info-box-number" id="total_pasivos">0</span>
                          </div>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-12 col-xs-12">
                        <div class="info-box" id="box_detractores" style="cursor: pointer;">
                          <span class="info-box-icon bg-red"><i class="fa fa-frown-o"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text pt-10">Detractores</span>
                            <span class="info-box-number" id="total_detractores">0</span>
                          </div>
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-md-3">
                    <div class="row">
                      <div class="col-sm-12 col-xs-12">
                        <div class="box box-solid">
                          <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                              Comparación Anual
                          </h4>
                          <div class="description-block box-body">
                            <table class="table table-striped" id="tabla_comparativa" name='tabla_comparativa'>
                              <thead>
                                  <tr>
                                    <th class="text-center">Año</th>
                                    <th class="text-center">NPS</th>
                                  </tr>
                              </thead>
                              <tbody>
                              </tbody>
                          </table>


                          </div>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-12 col-xs-12">
                        <div class="box box-solid">
                          <div class="description-block box-body">
                            <h3 id="check_venues" class="description-header text-yellow">0</h3>
                            <b><span class="description-text">Sitios evaluados</span></b>
                          </div>
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
              </div>
            </div>
            <!------------------------------------------------------------------------>
          </div>

          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pt-10">
            <div class="row">

              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="clearfix" style="background: #ffffff;">
                  <div id="main_grap_nps_week" style="width: 100%; min-height: 300px; border:1px solid #ccc;padding:10px;"></div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pt-10">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="clearfix" style="background: #ffffff;">
                    <div id="main_grap_nps" style="width: 100%; min-height: 300px; border:1px solid #ccc;padding:10px;"></div>
                  </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="clearfix" style="background: #ffffff;">
                    <div id="main_grap_nps_per_month" style="width: 100%; min-height: 300px; border:1px solid #ccc;padding:10px;"></div>
                  </div>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pt-10">
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                    Comparativa NPS vs Encuestados por mes
                </h4>
              </div>
              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="clearfix" style="background: #ffffff;">
                  <div id="main_grap_user_vs_request" style="width: 100%; min-height: 300px; border:1px solid #ccc;padding:10px;"></div>
                </div>
              </div>
              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="table-responsive" style="background: #ffffff;">
                  <table id="table_nps_vs_encuestados_mes" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Concepto</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>11</th>
                        <th>12</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pt-10">
            <div class="row">
              <div class="col-sm-12 col-xs-12">
                <div class="box box-solid">

                  <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                      Promedio de calificaciones por vertical
                  </h4>
                  <div class="description-block box-body">
                    <div class="table-responsive" style="background: #ffffff;">
                      <table id="table_vertical" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Vertical</th>
                            <th>Sitios</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                            <th>Indicador</th>
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

          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pt-10">
            <div class="row">
              <div class="col-sm-12 col-xs-12">
                <div class="clearfix" style="background: #ffffff;">
                    <div id="main_gra_grade_avg_per_month" style="width: 100%; min-height: 300px; border:1px solid #ccc;padding:10px;"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pt-10">
            <div class="row">
              <div class="col-sm-12 col-xs-12">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_3" data-toggle="tab">NPS Completo</a></li>
                    <li><a href="#tab_1" data-toggle="tab">NPS Calificación</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Comentarios</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_3">
                      <div class="table-responsive" style="background: #ffffff;">
                        <table id="table_results_full" class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Sitio</th>
                              <th>Cliente</th>
                              <th>Comentario</th>
                              <th>Calificación</th>
                              <th>Ing. asignado</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_1">
                      <div class="table-responsive" style="background: #ffffff;">
                        <table id="table_comments_full" class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Sitio</th>
                              <th>Cliente</th>
                              <th>Comentario</th>
                              <th>Calificación</th>
                              <th>Ing. asignado</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                      <div class="table-responsive" style="background: #ffffff;">
                        <table id="table_comments" class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Cliente</th>
                              <th>Sitio</th>
                              <th>Comentario</th>
                              <th>Calificación</th>
                              <th>Fecha registro</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
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
  @if( auth()->user()->can('View dashboard survey nps') )

  <script src="{{ asset('plugins/momentupdate/moment.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/momentupdate/moment-with-locales.js') }}" type="text/javascript"></script>
    <style media="screen">
      .pt-10 {
        padding-top: 10px;
      }
    </style>
    <script type="text/javascript">
      $(function() {
        moment.locale('es');
        data_nps();
        data_compare_nps();
        graph_nps();
        graph_nps_per_month();
        graph_nps_week();
        main_grap_user_vs_request();
        main_grap_avg_per_month();
        table_comparative_v1();
        table_avg_vertical();
        table_results();
        table_comments_full();
        table_comments();
        $('#date_to_search').datepicker({
          language: 'es',
          format: "yyyy-mm",
          viewMode: "months",
          minViewMode: "months",
          endDate: '-1m',
          autoclose: true,
          clearBtn: true
        });
        $('#date_to_search').val('').datepicker('update');

      });

      $('#box_total_survey').on('click', function(){
        //Funcion para crear data.
        boxes_modal("/box_total");
        $('#modal-view-encuestas').modal('show');
      });

      $('#box_response').on('click', function(){
        //Funcion para crear data.
        boxes_modal("/box_con");
        $('#modal-view-encuestas').modal('show');
      });

      $('#box_sin_response').on('click', function(){
        //Funcion para crear data.
        boxes_modal("/box_sin");
        $('#modal-view-encuestas').modal('show');
      });

      $('#box_promotores').on('click', function(){
        //Funcion para crear data.
        boxes_cali_modal('box_promo');
        $('#modal-view-ppd').modal('show');
      });
      $('#box_pasivos').on('click', function(){
        //Funcion para crear data.
        boxes_cali_modal('box_pas');
        $('#modal-view-ppd').modal('show');
      });
      $('#box_detractores').on('click', function(){
        //Funcion para crear data.
        boxes_cali_modal('box_detra');
        $('#modal-view-ppd').modal('show');
      });

      function boxes_cali_modal(url1) {
        var objData = $('#search_info').find("select,textarea, input").serialize();
        $.ajax({
            type: "POST",
            url: url1,
            data: objData,
            success: function (data){
              //console.log(data);
              table_boxes_cali(data, $('#table_boxes_ppd'));
            },
            error: function (data) {
              console.log('Error:', data);
            }
        });
      }
      function boxes_modal(url1) {
        var objData = $('#search_info').find("select,textarea, input").serialize();
        $.ajax({
            type: "POST",
            url: url1,
            data: objData,
            success: function (data){
              console.log(data);
              table_boxes(data, $('#table_encuestas_boxes'));
            },
            error: function (data) {
              console.log('Error:', data);
            }
        });
      }
      function table_boxes(datajson, table) {
        table.DataTable().destroy();
        var vartable = table.dataTable(Configuration_table_responsive_simple_two);
        vartable.fnClearTable();
        $.each(JSON.parse(datajson), function(index, status){
          vartable.fnAddData([
            status.Cliente,
            status.Sitio,
            status.IT,
            '<span class="label label-default">'+status.estatus+'</span>',
            getValueCurrent(status.NPS),
            status.fecha_update,
          ]);
        });
      }
      function table_boxes_cali(datajson, table) {
        table.DataTable().destroy();
        var vartable = table.dataTable(Configuration_table_responsive_simple_two);
        vartable.fnClearTable();
        $.each(JSON.parse(datajson), function(index, status){
          vartable.fnAddData([
            status.Cliente,
            status.Sitio,
            status.IT,
            status.fecha_update,
            getValueCurrent(status.NPS),
          ]);
        });
      }



      $('.filtrarDashboard').on('click', function(){
        data_nps();
        data_compare_nps();
        graph_nps();
        graph_nps_per_month();
        main_grap_user_vs_request();
        main_grap_avg_per_month();
        table_comparative_v1();
        table_avg_vertical();
        table_results();
        table_comments_full();
        table_comments();
      });


      function data_nps(){
        var _token = $('input[name="_token"]').val();
        var objData = $('#search_info').find("select,textarea, input").serialize();
        $.ajax({
             type: "POST",
             url: '/summary_info_nps',
             data: objData,
             success: function (data) {
                // console.log(data);
                $.each(JSON.parse(data), function(index, status){
                  if(status.Concepto == 'Promotores') {   $('#total_promotores').text(status.Count); }
                  if(status.Concepto == 'Pasivos') {   $('#total_pasivos').text(status.Count); }
                  if(status.Concepto == 'Detractores') {   $('#total_detractores').text(status.Count); }
                  if(status.Concepto == 'NPS') {   graph_gauge('main_nps', 'NPS', '100', '100', status.Count); }
                  if(status.Concepto == 'Abstenidos') {   $('#unanswered').text(status.Count); }
                  if(status.Concepto == 'Respondieron') {   $('#answered').text(status.Count); }
                  if(status.Concepto == 'Encuestas Enviadas') {   $('#total_survey').text(status.Count); }
                  if(status.Concepto == 'Sitios') {   $('#check_venues').text(status.Count); }
                });
             },
             error: function (data) {
               menssage_toast('Mensaje', '2', 'Operation Abort' , '3000');
             }
         })
      }
      function data_compare_nps(){
        var _token = $('input[name="_token"]').val();
        var objData = $('#search_info').find("select,textarea, input").serialize();
        // alert(objData);
        $.ajax({
             type: "POST",
             url: '/show_comparative_year',
             data: objData,
             success: function (data) {
              //  console.log(data);
               table_comparative(data, $("#tabla_comparativa"));
             },
             error: function (data) {
               menssage_toast('Mensaje', '2', 'Operation Abort' , '3000');
             }
         })
      }
      function table_comparative(datajson, table){
        table.DataTable().destroy();
        var vartable = table.dataTable(Configuration_table_responsive_simple);
        vartable.fnClearTable();
        $.each(JSON.parse(datajson), function(index, status){
        vartable.fnAddData([
            status.Periodo,
            status.NPS
          ]);
        });
      }
      function graph_nps() {
        var objData = $('#search_info').find("select,textarea, input").serialize();
        var data_count1 = [];
        var data_name1 = [];
        // var data_count1 = [{value:98, name:'Promotores = 98'},{value:62, name:'Pasivos = 62'},{value:21, name:'Detractores = 21'}];
        // var data_name1 = ["Promotores = 98","Pasivos = 62","Detractores = 21"];
        $.ajax({
            type: "POST",
            url: "/get_graph_nps",
            data: objData,
            success: function (data){
              $.each(JSON.parse(data),function(index, objdata){
                data_name1.push(objdata.Concepto + ' = ' + objdata.Count);
                data_count1.push({ value: objdata.Count, name: objdata.Concepto + ' = ' + objdata.Count},);
              });
              graph_pie_default_four_with_porcent('main_grap_nps', data_name1, data_count1, 'Grafica', 'NPS', 'left');
            },
            error: function (data) {
              console.log('Error:', data);
            }
        });
      }
      function graph_nps_per_month() {
        var objData = $('#search_info').find("select,textarea, input").serialize();
        var data_month = [];
        var value_promotores = [];
        var value_pasivos = [];
        var value_detractores = [];
        var data_name = ["Promotores","Pasivos","Detractores"];
        // var data_month = ["September 2016","October 2016", "November 2016", "December 2016", "January 2017", "February 2017", "March 2017"];
        // var value_promotores = [320, 302, 301, 234, 390, 330, 800];
        // var value_pasivos = [132, 202, 101, 314, 90, 330, 600];
        // var value_detractores = [120, 402, 231, 134, 130, 430, 100];
        $.ajax({
            type: "POST",
            url: "/get_graph_ppd",
            data: objData,
            success: function (data){
              $.each(JSON.parse(data),function(index, objdata){
                data_month.push(objdata.Fecha);
                value_promotores.push(objdata.Promotores);
                value_pasivos.push(objdata.Pasivos);
                value_detractores.push(objdata.Detractores);
              });
              graph_bar_with_three_val_insideRight('main_grap_nps_per_month',data_name, data_month, value_promotores, value_pasivos, value_detractores);
            },
            error: function (data) {
              console.log('Error:', data);
            }
        });
      }

      function graph_nps_week() {
        var objData = $('#search_info').find("select,textarea, input").serialize();
        var data_week_name = [];
        var data_week = [];

        $.ajax({
            type: "POST",
            url: "/get_graph_week",
            data: objData,
            success: function (data){
              //console.log(data);
              $.each(JSON.parse(data),function(index, objdata){
                data_week_name.push(objdata.Semana + ' = ' + objdata.Cantidad);
                data_week.push({ value: objdata.Cantidad, name: objdata.Semana + ' = ' + objdata.Cantidad},);
              });
              //console.log(data_week_name);
              //console.log(data_week);
              main_gra_grade_avg_per_month('main_grap_nps_week', data_week_name, data_week, 'Encuestas', 'Semanal');
            },
            error: function (data) {
              console.log('Error:', data);
            }
        });
        
      }

      function modTableCali() {
      	var datepicker3 = $('#date_to_search').val();

        if (datepicker3 == ''){
          var datepicker3 = moment().subtract(1, 'months').format('YYYY-MM');
        }

      	var datemod = datepicker3.split("-");
      	var goodFormat = datemod[0] + "-" + datemod[1];

        var cont = [];
        var meses = [];

        for (var i = 0; i <= 11; i++) {
          meses.push(moment(goodFormat).subtract(i, 'months').format('YYYY MMMM'));
        }
        // console.log(meses);
        return meses;
      }
      function main_grap_user_vs_request() {
        var objData = $('#search_info').find("select,textarea, input").serialize();
        var data_name =[];
        var data_month = [];
        var value_nps = [];
        var value_requests = [];

        $.ajax({
            type: "POST",
            url: "/get_graph_uvsr",
            data: objData,
            success: function (data){
              $.each(JSON.parse(data),function(index, objdata){
                data_name.push(objdata.Concepto);
                if (index == 0) {
                  value_nps.push(objdata.a12);
                  value_nps.push(objdata.a11);
                  value_nps.push(objdata.a10);
                  value_nps.push(objdata.a9);
                  value_nps.push(objdata.a8);
                  value_nps.push(objdata.a7);
                  value_nps.push(objdata.a6);
                  value_nps.push(objdata.a5);
                  value_nps.push(objdata.a4);
                  value_nps.push(objdata.a3);
                  value_nps.push(objdata.a2);
                  value_nps.push(objdata.a1);
                }
                else {
                  value_requests.push(objdata.a12);
                  value_requests.push(objdata.a11);
                  value_requests.push(objdata.a10);
                  value_requests.push(objdata.a9);
                  value_requests.push(objdata.a8);
                  value_requests.push(objdata.a7);
                  value_requests.push(objdata.a6);
                  value_requests.push(objdata.a5);
                  value_requests.push(objdata.a4);
                  value_requests.push(objdata.a3);
                  value_requests.push(objdata.a2);
                  value_requests.push(objdata.a1);
                }
              });
              // console.log(data);
              // console.log(data_name);
              // console.log(value_nps);
              // console.log(value_requests);
              data_month = modTableCali();
              // console.log(data_month);
              grap_user_vs_request('main_grap_user_vs_request',data_name, data_month.reverse(), value_nps, value_requests);
            },
            error: function (data) {
              console.log('Error:', data);
            }
        });
        // var data_name = ["NPS","Request"];
        // var data_month = ["April 2017", "May 2017", "June 2017", "July 2017", "August 2017", "September 2017", "October 2017", "November 2017", "December 2017", "January 2018", "February 2018", "March 2018"];
        // var value_nps = [48.3,69.2,231.6,46.6,55.4,230,600,10,55,89,147,75];
        // var value_requests = [320, 302, 301, 334, 390, 330, 800, 85, 76, 98, 120, 78];
        // grap_user_vs_request('main_grap_user_vs_request',data_name, data_month, value_nps, value_requests);
      }

      function main_grap_avg_per_month() {
        var objData = $('#search_info').find("select,textarea, input").serialize();
        var data_count = [];
        var data_name = [];
        $.ajax({
            type: "POST",
            url: "/get_graph_avgcal",
            data: objData,
            success: function (data){
              //console.log(data);
              $.each(JSON.parse(data),function(index, objdata){
                data_name.push(objdata.Referencia + ' = ' + objdata.Promedio);
                data_count.push({ value: objdata.Promedio, name: objdata.Referencia + ' = ' + objdata.Promedio},);
              });
              main_gra_grade_avg_per_month('main_gra_grade_avg_per_month', data_name, data_count, 'Promedio de Calificaciones', 'Mensual');
            },
            error: function (data) {
              console.log('Error:', data);
            }
        });
        // main_gra_grade_avg_per_month('main_gra_grade_avg_per_month', data_name, data_count, 'Promedio de Calificaciones', 'Mensual');
      }

      function table_comparative_v1() {
        var objData = $('#search_info').find("select,textarea, input").serialize();
        $.ajax({
            type: "POST",
            url: "/get_graph_uvsr",
            data: objData,
            success: function (data){
              remplazar_thead_th($("#table_nps_vs_encuestados_mes"), 1 ,12);
              table_comparativa_nps_v_enc(data, $("#table_nps_vs_encuestados_mes"));
            },
            error: function (data) {
              console.log('Error:', data);
            }
        });
      }
      function table_comparativa_nps_v_enc(datajson, table){
        table.DataTable().destroy();
        var vartable = table.dataTable(Configuration_table_responsive_simple);
        vartable.fnClearTable();
        $.each(JSON.parse(datajson), function(index, status){
        vartable.fnAddData([
            status.Concepto,
            status.a12,
            status.a11,
            status.a10,
            status.a9,
            status.a8,
            status.a7,
            status.a6,
            status.a5,
            status.a4,
            status.a3,
            status.a2,
            status.a1
          ]);
        });
      }

      function table_avg_vertical() {
        var objData = $('#search_info').find("select,textarea, input").serialize();
        $.ajax({
            type: "POST",
            url: "/get_table_vert",
            data: objData,
            success: function (data){
              remplazar_thead_th($("#table_vertical"), 2 ,9);
              table_comparativa_mes_vertical(data, $("#table_vertical"));
            },
            error: function (data) {
              console.log('Error:', data);
            }
        });
      }
      function table_comparativa_mes_vertical(datajson, table){
        table.DataTable().destroy();
        var vartable = table.dataTable(Configuration_table_responsive_simple);
        vartable.fnClearTable();
        $.each(JSON.parse(datajson), function(index, status){
          var span_identificador = '';
          if (status.Indicador == '0') { span_identificador = '<span class="label label-warning">Mantuvo</span>';}
          if (status.Indicador == '1') { span_identificador = '<span class="label label-danger">Bajo</span>';}
          if (status.Indicador == '2') { span_identificador = '<span class="label label-success">Subio</span>';}
          if (status.Indicador == '3') { span_identificador = '<span class="label label-default">Sin indicador</span>';}
        vartable.fnAddData([
            status.name,
            status.sitios,
            status.a8,
            status.a7,
            status.a6,
            status.a5,
            status.a4,
            status.a3,
            status.a2,
            status.a1,
            span_identificador,
          ]);
        });
      }
      function table_comments() {
        var objData = $('#search_info').find("select,textarea, input").serialize();
        $.ajax({
            type: "POST",
            url: "/get_table_comments_nps",
            data: objData,
            success: function (data){
              //console.log(data);              
              table_com_nps(data, $("#table_comments"));
            },
            error: function (data) {
              console.log('Error:', data);
            }
        });
      }
      function table_com_nps(datajson, table){
        table.DataTable().destroy();
        var vartable = table.dataTable(Configuration_table_responsive_with_pdf_dashboardNPS);
        vartable.fnClearTable();
        $.each(JSON.parse(datajson), function(index, status){
          vartable.fnAddData([
            status.Cliente,
            status.Sitios,
            status.Comentario,
            getValueCurrent(status.Calificacion),
            status.updated_at,
          ]);
        });
      }
      function table_comments_full() {
        var objdata = $('#search_info').find("select,textarea, input").serialize();
        $.ajax({
            type: "POST",
            url: "/get_table_comments_nps_full",
            data: objdata,
            success: function (data){
              //console.log(data);
              table_com_nps_full(data, $("#table_comments_full"));
              
            },
            error: function (data) {
              console.log('Error:', data);
            }
        });
        
      }
      function table_com_nps_full(datajson, table) {
        table.DataTable().destroy();
        var vartable = table.dataTable(Configuration_table_responsive_with_pdf_dashboardNPS);
        vartable.fnClearTable();
        $.each(JSON.parse(datajson), function(index, status){
          vartable.fnAddData([
            status.Nombre_hotel,
            status.Cliente,
            status.Comentario,
            getValueCurrent(status.respuesta),
            status.Assigned_IT,
          ]);
        });
      }

      function table_results() {
        var objdata = $('#search_info').find("select,textarea, input").serialize();

        $.ajax({
            type: "POST",
            url: "/get_table_results",
            data: objdata,
            success: function (data){
              console.log(data);
              create_table_results(data, $('#table_results_full'));
            },
            error: function (data) {
              console.log('Error:', data);
            }
        });
      }

      function create_table_results(datajson, table) {
        table.DataTable().destroy();
        var vartable = table.dataTable(Configuration_table_responsive_with_pdf_dashboardNPS);
        vartable.fnClearTable();
        $.each(JSON.parse(datajson), function(index, status){
          vartable.fnAddData([
            status.Venue,
            status.Cliente,
            status.Comentario,
            getValueCurrent(status.NPS),
            status.IT,
          ]);
        });
      }

      // function getValueCurrent(qty) {
      //     var retval;
      //     var val=qty;
      //     if (val == 'Pr') { retval = '<span class="label label-success">Promotor</span>';}
      //     if (val == 'Ps') { retval = '<span class="label label-warning">Pasivo</span>';}
      //     if (val == 'D') { retval = '<span class="label label-danger">Detractor</span>';}
      //     if (val == 'NA') { retval = '<span class="label label-danger">Sin calificación</span>';}
      //     if (typeof val === "undefined") { retval = 'Sin calificación';}
      //     return retval;
      // }

      function getValueCurrent(qty) {
        var retval;
        var val=qty;
        switch(val){
          case 'Pr':
            retval = '<span class="label label-success">Promotor</span>';
            break;
          case 'Ps':
            retval = '<span class="label label-warning">Pasivo</span>';
            break;
          case 'D':
            retval = '<span class="label label-danger">Detractor</span>';
            break;
          case 'NA':
            retval = '<span class="label label-danger">Sin calificación</span>';
            break;
          default:
            retval = '<span class="label label-danger">Sin calificación</span>';
        }
        return retval;
      }
      //julio 2017 - febrero 2017

      function remplazar_thead_th(table, posicionini, posicionfin) {
      	var datepicker3 = $('#date_to_search').val();
        if (datepicker3 == ''){
          var datepicker3 = moment().subtract(1, 'months').format('YYYY-MM');
        }
      	var datemod = datepicker3.split("-");
      	var goodFormat = datemod[0] + "-" + datemod[1];
        var j= posicionfin-posicionini;

        for (var i = posicionini; i <= posicionfin; i++) {
          table.DataTable().columns(i).header().to$().text(
            moment(goodFormat).subtract(j, 'months').format('YYYY MMMM')
          );
          j--;
        }
      }




    </script>
  @else
    <!--NO VER-->
  @endif
@endpush

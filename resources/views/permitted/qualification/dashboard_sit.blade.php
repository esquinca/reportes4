@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View dashboard sitwifi') )
    {{ trans('message.dashboard') }}
  @else
    {{ trans('message.dashboard') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View dashboard sitwifi') )
    {{ trans('message.subtitle_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View dashboard sitwifi') )
    {{ trans('message.breadcrumb_survey_sit') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View dashboard sitwifi') )
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="row">
            <form id="search_info" name="search_info" class="form-inline" method="post">
              {{ csrf_field() }}
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="select_surveys" class="col-md-4 control-label">{{ trans('message.survey') }}</label>
                  <div class="col-md-8 selectContainer">
                    <select id="select_surveys" name="select_surveys"class="form-control select2">
                      <option value="" selected> Elija </option>
                      @forelse ($surveys as $data_survey)
                      <option value="{{ $data_survey->id }}"> {{ $data_survey->name }} </option>
                      @empty
                      @endforelse
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  <input id="date_to_search" type="text" class="form-control" name="date_to_search">
                </div>
              </div>
              <div class="col-sm-7">
                <button id="boton-aplica-filtro" type="button" class="btn btn-info filtrarDashboard">
                  <i class="glyphicon glyphicon-filter" aria-hidden="true"></i>  Filtrar
                </button>
              </div>
            </form>
          </div>
        </div>

        <div id="preguntithas">

        </div>

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="row">
            <div id="conteo_res">

            </div>
          </div>
        </div>

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="row" id="div_table" style="display:none;">
            <table id="table_comments" class="table table-striped table-bordered table-hover" >
              <thead>
                <tr>
                  <th>Comentarios</th>
                  <th>Calificación</th>
                  <th>Fecha de registro</th>
                  <!-- <th>Servicio</th> -->
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="row" id="div_table_nps" style="display:none;">
            <table id="table_comments_nps" class="table table-striped table-bordered table-hover" >
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Sitio</th>
                  <th>Comentarios</th>
                  <th>Calificación</th>
                  <th>Fecha de registro</th>
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
  @if( auth()->user()->can('View dashboard sitwifi') )
  <style media="screen">
    .pt-10 {
      padding-top: 10px;
    }
  </style>
  <script type="text/javascript">
    $(function() {
      $('#date_to_search').datepicker({
        language: 'es',
        format: "yyyy-mm",
        viewMode: "months",
        minViewMode: "months",
        endDate: '1m',
        autoclose: true,
        clearBtn: true
      });
      $('#date_to_search').val('').datepicker('update');

    });

    $('.filtrarDashboard').on('click', function(){
      var date_cor = $('#date_to_search').val();
      var enc = $('#select_surveys').val();
      if (enc === "" || date_cor === "") {
        menssage_toast('Mensaje', '2', 'Completa todos los campos.' , '3000');
      }else{
        if (enc === '1') {
          consultar();
          table_count();
          tables_comments_nps();
        }else{
          consultar();
          table_count();
          table_comments_load();
        }
      }
    });

    function consultar() {
      var objData = $('#search_info').find("select,textarea, input").serialize();

      var date_cor= $('#date_to_search').val();
      var _token = $('input[name="_token"]').val();

      var id_pregunt ="";
      var contenido ="";

      $.ajax({
          type: "POST",
          url: "/get_data_survey_ys",
          data: objData,
          success: function (data){
            // console.log(data);
            $('#preguntithas').empty();
            for (var i = 0; i < data.length; i++) {
              id_pregunt = data[i].id;
              $.ajax({
                 type: "POST",
                 url: "/get_data_result_q",
                 data: { date : date_cor, question: id_pregunt, _token : _token },
                 success: function (data){
                   var des =JSON.parse(data);
                   $("#preguntithas").append(
                     '<div class="col-md-4 pt-10"><div class="box box-widget widget-user-2"><div class="widget-user-header bg-yellow"><h5>'
                        +des[0].pregunta+
                        '</h5></div><div class="box-footer no-padding">'+'<ul class="nav nav-stacked">'
                        +
                        '<li><a href="javascript: void(0);">Promotor<span class="pull-right badge bg-green">'+des[0].PR+'</span></a></li>'
                        +
                        '<li><a href="javascript: void(0);">Pasivo<span class="pull-right badge bg-yellow">'+des[0].PS+'</span></a></li>'
                        +
                        '<li><a href="javascript: void(0);">Detractor<span class="pull-right badge bg-red">'+des[0].D+'</span></a></li>'
                        +'</ul>'+'</div></div></div>');
                 },
                 error: function (data) {
                   console.log('Error:', data);
                 }
              });

            }

          },
          error: function (data) {
            console.log('Error:', data);
          }
      });
    }

    function table_count() {
      var objData = $('#search_info').find("select,textarea, input").serialize();
      var data_data = [];
      $('#conteo_res').empty();
      $.ajax({
          type: "POST",
          url: "/get_count_enc",
          data: objData,
          success: function (data){
            //console.log(data);

            $("#conteo_res").append(
              '<div class="col-md-4 pt-10"><div class="box box-widget widget-user-2"><div class="widget-user-header bg-green"><h5>Resultados de la encuesta.</h5></h5></div><div id="footer_conteo" class="box-footer no-padding">'
            );
            
            $.each(JSON.parse(data),function(index, objdata){
              //console.log(objdata.Concepto);
              $('#footer_conteo').append(
                '<ul class="nav nav-stacked"><li><a href="javascript: void(0);">'
                + objdata.Concepto
                + '<span class="pull-right badge bg-yellow">'
                + objdata.cantidad
                + '</span></a></li></ul>'
                + '</ul></div></div></div>'
              );
            });

          },
          error: function (data) {
            console.log('Error:', data);
            //alert('3');
          }
      });
    }

    function tables_comments_nps() {
      var objData = $('#search_info').find("select,textarea, input").serialize();
      var date_cor= $('#date_to_search').val();

      var _token = $('input[name="_token"]').val();
      var table_c = $('#table_comments_nps');

      $('#div_table').hide();
      $('#div_table_nps').show();

      $.ajax({
          type: "POST",
          url: "/get_table_comments_gnrl_nps",
          data: objData,
          success: function (data){
            //console.log(data);
            create_table_nps(data, table_c);
          },
          error: function (data) {
            console.log('Error:', data);
          }
      });
    }

    function table_comments_load() {
      var objData = $('#search_info').find("select,textarea, input").serialize();
      var date_cor= $('#date_to_search').val();

      var _token = $('input[name="_token"]').val();
      var table_c = $('#table_comments');
      var data_data = [];
      
      $('#div_table').show();
      $('#div_table_nps').hide();

      $.ajax({
          type: "POST",
          url: "/get_table_comments_gnrl",
          data: objData,
          success: function (data){
            //console.log(data);
            $.each(JSON.parse(data),function(index, objdata){
              data_data.push({"Comentario": objdata.Comentario,"Calificacion": objdata.Calificacion,"updated_at": objdata.updated_at});
            });
            //table_aps_top(data_data, $("#table_top_aps"));
            //console.log(data_count);
            create_table(data_data, table_c);
          },
          error: function (data) {
            console.log('Error:', data);
            //alert('3');
          }
      });
    }

    function getValueCali(qty) {
        var retval;
        var val=qty;
        if (val == 'Pr') { retval = '<span class="label label-success">Promotor</span>';}
        if (val == 'Ps') { retval = '<span class="label label-warning">Pasivo</span>';}
        if (val == 'D') { retval = '<span class="label label-danger">Detractor</span>';}
        return retval;
    }

    function create_table_nps(datajson, table) {
      table.DataTable().destroy();
      var vartable = table.dataTable(Configuration_table_responsive_simple_two);
      vartable.fnClearTable();
      $.each(JSON.parse(datajson), function(index, status){
        vartable.fnAddData([
          status.Cliente,
          status.Sitios,
          status.Comentario,
          getValueCali(status.Calificacion),
          status.updated_at
        ]);
      });
    }

    function create_table(datajson, table) {
      table.DataTable().destroy();
      var vartable = table.dataTable(Configuration_table_responsive_simple_two);
      vartable.fnClearTable();
      // $.each(JSON.parse(datajson), function(index, status){ //Este es el bueno
      $.each(datajson, function(index, status){
        vartable.fnAddData([
          status.Comentario,
          getValueCali(status.Calificacion),
          status.updated_at
        ]);
      });
    }
    </script>
  @else
    <!--NO VER-->
  @endif
@endpush

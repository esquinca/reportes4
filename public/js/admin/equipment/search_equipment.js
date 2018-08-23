$(function() {
    $('.input-daterange').datepicker({language: 'es', format: "yyyy-mm-dd",});
    general_table_equipment();
});

$(".btn-search-range").on("click", function () {
  var hotel_origen = $('#select_one').val();
  var date_a = $('input[name="date_start"]').val();
  var date_b = $('input[name="date_end"]').val();

  if ( date_a == '' || date_b == ''){
    menssage_toast('Mensaje', '2', 'Ingrese un rango de fechas, para continuar!' , '3000');
  }
  else {
    general_table_equipment();
  }
});


function general_table_equipment() {
  var _token = $('input[name="_token"]').val();
  var date_a = $('input[name="date_start"]').val();
  var date_b = $('input[name="date_end"]').val();

  $.ajax({
      type: "POST",
      url: "/search_range_equipament_all",
      data: { inicio: date_a, fin: date_b, _token : _token },
      success: function (data){
        table_consumption_remove(data, $("#table_equipament"));
      },
      error: function (data) {
        console.log('Error:', data);
      }
  });
}
function table_consumption_remove(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive_remove_item);
  vartable.fnClearTable();
  $.each(JSON.parse(datajson), function(index, status){
    vartable.fnAddData([
      status.Nombre_hotel,
      status.name,
      status.Nombre_marca,
      status.MAC,
      status.Serie,
      status.ModeloNombre,
      "<center><kbd style='background-color:grey'>"+status.Nombre_estado+"</kbd></center>",
      status.Fecha_Baja,
    ]);
  });
}

$("#btn_search_mac").on("click", function () {
  var mac = $('#mac_input').val();

  if ( mac == '' || mac.length < 4){
    menssage_toast('Mensaje', '2', 'Ingrese datos en el campo de mac, minimo 4 caracteres.' , '3000');
  }
  else {
    general_tabla_search();
  }
});

function general_tabla_search() {
  var _token = $('input[name="_token"]').val();
  var mac = $('#mac_input').val();


  $.ajax({
      type: "POST",
      url: "/get_mac_res",
      data: { _token : _token, mac_input: mac },
      success: function (data){
        //console.log(data);
        tabla_search_mac(data, $('#table_buscador'));
      },
      error: function (data) {
        console.log('Error:', data);
      }
  });
  
}

function tabla_search_mac(datajson, table) {
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive);
  vartable.fnClearTable();
  $.each(JSON.parse(datajson), function(index, status){
    vartable.fnAddData([
      status.Nombre_hotel,
      status.name,
      status.Nombre_marca,
      status.MAC,
      status.Serie,
      status.ModeloNombre,
      "<center><kbd style='background-color:grey'>"+status.Nombre_estado+"</kbd></center>",
      status.Fecha_Registro,
    ]);
  });
}

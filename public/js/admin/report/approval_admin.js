$(function() {
  $("#selectfiltro").hide();
  $("#filter_year").hide();
  $("#filter_status").hide();
  $("#filter_hotel").hide();
  table_approval_concierge();
});

$('#boton_muestra_selectfiltro').on('click', function() {
  $("#selectfiltro").show(10);
});

$(".selectFiltro").change(function() {
  mostraryreordenar($( this).val(), $("#filtration_container") );
});

function mostraryreordenar(identifier, contentElements)
{
  contentElements.append( $('#'+identifier) ); //Para mover el div
  $('#'+identifier).show(300);
  $("#selectfiltro").hide(100);
  $('#selectfiltro').prop('selectedIndex',0);
}

$(".boton-mini").click(function(event) {
   var identifier = $(this).closest( $( ".control-filter" ) );
   ocultaryreordenar(identifier);
});

function ocultaryreordenar(element)
{
  element.hide(100);
  element.find('select').prop('selectedIndex',0);
}

function table_approval_concierge() {
  // var _token = $('input[name="_token"]').val();
  // $.ajax({
  //     type: "POST",
  //     url: "/",
  //     data: { _token : _token },
  //     success: function (data){
      var data = JSON.stringify([{id:'1', Nombre_hotel:'sdsa', Nombre_Reporte:'Basico', FechaAutorizacion:'10-07-2018', status1:'1'},
        {id:'2', Nombre_hotel:'sdsa', Nombre_Reporte:'Concatenado', FechaAutorizacion:'10-07-2018', status1:'0'},
        {id:'3', Nombre_hotel:'sdsa', Nombre_Reporte:'Basico', FechaAutorizacion:'10-07-2018', status1:'1'}
      ]);

        table_approval_admin(data, $("#table_approval_a"));
      // },
      // error: function (data) {
      //   console.log('Error:', data);
      // }
  // });
}
function table_approval_admin(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive_simple_two);
  vartable.fnClearTable();
  $.each(JSON.parse(datajson), function(index, status){
    if(status.status1 == '0') { estadoact='<span class="label label-warning">Pendiente</span>'}
    if(status.status1 == '1') { estadoact='<span class="label label-primary">Aprobado</span>'};
    vartable.fnAddData([
      status.Nombre_hotel,
      status.Nombre_Reporte,
      status.FechaAutorizacion,
      estadoact,
      '<a href="javascript:void(0);" onclick="enviarOne(this)" value="'+status.id+'" class="btn btn-success btn-xs " role="button"><span class="fa fa-check-square" style="margin-right: 4px;"></span>Activar</a><a href="javascript:void(0);" onclick="enviarTwo(this)" value="'+status.id+'" class="btn btn-danger btn-xs" role="button"><span class="fa fa-hourglass-half" style="margin-right: 4px;"></span>Desactivar</a>',
    ]);
  });
}

function enviarOne(e){
  var valor= e.getAttribute('value');
  var _token = $('input[name="_token"]').val();
  alert('1');
  // $.ajax({
  //   type: "POST",
  //   url: "./changependientactive",
  //   data: { val: valor, _token : _token },
  //   success: function (data){
  //     toastr.success('Se ha aprobado correctamente..!!', 'Mensaje', {timeOut: 2000});
  //     table_approval_concierge();
  //   },
  //   error: function (data) {
  //     console.error('Error:', data);
  //   }
  // });
}

function enviarTwo(e){
  var valor= e.getAttribute('value');
  var _token = $('input[name="_token"]').val();
  alert('2');
  // $.ajax({
  //   type: "POST",
  //   url: "./changependientdesactive",
  //   data: { val: valor, _token : _token },
  //   success: function (data){
  //     toastr.success('Se ha desactivado correctamente..!!', 'Mensaje', {timeOut: 2000});
  //     table_approval_concierge();
  //   },
  //   error: function (data) {
  //     console.error('Error:', data);
  //   }
  // });
}

$('#boton-aprobar_todopendientes').on('click', function() {
  var _token = $('input[name="_token"]').val();
  alert('aprobando..');
  // $.ajax({
  //   type: "POST",
  //   url: "./changependientall",
  //   data: {_token : _token },
  //   success: function (data){
  //     toastr.success('Se ha activaron todos correctamente..!!', 'Mensaje', {timeOut: 2000});
  //     tableapproval();
  //   },
  //   error: function (data) {
  //     console.error('Error:', data);
  //   }
  // });
});

$("#boton-aplica-filtro-visitantes").click(function(event) {
  var objData = $("#filasasw").find("select,textarea, input").serialize();
  var _token = $('input[name="_token"]').val();
  alert('aplicando filtros..');
  // $.ajax({
  //      url: "/result_filter_approval",
  //      type: "POST",
  //      data: objData,
  //      success: function (data) {
  //         tablaEnc(data, $("#example1") , 0);
  //      },
  //      error: function (data) {
  //        console.log('Error:', data);
  //      }
  //  });
});

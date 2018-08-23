$(function () {
  graph_consumos_up();

});
function graph_consumos_up() {
  var _token = $('input[name="_token"]').val();
  $.ajax({
      type: "POST",
      url: "/data_type_report",
      data: { _token : _token },
      success: function (data){
        table_consumption_dow(data, $("#example_up"));
      },
      error: function (data) {
        console.log('Error:', data);
      }
  });
}

function table_consumption_dow(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive);
  vartable.fnClearTable();
  $.each(JSON.parse(datajson), function(index, status){
    vartable.fnAddData([
      status.id,
      status.name,
      '<a href="javascript:void(0);" onclick="enviare(this)" value="'+status.id+'" class="btn btn-info btn-xs" role="button" data-target="#EditarServ"><i class="fa fa-pencil-square-o margin-r5"></i> Editar</a> <a href="javascript:void(0);" onclick="enviard(this)" value="'+status.id+'" class="btn btn-danger btn-xs" role="button" data-target="#DeletServ"><i class="fa fa-trash-o margin-r5"></i> Eliminar</a>',
    ]);
  });
}

function enviare(e){
  var valor= e.getAttribute('value');
  var _token = $('input[name="_token"]').val();
  $.ajax({
       type: "POST",
       url: '/show_edit_type_report',
       data: {sector : valor, _token : _token},
       success: function (data) {
         if (data != '') {
           var data_new = JSON.parse(data);
           $("#select_hotel option[value='"+data_new.id+"']").prop('selected', true);
           $("#select_type option[value='"+data_new.id+"']").prop('selected', true);
           $('#modal-edit').modal('show');
         }
         else {
           $('#modal-edit').modal('show');
         }
       },
       error: function (data) {
         alert('Error:', data);
       }
   })
}

function enviard(e) {
  var valor= e.getAttribute('value');
  $('#recibidoconf').val(valor);
  $('#modal-del').modal('show');
}

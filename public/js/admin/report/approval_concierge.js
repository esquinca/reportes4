$(function () {
  table_approval_concierge();

});

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

        table_consumption_dow(data, $("#table_approval_c"));
      // },
      // error: function (data) {
      //   console.log('Error:', data);
      // }
  // });
}

function table_consumption_dow(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive);
  vartable.fnClearTable();
  $.each(JSON.parse(datajson), function(index, status){
    if(status.status1 == '0') { estadoact='<span class="label label-warning">Pendiente</span>'}
    if(status.status1 == '1') { estadoact='<span class="label label-success">Aprobado</span>'};
    vartable.fnAddData([
      status.Nombre_hotel,
      status.Nombre_Reporte,
      status.FechaAutorizacion,
      estadoact,
      '<a href="javascript:void(0);" onclick="enviard(this)" value="'+status.id+'" class="btn btn-danger btn-xs" role="button" data-target="#DeletServ"><i class="fa fa-trash-o margin-r5"></i> Eliminar</a>',
    ]);
  });
}

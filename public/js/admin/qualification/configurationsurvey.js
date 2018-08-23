$(document).ready(function() {
  $('.input-daterange').datepicker({language: 'es', format: "yyyy-mm-dd",});
  $('#month_evaluate').datepicker({
      language: 'es',
      defaultDate: '',
      format: "yyyy-mm",
      viewMode: "months",
      minViewMode: "months",
      endDate: '-1m', //Esto indica que aparecera el mes hasta que termine el ultimo dia del mes.
      autoclose: true
  });
  table_config();
  $('#select_one').multiselect({
      buttonWidth: '100%',
      nonSelectedText: 'Elija uno o más',
      maxHeight: 150,
      // enableClickableOptGroups: true,
      // enableCollapsibleOptGroups: true,
      // maxHeight: 300,
      // dropUp: true,
      // flowUp:true,
      // enableFiltering: false,
   });

   $('#select_two').multiselect({
      buttonWidth: '100%',
      nonSelectedText: 'Elija uno o más',

      enableClickableOptGroups: true,

      enableCollapsibleOptGroups: true,
      collapseOptGroupsByDefault: true,


      includeSelectAllOption: false,
      maxHeight: 150,


    });
});

function table_config() {
  // var _token = $('input[name="_token"]').val();
  // $.ajax({
  //     type: "POST",
  //     url: "/",
  //     data: { _token : _token },
  //     success: function (data){
      var data = JSON.stringify([{id:'1', hotel_id:'1', user_id:'1', estatus_id:'1'},
        {id:'2', hotel_id:'2', user_id:'2', estatus_id:'1'},
        {id:'3', hotel_id:'3', user_id:'3', estatus_id:'2'}
      ]);

        table_generate(data, $("#example_survey"));
      // },
      // error: function (data) {
      //   console.log('Error:', data);
      // }
  // });
}

function table_generate(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive);
  vartable.fnClearTable();
  $.each(JSON.parse(datajson), function(index, status){
    if(status.estatus_id == '1') { estadoact='<span class="label label-success">Activo</span>'}
    if(status.estatus_id == '2') { estadoact='<span class="label label-danger">Inactivo</span>'};
    vartable.fnAddData([
      status.hotel_id,
      status.user_id,
      estadoact,
      '<a href="javascript:void(0);" onclick="enviaredit(this)" value="'+status.id+'" class="btn btn-primary btn-xs" role="button" data-target="#EditServ"><i class="fa fa-pencil margin-r5"></i> Editar</a>',
      '<a href="javascript:void(0);" onclick="enviardelet(this)" value="'+status.id+'" class="btn btn-danger btn-xs" role="button" data-target="#DeletServ"><i class="fa fa-trash-o margin-r5"></i> Eliminar</a>',

    ]);
  });
}

$(".capture").on("click", function () {
  var objData = $("#form_reg_survey").find("select,textarea, input").serialize();
  //var _token = $('input[name="_token"]').val();
  $.ajax({
       type: "POST",
       url: '/assign_survey',
       data: objData,
       success: function (data) {
          console.log(data);
          if (data == 'true') {
          //   graph_config_user();
          //   $('#modal-CreatUser').modal('toggle');
            menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
          }
          if (data == 'false') {
             menssage_toast('Mensaje', '2', 'You do not have permission to access this module, please refer to your system administrator!' , '3000');
          }
       },
       error: function (data) {
         menssage_toast('Mensaje', '2', 'Operation Abort' , '3000');
       }
   })
});

$(function () {
   graph_config_user();
});

function graph_config_user() {
  var _token = $('input[name="_token"]').val();
  $.ajax({
      type: "POST",
      url: "/data_config",
      data: { _token : _token },
      success: function (data){
        table_config_user(data, $("#example_conf_user"));
      },
      error: function (data) {
        console.log('Error:', data);
      }
  });
}

function table_config_user(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive_two);
  vartable.fnClearTable();
  $.each(JSON.parse(datajson), function(index, status){
    vartable.fnAddData([
      status.name,
      status.email,
      status.city,
      '<a href="javascript:void(0);" onclick="enviar(this)" value="'+status.id+'" class="btn btn-info btn-xs" role="button" data-target="#EditarServ"><i class="fa fa-pencil-square-o margin-r5"></i> Editar</a> <a href="javascript:void(0);" onclick="enviarmenu(this)" value="'+status.id+'" class="btn bg-olive btn-xs" role="button" data-target="#MenuServ"><i class="fa fa-caret-square-o-down margin-r5"></i> Menu</a> <a href="javascript:void(0);" onclick="enviart(this)" value="'+status.id+'" class="btn btn-danger btn-xs" role="button" data-target="#DeletServ"><i class="fa fa-user-times margin-r5"></i> Eliminar</a>',
    ]);
  });
}

function enviar(e){
  var valor= e.getAttribute('value');
  var _token = $('input[name="_token"]').val();
  $.ajax({
       type: "POST",
       url: '/data_edit_config',
       data: {sector : valor, _token : _token},
       success: function (data) {
         if (data != '') {
           $('#inputEditName').val(data.name);
           $('#inputEditEmail').val(data.email);
           $('#inpuEditlocation').val(data.city);
           $("#selectEditPriv option[value='"+data.roles[0].id+"']").prop('selected', true);
           $('#modal-editUser').modal('show');
         }
         else {
           $('#modal-editUser').modal('show');
         }
       },
       error: function (data) {
         alert('Error:', data);
       }
   })
}

function enviarmenu(e){
  var valor= e.getAttribute('value');
  var _token = $('input[name="_token"]').val();
  $('#modal-menu').modal('show');
  $('#id_recibido').val(valor);
  $.ajax({
       type: "POST",
       url: '/data_menu_config',
       data: {sector : valor, _token : _token},
       success: function (data) {
         $('#menuusersystem')[0].reset();
         $('#permisosusersystem')[0].reset();
          // console.log(data);
          // console.log(data.menus.length);
          // console.log(data.permissions.length);
          for (i = 0; i < data.menus.length; i++) {
              $('#menuusersystem input:checkbox[value=' + data.menus[i].id + ']').prop('checked', 'checked');
          }
          for (j = 0; j < data.permissions.length; j++) {
              $('#permisosusersystem input:checkbox[id='+data.permissions[j].id+']').prop('checked', 'checked');
          }
       },
       error: function (data) {
         alert('Error:', data);
       }
   })
}
//Editar Usuario
$(".update_user_data").on("click", function () {
  var objData = $("#editusersystem").find("select,textarea, input").serialize();
  $.ajax({
       type: "POST",
       url: '/data_edit_user_config',
       data: objData,
       success: function (data) {
         if (data == 'true') {
           graph_config_user();
           $('#modal-editUser').modal('toggle');
           menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
         }
         if (data == 'false') {
            menssage_toast('Mensaje', '2', 'You do not have permission to access this module, please refer to your system administrator!' , '3000');
         }
       },
       error: function (data) {
        //  console.log(data);
         menssage_toast('Mensaje', '2', 'Operation Abort- Changes not made' , '3000');
       }
   })
});

function enviart(e) {
  var valor= e.getAttribute('value');
  $('#recibidoconf').val(valor);
  $('#modal-delUser').modal('show');
}

//Crear Usuario
$(".create_user_data").on("click", function () {
  var objData = $("#creatusersystem").find("select,textarea, input").serialize();
  //var _token = $('input[name="_token"]').val();
  $.ajax({
       type: "POST",
       url: '/data_create_user_config',
       data: objData,
       success: function (data) {
          // console.log(data);
          if (data == 'true') {
            graph_config_user();
            $('#modal-CreatUser').modal('toggle');
            menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
          }
          if (data == 'false') {
             menssage_toast('Mensaje', '2', 'You do not have permission to access this module, please refer to your system administrator!' , '3000');
          }
       },
       error: function (data) {
         menssage_toast('Mensaje', '2', 'Operation Abort- This Email is already registered' , '3000');
       }
   })
});

//Actualizar privilegio
$(".btnprivilege").on("click", function () {
  var objData = $("#permisosusersystem").find("select,textarea, input").serialize();
  var id = $('#id_recibido').val();
  // var DataMod=  objData + "&identificador=" + id;
  //alert(DataMod);
  $.ajax({
       type: "POST",
       url: '/data_edit_priv_config',
       data: objData + "&identificador=" + id,
       success: function (data) {
         if (data == 'abort') {
           $('#modal-menu').modal('toggle');
           menssage_toast('Mensaje', '2', 'Operation Abort- You can not remove all permissions from this user' , '3000');
         }
         if (data == 'uncompleted') {
           $('#modal-menu').modal('toggle');
           menssage_toast('Mensaje', '2', 'Operation Abort- You must check the Configuration option' , '3000');
         }
         if (data == 'complete') {
           graph_config_user();
           $('#modal-menu').modal('toggle');
           menssage_toast('Mensaje', '4', 'Operation complete, Wait 2 seconds while the changes are applied!' , '3000');
           setInterval(function(){ window.location.reload(true) },4000);
         }
         if (data == 'success') {
           graph_config_user();
           $('#modal-menu').modal('toggle');
           menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
         }
         if (data == 'uncheck') {
           graph_config_user();
           $('#modal-menu').modal('toggle');
           menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
         }
          // console.log(data);
       },
       error: function (data) {
        //  console.log(data);
         menssage_toast('Mensaje', '2', 'Operation Abort- Changes not made' , '3000');
       }
   })
});

//Actualizar menus
$(".btnconsumptiontopday").on("click", function () {
  var objData = $("#menuusersystem").find("select,textarea, input").serialize();
  var id = $('#id_recibido').val();
  // var DataMod=  objData + "&identificador=" + id;
  // alert(DataMod);
  $.ajax({
       type: "POST",
       url: '/data_edit_menu_config',
       data: objData + "&identificador=" + id,
       success: function (data) {
         if (data == 'abort') {
           $('#modal-menu').modal('toggle');
           menssage_toast('Mensaje', '2', 'Operation Abort- You can not remove all permissions from this user' , '3000');
         }
         if (data == 'uncompleted') {
           $('#modal-menu').modal('toggle');
           menssage_toast('Mensaje', '2', 'Operation Abort- You must check the Configuration option' , '3000');
         }
         if (data == 'complete') {
           graph_config_user();
           $('#modal-menu').modal('toggle');
           menssage_toast('Mensaje', '4', 'Operation complete, Wait 2 seconds while the changes are applied!' , '3000');
           setInterval(function(){ window.location.reload(true) },4000);
         }
         if (data == 'success') {
           graph_config_user();
           $('#modal-menu').modal('toggle');
           menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
         }
         if (data == 'uncheck') {
           graph_config_user();
           $('#modal-menu').modal('toggle');
           menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
         }
          // console.log(data);
       },
       error: function (data) {
        //  console.log(data);
         menssage_toast('Mensaje', '2', 'Operation Abort- Changes not made' , '3000');
       }
   })
});

//Eliminar Usuario
$(".btndelete").on("click", function () {
  var objData = $("#deleteusersystem").find("select,textarea, input").serialize();
  var id = $('#recibidoconf').val();
  $.ajax({
       type: "POST",
       url: '/data_delete_config',
       data: objData + "&identificador=" + id,
       success: function (data) {
         if (data == 'abort') {
            graph_config_user();
            $('#modal-delUser').modal('toggle');
            menssage_toast('Mensaje', '2', 'Operation Abort- The current user can not be removed' , '3000');
         }
         if (data == 'true') {
           graph_config_user();
           $('#modal-delUser').modal('toggle');
           menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
         }
         if (data == 'false') {
           graph_config_user();
           $('#modal-delUser').modal('toggle');
           menssage_toast('Mensaje', '2', 'You do not have permission to access this module, please refer to your system administrator!' , '3000');
         }
          // console.log(data);
       },
       error: function (data) {
        //  console.log(data);
         menssage_toast('Mensaje', '2', 'Operation Abort- Changes not made' , '3000');
       }
   })
});

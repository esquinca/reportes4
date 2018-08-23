$(function() {
  $(".select2").select2();
  table_user_type();
});

function table_user_type() {
  var _token = $('input[name="_token"]').val();
  $.ajax({
    type: "POST",
    url: "/get_user_type",
    data: { _token : _token },
    success: function (data){
      table_type_rep(data, $("#example_up"));
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}

function table_type_rep(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive_asignacion_htype);
  vartable.fnClearTable();
  $.each(JSON.parse(datajson), function(index, status){
    vartable.fnAddData([
      status.Nombre_hotel,
      '<span class="label label-default">'+status.name+'</span>',
      '<a href="javascript:void(0);" onclick="enviar(this)" value="'+status.id+'" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o margin-r5"></i></a>',
    ]);
  });
}
function validarSelect(campo) {
  if (campo != '') {
    select=document.getElementById(campo).selectedIndex;
    if( select == null || select == 0 ) { return false; }
    else { return true; }
  }
  else { return false;  }
}
function reset_select2(name_d){
  $('#'+name_d).val('').trigger('change');
}
$('.btngeneral').on('click', function(e){
  $obligatorio_a = validarSelect('select_one');
  $obligatorio_b = validarSelect('select_two');
  var objData = $("#re_data_type").find("select,textarea, input").serialize();
  if ($obligatorio_a == true && $obligatorio_b == true) {
    $.ajax({
        type: "POST",
        url: "/reg_user_type",
        data: objData,
        success: function (data){
          if (data === "1") {
            menssage_toast('Mensaje', '4', 'Datos insertados con exito' , '3000');
            table_user_type();
            reset_select2('select_one');
            reset_select2('select_two');
          }else{
            menssage_toast('Mensaje', '2', 'Hubo un error en la insercion, vuelva a intentar.' , '3000');
          }
        },
        error: function (data) {
          console.log('Error:', data);
        }
    });
  }
  else {
    menssage_toast('Mensaje', '2', 'Por favor complete todos los campos' , '3000');
  }
});

function enviar(e) {
  var valor= e.getAttribute('value');
  $('#recibidoconf').val(valor);
  $('#modal-del').modal('show');
}

$('.btndelete').on('click', function(e){
  deleterelacion();
});
function deleterelacion(){
    var objData = $("#delete_type").find("select,textarea, input").serialize();
    $.ajax({
      type: "POST",
      url: "./delete_assign_hotel_cl",
      data: objData,
      success: function (data){
          // table_surveyed();
          if (data == '1') {
            $('#modal-del').modal('toggle');
            menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
            table_user_type() ;
          }
      },
      error: function (data) {
        console.log('Error:', data);
      }
    });
}

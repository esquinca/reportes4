$(document).ready(function() {
  clearmultiselect('select_ind_two');
  // clearmultiselect('select_hotels');
  table_surveyed();
  table_surveyed_clients();
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
  $('#month_correspond_mail').datepicker({
      language: 'es',
      defaultDate: '',
      format: "yyyy-mm",
      viewMode: "months",
      minViewMode: "months",
      endDate: '-1m', //Esto indica que aparecera el mes hasta que termine el ultimo dia del mes.
      autoclose: true
  });

  $('.datepickermonth').datepicker({
    language: 'es',
    format: "yyyy-mm",
    viewMode: "months",
    minViewMode: "months",
    endDate: '1m',
    autoclose: true,
    clearBtn: true
  });
  $('.datepickermonth').val('').datepicker('update');


});


$('#select_one_v').on('change', function(e){
  var id= $(this).val();
  var _token = $('input[name="_token"]').val();
  if (id != ''){
    let countC = 0;
    $.ajax({
      type: "POST",
      url: "./user_vertical",
      data: { iv : id , _token : _token },
      success: function (data){
        countH = data.length;
        if (countH === 0) {
          $('#select_clients_auto').empty();
          // $('#select_two').append('<option value="" selected>Elije</option>');
          $("#select_clients_auto").multiselect('destroy');
        }
        else{
          $("#select_clients_auto").multiselect('destroy');
          $('#select_clients_auto').empty();
          // $('#select_two').append('<option value="" selected>Elije</option>');
          $.each(JSON.parse(data),function(index, objdata){
            $('#select_clients_auto').append('<option value="'+objdata.id+'">'+ objdata.name +'</option>');
          });
          $('#select_clients_auto').multiselect({
            includeSelectAllOption: true,
            buttonWidth: '100%',
            nonSelectedText: 'Elija uno o más',
            maxHeight: 100,
           });
        }
      },
      error: function (data) {
        console.log('Error:', data);
      }
    });
  }
  else{
    $("#select_clients_auto").multiselect('fresh');
    $('#select_clients_auto').empty();
  }
});

$('#select_ind_one').on('change', function(e){
  var id= $(this).val();
  var _token = $('input[name="_token"]').val();
  if (id != ''){
    let countC = 0;
    $.ajax({
      type: "POST",
      url: "./user_vertical",
      data: { iv : id , _token : _token },
      success: function (data){
        countH = data.length;
        if (countH === 0) {
          $('#select_ind_two').empty();
          $("#select_ind_two").multiselect('destroy');
          clearmultiselect('select_ind_two');
        }
        else{
          $("#select_ind_two").multiselect('destroy');
          $('#select_ind_two').empty();
          // $('#select_two').append('<option value="" selected>Elije</option>');
          $.each(JSON.parse(data),function(index, objdata){
            $('#select_ind_two').append('<option value="'+objdata.id+'">'+ objdata.name +'</option>');
          });
          $('#select_ind_two').multiselect({
            includeSelectAllOption: true,
            buttonWidth: '100%',
            nonSelectedText: 'Elija uno o más',
            maxHeight: 100,
           });
        }
      },
      error: function (data) {
        console.log('Error:', data);
      }
    });
  }
  else{
    $('#select_ind_two').empty();
    $("#select_ind_two").multiselect('destroy');
    clearmultiselect('select_ind_two');
  }
});

$('#btn-send_reenv_mail').on('click', function () {
    var date = $('#month_correspond_mail').val();
    var _token = $('input[name="_token"]').val();
    if (date == "") {
      menssage_toast('Mensaje', '2', 'Completa el campo de fecha.' , '3000');
    }else{
      $('#modal-confirmation').modal('show');
    }

});

$(".btn-conf-action").click(function(event) {
  var date = $('#month_correspond_mail').val();
  var _token = $('input[name="_token"]').val();
    $.ajax({
      type: "POST",
      url: "/send_unanswer",
      data: { date : date , _token : _token },
      success: function (data){
        //console.log(data);
        if (data == 1) {
          menssage_toast('Mensaje', '3', 'Correos enviados exitosamente.' , '6000');
          $('#modal-confirmation').modal('toggle');
        }else{
          menssage_toast('Mensaje', '2', 'No hay clientes para enviar correo.' , '5000');
          $('#modal-confirmation').modal('toggle');
        }
      },
      error: function (data) {
        console.log('Error:', data);
      }
    });
});

$('#cancela_cu').click(function(){
  $('#creatusersystem')[0].reset();
  $('#creatusersystem').validator('destroy').validator();
});
$('#cancela_hc').click(function(){
  $('#select_hotels').multiselect('deselectAll', false);
  $('#select_hotels').multiselect('updateButtonText');
  $('#assign_hotel_client')[0].reset();
  $('#assign_hotel_client').data('formValidation').resetForm('true');
  $("#select_clients").val('').trigger('change');
});
$('#cancela_dc').click(function(){
    $('#delete_all_client')[0].reset();
});


$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href") // activated tab
    if (target == '#tab_1-1') {
      if ( $("#creatusersystem").length > 0 ) {
        $('#creatusersystem')[0].reset();
        $('#creatusersystem').validator('destroy').validator();
      }
    }
    if (target == '#tab_2-2') {
      if ( $("#assign_hotel_client").length > 0 ) {
        $('#select_hotels').multiselect('deselectAll', false);
        $('#select_hotels').multiselect('updateButtonText');
        $('#assign_hotel_client')[0].reset();
      }
    }
    if (target == '#tab_3-2') {
      if ( $("#delete_all_client").length > 0 ) {
          $('#delete_all_client')[0].reset();
      }
    }
  });

function clearmultiselect(campo){
      $('#'+campo).multiselect({
        buttonWidth: '100%',
        nonSelectedText: 'Elija uno o más',
        maxHeight: 100,
      });
      $('#'+campo).multiselect('deselectAll', false);
      $('#'+campo).multiselect('updateButtonText');
  }


$("#creatusersystem").validator().on("submit", function (event) {
      if (event.isDefaultPrevented()) {
          menssage_toast('Mensaje', '2', 'Completa los requisitos' , '3000');
      } else {
          // everything looks good!
          // event.preventDefault();
          // submitForm();
          document.getElementById("creatusersystem").submit();
      }
  });


function submitForm(){
      // Initiate Variables With Form Content
      // var name = $("#inputCreatName").val();
      // var email = $("#inputCreatEmail").val();
      // var location = $("#inputCreatLocation").val();

      var objData = $("#creatusersystem").find("select,textarea, input").serialize();
      $.ajax({
           type: "POST",
           url: "./data_create_client_config",
           data: objData,
           success: function (data) {
              if (data == 'true') {
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

  }

function table_surveyed(){
  var _token = $('input[name="_token"]').val();
  $.ajax({
    type: "POST",
    url: "./show_assign_surveyed",
    data: { _token : _token },
    success: function (data){
        table_equipment(data, $("#see_venue_client"));
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}


function table_equipment(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive_with_pdf_client_hotel);
  vartable.fnClearTable();
  $.each(JSON.parse(datajson), function(index, status){
    vartable.fnAddData([
      status.nombre,
      status.Venue,
      '<a href="javascript:void(0);" onclick="enviart(this)" value="'+status.hotel_user_id+'" class="btn btn-danger btn-xs" role="button" data-target="#DeletServ">Eliminar</a>'
    ]);
  });
}

function table_surveyed_clients(){
  var _token = $('input[name="_token"]').val();
  $.ajax({
    type: "POST",
    url: "./show_survey_table",
    data: { _token : _token },
    success: function (data){
        table_surveys_clients(data, $("#example_survey"));
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}
function getValueStatus(qty) {
    var retval;
    var val=qty;
    if (val == '1') { retval = '<span class="label label-success">Activo</span>';}
    if (val == '2') { retval = '<span class="label label-danger">Inactivo</span>';}
    if (val == '' || val == 'NULL') { retval = '';}
    return retval;
}
function getValueStatusResp(vxval) {
    var retval2='';
    var val2=vxval;
    if (val2 == 0) { retval2 = '<span class="label label-danger">No contestada</span>'; }
    else if (val2 == 1) { retval2 = '<span class="label label-success">Contestada</span>'; }
    else if (val2 == '') { retval2 = ''; }
    return retval2;
}
function table_surveys_clients(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive_with_pdf_client_hotel);
  vartable.fnClearTable();
  $.each(JSON.parse(datajson), function(index, status){
    vartable.fnAddData([
      status.clientes,
      status.email,
      getValueStatus(parseInt(status.estatus_id)),
      getValueStatusResp(parseInt(status.estatus_res)),
      status.fecha_corresponde,
      status.fecha_inicial,
      status.fecha_fin,
      '<a href="javascript:void(0);" onclick="enviarMail(this)" value="'+status.id_eu+'" class="btn bg-navy btn-xs" role="button" data-target="#Send_mailnps"><i class="fa fa-share-square"></i> Reenviar Mail</a><a href="javascript:void(0);" onclick="enviarModal(this)" value="'+status.id_eu+'" class="btn bg-orange btn-xs" role="button" data-target="#search_htls"><i class="fa fa-search"></i> Ver Hotel</a>'
    ]);
  });
}
function enviarModal(e) {
  var valor= e.getAttribute('value');
  var _token = $('input[name="_token"]').val();
  $.ajax({
    type: "POST",
    url: "./search_hotel_u",
    data: {  uh : valor , _token : _token },
    success: function (data){
      console.log(data);
      if (data != '') {
        var x='';
        $.each(JSON.parse(data), function(index, status){
          x=x+status.Nombre_hotel+'\n';
        });

        $('#search_hotel_text').val(x);
        $('#search_hotel_text').prop('disabled', true);
        $('#modal-searchhotel').modal('show');
      }
      else {
        $('#search_hotel_text').val('');
        $('#search_hotel_text').prop('disabled', true);
        $('#modal-searchhotel').modal('show');
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}
function enviarMail(e) {
  var valor= e.getAttribute('value');
  var _token = $('input[name="_token"]').val();
  $.ajax({
    type: "POST",
    url: "./send_mail_nps",
    data: {  uh : valor , _token : _token },
    success: function (data){
        if (data == '1') {
          menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
          table_surveyed_clients();
        }else{
          menssage_toast('Mensaje', '2', 'Operation abort!' , '4000');
          table_surveyed_clients();
        }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}
function enviart(e) {
  var valor= e.getAttribute('value');
  var _token = $('input[name="_token"]').val();
  $('#recibidoconf').val(valor);
  $('#modal-delrelacion').modal('show');
}
function deleterelacion(){
    var _token = $('input[name="_token"]').val();
    var valor= $('#recibidoconf').val();
    $.ajax({
      type: "POST",
      url: "./delete_assign_surveyed",
      data: {  uh : valor , _token : _token },
      success: function (data){
          // table_surveyed();
          if (data == '1') {
            $('#modal-delrelacion').modal('toggle');
            menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
            table_surveyed();
          }
      },
      error: function (data) {
        console.log('Error:', data);
      }
    });
}

$(".btndeletereluser").on("click", function () {
deleterelacion();
});

$('#btn_filter_nps').on('click',function(){
  var date = $('#calendar_fecha_nps').val();
  var _token = $('input[name="_token"]').val();
//console.log(date);
  $.ajax({
    type: "POST",
    url: "/show_survey_table_month",
    data: {  data_one : date , _token : _token },
    success: function (data){
          table_surveys_clients(data, $("#example_survey"));
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });

});

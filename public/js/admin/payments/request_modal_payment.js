function enviar(e){
  var valor= e.getAttribute('value');
  var _token = $('input[name="_token"]').val();
  data_basic(valor, _token);
  data_basic_area(valor, _token);
  data_basic_type(valor, _token);
//  data_basic_venues(valor, _token);
  data_basic_financing(valor, _token);
  data_basic_comments(valor, _token);
  data_basic_bank(valor, _token);
  data_basic_firmas(valor, _token);
  $("input[type=checkbox]").prop('checked', '');
  $("input[type=radio]").prop('checked', '');
  $("#rec_venues_table tbody").children().remove();

  if ( $("#id_xs").length > 0 ) { $("#id_xs").val(valor); }

  $('#modal-view-concept').modal('show');

}

$(".btn-print-invoice").on('click',function(){
  var token = $('input[name="_token"]').val();
  var id = $("#id_xs").val();
  $.ajax({
    type: "POST",
    url: "/downloadInvoicePay",
    data: { id_fact : id , _token : token },
    xhrFields: {responseType: 'blob'},
    success: function(response, status, xhr){
      console.log(response);
    if(response !== '[object Blob]'){

      var filename = "";
      var disposition = xhr.getResponseHeader('Content-Disposition');

                  if (disposition) {
                    var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                    var matches = filenameRegex.exec(disposition);
                    if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                  }
                  var linkelem = document.createElement('a');
                  try {
                      var blob = new Blob([response], { type: 'application/octet-stream' });

                      if (typeof window.navigator.msSaveBlob !== 'undefined') {
                          //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                          window.navigator.msSaveBlob(blob, filename);
                      } else {
                          var URL = window.URL || window.webkitURL;
                          var downloadUrl = URL.createObjectURL(blob);

                          if (filename) {
                              // use HTML5 a[download] attribute to specify filename
                              var a = document.createElement("a");
                              // safari doesn't support this yet
                              if (typeof a.download === 'undefined') {
                                  window.location = downloadUrl;
                              } else {
                                  a.href = downloadUrl;
                                  a.download = filename;
                                  document.body.appendChild(a);
                                  a.target = "_blank";
                                  a.click();
                              }
                          } else {
                              window.location = downloadUrl;
                          }
                      }

                  } catch (ex) {
                      console.log(ex);
                  }
                }else{
                  swal("Factura no disponible", "", "error");
                }
              },
              error: function (response) {

              }

        });

});


function data_basic(campoa, campob){
  $.ajax({
    type: "POST",
    url: "/view_gen_sol_pay",
    data: { pay : campoa , _token : campob },
    success: function (data){
      if (data == null || data == '[]') {
          $("#fecha_ini").val('No disponible.');
          $("#fecha_pay").val('No disponible.');
          $("#rec_proy").val('No disponible.');
          $("#rec_sitio").val('No disponible.');
          $("#folio").val('No disponible.');
          $("#rec_proveedor").val('No disponible.');
          $("#rec_monto").val('No disponible.');
          $("#rec_type_mont").val('');
          $("#numfact").val('No disponible.');
          $("#rec_description").val('No disponible.');
          $("#rec_way_pay").val('No disponible.');
          $("#rec_name_project").val('No disponible.');
          $("#rec_class_cost").val('No disponible.');
          $("#rec_application").val('No disponible.');
          $("#rec_option_proy").val('No disponible.');
          $("#rec_priority").val('No disponible.');
      }
      else {
        if ($.trim(data)){
console.log(data);
                  $("#fecha_ini").text(data[0].date_solicitude);
                  $("#fecha_pay").val(data[0].date_pay);
                  $("#rec_priority").val(data[0].priority);
                  $("#rec_proy").val(data[0].cadena);
                  $("#rec_sitio").val(data[0].hotel);
                  $("#folio").val(data[0].folio);
                  $("#rec_proveedor").val(data[0].proveedor);
                  $("#rec_monto").val("$" + data[0].amount_format + " " + data[0].currency);

                  var number = parseFloat(data[0].amount_format.replace(/,/g, ''));
                  var cadena = NumeroALetras(number);
                  $("#amountText").val(cadena + data[0].currency);

                  $("#rec_type_mont").val(data[0].currency);
                  $("#numfact").val(data[0].factura);
                  $("#rec_description").val(data[0].concept_pay);
                  $("#rec_way_pay").val(data[0].way_pay);
                  $("#rec_name_project").val(data[0].name);
                  $("#rec_class_cost").val(data[0].classifications);
                  $("#rec_application").val(data[0].applications);
                  $("#rec_option_proy").val(data[0].options);

                  $("input[name='options[]']").each( function () {
                      if( $(this).val() ==  data[0].options){
                        $(this).prop('checked', 'checked');
                      }
                  })

                  $("input[name='opt_application[]']").each( function () {
                      if( $(this).val() ==  data[0].applications){
                        $(this).prop('checked', 'checked');
                      }
                  })


        }
        else{
                $("#fecha_ini").val('No disponible.');
                $("#fecha_pay").val('No disponible.');
                $("#rec_proy").val('No disponible.');
                $("#rec_sitio").val('No disponible.');
                $("#folio").val('No disponible.');
                $("#rec_proveedor").val('No disponible.');
                $("#rec_monto").val('No disponible.');
                $("#rec_type_mont").val('');
                $("#rec_description").val('No disponible.');
                $("#rec_way_pay").val('No disponible.');

                $("#rec_name_project").val('No disponible.');
                $("#rec_class_cost").val('No disponible.');
                $("#rec_application").val('No disponible.');
                $("#rec_option_proy").val('No disponible.');
        }
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}
function data_basic_area(campoa, campob){


  $.ajax({
    type: "POST",
    url: "/view_gen_sol_pay_area",
    data: { pay : campoa , _token : campob },
    success: function (data){

      $.each(JSON.parse(data),function(index, objdata){
            $("input[name='areas[]']").each( function () {
                if( $(this).val() ==  objdata.areas){
                  $(this).prop('checked', 'checked');
                }
            })
      });

    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}
function data_basic_type(campoa, campob){
  $.ajax({
    type: "POST",
    url: "/view_gen_sol_pay_type",
    data: { pay : campoa , _token : campob },
    success: function (data){

      $.each(JSON.parse(data),function(index, objdata){

            $("input[name='verticals[]']").each( function () {
                if( $(this).val() ==  objdata.verticals){
                  $(this).prop('checked', 'checked');
                }
            })
       });
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}
function data_basic_financing(campoa, campob){
  $.ajax({
    type: "POST",
    url: "/view_gen_sol_pay_financing",
    data: { pay : campoa , _token : campob },
    success: function (data){
      $.each(JSON.parse(data),function(index, objdata){
            $("input[name='financings[]']").each( function () {
                if( $(this).val() ==  objdata.financings){
                  $(this).prop('checked', 'checked');
                }
            })
       });
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}
function data_basic_comments(campoa, campob){
  $.ajax({
    type: "POST",
    url: "/view_gen_sol_pay_comments",
    data: { pay : campoa , _token : campob },
    success: function (data){
      if (data == null || data == '[]') {
          $("#rec_observation").text('No disponible.');
      }
      else {
        if ($.trim(data)){
          datax = JSON.parse(data);
          $("#rec_observation").text(datax[0].comments);
        }
        else{
          $("#rec_observation").text('No disponible.');
        }
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}

function data_basic_bank(campoa, campob){
  $.ajax({
    type: "POST",
    url: "/view_gen_sol_pay_bank",
    data: { pay : campoa , _token : campob },
    success: function (data){
      if (data == null || data == '[]') {
          $("#rec_bank").val('No disponible.');
          $("#rec_cuenta").val('No disponible.');
          $("#rec_clabe").val('No disponible.');
          $("#rec_reference").val('No disponible.');
      }
      else {
        if ($.trim(data)){
          datax = JSON.parse(data);
          $("#rec_bank").val(datax[0].banco);
          $("#rec_cuenta").val(datax[0].cuenta);
          $("#rec_clabe").val(datax[0].clabe);
          $("#rec_reference").val(datax[0].referencia);
        }
        else{
          $("#rec_bank").val('No disponible.');
          $("#rec_cuenta").val('No disponible.');
          $("#rec_clabe").val('No disponible.');
          $("#rec_reference").val('No disponible.');
        }
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}

// function  data_basic_venues(campoa, campob){
//   $.ajax({
//     type: "POST",
//     url: "/view_gen_sol_venues",
//     data: { pay : campoa , _token : campob },
//     success: function (data){
//       if (data == null || data == '[]') {
//         console.log("No disponible");
//       }
//       else {
//         datax = JSON.parse(data);
//         console.log(datax);
//         $.each( datax, function( i, venue ) {
//           if(venue.id_proyecto == null){
//             venue.id_proyecto = "No disponible";
//           }
//           $('#rec_venues_table').append('<tr><td>' + venue.cadena + '</td><td>' + venue.sitio + '</td><td>' + venue.id_proyecto + '</td><td>' + venue.cantidad + '</td></tr>');
//         });
//
//       }
//     },
//     error: function (data) {
//       console.log('Error:', data);
//     }
//   });
// }

function data_basic_firmas(campoa, campob){
  $.ajax({
    type: "POST",
    url: "/view_gen_sol_pay_firmas",
    data: { pay : campoa , _token : campob },
    success: function (data){

      if (data == null || data == '[]') {
          $("#rec_observation").text('No disponible.');
      }
      else {
        if ($.trim(data)){
          datax = JSON.parse(data);
          $("#persona_1").text(datax[0].nombre1);
          $("#persona_2").text(datax[0].nombre2);
          $("#persona_3").text(datax[0].nombre3);
          $("#rec_name_conf").text(datax[0].nombre4);

          if(datax[0].nombre5 != 'N/A'){    $("#rec_name_conf_del").text(datax[0].nombre5); }
          else {  $("#rec_name_conf_del").text('No aplica');  }

          if(datax[0].firma1 != 'N/A'){  $("#firma_1").attr("src","../images/storage/signature/"+datax[0].firma1); }
          else {  $("#firma_1").attr("src","../images/hotel/Default.svg");  }

          if(datax[0].firma2 != 'N/A'){  $("#firma_2").attr("src","../images/storage/signature/"+datax[0].firma2); }
          else {  $("#firma_2").attr("src","../images/hotel/Default.svg");  }

          if(datax[0].firma3 != 'N/A'){  $("#firma_3").attr("src","../images/storage/signature/"+datax[0].firma3); }
          else {  $("#firma_3").attr("src","../images/hotel/Default.svg");  }

        }
        else{
          $("#rec_observation").text('No disponible.');
        }
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}
function table_permission_zero() {
  var objData = $('#search_info').find("select,textarea, input").serialize();
  $.ajax({
      type: "POST",
      url: "/view_request_pay_zero",
      data: objData,
      success: function (data){
        payments_table(data, $("#table_pays"));
      },
      error: function (data) {
        console.log('Error:', data);
      }
  });
}

//Funcionalidad para convertir numero a letras

function Unidades(num){

  switch(num)
  {
    case 1: return "UN";
    case 2: return "DOS";
    case 3: return "TRES";
    case 4: return "CUATRO";
    case 5: return "CINCO";
    case 6: return "SEIS";
    case 7: return "SIETE";
    case 8: return "OCHO";
    case 9: return "NUEVE";
  }

  return "";
}

function Decenas(num){

  decena = Math.floor(num/10);
  unidad = num - (decena * 10);

  switch(decena)
  {
    case 1:
      switch(unidad)
      {
        case 0: return "DIEZ";
        case 1: return "ONCE";
        case 2: return "DOCE";
        case 3: return "TRECE";
        case 4: return "CATORCE";
        case 5: return "QUINCE";
        default: return "DIECI" + Unidades(unidad);
      }
    case 2:
      switch(unidad)
      {
        case 0: return "VEINTE";
        default: return "VEINTI" + Unidades(unidad);
      }
    case 3: return DecenasY("TREINTA", unidad);
    case 4: return DecenasY("CUARENTA", unidad);
    case 5: return DecenasY("CINCUENTA", unidad);
    case 6: return DecenasY("SESENTA", unidad);
    case 7: return DecenasY("SETENTA", unidad);
    case 8: return DecenasY("OCHENTA", unidad);
    case 9: return DecenasY("NOVENTA", unidad);
    case 0: return Unidades(unidad);
  }
}//Unidades()

function DecenasY(strSin, numUnidades){
  if (numUnidades > 0)
    return strSin + " Y " + Unidades(numUnidades)

  return strSin;
}//DecenasY()

function Centenas(num){

  centenas = Math.floor(num / 100);
  decenas = num - (centenas * 100);

  switch(centenas)
  {
    case 1:
      if (decenas > 0)
        return "CIENTO " + Decenas(decenas);
      return "CIEN";
    case 2: return "DOSCIENTOS " + Decenas(decenas);
    case 3: return "TRESCIENTOS " + Decenas(decenas);
    case 4: return "CUATROCIENTOS " + Decenas(decenas);
    case 5: return "QUINIENTOS " + Decenas(decenas);
    case 6: return "SEISCIENTOS " + Decenas(decenas);
    case 7: return "SETECIENTOS " + Decenas(decenas);
    case 8: return "OCHOCIENTOS " + Decenas(decenas);
    case 9: return "NOVECIENTOS " + Decenas(decenas);
  }

  return Decenas(decenas);
}//Centenas()

function Seccion(num, divisor, strSingular, strPlural){
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)

  letras = "";

  if (cientos > 0)
    if (cientos > 1)
      letras = Centenas(cientos) + " " + strPlural;
    else
      letras = strSingular;

  if (resto > 0)
    letras += "";

  return letras;
}//Seccion()

function Miles(num){
  divisor = 1000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)

  strMiles = Seccion(num, divisor, "UN MIL", "MIL");
  strCentenas = Centenas(resto);

  if(strMiles == "")
    return strCentenas;

  return strMiles + " " + strCentenas;

}//Miles()

function Millones(num){
  divisor = 1000000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)

  strMillones = Seccion(num, divisor, "UN MILLON", "MILLONES");
  strMiles = Miles(resto);

  if(strMillones == "")
    return strMiles;

  return strMillones + " " + strMiles;

}//Millones()

function NumeroALetras(num){
  var data = {
    numero: num,
    enteros: Math.floor(num),
    centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
    letrasCentavos: "",
    letrasMonedaPlural: "",
    letrasMonedaSingular: ""
  };

  if (data.centavos > 0)
    data.letrasCentavos = "CON " + data.centavos + "/100 ";

  if(data.enteros == 0)
    return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos + "";
  if (data.enteros == 1)
    return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
  else
    return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos ;
}//NumeroALetras()

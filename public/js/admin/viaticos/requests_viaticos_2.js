$(function() {
  moment.locale('es');
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
  table_permission_two();
});

$("#boton-aplica-filtro").click(function(event) {
  table_permission_two();
});
var Configuration_table_responsive_checkbox_move_viatic= {
        "order": [[ 8, "desc" ]],
        "select": true,
        "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "columnDefs": [
            { //Subida 1
                "targets": 0,
                "checkboxes": {
                  'selectRow': true
                },
                "width": "1%",
                "createdCell": function (td, cellData, rowData, row, col){
                    if ( cellData >=0 ) {
                      if(rowData[11] != 'Pendiente'){
                        this.api().cell(td).checkboxes.disable();
                      }
                    }
                }
            },
            {
                "targets": 1,
                "width": "1%",
                "className": "text-center",
            },
            {
                "targets": 2,
                "width": "3%",
                "className": "text-center",
            },
            {
                "targets": 3,
                "width": "1%",
                "className": "text-center",
            },
            {
                "targets": 4,
                "width": "1%",
                "className": "text-center",
            },
            {
                "targets": 5,
                "width": "0.2%",
                "className": "text-center",
            },
            {
                "targets": 6,
                "width": "0.2%",
                "className": "text-center",
            },
            {
                "targets": 7,
                "width": "0.2%",
                "className": "text-center",
            },
            {
                "targets": 8,
                "width": "0.2%",
                "className": "text-center",
            },
            {
                "targets": 9,
                "width": "2%",
                "className": "text-center",
            },
            {
                "targets": 10,
                "width": "1%",
                "className": "text-center",
            },
            {
                "targets": 11,
                "visible": false,
                "searchable": false
            }
        ],
        "select": {
            'style': 'multi',
        },
        dom: "<'row'<'col-sm-6'B><'col-sm-2'l><'col-sm-4'f>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
          {
            text: '<i class="fa fa-check margin-r5"></i> Aprobar Marcados',
            titleAttr: 'Aprobar Marcados',
            className: 'btn bg-navy',
            init: function(api, node, config) {
               $(node).removeClass('btn-default')
            },
            action: function ( e, dt, node, config ) {
              // $('#modal-confirmation').modal('show');
              swal({
                title: "Estás seguro?",
                text: "Se aprobarán todos los viáticos seleccionados.!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Continuar.!",
                cancelButtonText: "Cancelar.!",
                closeOnConfirm: false,
                closeOnCancel: false
              },
              function(isConfirm) {
                if (isConfirm) {
                  var rows_selected = $("#table_viatics").DataTable().column(0).checkboxes.selected();
                  var _token = $('input[name="_token"]').val();
                   // Iterate over all selected checkboxes
                   var valores= new Array();
                   $.each(rows_selected, function(index, rowId){
                      valores.push(rowId);
                  });
                  if ( valores.length === 0){
                    swal("Operación abortada", "Ningún viático seleccionado :(", "error");
                  }
                  else {
                      $.ajax({
                          type: "POST",
                          url: "/send_item_pendientes",
                          data: { idents: JSON.stringify(valores), _token : _token },
                          success: function (data){
                            if (data === 'true') {
                              swal("Operación Completada!", "Los viáticos seleccionados han sido afectados.", "success");
                              table_permission_two();
                            }
                            if (data === 'false') {
                              swal("Operación Completada!", "Los viáticos seleccionados han sido afectados.", "success");
                            }
                          },
                          error: function (data) {
                            console.log('Error:', data);
                          }
                      });
                  }

                } else {
                  swal("Operación abortada", "Ningún viático afectado :)", "error");
                }
              });
            }
          },
          {
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel-o"></i> Excel',
            titleAttr: 'Excel',
            title: function ( e, dt, node, config ) {
              return 'Reporte de viaticos.';
            },
            init: function(api, node, config) {
               $(node).removeClass('btn-default')
            },
            exportOptions: {
                columns: [ 1,2,3,4,5,6,7,8],
                modifier: {
                    page: 'all',
                }
            },
            className: 'btn btn-success',
          },
          {
            extend: 'csvHtml5',
            text: '<i class="fa fa-file-text-o"></i> CSV',
            titleAttr: 'CSV',
            title: function ( e, dt, node, config ) {
              return 'Reporte de viaticos.';
            },
            init: function(api, node, config) {
               $(node).removeClass('btn-default')
            },
            exportOptions: {
                columns: [ 1,2,3,4,5,6,7,8],
                modifier: {
                    page: 'all',
                }
            },
            className: 'btn btn-info',
          },
          {
            extend: 'pdf',
            text: '<i class="fa fa-file-pdf-o"></i>  PDF',
            title: function ( e, dt, node, config ) {
              return 'Reporte de viaticos.';
            },
            init: function(api, node, config) {
               $(node).removeClass('btn-default')
            },
            exportOptions: {
                columns: [ 1,2,3,4,5,6,7,8],
                modifier: {
                    page: 'all',
                }
            },
            className: 'btn btn-danger',
          }
        ],
        language:{
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "<i class='fa fa-search'></i> Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Último",
              "sNext":     "Siguiente",
              "sPrevious": "Anterior"
            },
            "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            'select': {
                'rows': {
                    _: "%d Filas seleccionadas",
                    0: "Haga clic en una fila para seleccionarla",
                    1: "Fila seleccionada 1"
                }
            }
        },
};

function table_permission_two() {
  var objData = $('#search_info').find("select,textarea, input").serialize();
  $.ajax({
      type: "POST",
      url: "/view_request_via_two",
      data: objData,
      success: function (data){
        viatics_table(data, $("#table_viatics"));
      },
      error: function (data) {
        console.log('Error:', data);
      }
  });
}

function viatics_table(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive_checkbox_move_viatic);
  vartable.fnClearTable();
  $.each(JSON.parse(datajson), function(index, status){
    var priority_s="";
    if(status.prioridad == 'Urgente'){ priority_s="<span class='label label-danger'>"+status.prioridad+"</span>"; }
    else { priority_s="<span class='label label-default'>"+status.prioridad+"</span>"; }
  vartable.fnAddData([
    status.id,
    status.folio,
    status.name,
    status.date_start,
    status.date_end,
    status.solicitado,
    status.aprobado,
    '<span class="label label-default">'+status.estado+'</span>',
    priority_s,
    status.usuario,
    '<a href="javascript:void(0);" onclick="enviar(this)" value="'+status.id+'" class="btn btn-default btn-xs" role="button" data-target="#modal-concept" title="Ver"><span class="fa fa-eye"></span></a><a href="javascript:void(0);" onclick="enviartwo(this)" value="'+status.id+'" class="btn btn-danger btn-xs" role="button" data-target="#modal-deny" title="Denegar Solicitud"><span class="fa fa-ban"></span></a>',
    status.estado,
    ]);
  });
}

function enviar(e){
  var valor= e.getAttribute('value');
  var _token = $('input[name="_token"]').val();
  var fecha = $('#date_to_search').val();
  $.ajax({
      type: "POST",
      url: "/view_pertain_viatic_ur_n2",
      data: { date_to_search: fecha, viatic : valor , _token : _token },
      success: function (data){
        if (data === "0") { // NO SE NECESITA APROBAR PENDIENTES
          console.log('NO SE NECESITA APROBAR PENDIENTES');
          cabecera_viatic(valor, _token);
          cuerpo_viatic(valor, _token);
          timeline(valor, _token);
          totales_concept_zsa(valor, _token);
          $('#modal-view-concept').modal('show');
        }
        if (data === "1") { //NECESITA APROBAR PENDIENTES
          console.log('NECESITA APROBAR PENDIENTES');
          cabecera_viatic(valor, _token);
          cuerpo_viatic(valor, _token);
          timeline(valor, _token);
          totales_concept_zsa(valor, _token);
          $('#modal-view-concept').modal('show');
        }
      },
      error: function (data) {
        console.log('Error:', data);
      }
  });
}

// Exportacion del pdf
$('.btn-export').on('click', function(){
    $("#captura_table_general").hide();
    $(".hojitha").css("border", "");
    html2canvas(document.getElementById("captura_pdf_general")).then(function(canvas) {
      var ctx = canvas.getContext('2d');
      ctx.rect(0, 0, canvas.width, canvas.height);
          var imgData = canvas.toDataURL("image/jpeg", 1.0);
          var correccion_landscape = 0;
          var correccion_portrait = 0;
          if(canvas.height > canvas.width) {
              var orientation = 'portrait';
              correccion_portrait = 1;
              correccion_landscape = 0;
              var imageratio = canvas.height/canvas.width;
          }
          else {
              var orientation = 'landscape';
              correccion_landscape = 0;
              correccion_portrait = 0;
              var imageratio = canvas.width/canvas.height;
          }
          if(canvas.height < 900) {
              fontsize = 16;
          }
          else if(canvas.height < 2300) {
              fontsize = 11;
          }
          else {
              fontsize = 6;
          }

          var margen = 0;//pulgadas

          // console.log(canvas.width);
          // console.log(canvas.height);

         var pdf  = new jsPDF({
                      orientation: orientation,
                      unit: 'in',
                      format: [16+correccion_portrait, (16/imageratio)+margen+correccion_landscape]
                    });

          var widthpdf = pdf.internal.pageSize.width;
          var heightpdf = pdf.internal.pageSize.height;
          pdf.addImage(imgData, 'JPEG', 0, margen, widthpdf, heightpdf-margen);
          pdf.save("Solicitud de viaticos.pdf");
          $(".hojitha").css("border", "1px solid #ccc");
          $(".hojitha").css("border-bottom-style", "hidden");
    });
});
//Denegar solicitud
function enviartwo(e){
  var valor= e.getAttribute('value');
  var _token = $('input[name="_token"]').val();
  swal({
    title: "Estás seguro?",
    text: "Se denegara la solicitud.!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Continuar.!",
    cancelButtonText: "Cancelar.!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm) {
    if (isConfirm) {
          $.ajax({
              type: "POST",
              url: "/deny_viatic",
              data: { idents: valor, _token : _token },
              success: function (data){
                if (data === 'true') {
                  swal("Operación Completada!", "El viatico ha sido denegado.", "success");
                  table_permission_two();
                }
                if (data === 'false') {
                  swal("Operación abortada!", "No cuenta con el permiso o esta ya se encuentra denegado :)", "success");
                }
              },
              error: function (data) {
                console.log('Error:', data);
              }
          });
    }
    else {
      swal("Operación abortada", "Ningún viático afectado :)", "error");
    }
  });
}

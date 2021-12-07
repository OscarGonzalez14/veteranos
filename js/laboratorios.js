
function init(){
    listar_ordenes_procesando_lab();
}

$(".modal-header").on("mousedown", function(mousedownEvt) {
    let $draggable = $(this);
    let x = mousedownEvt.pageX - $draggable.offset().left,
        y = mousedownEvt.pageY - $draggable.offset().top;
    $("body").on("mousemove.draggable", function(mousemoveEvt) {
    $draggable.closest(".modal-dialog").offset({
    "left": mousemoveEvt.pageX - x,
      "top": mousemoveEvt.pageY - y
    });
    });
    $("body").one("mouseup", function() {
      $("body").off("mousemove.draggable");
    });
    $draggable.closest(".modal").one("bs.modal.hide", function() {
        $("body").off("mousemove.draggable");
    });
  
});

function listar_ordenes_pend_lab(){

  let inicio = $("#desde_orders_lab_pend").val();
  let hasta = $("#hasta_orders_lab_pend").val();

  tabla_ordenes= $('#ordenes_pendientes_lab').DataTable({      
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons: [     
      'excelHtml5',
    ],

    "ajax":{
      url:"../ajax/laboratorios.php?op=get_ordenes_pendientes_lab",
      type : "POST",
      //dataType : "json",
      data:{inicio:inicio,hasta:hasta},           
      error: function(e){
      console.log(e.responseText);
    },           
    },

        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 30,//Por cada 10 registros hace una paginación
          "order": [[ 0, "desc" ]],//Ordenar (columna,orden)

          "language": {
 
          "sProcessing":     "Procesando...",
       
          "sLengthMenu":     "Mostrar _MENU_ registros",
       
          "sZeroRecords":    "No se encontraron resultados",
       
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
       
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
       
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
       
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
       
          "sInfoPostFix":    "",
       
          "sSearch":         "Buscar:",
       
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
       
          }

         }, //cerrando language

          //"scrollX": true

        });
}

 function verImg(img,codigo,paciente){
  document.getElementById("imagen_aro_v").src="";
  $("#imagen_aro_orden").modal("show");
  document.getElementById("imagen_aro_v").src="images/"+img;
  $("#cod_orden_lab").html(codigo);
  $("#paciente_ord_lab").html(paciente);
 }


/**************************
  ARREGLO ORDENES RECIBIR
***************************/
var ordenes_recibir = [];
$(document).on('click', '.ordenes_recibir_lab', function(){
let id_orden = $(this).attr("value");
let id_item = $(this).attr("id");
let codigo = $(this).attr("name");

let checkbox = document.getElementById(id_item);
let check_state = checkbox.checked;

  if (check_state) {
    let obj = {
      id_orden : id_orden,
      codigo : codigo
    }
    ordenes_recibir.push(obj);
  }else{
    let indice = ordenes_recibir.findIndex((objeto, indice, ordenes_recibir) =>{
      return objeto.id_orden == id_orden
    });
    ordenes_recibir.splice(indice,1)
  }
  orders = []; 
  for(var i=0;i<ordenes_recibir.length;i++){
    orders.push(ordenes_recibir[i].id_orden);
  }
  let codes = orders.reverse();
  let rec = codes.toString();
  let fecha_ini = $('#desde_orders_lab_pend').val();
  let fecha_fin = $('#hasta_orders_lab_pend').val();
  $('#inicio_rec').val(fecha_ini);
  $('#fin_rec').val(fecha_fin);
  document.getElementById("ordenes_imp").value = rec;
});


function recibirOrdenesLab(){

  let count = ordenes_recibir.length;
  if (count==0) {
    Swal.fire({
      position: 'top-center',
      icon: 'error',
      title: 'Orden de recibidos vacio',
      showConfirmButton: true,
      timer: 2500
    });
  return false
  }

 $("#count_select").html(count);
 $("#modal_ingreso_lab").modal('show');
  console.log(ordenes_recibir);
  orders = []; 
  for(var i=0;i<ordenes_recibir.length;i++){
    orders.push(ordenes_recibir[i].id_orden);
  }
}

function confirmarIngresoLab(){
  let usuario = $("#usuario").val();
  let n_ordenes = ordenes_recibir.length;
  $.ajax({
      url:"../ajax/laboratorios.php?op=recibir_ordenes_laboratorio",
      method:"POST",
      data : {'arrayRecibidos':JSON.stringify(ordenes_recibir),'usuario':usuario},
      cache:false,
      dataType:"json",
      success:function(data){   
        $("#ordenes_pendientes_lab").DataTable().ajax.reload();
        ordenes_recibir = [];
        $("#modal_ingreso_lab").modal("hide");
        Swal.fire({
        position: 'top-center',
        icon: 'success',
        title: 'Se han recibido '+n_ordenes+' ordenes',
        showConfirmButton: true,
        timer: 50500
      });

      }
    });
}

function listar_ordenes_procesando_lab(){


  tabla_ordenes = $('#ordenes_procesando_lab').DataTable({      
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons: [     
      'excelHtml5',
    ],

    "ajax":{
      url:"../ajax/laboratorios.php?op=get_ordenes_procesando_lab",
      type : "POST",
      dataType : "json",
      //data:{inicio:inicio,hasta:hasta},           
      error: function(e){
      console.log(e.responseText);
    },           
    },

        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 30,//Por cada 10 registros hace una paginación
          "order": [[ 0, "desc" ]],//Ordenar (columna,orden)

          "language": {
 
          "sProcessing":     "Procesando...",
       
          "sLengthMenu":     "Mostrar _MENU_ registros",
       
          "sZeroRecords":    "No se encontraron resultados",
       
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
       
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
       
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
       
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
       
          "sInfoPostFix":    "",
       
          "sSearch":         "Buscar:",
       
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
       
          }

         }, //cerrando language

          //"scrollX": true

        });
}

/*******************************
  ARREGLO ORDENES PROCESANDO
********************************/
var ordenes_procesando = [];
$(document).on('click', '.ordenes_procesando_lab', function(){
  let id_orden = $(this).attr("value");
  let id_item = $(this).attr("id");
  let codigo = $(this).attr("name");

  let checkbox = document.getElementById(id_item);
  let check_state = checkbox.checked;

  if (check_state) {
    let obj = {
      id_orden : id_orden,
      codigo : codigo
    }
    ordenes_procesando.push(obj);
  }else{
    let indice = ordenes_procesando.findIndex((objeto, indice, ordenes_procesando) =>{
      return objeto.id_orden == id_orden
    });
    ordenes_procesando.splice(indice,1)
  }
  
});




init();
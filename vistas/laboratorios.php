<?php 
require_once("../config/conexion.php");
if(isset($_SESSION["usuario"])){
$categoria_usuario = $_SESSION["categoria"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
<?php require_once("links_plugin.php"); 
 require_once('../modelos/Ordenes.php');
 $ordenes = new Ordenes();
 $suc = $ordenes->get_opticas();
 require_once('../modales/nueva_orden_lab.php');
 require_once('../modales/aros_en_orden.php');

 ?>
<style>
  .buttons-excel{
      background-color: green !important;
      margin: 2px;
      max-width: 150px;
  }
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed" style='font-family: Helvetica, Arial, sans-serif;'>
<div class="wrapper">
<!-- top-bar -->
  <?php require_once('top_menu.php')?>

  <?php require_once('side_bar.php')?>
  <!--End SideBar Container-->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
      <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
      <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["usuario"];?>"/>
      <input type="hidden" name="categoria" id="get_categoria" value="<?php echo $_SESSION["categoria"];?>"/>
      <div style="border-top: 0px">
      </div>

      <div class="card-body" style="margin: 1px solid red;color: black !important">
        <a href="pend_lab.php.php" class="btn btn-app" style="color: black;border: solid #5bc0de 1px;">
          <span class="badge bg-warning" id="alert_creadas_ord"></span>
          <i class="fas fa-history" style="color: #f0ad4e"></i> PENDIENTES
        </a>

        <a href="procesando_lentes.php" class="btn btn-app" style="color: black;border: solid #5bc0de 1px;">
          <span class="badge bg-info" id="alert_enviadas_ord"></span>
          <i class="fas fa-cog" style="color: #0275d8"></i> PROCESANDO
        </a>

        <a href="enviadas.php" class="btn btn-app" style="color: black;border: solid #5bc0de 1px;">
          <span class="badge bg-success" id="alert_recibidos_ord"></span>
          <i class="fas fa-location-arrow" style="color: #5cb85c"></i> ENVIADAS
        </a>
      </div>

      <div class="form-row">
         <div class="col-sm-3"></div>
         <div class="col-sm-2" style="text-align: right;display: flex;align-items: right">
           <input type="date" class="form-control clear_orden_i" id="desde_orders_lab_pend" placeholder="desde">
         </div>
         <div class="col-sm-2 form-group" style="text-align: right;display: flex;align-items: right">
          <input type="date" class="form-control clear_orden_i" id="hasta_orders_lab_pend" placeholder="desde">
         </div>
         <div class="col-sm-2 form-group" style="text-align: right;display: flex;align-items: right">
           <button class="btn btn-primary"><i class="fas fa-search" style="cursor:pointer;margin-top: 4px" onClick="listar_ordenes_pend_lab()"></i></button>
         </div>
         <div class="col-sm-2">
         <button class="btn btn-info" onClick="recibirOrdenesLab();"><i class="fas fa-download"></i> Recibir</button>
         </div>
       </div>

        <table width="100%" class="table-hover table-bordered" id="ordenes_pendientes_lab"  data-order='[[ 0, "desc" ]]'>        
         <thead class="style_th bg-dark" style="color: white">
           <th>ID</th>
           <th>Codigo</th>
           <th>Fecha</th>
           <th>Recibir</th>
           <th>Paciente</th>
           <th>Tipo lente</th>
           <th>Detalles</th>
           <th>Aro</th>
         </thead>
         <tbody class="style_th"></tbody>
       </table>

    </section>
    <!-- /.content -->
  </div>

  <input type="hidden" value="<?php echo $categoria_usuario;?>" id="cat_users">

   <!--Modal Imagen Aro-->
   <div class="modal" id="modal_recibir_aros">
    <div class="modal-dialog" style="max-width: 55%">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <span><b>Código: </b></span><span id="cod_orden_lab"></span>&nbsp;&nbsp;&nbsp;<span><b>Paciente: </b></span><span id="paciente_ord_lab"></span>
          <div style="  background-size: cover;background-position: center;display:flex;align-items: center;">
            <img src="" alt="" id="imagen_aro_v" style="width: 100%;border-radius: 8px;">
          </div>          
        </div>        
   
      </div>
    </div>
  </div>


   <!--Modal Ingreso a laboratorio-->
   <div class="modal" id="modal_ingreso_lab" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="max-width: 35%">
      <div class="modal-content">       
        <!-- Modal body -->
        <div class="modal-body">
          <b><h5 style="font-size: 18px;text-align: center">ORDENES RECIBIDAS EN LABORATORIO</h5></b>
          <b><h5 style="font-size: 14px;text-align: center">Confirmar que recibe <span id="count_select"></span> ordenes.</h5></b>
          
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger">Cancelar</button>
        <button type="button" class="btn btn-primary" onClick='confirmarIngresoLab();'><i class="fas fa-print"></i> Recibir</button>
      </div>        
   
      </div>
    </div>
  </div>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>2021 Lenti || <b>Version</b> 1.0</strong>
     &nbsp;All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      
    </div>
  </footer>
</div>

<!-- ./wrapper -->
<?php 
require_once("links_js.php");
?>
<script type="text/javascript" src="../js/laboratorios.js"></script>

<script>
  var dui = new Cleave('#dui_pac', {
  delimiter: '-',
  blocks: [8,1],
  uppercase : true
});

var telefono = new Cleave('#telef_pac', {
  delimiter: '-',
  blocks: [4,4],
  uppercase : true
});
</script>
</body>
</html>
 <?php } else{
echo "Acceso denegado";
  } ?>

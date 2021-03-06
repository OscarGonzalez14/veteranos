<?php

require_once("../config/conexion.php");
//llamada al modelo categoria
require_once("../modelos/Laboratorios.php");

$ordenes = new Laboratorios();

switch ($_GET["op"]){

case 'get_ordenes_pendientes_lab':
  
  $data = Array();
  $i=0;
  $datos = $ordenes->get_ordenes_filter_date($_POST["inicio"],$_POST["hasta"]);
  foreach ($datos as $row) { 
  $sub_array = array();

  $sub_array[] = $row["id_orden"];
  $sub_array[] = $row["codigo"];  
  $sub_array[] = date("d-m-Y",strtotime($row["fecha"]));
   $sub_array[] = '<input type="checkbox"class="form-check-input ordenes_recibir_lab" value="'.$row["id_orden"].'" name="'.$row["codigo"].'" id="orden_env'.$i.'">'."Rec.".'';
  $sub_array[] = strtoupper($row["paciente"]);
  $sub_array[] = $row["tipo_lente"];
  $sub_array[] = '<button type="button"  class="btn btn-sm bg-light" onClick="verEditar(\''.$row["codigo"].'\',\''.$row["paciente"].'\')"><i class="fa fa-eye" aria-hidden="true" style="color:blue"></i></button>';  
  $sub_array[] = '<i class="fas fa-image fa-2x" aria-hidden="true" style="color:blue" onClick="verImg(\''.$row["img"].'\',\''.$row["codigo"].'\',\''.$row["paciente"].'\')">';               
  $i++;                                             
  $data[] = $sub_array;
  }
  
  $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
  break;

  case 'recibir_ordenes_laboratorio':
    $ordenes->recibirOrdenesLab();
    $mensaje = "Ok";
  echo json_encode($mensaje);    
  break;

 case 'get_ordenes_procesando_lab':
  $data = Array();
  $i=0;
  $datos = $ordenes->get_ordenes_procesando_lab();
  foreach ($datos as $row) { 
  $sub_array = array();

  $sub_array[] = $row["id_orden"];
  $sub_array[] = $row["codigo"];  
  $sub_array[] = date("d-m-Y",strtotime($row["fecha"]));
   $sub_array[] = '<input type="checkbox"class="form-check-input ordenes_procesando_lab" value="'.$row["id_orden"].'" name="'.$row["codigo"].'" id="orden_enviar'.$i.'">'."Rec.".'';
  $sub_array[] = strtoupper($row["paciente"]);
  $sub_array[] = $row["tipo_lente"];
  $sub_array[] = '<button type="button"  class="btn btn-sm bg-light" onClick="verEditar(\''.$row["codigo"].'\',\''.$row["paciente"].'\')"><i class="fa fa-eye" aria-hidden="true" style="color:blue"></i></button>';  
  $sub_array[] = '<i class="fas fa-image fa-2x" aria-hidden="true" style="color:blue" onClick="verImg(\''.$row["img"].'\',\''.$row["codigo"].'\',\''.$row["paciente"].'\')">';               
  $i++;                                             
  $data[] = $sub_array;
  }
  
  $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
  break;

  case 'finalizar_ordenes_laboratorio':
    $ordenes->finalizarOrdenesLab();
    $mensaje = "Ok";
    echo json_encode($mensaje); 
    
    break;

    case 'get_ordenes_finalizadas_lab':
      $data = Array();
      $datos = $ordenes->get_ordeOrdenesFinalizadas();
      foreach ($datos as $row) { 
      $sub_array = array();

      $sub_array[] = $row["id_orden"];
      $sub_array[] = $row["codigo"];  
      $sub_array[] = date("d-m-Y",strtotime($row["fecha"]));
      $sub_array[] = strtoupper($row["paciente"]);
      $sub_array[] = $row["tipo_lente"];
      $sub_array[] = '<button type="button"  class="btn btn-sm bg-light" onClick="verEditar(\''.$row["codigo"].'\',\''.$row["paciente"].'\')"><i class="fa fa-eye" aria-hidden="true" style="color:blue"></i></button>';  
      $sub_array[] = '<i class="fas fa-image fa-2x" aria-hidden="true" style="color:blue" onClick="verImg(\''.$row["img"].'\',\''.$row["codigo"].'\',\''.$row["paciente"].'\')">';                                       
      $data[] = $sub_array;
      
      }
      
      $results = array(
        "sEcho"=>1, //Información para el datatables
        "iTotalRecords"=>count($data), //enviamos el total registros al datatable
        "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
        "aaData"=>$data);
      echo json_encode($results);

  break;

}
<?php

require_once("../config/conexion.php");  

  class Laboratorios extends Conectar{
   
     public function get_ordenes_filter_date($inicio,$fin){
    $conectar= parent::conexion();
    $sql= "select*from orden_lab where fecha between ? and ? order by id_orden DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $inicio);
    $sql->bindValue(2, $fin);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  }
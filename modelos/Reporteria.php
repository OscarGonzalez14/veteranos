<?php
require_once("../config/conexion.php");

class Reporteria extends Conectar{

public function print_orden($codigo){
    $conectar= parent::conexion();
    parent::set_names(); 

    $sql = "select o.fecha,o.paciente,o.dui,o.edad,rx.od_esferas,rx.od_cilindros,rx.od_eje,rx.od_adicion,rx.oi_esferas,rx.oi_cilindros,rx.oi_eje,rx.oi_adicion,o.pupilar_od,o.pupilar_oi,o.lente_od,o.lente_oi,o.pupilar_od,o.pupilar_oi,o.lente_od,o.lente_oi,o.avsc,o.avfinal,o.modelo_aro,o.marca_aro,o.horizontal_aro,o.vertical_aro,o.puente_aro,o.tipo_lente,o.codigo from orden_lab as o inner join rx_orden_lab as rx on o.codigo=rx.codigo where o.codigo=?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1,$codigo);
    $sql->execute();
    $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    $tabla = "<table class='table2' width='100%' style='margin-top;0px !important'>";
    $tabla .="
     <tr>
      <td colspan='50'>
        <img src='../dist/img/inabve.jpg' width='55' height='55'>
      </td>
      <td colspan='50' align='right' style='text-align:right'>
       <img src='../dist/img/logooficial.jpg' width='50' height='25'>
      </td>
     </tr>
    ";

    foreach ($resultado as $key) {

      $tabla .= "
      <tr>
      <td class='stilot1' colspan='30' style='text-align:left'><b>Cod.:</b> ".$key["codigo"]."</td>
      <td class='stilot1' colspan='35' style='text-align:left'><b>Lente:</b> ".$key["tipo_lente"]."</td>
      <td class='stilot1' colspan='35' style='text-align:left'><b>Fecha exp.:</b> ".date("d-m-Y",strtotime($key["fecha"]))."</td>
      </tr>
      <tr style='height: 14px'>
        <td class='stilot1 encabezado' colspan='65'><b style='padding: 0px'>Paciente:</b></td>
        <td class='stilot1 encabezado' colspan='20'><b style='padding: 0px'>DUI</b></td>
        <td class='stilot1 encabezado' colspan='15'><b style='padding: 0px'>Edad:</b></td>
      </tr>
      <tr>
        <td class='stilot1' colspan='65' style='text-transform:uppercase;font-size:10px'>".$key["paciente"]."</td>
        <td class='stilot1' colspan='20'>".$key["dui"]."</td>
        <td class='stilot1' colspan='15'>".$key["edad"]."</td>
      </tr>
      <tr>
        <td colspan='100' class='stilot1 encabezado' style='text-align: center'><b>Rx final</b></td>
      </tr>
      <tr>
      <th style='text-align: center;' colspan='20' class='stilot1'><b>OJO</b></th>
        <th style='text-align: center;' colspan='20' class='stilot1'><b>Esfera</b></th>
        <th style='text-align: center;' colspan='20' class='stilot1'><b>Cilindro</b></th>
        <th style='text-align: center;' colspan='20' class='stilot1'><b>Eje</b></th>
        <th style='text-align: center;' colspan='20' class='stilot1'><b>Adición</b></th>
      </tr>
      <tr>
        <td colspan='20' class='stilot1'><b>OD</b></td>
        <td colspan='20' class='stilot1'>".$key["od_esferas"]."</td>
        <td colspan='20' class='stilot1'>".$key["od_cilindros"]."</td>
        <td colspan='20' class='stilot1'>".$key["od_eje"]."</td>
        <td colspan='20' class='stilot1'>".$key["od_adicion"]."</td>
      </tr>

    <tr>
      <td colspan='20' class='stilot1'><b>OI</b></td>
      <td colspan='20' class='stilot1'>".$key["oi_esferas"]."</td>
      <td colspan='20' class='stilot1'>".$key["oi_cilindros"]."</td>
      <td colspan='20' class='stilot1'>".$key["oi_eje"]."</td>
      <td colspan='20' class='stilot1'>".$key["oi_adicion"]."</td>
    </tr>
    <tr>
    <td colspan='30' class='stilot1 encabezado' style='height:10px'>Dist. Pupilar</td>
    <td colspan='30' class='stilot1 encabezado' style='height:10px'>Altura de lente</td>
    <td colspan='40' class='stilot1 encabezado' style='height:10px'>Agudeza visual</td>
    </tr>
    
    <tr>
      <td colspan='15' class='stilot1'><b>OD</b></td>
      <td colspan='15' class='stilot1'><b>OI</b></td>

      <td colspan='15' class='stilot1'><b>OD</b></td>
      <td colspan='15' class='stilot1'><b>OI</b></td>

      <td colspan='20' class='stilot1'><b>AVsc</b></td>
      <td colspan='20' class='stilot1'><b>AVfinal</b></td>

    </tr>
    
    <tr>
      <td colspan='15' class='stilot1'>".$key["pupilar_od"]." mm</td>
      <td colspan='15' class='stilot1'>".$key["pupilar_oi"]." mm</td>

      <td colspan='15' class='stilot1'>".$key["lente_od"]." mm</td>
      <td colspan='15' class='stilot1'>".$key["lente_oi"]." mm</td>

      <td colspan='20' class='stilot1'>".$key["avsc"]."</td>
      <td colspan='20' class='stilot1'>".$key["avfinal"]."</td>

    </tr>
    <tr>
      <td colspan='100' class='stilot1 encabezado'><b>ARO</b></td>
    </tr>
    
    <tr>
      <td colspan='15' class='stilot1'><b>Mod.</b></td>
      <td colspan='30' class='stilot1'><b>Marca</b></td>
      <td colspan='15' class='stilot1'><b>Horiz.</b></td>
      <td colspan='20' class='stilot1'><b>Vertical</b></td>
      <td colspan='20' class='stilot1'><b>Puente</b></td>
    </tr>
    <tr>
      <td colspan='15' class='stilot1'>".$key["modelo_aro"]."</td>
      <td colspan='30' class='stilot1' style='font-size:10px'>".$key["marca_aro"]."</td>
      <td colspan='15' class='stilot1'>".$key["horizontal_aro"]."</td>
      <td colspan='20' class='stilot1'>".$key["vertical_aro"]."</td>
      <td colspan='20' class='stilot1'>".$key["puente_aro"]."</td>
    </tr>

      ";
    }
    $tabla .= "</table>";
    $tabla .= "<span style='text-align:center;color: #909090'>------------------------------------------------------------------------------</span>";
    return $tabla;
}


}
?>


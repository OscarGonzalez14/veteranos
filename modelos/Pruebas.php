<?php

require_once("../config/conexion.php");
//require_once('../vistas/side_bar.php');
class Pruebas extends Conectar{

	public function sendAros(){
	$conectar=parent::conexion();
    parent::set_names();

    for ($i = 1; $i <= 2; $i++) {
        $sql="select * from orden_lab where modelo_aro='VI11044', and estado_aro = '0' order by id_orden ASC limit 1;";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultado as $value) {
            $codigo = $value["codigo"];
            $id_orden = $value["id_orden"];
            $sql2 = "update orden_lab set estado_aro='1',dest_aro='Lenti' where id_orden=? and codigo=?;";
            $sql2 = $conectar->prepare($sql2);
            $sql2->bindValue(1,$id_orden);
            $sql2->bindValue(2,$codigo);
            $sql2->execute();
         
        }
    }
}

public function progresive($inicio,$fin,$laboratorio,$tipo_lente){
    $conectar=parent::conexion();
    parent::set_names();
    $html = '<thead class="style_th bg-dark" style="color: black">
           <th>Esf/Add</th>
           <th>1.00</th>
           <th>1.25</th>
           <th>1.50</th>
           <th>1.75</th>
           <th>2.00</th>
           <th>2.25</th>
           <th>2.05</th>
           <th>2.75</th>
           <th>3.00</th>
         </thead>';
    $div = 3;     
    for ($i = -2; $i <= 4; $i = $i + 0.25) {
        $html .="<tr class='fila'>";
    if($i>0){
        $esf = "+".number_format($i,2,".",",");
    }else{
        $esf  = number_format($i,2,".",",");
    }
   $html .= "<td class='stilot1'><b>".$esf." Right</b></td>";

   for ($j = 1; $j <= 3; $j = $j + 0.25) {
     $add = "+".number_format($j,2,".",",");

    $sql="select count(*) as total, rx.codigo,rx.od_esferas,rx.od_adicion from orden_lab as o INNER JOIN rx_orden_lab as rx on o.codigo=rx.codigo where od_esferas=? and od_adicion=? and laboratorio=? and o.estado='1' and o.tipo_lente=? and fecha between ? and ?;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$esf);
        $sql->bindValue(2,$add);
        $sql->bindValue(3,$laboratorio);
        $sql->bindValue(4,$tipo_lente);
        $sql->bindValue(5,$inicio);
        $sql->bindValue(6,$fin);
        $sql->execute();
        $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultado as $value) {
            $html .= "<td class='stilot1 tableProgresiveOD'
            data-odsferas='".$value["od_esferas"]."'
            data-odadiccion = '".$value["od_adicion"]."'
            data-fechaInicio = '".$inicio."'
            data-fechaFin = '".$fin."'
            data-laboratorio = '".$laboratorio."'
            >"

            .$value["total"].
            "</td>";
        }
   }
   $html .="</tr>";
   $div++;
}
return print $html;
}

public function progresiveOI($inicio,$fin,$laboratorio,$tipo_lente){
    $conectar=parent::conexion();
    parent::set_names();
    $html='<thead class="style_th bg-dark" style="color: black">
           <th>Esf/Add</th>
           <th>1.00</th>
           <th>1.25</th>
           <th>1.50</th>
           <th>1.75</th>
           <th>2.00</th>
           <th>2.25</th>
           <th>2.05</th>
           <th>2.75</th>
           <th>3.00</th>
         </thead>';
    $div = 3;     
    for ($i = -2; $i <= 4; $i = $i + 0.25) {
        $html .="<tr class='fila'>";
    if($i>0){
        $esf = "+".number_format($i,2,".",",");
    }else{
        $esf  = number_format($i,2,".",",");
    }
   $html .= "<td class='stilot1'><b>".$esf." Left</b></td>";

   for ($j = 1; $j <= 3; $j = $j + 0.25) {
     $add = "+".number_format($j,2,".",",");

    $sql="select count(*) as total, rx.codigo,rx.od_esferas,rx.od_adicion from orden_lab as o INNER JOIN rx_orden_lab as rx on o.codigo=rx.codigo where oi_esferas=? and oi_adicion=? and laboratorio=? and o.estado='1' and o.tipo_lente=? and fecha between ? and ?;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$esf);
        $sql->bindValue(2,$add);
        $sql->bindValue(3,$laboratorio);
        $sql->bindValue(4,$tipo_lente);
        $sql->bindValue(5,$inicio);
        $sql->bindValue(6,$fin);
        $sql->execute();
        $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultado as $value) {
            $html .= "<td class='stilot1'>".$value["total"]."</td>";
        }
   }
   $html .="</tr>";
   $div++;
}
return print $html;
}


public function flaptopOd($inicio,$fin,$laboratorio,$tipo_lente){
    $conectar=parent::conexion();
    parent::set_names();
    $html='<thead class="style_th bg-dark" style="color: black">
           <th>Esf/Add</th>
           <th>1.00</th>
           <th>1.25</th>
           <th>1.50</th>
           <th>1.75</th>
           <th>2.00</th>
           <th>2.25</th>
           <th>2.05</th>
           <th>2.75</th>
           <th>3.00</th>
         </thead>';
    $div = 3;     
    for ($i = -2; $i <= 4; $i = $i + 0.25) {
        $html .="<tr class='fila'>";
    if($i>0){
        $esf = "+".number_format($i,2,".",",");
    }else{
        $esf  = number_format($i,2,".",",");
    }
   $html .= "<td class='stilot1'><b>".$esf." Right</b></td>";

   for ($j = 1; $j <= 3; $j = $j + 0.25) {
     $add = "+".number_format($j,2,".",",");

    $sql="select count(*) as total, rx.codigo,rx.od_esferas,rx.od_adicion from orden_lab as o INNER JOIN rx_orden_lab as rx on o.codigo=rx.codigo where od_esferas=? and od_adicion=? and laboratorio=? and o.estado='1' and o.tipo_lente=? and fecha between ? and ?;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$esf);
        $sql->bindValue(2,$add);
        $sql->bindValue(3,$laboratorio);
        $sql->bindValue(4,$tipo_lente);
        $sql->bindValue(5,$inicio);
        $sql->bindValue(6,$fin);
        $sql->execute();
        $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultado as $value) {
            $html .= "<td class='stilot1'>".$value["total"]."</td>";
        }
   }
   $html .="</tr>";
   $div++;
}
return print $html;
}

public function flaptopOi($inicio,$fin,$laboratorio,$tipo_lente){
    $conectar=parent::conexion();
    parent::set_names();
    $html='<thead class="style_th bg-dark" style="color: black">
           <th>Esf/Add</th>
           <th>1.00</th>
           <th>1.25</th>
           <th>1.50</th>
           <th>1.75</th>
           <th>2.00</th>
           <th>2.25</th>
           <th>2.05</th>
           <th>2.75</th>
           <th>3.00</th>
        </thead>';
    $div = 3;     
    for ($i = -2; $i <= 4; $i = $i + 0.25) {
        $html .="<tr class='fila'>";
    if($i>0){
        $esf = "+".number_format($i,2,".",",");
    }else{
        $esf  = number_format($i,2,".",",");
    }
   $html .= "<td class='stilot1'><b>".$esf." Left</b></td>";

   for ($j = 1; $j <= 3; $j = $j + 0.25) {
     $add = "+".number_format($j,2,".",",");

    $sql="select  count(*) as total, rx.codigo,rx.od_esferas,rx.od_adicion from orden_lab as o INNER JOIN rx_orden_lab as rx on o.codigo=rx.codigo where oi_esferas=? and oi_adicion=? and laboratorio=? and o.estado='1' and o.tipo_lente=? and fecha between ? and ?;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$esf);
        $sql->bindValue(2,$add);
        $sql->bindValue(3,$laboratorio);
        $sql->bindValue(4,$tipo_lente);
        $sql->bindValue(5,$inicio);
        $sql->bindValue(6,$fin);
        $sql->execute();
        $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultado as $value) {
            $html .= "<td class='stilot1'>".$value["total"]."</td>";
        }
   }
   $html .="</tr>";
   $div++;
}
    return print $html;
}

public function VisionSencilla(){
    $conectar=parent::conexion();
    parent::set_names();
    $html='<thead class="style_th bg-dark" style="color: black">
           <th>Esf/Add</th>
           <th>0.00</th>
           <th>-0.25</th>
           <th>-0.50</th>
           <th>-0.75</th>
           <th>-1.00</th>
           <th>-1.25</th>
           <th>-1.50</th>
           <th>-1.75</th>
           <th>-2.00</th>
           <th>-2.25</th>
           <th>-2.50</th>
           <th>-2.75</th>
           <th>-3.00</th>
           <th>-3.25</th>
           <th>-3.50</th>
           <th>-3.75</th>
           <th>-4.00</th>
         </thead>';
    $div = 3;     
    for ($i = 0; $i >= (-4); $i = $i - 0.25) {
        $html .="<tr class='fila'>";
          $esf  = number_format($i,2,".",","); 
        $html .= "<td class='stilot1'><b>".$esf."</b></td>";

   for ($j = 0; $j >= (-4); $j = $j - 0.25) {
     $cil = number_format($j,2,".",",");

     //echo $esf."<br>";
     //echo $cil."<br>";

    $sql="select  count(*) as total, rx.codigo,rx.od_esferas,rx.od_adicion from orden_lab as o INNER JOIN rx_orden_lab as rx on o.codigo=rx.codigo where oi_esferas=? and oi_cilindros=? and laboratorio='Lenti' and o.estado='1' and o.tipo_lente='Visión Sencilla' and categoria='Terminado' and o.fecha BETWEEN '2021-07-28' and '2021-07-30';";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$esf);
        $sql->bindValue(2,$cil);
        $sql->execute();
        $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultado as $value) {
            $html .= "<td class='stilot1'>".$value["total"]."</td>";
        }
   }
   $html .="</tr>";
   //$div++;
}
return print $html;
}

public function getVisionSencilla(){
    $conectar=parent::conexion();
    parent::set_names();
    $html='<thead class="style_th bg-dark" style="color: black">
    <th>Esf/Add</th>
    <th>0.00</th>
    <th>-0.25</th>
    <th>-0.50</th>
    <th>-0.75</th>
    <th>-1.00</th>
    <th>-1.25</th>
    <th>-1.50</th>
    <th>-1.75</th>
    <th>-2.00</th>
    <th>-2.25</th>
    <th>-2.50</th>
    <th>-2.75</th>
    <th>-3.00</th>
    <th>-3.25</th>
    <th>-3.50</th>
    <th>-3.75</th>
    <th>-4.00</th>
    </thead>';
  $sql="select o.dui,rx.codigo,rx.od_esferas,rx.od_cilindros,rx.oi_esferas,rx.oi_cilindros from orden_lab as o INNER JOIN rx_orden_lab as rx on o.codigo=rx.codigo where laboratorio='Lenti' and o.estado='1' and o.tipo_lente='Visión Sencilla' and o.categoria='Terminado' and fecha between '2021-06-28' and '2021-07-10';";
  $sql=$conectar->prepare($sql);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

}

}

$passed = Array();
$graduacion = Array();
$graduacion_oi = Array();
$proof = new Pruebas();
$arr = $proof->getVisionSencilla();

foreach ($arr as $value) {
    array_push($passed, $value["codigo"]);
    array_push($graduacion, $value["od_esferas"]."*".$value["od_cilindros"]);
    array_push($graduacion_oi, $value["oi_esferas"]."*".$value["oi_cilindros"]);
}
$grad_res = Array();
$grad_res[] = (array_count_values($graduacion));
$grad_res_oi[] = (array_count_values($graduacion_oi));


$html="";
for ($i = 0; $i >= (-4); $i = $i - 0.25) {
    $html .="<tr class='fila'>";
    $esf  = number_format($i,2,".",","); 
    $html .= "<td class='stilot1'><b>".$esf."</b></td>";

   for ($j = 0; $j >= (-4); $j = $j - 0.25) {
     $cil = number_format($j,2,".",",");
     $param = $esf."*".$cil;
     //echo $param; exit();
     foreach ($grad_res as $value) {
       if(isset($value[$param])){
            $html .= "<td class='stilot1'>".$value[$param]."</td>";
       }else{
        $html .= "<td class='stilot1'>0</td>";
       }     
       }
        
   }
   $html .="</tr>";
}

////////////////////TABLA DOS

$html_dos="";
for ($i = 0; $i >= (-4); $i = $i - 0.25) {
    $html_dos .="<tr class='fila'>";
    $esf  = number_format($i,2,".",","); 
    $html_dos .= "<td class='stilot1'><b>".$esf."</b></td>";

   for ($j = 0; $j >= (-4); $j = $j - 0.25) {
     $cil = number_format($j,2,".",",");
     $param = $esf."*".$cil;
     //echo $param; exit();
     foreach ($grad_res_oi as $value) {
       if(isset($value[$param])){
            $html_dos .= "<td class='stilot1'>".$value[$param]."</td>";
       }else{
        $html_dos .= "<td class='stilot1'>0</td>";
       }     
       }
        
   }
   $html_dos .="</tr>";
}

?>

<script>
    function passedToArray(){
    let  passedArray = <?php echo json_encode($passed); ?>;
       
// Display the array elements
/*for(var i = 0; i < passedArray.length; i++){
    console.log(i+passedArray[i]);
  }
}*/
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button onClick="passedToArray();">CLICK</button>
    <table>
    <thead class="style_th bg-dark" style="color: black">
    <th>Esf/Add</th>
    <th>0.00</th>
    <th>-0.25</th>
    <th>-0.50</th>
    <th>-0.75</th>
    <th>-1.00</th>
    <th>-1.25</th>
    <th>-1.50</th>
    <th>-1.75</th>
    <th>-2.00</th>
    <th>-2.25</th>
    <th>-2.50</th>
    <th>-2.75</th>
    <th>-3.00</th>
    <th>-3.25</th>
    <th>-3.50</th>
    <th>-3.75</th>
    <th>-4.00</th>
    </thead>
    <tbody>
        <?php echo $html; ?>
    </tbody>
    </table>

<table>
    <thead class="style_th bg-dark" style="color: black">
    <th>Esf/Add</th>
    <th>0.00</th>
    <th>-0.25</th>
    <th>-0.50</th>
    <th>-0.75</th>
    <th>-1.00</th>
    <th>-1.25</th>
    <th>-1.50</th>
    <th>-1.75</th>
    <th>-2.00</th>
    <th>-2.25</th>
    <th>-2.50</th>
    <th>-2.75</th>
    <th>-3.00</th>
    <th>-3.25</th>
    <th>-3.50</th>
    <th>-3.75</th>
    <th>-4.00</th>
    </thead>
    <tbody>
        <?php echo $html_dos; ?>
    </tbody>
    </table>
</body>
</html>
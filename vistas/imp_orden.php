<?php ob_start();
use Dompdf\Dompdf;

require_once('../dompdf/autoload.inc.php');
require_once('../config/conexion.php');
require_once('../modelos/Reporteria.php');

$reporteria= new Reporteria;

$codigos = $_GET["orders"];
$array_codigos=explode(",", $codigos);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <style>
  html{
    margin-top: 2;
    margin-left: 8px;
    margin-right:8px; 
    margin-bottom: 0;
  }
  body{
    font-family: Helvetica, Arial, sans-serif;
    font-size: 11px;
  }
  .stilot1{
    border: 1px solid black;
    padding: 2.5px;
    font-size: 11px;
    font-family: Helvetica, Arial, sans-serif;
    text-align: center;

  }
  .table2 {
    border-collapse: collapse;
  }
  .encabezado{
    background: #E8E8E8;
  }
</style>
</head>
<body>
<?php
$html = "";
 for($i=0;$i<count($array_codigos);$i++){

    if($i % 2 == 0){
      $html .= "<tr>";
    }
    $item = $array_codigos[$i];
    $data = $reporteria->print_orden($item);
    $html .= "<td>".$data."</td>";

    if ($i % 2 != 0) {
      $html .= "</tr>";
    }
  }
  
?>
<table width="100%">
  <?php 
  echo $html;
  ?>
</table>
</body>
</html>

<?php
$salida_html = ob_get_contents();

ob_end_clean();
$dompdf = new Dompdf();
$dompdf->loadHtml($salida_html);
$dompdf->setPaper('letter', 'portrait');
$dompdf->render();
$dompdf->stream('document', array('Attachment'=>'0'));
?>
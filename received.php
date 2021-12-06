<html>
<body>
<p>
<?php 
$jArray = $_POST['hiddenF'];
//print_r($jArray); exit();
//$pArray = new Array( $jArray );
   foreach ( $pArray as $getArray ) {
   echo $getArray."<br>";
   }
?>
</p>
</body>
</html>
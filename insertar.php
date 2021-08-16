<link rel="stylesheet" href="rename.css">
<?php require "conexion.php";
require("inicio.html"); ?>
<body>
<?php
$cn = fnConectar( $msg );
if( !$cn ) {
    fnmensaje( "Error", $msg );
    echo "</body>";
    return;
}
$sql = "select valor from control where parametro = 'Departamento'";
$rs = $cn->query($sql);
$cont = $rs->fetch_assoc();
$cont =$cont["valor"];
$cont=$cont-14;
$sql = "update control set valor = valor + 1 where parametro = 'Departamento'";
$rpta= $cn->query($sql);
if( !$rpta ) {
fnmensaje( "Error", "No se puede generar el su código." );
say( "</body>" );
return;
}
$codigo = $cont ;
 $nom = $_POST["nombre"];
 $ubi = $_POST["ubic"];
 $sql = "insert into departamento(iddepartamento,nombre,idubicacion) values ( '$codigo','$nom','$ubi')";
 $rpta = $cn->query($sql);
 if(!$rpta){
 $msg = "Datos ingresados no son correctos.<br>";
 $msg .= "SQL: $sql";
 fnmensaje( "Error", $msg );
 say( "</body>" );
 return;
 }
 $msg = "Nuevo departamento registrado correctamente.<br>";
 $msg .= "Codigo Generado: $codigo<br>";
 fnmensaje( "Mensaje", $msg );
 echo "<a href='ejercicio02.php'>Nuevo Departamento</a>" ;
 
?>
<br><br>
<?php
require "pie.html";
?>
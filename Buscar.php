<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rename.css">
    <title>Document</title>
</head>
<?php 
require( "conexion.php" );
require("inicio.html"); ?>
<body>  
    <h1>Paginacion</h1>
    <h2>Listado de Departamento</h2>
    <?php
    $cn = fnConectar( $msg );
    if( !$cn ) {
        fnmensaje( "Error", $msg );
        echo "</body>" ;
        return;
    }
    $pagesize = 5; 
    $pageno = 1; 
    if( isset($_GET["pageno"]) ) {$pageno = $_GET["pageno"];}
    $dezp = ($pageno - 1) * $pagesize; 
    $sql = "select count(*) as total from departamento ";
    $rs = $cn->query($sql);
    $rows = $rs->fetch_assoc();
    $rows=$rows["total"];
    $pages = ceil( $rows / $pagesize );
    echo "Paginas: ";
    for( $i = 1; $i <= $pages; $i++ ) {
        if($i != $pageno) {
            $link = "<a href=' Buscar.php?pageno=$i'>$i</a>";
        } else {
            $link = $i;
        }
        echo $link . " " ;
    }
    $sql = "select iddepartamento,nombre, idubicacion from departamento limit $dezp, $pagesize";
    $rs = $cn->query($sql);
    echo "<table border='1' class='nuevatabla'>" ;
    echo "<tr>" ;
    echo "<th>Id Departamento</th>" ;
    echo "<th>Nombre</th>" ;
    echo "<th>Id Ubicacion</th>" ;
    echo "</tr>" ;

    while( $rec = $rs->fetch_assoc() ) {
        echo "<tr>" ;
        foreach ( $rec as $field ){
        echo "<td>$field</td>" ;
        }
        echo "</tr>" ;
        }
    
   ?>

</body>
<br>
<br>
<button onclick="location.href='http://localhost/prog_xamp/ejercicio02.php'" class="boton">Regresar...</button>
<br><br>
<?php
require "pie.html";
?>
</html>


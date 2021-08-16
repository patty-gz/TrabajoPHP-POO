<link rel="stylesheet" href="css01.css">
<?php 
require( "conexion.php" );
require("inicio.html"); ?>
<body>  
    <h1>Paginacion</h1>
    <h2>Listado de Empleados</h2>
    <?php
    $cn = fnConectar( $msg );
    if( !$cn ) {
        fnmensaje( "Error", $msg );
        echo "</body>" ;
        return;
    }
    $pagesize = 10; 
    $pageno = 1; 
    if( isset($_GET["pageno"]) ) {$pageno = $_GET["pageno"];}
    $dezp = ($pageno - 1) * $pagesize; 
    $sql = "select count(*) as total from empleado ";
    $rs = $cn->query($sql);
    $rows = $rs->fetch_assoc();
    $rows=$rows["total"];
    $pages = ceil( $rows / $pagesize );
    echo "Paginas: ";
    for( $i = 1; $i <= $pages; $i++ ) {
        if($i != $pageno) {
            $link = "<a href=' ejercicio01.php?pageno=$i'>$i</a>";
        } else {
            $link = $i;
        }
        echo $link . " " ;
    }
    $sql = "select idempleado, apellido, nombre, email from empleado limit $dezp, $pagesize";
    $rs = $cn->query($sql);
    echo "<table border='1' class='nuevatabla'>" ;
    echo "<tr>" ;
    echo "<th>Código</th>" ;
    echo "<th>Apellido</th>" ;
    echo "<th>Nombre</th>" ;
    echo "<th>Email</th>" ;
    echo "</tr>" ;

    while( $rec = $rs->fetch_assoc() ) {
        $i=1;
        echo "<tr>" ;
        foreach ( $rec as $field ){
            if($i==1){
                echo "<td><a href='modificar.php?codigo=$field'>$field</a></td>" ;
            }
            else{
                echo "<td>$field</td>" ;
            }
            $i++;

        }
    
        echo "</tr>" ;
    }
    
   ?>
   
</body>
<?php
require "pie.html";
?>
<link rel="stylesheet" href="rename.css">
<?php 
require "conexion.php"; 
require "inicio.html";?>
<body>
<?php
$cn = fnConectar( $msg );
if( !$cn ) {
    fnmensaje( "Error", $msg );
    echo "</body>";
    return;
}
?>
<h1>Nuevo Departamento</h1>
<form method="POST" action="insertar.php">
    <table border='1' class="nuevatabla">
        <tr>
            <td> Nombre </td>
            <td> <input type="text" name="nombre"> </td>
        </tr>
        <tr>
            <td> Ubicacion </td>
            <td> 
                <select name="ubic" id="ubic" size="1" >
                    <option value="">Seleccione...</option>
                    <?php
                    $sql = "select distinct idubicacion,ciudad,direccion from rh.vista_dep_ubic;";
                    $rs = $cn->query($sql);
                    while( $row = $rs->fetch_assoc() ) 
                    {
                        echo "<option value='" . $row["idubicacion"] . "'>"." ( ". $row["ciudad"]." )    ".$row["direccion"] . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
    
        <tr>
            <br>
            <td colspan="2" align="center">
                
                <br>
                <input type="reset" name="reset" value="Limpiar" class="boton">
                <input type="submit" value="Enviar" class="boton">
                <br>
                <br>
            </td>
        </tr>
    </table>
</form>
<button onclick="location.href='http://localhost/prog_xamp/Buscar.php'" class="boton">Ver tabla departamento</button>
</body>
<?php
require "pie.html";
?>

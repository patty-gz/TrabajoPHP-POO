<link rel="stylesheet" href="css01.css">
<?php 
require("inicio.html");
require "conexion.php"; ?>
<body>
<?php
$cn = fnConectar( $msg );
if( !$cn ) {
    fnmensaje( "Error", $msg );
    echo "</body>";
    return;
}
echo "<h1>Modificar empleado</h1>" ;
if( !isset($_POST["seguro"])) {
    $cod=$_GET['codigo'];
    $sql = "select apellido, nombre,email,telefono,idcargo,iddepartamento,sueldo, comision from empleado where idempleado='$cod'";
    $rs = $cn->query($sql);
    while( $row = $rs->fetch_assoc() ) {
        $iddep=$row["iddepartamento"];
        $idcargo=$row["idcargo"];
        $ape=$row["apellido"];
        $nom=$row["nombre"];
        $email=$row["email"];
        $tell=$row["telefono"];
        $sueldo=$row["sueldo"];
        $comm=$row["comision"];
    }

    $sql = "select NombreCargo, Departamento from rh.vista_cargo_empl where IdCargo ='$idcargo' and IdDep = '$iddep';";
    $rs = $cn->query($sql);
    while( $row = $rs->fetch_assoc() ) {
        $ncargo=$row["NombreCargo"];
        $departament=$row["Departamento"];
    }
    ?>
    <form method="POST" action="modificar.php" id="miForm">
    
        <table width="300" border='1' class="nuevatabla">
            <tr>
                <td> Codigo </td>
                <td><?php echo $cod; ?></td>
                <input type="text" hidden="" name="id" value='<?php echo $cod;?>'>
            </tr>
            <tr>
                <td> Apellido </td>
                <td> <input type="text" name="apellido"  value="<?php echo $ape;?>"> </td>
            </tr>
            <tr>
                <td> Nombre </td>
                <td> <input type="text" name="nombre"  value='<?php echo $nom; ?>'> </td>
            </tr>
            <tr>
                <td> Email </td>
                <td> <input type="text" name="email"  value='<?php echo $email; ?>'> </td>
            </tr>
            <tr>
                <td> Telefono </td>
                <td> <input type="text" name="telefono"  value='<?php echo $tell; ?>'> </td>
            </tr>
            <tr>
                <td> Departamento </td>
                <td> 
                    <select name="dept" size="1">
                        <?php
                        $sql = "select iddepartamento, nombre from departamento where iddepartamento in (select distinct iddepartamento from empleado)";
                        $rs = $cn->query($sql);
                        while( $row = $rs->fetch_assoc() ) 
                        {
                            echo "<option value='" . $row["iddepartamento"] . "'>" . $row["nombre"] . "</option>";
                        }
                        ?>
                    </select> 
                    <?php echo $departament ?>
                </td>
            </tr>
            <tr>
                <td> Cargo </td>
                <td>
                    <select name="cargo" size="1">
                        <?php
                        $sql = "select idcargo, nombre from cargo where idcargo not in ('C01', 'C02')";
                        $rs = $cn->query($sql);
                        while( $row = $rs->fetch_assoc() ) {
                            $op = "<option value='" . $row["idcargo"] . "'>";
                            $op .= $row["nombre"] . "</option>";
                            echo $op ;
                        }
                        ?>
                        </select>
                        <?php echo $ncargo ?>
                    </td>
                </tr>
                <tr>
                <td> Sueldo </td>
                <td> <input type="text" name="sueldo" value=<?php echo $sueldo; ?>> </td>
            </tr>
            <tr>
                <td> Comision </td>
                <td> <input type="text" name="comision" value=<?php echo $comm; ?>> </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align:center;">
                    <br>
                    
                    <input type="hidden" name="seguro" value="12345">
                    <input type="reset" name="reset" value="Reset" class="boton" >
                    <input type="submit" value="Enviar" class="boton">
                    <input type="button" onclick="history.back()" name="volver atrás" value="volver atrás"class="boton">
                    <br>
                    <br>
                </td>
        </table>
    </form>
    <?php
} 
else {
    
    $codigo = $_POST["id"];
    $ape = $_POST["apellido"];
    $nom = $_POST["nombre"];
    $email = $_POST["email"];
    $tel = $_POST["telefono"];
    $cargo = $_POST["cargo"];
    $dept = $_POST["dept"];
    $sueldo = $_POST["sueldo"];
    $comm = $_POST["comision"];
    $sql = "select idempleado from empleado where iddepartamento ='$dept'and idcargo in ( 'C01', 'C02' )";
    $rs = $cn->query($sql );
    $rows = $rs->num_rows;
    if( $rows != 1 ) {
        fnmensaje( "Error", "No se pudo determinar el Jefe." );
        say( "</body>" );
        return;
    }
    $jefe=$rs->fetch_assoc();
    $jefe = $jefe["idempleado"];
    $sql="update rh.empleado set apellido = '$ape', nombre = '$nom',fecingreso =curdate(), email = '$email', telefono = '$tel', idcargo = '$cargo', iddepartamento = '$dept', sueldo = '$sueldo', comision = '$comm', jefe = '$jefe' WHERE (idempleado = '$codigo');";
    $rpta = $cn->query($sql);
    if(!$rpta){
        $msg = "Datos ingresados no son correctos.<br>";
        $msg .= "SQL: $sql";
        fnmensaje( "Error", $msg );
        say( "</body>" );
        return;
    }
    $msg = "Datos del empleados se han modificados correctamente.<br>";
    fnmensaje( "Mensaje", $msg );
    echo "<a href='ejercicio01.php'>Volver...</a>" ;
}
require "pie.html";
?>
</body>

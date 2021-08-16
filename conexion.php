<?php 
function fnConectar( &$msg)
{
$cn = new mysqli("localhost:3307", "Patty", "82465","rh");
if(!$cn){
$msg = "Error en la conexion";
return 0;
}
return $cn;
}
function fnmensaje($title,$msg){
 echo "<table width='250'>";
 echo "<tr>";
 echo "<th align=center valign=middle>$title</th>";
 echo "</tr>";
 echo "<tr>";
 echo "<td align=left valign=middle>".$msg."</td>"; 
 echo "</tr>";
 echo "</table>";
}
?>
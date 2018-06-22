<?php virtual('/p8/Connections/Conexion_p8.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_Consultas_usu = 10;
$pageNum_Consultas_usu = 0;
if (isset($_GET['pageNum_Consultas_usu'])) {
  $pageNum_Consultas_usu = $_GET['pageNum_Consultas_usu'];
}
$startRow_Consultas_usu = $pageNum_Consultas_usu * $maxRows_Consultas_usu;

mysql_select_db($database_Conexion_p8, $Conexion_p8);
$query_Consultas_usu = "SELECT * FROM usuarios";
$query_limit_Consultas_usu = sprintf("%s LIMIT %d, %d", $query_Consultas_usu, $startRow_Consultas_usu, $maxRows_Consultas_usu);
$Consultas_usu = mysql_query($query_limit_Consultas_usu, $Conexion_p8) or die(mysql_error());
$row_Consultas_usu = mysql_fetch_assoc($Consultas_usu);

if (isset($_GET['totalRows_Consultas_usu'])) {
  $totalRows_Consultas_usu = $_GET['totalRows_Consultas_usu'];
} else {
  $all_Consultas_usu = mysql_query($query_Consultas_usu);
  $totalRows_Consultas_usu = mysql_num_rows($all_Consultas_usu);
}
$totalPages_Consultas_usu = ceil($totalRows_Consultas_usu/$maxRows_Consultas_usu)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table border="1">
  <tr>
    <td>id_usuarios</td>
    <td>nombre_usuario</td>
    <td>apellido_usuario</td>
    <td>foto</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Consultas_usu['id_usuarios']; ?></td>
      <td><?php echo $row_Consultas_usu['nombre_usuario']; ?></td>
      <td><?php echo $row_Consultas_usu['apellido_usuario']; ?></td>
      <td><?php echo $row_Consultas_usu['foto']; ?></td>
    </tr>
    <?php } while ($row_Consultas_usu = mysql_fetch_assoc($Consultas_usu)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Consultas_usu);
?>

<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Conexion_p8 = "localhost";
$database_Conexion_p8 = "bd_p8";
$username_Conexion_p8 = "root";
$password_Conexion_p8 = "";
$Conexion_p8 = mysql_pconnect($hostname_Conexion_p8, $username_Conexion_p8, $password_Conexion_p8) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
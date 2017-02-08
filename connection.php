<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "projeto";
$con = mysql_connect($servidor, $usuario, $senha);

if (!$con)
{
  echo "Falha em conectar no servidor";	
}
else
{
	
 $db = mysql_select_db($banco);
}



?>
<?php
session_start();
$gmtDate = gmdate("D, d M Y H:i:s"); 
header("Expires: {$gmtDate} GMT"); 
header("Last-Modified: {$gmtDate} GMT"); 
header("Cache-Control: no-cache, must-revalidate"); 
header("Pragma: no-cache");

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "projeto";


$usuarioLogar = $_GET['usuario'];
$senhaLogar = $_GET['senha'];




$con = mysql_connect($servidor, $usuario, $senha);
if (!$con)
{
  echo "Falha em conectar no servidor";	
}
else
{
	
 $db = mysql_select_db($banco);

}
   $insertsql = '';
   $flag = 0;
   $sql = "select * from cliente";
   $result= mysql_query($sql) or die(mysql_error());
   
    while($row = mysql_fetch_array($result)){
	   $codigo = $row['idCliente'];
	   $usuarioQuery = $row['usuario'];
	   $emailQuery = $row['email'];
	   $senhaQuery = $row['senha'];
	   
	   if (($usuarioLogar == $usuarioQuery) || ($usuarioLogar == $emailQuery))
	   {
		   if ($senhaLogar == $senhaQuery)
		   {
			   $flag = 1;
			   $_SESSION['idCliente'] = $codigo;
		   }
		   
	   }
	  
	}
   
   if ($flag == 1)
   {
   
   $_SESSION['user'] = $usuarioLogar;
   $_SESSION['idUserSession'] = $_SESSION['user'] . rand();
   
   
   ?>
   <div style="font-style:inherit; color:#F00; font-size:10px; text-align:center" ><?php echo 'Usuário logado'; ?>
   <?php
   }
   ?>
   <?php 
   if($flag == 0)
   {
   ?>   
   
    <div style="font-style:inherit; color:#F00; font-size:20px; text-align:center" ><?php echo 'Usuário ou senha invalido!'; ?>
   



<?php
   }
mysql_close($con);
echo "<meta HTTP-EQUIV='refresh' CONTENT='1;URL=index.php'>";
?>
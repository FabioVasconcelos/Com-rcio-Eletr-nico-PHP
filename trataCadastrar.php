<?php
$gmtDate = gmdate("D, d M Y H:i:s"); 
header("Expires: {$gmtDate} GMT"); 
header("Last-Modified: {$gmtDate} GMT"); 
header("Cache-Control: no-cache, must-revalidate"); 
header("Pragma: no-cache");

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "projeto";


$usuarioCadastrar = $_GET['usuario'];
$senhaCadastrar = $_GET['senha'];
$emailCadastrar = $_GET['email'];



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
	   $usuarioQuery = $row['usuario'];
	   $emailQuery = $row['email'];
	   
	   if ($usuarioCadastrar == $usuarioQuery)
	   {
		   echo '<br><div style="font-style:inherit; color:red; font-size:17px; text-align:center" >Este usuário já está cadastrado no sistema</div>';
		   $flag = 1;
	   }
	   else if ($emailCadastrar == $emailQuery)
	   {
		   echo '<br><div style="font-style:inherit; color:red; font-size:17px; text-align:center" >Este email já está cadastrado no sistema</div>';
		   $flag = 1;
	   }
	   else
	   {
		   
	   }
	}
   
   if ($flag == 0)
   {
   
   $insertsql = "INSERT INTO cliente (usuario, email, senha) VALUES ('" . $usuarioCadastrar . "', '" . $emailCadastrar . "', ' " . $senhaCadastrar . "')";
   mysql_query($insertsql);
   
   ?> <div style="font-style:inherit; color:#060; font-size:20px; text-align:center" ><?php echo 'Cadastro efetuado!'; ?>
   

<div style="font-style:inherit; color:#060; font-size:17px; text-align:center" >Agora basta acessar o sistema e aproveitar as incríveis ofertas!</div>

<?php
   }
mysql_close($con);
?>
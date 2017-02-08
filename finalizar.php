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
$con = mysql_connect($servidor, $usuario, $senha);
if (!$con)
{
  echo "Falha em conectar no servidor";	
}
else
{	
 $db = mysql_select_db($banco);
}



function cadastraPedido()
{
	$idCliente = $_SESSION['idCliente'];
	$sql = "INSERT INTO pedido (dataPedido, idCliente) VALUES ('" . date('Y/m/d') . "' , " . $idCliente . ")";
	mysql_query($sql);
}



function pegaIdPedido()
{
     $sql = "SELECT max(idPedido) as id FROM pedido";
	 $result= mysql_query($sql) or die(mysql_error());
	      
   if($row = mysql_fetch_array($result)){
	   $codigo = $row['id'];
   }
   return $codigo;
}

cadastraPedido();

function pegaQuantidade($idProduto)
{

   $sql = "SELECT * FROM produto where idProduto = " . $idProduto;
   $result= mysql_query($sql) or die(mysql_error());
	      
   if($row = mysql_fetch_array($result)){
	   $quantidade = $row['quantidade'];
   }
   return $quantidade;
}
	
function cadastraItemPedido()
{
	if (isset($_SESSION['idUserSession']))
	{
		
	   $sql = "SELECT * FROM carrinho where sessao = '" . $_SESSION['idUserSession'] . "'";
	   $result= mysql_query($sql) or die(mysql_error());

  
       $idPedido = pegaIdPedido();
       while($row = mysql_fetch_array($result))
	   {
	   $nome = $row['nome'];
	   $codigo = $row['codProduto'];
	   $preco = $row['preco'];
	   $quantidade = $row['qtd'];
	   $quantidadeProduto = pegaQuantidade($codigo);
	   $updateqtd = (int)$quantidadeProduto - (int)$quantidade;
	   
	   if ($updateqtd >= 0)
	   {
	   
	   $sqlInsert = "INSERT INTO itempedido	(preco, quantidade, idProduto, idPedido) VALUES
	   (" .$preco. " , " .$quantidade. " , " .$codigo . " , " .$idPedido. ")"; 	   
	   mysql_query($sqlInsert);	   
	   $sqlUpdate = "UPDATE produto SET quantidade = " .$updateqtd. " WHERE idProduto = " .$codigo;
	   mysql_query($sqlUpdate);
	   
	   echo "<div style='font-style:inherit; color:green; font-size:15px; text-align:center'>Pedido do produto "  . $nome . " realizado!";
	   }
	   else
	   {
		   echo "<div style='font-style:inherit; color:red; font-size:15px; text-align:center'>Não há estoque para o produto "  . $nome; 
	   }
	   }
	   
	   	   
   }
}
cadastraItemPedido();  
mysql_close($con);

	


?>
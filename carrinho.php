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
			
$idproduto = $_GET['idproduto'];
$acao = $_GET['acao'];

function pegaQuantidade($idProduto)
{

   $sql = "SELECT * FROM produto where idProduto = " . $idProduto;
   $result= mysql_query($sql) or die(mysql_error());
	      
   if($row = mysql_fetch_array($result)){
	   $quantidade = $row['quantidade'];
   }
   return $quantidade;
}

function view()
{
  if (isset($_SESSION['fezCompras']))
  {	
   if($_SESSION['fezCompras'] == 'true')
   {
    $sqlMeuCarrinho = "SELECT * FROM carrinho WHERE  sessao = '".$_SESSION['idUserSession']."' ORDER BY nome ASC";
    $execMeuCarrinho =  mysql_query($sqlMeuCarrinho);
    $qtdMeuCarrinho = mysql_num_rows($execMeuCarrinho);
   
     if ($qtdMeuCarrinho > 0)
     {
  	 $somaCarrinho = 0;
  	 $resultsqlMeuCarrinho= mysql_query($sqlMeuCarrinho) or die(mysql_error());	
	 
     echo '<table>';
	 echo '<tr>';
	 echo '<th>Código:</th>';
	 echo '<th>Nome:</th>';
	 echo '<th>Preço:</th>';
	 echo '<th>Quantidade</th>';
     echo '<th></th>';
     echo '</tr>';
    
	
	 }
	 
	 
	 while($rowMeuCarrinho = mysql_fetch_array($execMeuCarrinho))
	 {
	   $codigoProdutoRow = $rowMeuCarrinho['codProduto']; 
	   $quantidadeProduto = (int)pegaQuantidade($codigoProdutoRow);
	   	   
	   $nomeProdutoRow = $rowMeuCarrinho['nome'];
	   $precoProdutoRow = $rowMeuCarrinho['preco'];
	   $quantidadeProdutoRow = $rowMeuCarrinho['qtd'];
	   	   
	   if ($quantidadeProduto == 0)
	   {
		   echo "<div style='font-style:inherit; color:red; font-size:15px; text-align:center'>Não há estoque para o produto: " . $nomeProdutoRow . "</div>";
	   }
	   else
	   {
	   $somaCarrinho += ($rowMeuCarrinho['preco'] * $rowMeuCarrinho['qtd']);	   
	   echo "<tr>";
	   echo '<td>'.$codigoProdutoRow.'</td>';	   
	   echo '<td>'.$nomeProdutoRow.'</td>';	 
	   echo '<td>'.$precoProdutoRow.'</td>';	 
	   echo '<td>'.$quantidadeProdutoRow.'</td>';
	   echo "</tr>";
	   }
     }	
	echo '</table>'; 
		
	echo "<div style='font-style:inherit; color:blue; font-size:15px; text-align:center'>Valor total: " . $somaCarrinho . "</div>";
    }
   }


}
function add($idproduto)
{
	
if ($idproduto != '')
{
 if (is_numeric($idproduto))
   {
						
      $queryCarrinho = "SELECT * FROM carrinho WHERE carrinho.sessao = '".$_SESSION['idUserSession']."'";
	  $rsCarrinho = mysql_query($queryCarrinho);
	  $rowCarrinho = mysql_fetch_assoc($rsCarrinho);
	  $totalRowsCarrinho = mysql_num_rows($rsCarrinho);
			
	  $queryQuantidade = "SELECT * FROM carrinho WHERE carrinho.codProduto = ".$idproduto." and carrinho.sessao = '".$_SESSION['idUserSession']."'";
			
	  $rsQuantidade = mysql_query($queryQuantidade);
	  $rowQuantidade = mysql_fetch_assoc($rsQuantidade);
	  $totalRowQuantidade = mysql_num_rows($rsQuantidade);
			
	  if ($totalRowsCarrinho == 0)
	  {	
		$_SESSION['fezCompras'] = 'false';
	  }
	  else
	  {
		$_SESSION['fezCompras'] = 'true';
	  }
	  $querySql = 'select * from produto where idProduto = ' . $idproduto;
	  $rsProduto = mysql_query($querySql);
	  $rowProduto = mysql_fetch_assoc($rsProduto);
	  $totalRowsProduto = mysql_num_rows($rsProduto);
				
      if($totalRowsProduto > 0)
	  {
		$rsProduto = mysql_fetch_assoc($rsProduto);
		if ($totalRowQuantidade == 0)
		{
		   $addSql = "INSERT INTO carrinho (codProduto, nome, preco, qtd, sessao) 
					 VALUES (".$rowProduto['idProduto'].",'".$rowProduto['nome']."','".$rowProduto['preco']."','1','".$_SESSION['idUserSession']."')";
		}
		else
		{	
		   $rsQuantidade = mysql_fetch_assoc($rsQuantidade);
		   $varadd = (int)$rowQuantidade['qtd'] + 1;
		   $quantidadeProduto = (int)pegaQuantidade($rowProduto['idProduto']);
		   if ($quantidadeProduto > 0)
		   {			
		   $addSql = "UPDATE carrinho SET qtd = 	" . $varadd . " where carrinho.codProduto = " . $rowQuantidade['codProduto'] . " and carrinho.sessao = '".$_SESSION['idUserSession']."'";
		   }
		   else
		   {
			   exit('não há estoque disponível');
			   
		   }
		}
		   $rsProdutoAdd = mysql_query($addSql);
		   
		   $_SESSION['fezCompras'] = 'true';
		   view();
 
	}
}
			
}	

}

if (isset($_SESSION['idUserSession']))
{

 if ($acao == 'add')
 {
    add($idproduto);
 }
}

if (isset($_SESSION['fezCompras']))
{
	 if($_SESSION['fezCompras'] == 'true')
	 {
	   
       if ($acao == 'listar')
       {
	    view();
       }
	  
	   ?>
	   <br />
       <br />
       <br />
       <br />
       <br />
       <div style="text-align:center">
       <a href="#" onClick="finalizar();"><img src="img/finalizar.png"/></a></div>
       <?php
	 }
}
 else
	   {   
	     echo "<div style='font-style:inherit; color:red; font-size:15px; text-align:center'>carrinho vazio</div>";   
	   }
 ?>


<?php
if (!isset($_SESSION['idUserSession']))
{
echo "<div style='font-style:inherit; color:red; font-size:15px; text-align:center'>É necessário fazer login</div>";
echo "<meta HTTP-EQUIV='refresh' CONTENT='2';URL=index.php'>";
}
?>	
<?php
$gmtDate = gmdate("D, d M Y H:i:s"); 
header("Expires: {$gmtDate} GMT"); 
header("Last-Modified: {$gmtDate} GMT"); 
header("Cache-Control: no-cache, must-revalidate"); 
header("Pragma: no-cache");


$busca = $_GET['palavra'];



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

    $sql = "select * from produto where nome like '%"  .$busca. "%'";

  
   
   $result= mysql_query($sql) or die(mysql_error());

  
   ?>
   
    <table>
	<tr>
	 <th>Código:</th>
	 <th>Nome:</th>
	 <th>Preço:</th>
	 <th>Quantidade</th>
     <th></th>
    </tr>
	
    
    <?php
   
   while($row = mysql_fetch_array($result)){
	   $codigo = $row['idProduto'];
	   $nome = $row['nome'];
	   $preco = $row['preco'];
	   $quantidade = $row['quantidade'];
	   $imgUrl = $row['imgUrl'];
	   $descricao = $row['descricao'];
	   
	     echo "<tr>";
		 
		 
	     //echo "<td ><img src='" . $imgUrl . "'></td>";
         
		
	     echo '<td>'.$codigo.'</td>';	   
	   	 echo '<td>'.$nome.'</td>';	 
		 echo '<td>'.$preco.'</td>';	 
		 echo '<td>'.$quantidade.'</td>';
		 echo "<td><a href='#' onClick='obtemInfoDetalhes(".$codigo.");' style='text-decoration:none'>Ver detalhes</a></td>";	 
	   
	
	   echo "</tr>";
   }
   
   echo "</table>";
mysql_close($con);

?>
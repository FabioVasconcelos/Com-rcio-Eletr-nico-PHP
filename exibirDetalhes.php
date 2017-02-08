<?php
$gmtDate = gmdate("D, d M Y H:i:s"); 
header("Expires: {$gmtDate} GMT"); 
header("Last-Modified: {$gmtDate} GMT"); 
header("Cache-Control: no-cache, must-revalidate"); 
header("Pragma: no-cache");

$codigo = $_GET['idproduto'];
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

   $sql = 'select * from produto where idProduto = ' . $codigo;
  
  
   
   $result= mysql_query($sql) or die(mysql_error());
  while($row = mysql_fetch_array($result)){
	   
	   $nome = $row['nome'];
	   $preco = $row['preco'];
	   $quantidade = $row['quantidade'];
	   $imgUrl = $row['imgUrl'];
	   $descricao = $row['descricao'];
  }
 
?>

		<div class="span-7 colborder">
        <img src="<?php echo $imgUrl;?>" width="250" height="250">
		
		</div>
        
        
        <div class="span-10 last">
        
        <div style="font-style:inherit; color:green; font-size:x-large; text-align:left"><?php echo $nome?></div>
        <p></p>
        
        <div style="font-style:inherit; color:#900; font-size:large; text-align:left" >Preço: R$ <?php echo $preco?></div>
        <div style="font-style:inherit; color:#CCC; text-align:left">Quantidade disponível: <?php echo $quantidade?></div>
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <div style="text-align:center"><a href="#" onClick="addCarrinho('<?php echo $codigo ?>', 'add');"><img src="img/comprar.jpg" /></a></div>
        </div>
        
        <div class="span-17 last">
        <div style="font-style:inherit; color:green; font-size:20px; text-align:left">Descrição</div><br /><br />
        
        <p style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:15px"><?php echo $descricao?></p>
        </div>
<?php
 mysql_close($con);
?>
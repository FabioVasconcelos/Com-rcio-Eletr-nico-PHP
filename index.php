<?php
session_start();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Vídeo aulas Eletrofabio</title>

 <link rel="stylesheet" href="css/screen.css" type="text/css" media="screen, projection">

  <script type="application/javascript" src="js/bibliotecaAjax.js"></script>
  
 
  <script type="application/javascript" src="trataBuscar.js"></script>
  <script type="application/javascript" src="trataCategoria.js"></script>
  <script type="application/javascript" src="exibirDetalhes.js"></script>
  <script type="application/javascript" src="cadastrar.js"></script>
  <script type="application/javascript" src="trataCadastrar.js"></script>
  <script type="application/javascript" src="login.js"></script>
  <script type="application/javascript" src="logout.js"></script>
  <script type="application/javascript" src="trataLogin.js"></script>
  <script type="application/javascript" src="carrinho.js"></script>
  <script type="application/javascript" src="finalizar.js"></script>
</head>

<body>
  <div class="container">
   
    
     <div class="span-8 ">
     
     	    <img src="img/logo_eletrofabio2012.jpg"/>	
     </div>
     
     <div class="span-14 last">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <?php		
		if (!isset($_SESSION['user']))
		{
		?>
        <div class="span-2 colborder ">
          <a href="#" onClick="cadastrar();"> <img src="img/buttonCadastrar.gif"></a>
	    </div>
		
        <?php	
		}
		if (!isset($_SESSION['user']))
		{
		?>
        <div class="span-2 colborder ">
        <a href="#" onClick="login();"><img src="img/bt_acessar.png"></a>
        </div>
        <?php 
		}
		?>
        <div class="span-2 colborder">
        <a href="#" onClick="addCarrinho('null', 'listar');"> <img src="img/carrinho.jpg"></a>
        </div>
        <?php
		
               	
		if (isset($_SESSION['user']))
		{
		?>
        <div class="span-3 colborder last">
          <div style="font-style:inherit; color:green; font-size:15px" id="nome" name="nome">

		<?php
			echo 'Olá ' . $_SESSION['user'] . ' <span style="font-style:inherit; color:blue; font-size:15px"><a href="#"onClick="abandonarSessao();" style="text-decoration:none">(sair)</a></span>';
        ?>
          </div>
        </div>  
        <?php
		}
		?>
     </div> 

      <hr>
      <div class="span-4 " style="background-color: #FAF9FF">
       <?php	  
       $servidor = "localhost";
       $usuario = "root";
       $senha = "";
       $banco = "projeto";
       $con = mysql_connect($servidor, $usuario, $senha);
       ?>

<h3 style="color:#090">Categorias</h3>

<?php
if (!$con)
{
  echo "Falha em conectar no servidor";	
}
else
{
	
 $db = mysql_select_db($banco);
}
   
   $sql = "select * from categoria";   
   $result= mysql_query($sql) or die(mysql_error());   
   echo "<table>";   
   while($row = mysql_fetch_array($result)){
	   echo "<tr>";
	   echo "<td style='color:#33C'>";
	   $id = $row['idCategoria'];
	   $descricao = $row['descricao'];
	   echo "<a href='#' onClick='obtemInfoCategoria(".$id.")' style='text-decoration:none'>" . $descricao  ."</a>";
	   echo "</td>";
	   echo "</tr>";
   }   	
   echo "</table>";
mysql_close($con); 
?>

      <br>
      <h3 style="color:#090">Buscar</h3>
      <form action="javascript:void%200">
<p align="center"><input name="palavra" id="palavra" type="text"></p>      
      </div>
      <div class="span-18 last" id="lista" name="lista">   
        
      </div>
      <hr>
      <hr class="space">
</div>
</body>
</html>
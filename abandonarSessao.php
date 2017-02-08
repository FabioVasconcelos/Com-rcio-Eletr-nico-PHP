<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['idUserSession']);
unset($_SESSION['fezCompras']);
unset($_SESSION['idCliente']);
session_destroy();
echo "<meta HTTP-EQUIV='refresh' CONTENT='1;URL=index.php'>";
?>
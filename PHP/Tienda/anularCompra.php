<?php 

session_start();
unset($_SESSION["cesta"]);
sleep(2);
header("Location:clientes.php");

?>
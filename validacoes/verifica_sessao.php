<?php  
session_start();
if(!isset($_SESSION['nick'])){
	header("Location: index.php?msg=2"); // Você não está autenticado para acessar este chat
	exit;
}
$nick = $_SESSION['nick'];
?>
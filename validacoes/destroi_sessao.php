<?php 
include "../banco/conecta_banco.php";
$id = $_POST['id'];
$nick = $_POST['nick'];
$deleta = $_GET['deleta'];
//Destroi a sessão atual
session_start();
unset($_SESSION['nick']);
//Deleta o usuario do banco de dados
$sql = "DELETE FROM tb_usuario WHERE id_chat = $id AND nick = '$nick';";
$con->query($sql);
if($deleta == '2'){	
	$sql = "DELETE FROM tb_msg WHERE id_chat = $id;";
	$con->query($sql);
	$sql = "DELETE FROM tb_chat WHERE id_chat = $id;";
	$con->query($sql);
}
header("Location: ../index.php");
?>
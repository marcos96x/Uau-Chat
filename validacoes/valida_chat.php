<?php  
include "../banco/conecta_banco.php";
$id = $_GET['id']; // id da sala
$nick = $_GET['nick'].trim(); // nick do user

//Vejo se já existe um integrante com o mesmo nick
$sql = "SELECT * FROM tb_usuario WHERE id_chat = $id AND nick = '$nick'";
$res = $con->query($sql);
if($res->num_rows > 0){
	header("Location: ../index.php?msg=1"); // Se ja existe alguem na sala com esse newt_listbox_set_current_by_key(listbox, key)
	exit;
}
//Insere
$sql = "INSERT INTO tb_usuario VALUES('$nick', $id);";
$res = $con->query($sql);
// Seta a sessão com o nick do usuario 
session_start();
$_SESSION['nick'] = $nick;
header("Location: ../chat.php?id=$id");

?>
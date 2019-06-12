<?php 
include "../banco/conecta_banco.php";

$titulo = trim($_POST['titulo']);
$nick = trim($_POST['nick']);
// Insere um novo chat com o nome passado
$sql = "INSERT INTO tb_chat VALUES (DEFAULT, '$titulo');";
$con->query($sql);
//Saber o id do chat criado pra poder ja colocar ele no chat
$sql = "SELECT * FROM tb_chat ORDER BY id_chat DESC LIMIT 1;";
$res = $con->query($sql);
$res2 = $res->fetch_row();
$id = $res2[0];
//Ja insere o usuario no chat
$sql = "INSERT INTO tb_usuario VALUES ('$nick', $id);";
$res = $con->query($sql);
//Inicio a sessão
session_start();
$_SESSION['nick'] = $nick;
//Mando ele direto pro chat
header("Location: ../chat.php?id=$id");
$con->close();
?>
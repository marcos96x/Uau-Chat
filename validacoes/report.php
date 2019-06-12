<?php  
require_once "../banco/conecta_banco.php";
require_once "../validacoes/verifica_sessao.php";
//Recebe o nick do jogador a receber report
$nick_report = $_GET['nick'];
//Recebe o id da sala 
$sala = $_GET['id'];
//Verifica se o usuario ja reportou o individuo
$sql = "SELECT * FROM tb_report WHERE id_chat = $sala AND nick_report = '$nick_report' AND nick_reportador = '$nick'";
$res = $con->query($sql);
$qt_reports_feitos = $res->num_rows;
if($qt_reports_feitos > 0){
	header("Location: ../chat.php?msg=3&id=$sala");
	exit;
}
//Se nao reportou, faz o report
$sql = "INSERT INTO tb_report VALUES ($sala, '$nick_report', '$nick')";
$res = $con->query($sql);
//Verifica se tem mais que 5 reports
$sql = "SELECT * FROM tb_report WHERE id_chat = $sala AND nick_report = '$nick_report'";
$res = $con->query($sql);
$qt_reports = $res->num_rows;
if($qt_reports > 5){
	//Se tiver, deleta o nick reportado do banco
	$sql = "DELETE FROM tb_report WHERE id_chat = $sala AND nick_report = '$nick_report';";
	$res = $con->query($sql);
	$sql = "DELETE FROM tb_usuario WHERE id_chat = $sala AND nick = '$nick_report';";
	$res = $con->query($sql);
	
	header("Location: ../chat.php?msg=1&id=$sala");
	exit;
}else{
	//Se tiver menos que 5 reports
	header("Location: ../chat.php?msg=2&id=$sala");
	exit;
}

?>
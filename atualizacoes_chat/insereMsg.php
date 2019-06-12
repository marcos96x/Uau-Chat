<?php 
	if(count($_POST) > 0){
		include "../banco/conecta_banco.php";

		$mensagem = $_POST['mensagem']; // mensagem de status
		$id = trim($_POST['id']); // id do chat
		$nick = $_POST['nick']; // nick do usuario
		$hr = date("Y-j-m g:i:s"); // Hora que a msg foi enviada
		// Insere
		if($mensagem != ""){
			$sql = "INSERT INTO tb_msg VALUES (default, '$mensagem', '$nick', '$hr', $id);";
			$res = $con->query($sql);
		}				
	}
?>
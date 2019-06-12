	<?php  
	require_once "../banco/conecta_banco.php";
	//Lista todos os chats abertos
	//Exibe quantos chats tem online
	$sql = "SELECT * FROM tb_chat;";
	$res = $con->query($sql);
	$dados_chats = $res->fetch_all();
	$qt_chat = $res->num_rows;						
	//Lista todos os nomes dos chats abertos e quantos tem na sala
	if($qt_chat > 0){
		for($i = 0; $i < $qt_chat; $i++){
			$sala = $dados_chats[$i][0];
			$nm_sala = $dados_chats[$i][1];
			//Verifica quantos tem na sala
			$sql = "SELECT * FROM tb_usuario WHERE id_chat = $sala";
			$res = $con->query($sql);
			$qt_users = $res->num_rows;
			echo "
			<li><p> <a href='entra_chat1.php?id=$sala' class='black-text'>Sala $sala - $nm_sala
				<span class='badge'>$qt_users online</span>
			</a> </li></p>
			<li class='divider'></li>
			";
		}
	}
?>
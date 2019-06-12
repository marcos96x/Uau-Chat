<?php  
require_once "../banco/conecta_banco.php";
$id = $_POST['id'];
$nick = $_POST['nick'];
$sql = "SELECT * FROM tb_usuario WHERE id_chat = $id;";
$resposta = $con->query($sql);
$dados_users = $resposta->fetch_all();
for($i2 = 0; $i2 < $resposta->num_rows; $i2++){
	$userOn = $dados_users[$i2][0];
	if($userOn != $nick){
		//Verifica se o usuario ja reportou o individuo
		$sql = "SELECT * FROM tb_report WHERE id_chat = $id AND nick_report = '$userOn' AND nick_reportador = '$nick'";
		$res = $con->query($sql);
		if($res->num_rows == 0)	{
			echo "<p class='collection-item black-text report'>$userOn<a href='validacoes/report.php?nick=$userOn&id=$id' class='btn red right'><i class='material-icons'>priority_high</i></a></p>
			";
		}else{
			echo "<p class='collection-item black-text report'>$userOn</p>
			";
		}
	}		
}

?>
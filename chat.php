<?php  
//Verifica se a sessão está iniciada
include "validacoes/verifica_sessao.php";
include "banco/conecta_banco.php";
// Pega o id do chat
@$id = $_GET['id'];
if(!isset($id)){	
	header("location: index.php?msg=1");
	exit;
}
$sql = "SELECT * FROM tb_chat WHERE id_chat = $id";
$res1 = $con->query($sql);
$res = $res1->fetch_row();
$titulo_chat = $res[1];
//Mensagens
@$msg = $_GET['msg'];
if(isset($msg)){
	switch ($msg) {
		case 1:
			$mensagem = "O usuário foi reportado com sucesso! Por conta do mesmo ter recebido mais que 5 reports, foi banido do chat. Obrigado por colaborar com a comunidade.";
			break;
		case 2:
			$mensagem = "O usuário foi reportado com sucesso! Obrigado por colaborar com a comunidade.";
			break;
		case 2:
			$mensagem = "Você ja reportou este usuário.";
			break;
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>UAU Chat - Lobby</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <link rel="shortcut icon" href="img/icon.png" />   
    <!-- -------------------------MATERIALIZE -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/> 
      
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>     
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/script.js"></script>
</head>
<body>	
	<style type="text/css">
		body{
			background-color: #fafafa ;
		}
		#chat li{
			background-color: transparent ;
		}
		#chat ul{
			width: 50%;
			margin: 20px;
		}
		#users_online ul{
			margin: 20px;
		}
		#chat{			
			max-height: 500px;
			width: 100%;
			background-color: transparent ;
			border: 2px solid #efefef ;
			
			overflow:auto;			
		}
		#mensagem{
			width:80%;
		}		
		#nome{
			max-width: 400px;
		}		
		.outra-mensagem{
			max-width: 46%;
			float: left;
			word-wrap: break-word;
			text-align: left;			
		}
		.minha-mensagem{
			max-width: 46%;
			float: right;
			word-wrap: break-word;
			text-align: left;							
		}
		#users_online{
			width: 100%;
			max-height: 500px;
			overflow: auto;
			border: 2px solid #efefef ;
		}
		.report{
			height: 60px;
		}
		h4{
			font-family: "Segoe UI Black";
			color: #2ab8f0;
		}
		h5{
			font-family: "Segoe UI";
			color: #2ab8f0;
		}
		/*--------scroll--------*/
		::-webkit-scrollbar-track {
		    background-color: transparent;
		}
		::-webkit-scrollbar {
		    width: 9px;
		    background: transparent;
		}
		::-webkit-scrollbar-thumb {
		    background: #2ab8f0;
		}
	</style>
	
		<div class="row">
			<div class="col s12 m6 l6">			
				<div class="row">
					<h4>Sala <?php echo "$id - ".$titulo_chat; ?></h4>			
					<div id="chat"  class="z-depth-1">
						<!-- MAX DE 8 MSG -->
						<?php 
						// Lista todas as mensagens no chat
						$sql = "SELECT usuario, ct_msg, time(hr_msg) from tb_msg WHERE id_chat = $id order by hr_msg";
						$res = $con->query($sql);					
						// Exibe
						$qt_linhas = $res->num_rows;
							
						//Saber quantas pessoas tem na sala, se tiver uma, exclui o chat quando ela sair
						$sql = "SELECT * FROM tb_usuario WHERE id_chat = $id;";
						$res = $con->query($sql);
						$qt_users = $res->num_rows;				
						if($res->num_rows > 1){
							$deleta = '5'; // não deleta
						}else{
							$deleta = '2'; // Deleta
						}
						if($qt_linhas > 0){
							$row = $res->fetch_all();
							for ($i=0; $i < $qt_linhas; $i++) {
								$nick_msg = $row[$i][0];
								$msg_enviada = $row[$i][1];
								$hr_msg = $row[$i][2];						
								// Exibe
								// class='minha-mensagem'
								if($nick_msg == $nick){									
									echo "						
										<ul class='collection minha-mensagem' >
											<li class='collection-item'>
												<p><label>$hr_msg</label><br> &nbsp &nbsp $nick_msg: $msg_enviada</p>
											</li>
										</ul>
									";
								}else{									
									echo "							
										<ul class='collection outra-mensagem'>
											<li class='collection-item '>
												<p><label>$hr_msg</label><br>$msg_enviada</p>
											</li>
										</ul>
									";
								}
								
								
							}				
						}
						?>			
					</div>	
					
				</div>
				<!-- Enviar sua mensagem -->
				<div class="row" align="center">					
					<form id="formulario" method="POST" onsubmit="return validaForm(this)" action="#">
						<input type="hidden" name="id" id="id" value="<?php echo $id;?>"><!-- --ID DO CHAT -->
						<input type="hidden" value="<?php echo $nick ?>" name="nick" id="nick"/>			
				        <input name="mensagem" id="mensagem">
				        <button type="submit" class="btn light-blue"><i class="large material-icons">send</i></button> 
					</form>
				</div>						
			</div>
			<div class="col s12 m4 l4">
				<div class="container">
					<!-- Conteudo lateral -->
					<!-- Lista de usuarios online neste chat -->
					<div class="row">	
						<h4>Usuarios online - <?php echo $qt_users ?></h4>				
						<div id="users_online"  class="z-depth-1">
							<ul class="collection">
							<?php  
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
							</ul>
						</div>
						<div class="row" align="center">						
						<form action="validacoes/destroi_sessao.php?deleta=<?php echo $deleta ?>" method="POST">
							<br>
							<input type="hidden" value="<?php echo $nick ?>" name="nick"/>
							<input type="hidden" value="<?php echo $id ?>" name="id"/>
							<input type="hidden" name="apagar" id="apagar" value=""/>
							<button type="submit" class="btn white black-text">Sair do chat</button>
						</form>
					</div>							
					</div>
						
				</div>
			</div>
			
		</div>
	
	<script type="text/javascript">
		//Quando a pagina for carregada, joga a visão pra ultima mensagem
		$(document).ready(function(){
			atualiza();	
			refreshUsers();
			var objDiv = document.getElementById("chat");
			objDiv.scrollTop = objDiv.scrollHeight;
		});
		//Valida se a mensagem está vazia
		function validaForm(formulario){
			if (formulario.mensagem.value.trim() == "") {
				return false;
			}
			return true;
		}
		//Atualização dos usuarios online na lateral
		function refreshUsers(){
			$.ajax({
				type: "POST",
				url: "atualizacoes_chat/refreshUsers.php",
				data: {
					id: $("#id").val(),
					nick: $("#nick").val()
				}
			}).done(function(xx){
				if($("#users_online").text() != xx){
					$("#users_online").html(xx);
				}
			});
			setTimeout(refreshUsers, 1000);
		}
		//Inserção da mensagem em tempo real
		$("#formulario").submit(function(){
			$.ajax({
				type: 'POST',
				url: 'atualizacoes_chat/insereMsg.php',
				data: {
					id: $("#id").val(),
					nick: $("#nick").val(),
					mensagem: $("#mensagem").val()
				}
			}).done(function(x){
				//$("#chat").append(e);
				$("#mensagem").val(null);			
				var objDiv = document.getElementById("chat");
				objDiv.scrollTop = objDiv.scrollHeight;
			});
			return false;
		});
		$(document).ready(function(){				
					
		});
	//Envia a mensagem pro banco em tempo real
	
	//Atualiza o chat com as mensagens em tempo real
	function atualiza(){
		$.ajax({
		type: 'POST',
		url: 'atualizacoes_chat/recebeMsg.php',
		data: {
			id: $("#id").val(),							
			nick: $("#nick").val()
		}
		}).done(function(x){
			if($("#chat").text() != x){
				$("#chat").html(x);
			}
		});
		setTimeout(atualiza, 100);
	}
	//Valida se a mensagem está vazia
	function validaForm(formulario){
		if (formulario.mensagem.value.trim() == "") {
			return false;
		}
		return true;
	}
	//toasts 
	<?php 
  		if(isset($msg)):
		?>
			M.toast({html: '<?php if(isset($msg)) echo "$mensagem"; ?>'});
		<?php  
			endif;
		?>
	</script>

</body>
</html>
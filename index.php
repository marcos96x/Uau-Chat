<?php  
include "banco/conecta_banco.php";
@$msg = $_GET['msg'];
if(isset($msg)){
	switch ($msg) {
			case 1:
				$mensagem = "Já existe alguem nesta sala com esse nome!";
				break;
			case 2:
				$mensagem = "Você não está autenticado para acessar este chat";
				break;
			default:
				# code...
				break;
		}	
}
?>
<!DOCTYPE html>	
<html>
<head>
	<title>UAU Chat Online</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <link rel="shortcut icon" href="img/icon.png" />   
    <!-- -------------------------MATERIALIZE -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>  
    <link rel="stylesheet" type="text/css" href="css/estiloHome.css">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>     
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/scriptIndex.js"></script>
</head>
<body>		
		
	<!-- Corpo -->
	<div class="container">
		<div class="row">
			<div class="col s12 m6 right">
			<br><br><br><br>			
				<img src="img/img1.svg" class="responsive-img">
			</div>
			<div class="col s12 m6 left">
			<!-- Sobre o sistema -->			
			<h2>Uau Chat online</h2>
			<p>
				Crie uma sala ou entre em uma já aberta a hora que quiser e converse com diversas pessoas diferentes.
			</p>
			<p>
				Uau Chat é uma plataforma de chat online comunitária. Não é necessário se registrar para participar, apenas leia nossa <a href="#politica">Politica da comunidade</a> para poder interagir sem possíveis problemas futuros.
			</p>
			</div>			
		</div>		
	</div>
	<!-- Menu para entrar -->
	<div class="container">
		<div class="row">
			<div class="col m6">				
				 <div id="chats-abertos" class="z-depth-1">
				 	<h4>Encontre uma sala</h4>
				 	<div id="chats">
				 	
				 	</div>
				 </div>
				 
			</div>
			<div class="col m6">
				<div id="conteudo-central" class="center z-depth-1">
					<h4>Ou crie uma sala</h4>
					<form action="validacoes/cria_chat.php" method="POST">
						<div class="input-field col m11">
				          <i class="material-icons prefix">title</i>
				          <input id="nm_sala" type="text" class="validate" name="titulo">
				          <label for="nm_sala">Nome da sala</label>
				        </div>
				        <br>
				        <div class="input-field col m11">
				          <i class="material-icons prefix">perm_identity</i>
				          <input id="nick" type="text" class="validate" name="nick">
				          <label for="nick">Seu apelido</label>
				        </div>
				        <input type="submit" class="btn waves-effect light-waves light-blue" value="Criar">

					</form>
				</div>
				
			</div>
		</div>
	</div>
	<!-- Politica da comunidade -->
	<div class="container">
		<div class="row">
			<div class="col s12 m6">
				<br><br><br>
				<img src="img/img2.svg" class="responsive-img">	
			</div>
			<div class="col s12 m6">
				<h2 id="politica">Política da comunidade</h2>
				<p>
					De forma resumida, nós pensamos em estabelecer uma comunicação entre diferentes pessoas de forma segura, evitando na medida do possível qualquer tipo de agressão virtual, o famoso Bullying. Para evitar isso ao maximo, além de pedimos a colaboração de você, usuario, para que a comunidade sempre esteja crescendo e em um ambiente confortável, contamos com a funcionalidade de reports em nossos chats para que sempre que alguem for desagradável seja removido do chat. 
				</p>
			</div>			
		</div>
		
	</div>
	<!-- FOOTER -->
	<footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Uau Chat Online</h5>
                <p class="grey-text text-lighten-4">Esta plataforma foi criada para fins acadêmicos, sem fins lucrativos.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Colabore com a plataforma</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="http://github.com/mencholipa14" target="_blank"><img src="img/git.png" width="50px"> Github</a></li>
                  <li><a class="grey-text text-lighten-3" href="http://facebook.com/leks.alexandre" target="_blank"><img src="img/face.png" width="50px">Facebook</a></li>                  
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2019 - Desenvolvido por Marcos Alexandre            
            </div>
          </div>
        </footer>
	<script type="text/javascript">		
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
<?php  
include "banco/conecta_banco.php";
$id = $_GET['id'];
@$msg = $_GET['msg'];
//Verifica se existe o chat com o ID
$sql = "SELECT * FROM tb_chat WHERE id_chat = $id;";
$res = $con->query($sql);
//Se nao tiver o chat no banco...
if($res->num_rows == 0){
	header("Location: index.php?msg=1");
}
//Se tiver a mensagem setada
if(isset($msg)){
	if($msg == 1){
		$mensagem = "Este nick ja está em uso nesta sala!";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Entrar - chat</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <link rel="shortcut icon" href="img/icon.png" />
    <!-- -------------------------MATERIALIZE -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>    
     <link type="text/css" rel="stylesheet" href="css/estiloEntrada.css"  media="screen,projection"/>  
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
        #nick{
            max-width: 300px;
        }
        
        h2{
            font-family: "Segoe UI Black";
            color: #2ab8f0;
        }
        p{
            font-family: "Segoe UI";
            font-size: 20px;
        }
        .light-blue{
            background-color: #2ab8f0;
        }

        /* label color */
        .input-field label .activate {
         color: #2ab8f0;
        }
        /* label focus color */
        .input-field input[type=text]:focus + label {
         color: #2ab8f0;
        }
        /* label underline focus color */
        .input-field input[type=text]:focus {
         border-bottom: 1px solid #2ab8f0;
         box-shadow: 0 1px 0 0 #2ab8f0;
        }
        .input-field .active label input[type=text]:focus {
         border-bottom: 1px solid #2ab8f0;
         box-shadow: 0 1px 0 0 #2ab8f0;
          color: #2ab8f0;
        }
        /* valid color */
        .input-field input[type=text].valid {
         border-bottom: 1px solid #2ab8f0;
         box-shadow: 0 1px 0 0 #2ab8f0;
        }
        /* invalid color */
        .input-field input[type=text].invalid {
         border-bottom: 1px solid red;
         box-shadow: 0 1px 0 0 red;
        }
        /* icon prefix focus color */
        .input-field .prefix.active {
         color:#2ab8f0;
        }
        h4{         
            color:#2a98ff ;
        }
        #entrarSala{
            font-family: "Segoe UI";
        }
    </style>
	<div class="container">
        <div class="row">
            <div class="col s12 m6">
                <h2>Uau Chat Online</h2>
               
                <img src="img/img3.svg" class="responsive-img">
            </div>
            <div class="col s12 m6 center-align" >
                <br><br><br>
                <h4 id="entrarSala">Entrar na sala <?php echo $id; ?> </h4>
                 <p>Você solicitou a entrada na sala <?php echo $id ?>. Já deu uma lida em nossa <a href="#">Politica da comunidade</a>? Se sim, aproveite o nosso serviço de chat a vontade xD </p>
                
                <form action="validacoes/valida_chat.php" method="GET">
                    <h4>Insira seu apelido</h4> 
                    <div class="input-field col m11 ">
                            <i class="material-icons prefix">perm_identity</i>
                            <input id="nick" type="text" class="validate" name="nick">
                           
                            <br><br>
                            
                            <button  type="submit" class="btn waves-effect light-waves light-blue"><i class="material-icons">done</i>Entrar</button>
                        </div>
                    <input type="hidden" value="<?php echo $id?>" name="id">
                    
                </form> 
               
               
            </div>
        </div>
		 
        <br><br>
        <div align="center">
            <a href="index.php" class="btn waves-effect light-waves light-blue"><i class="material-icons">reply</i>Voltar</a>
        </div>
         
	</div>
        
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
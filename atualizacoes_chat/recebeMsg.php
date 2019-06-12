<?php 
	if(count($_POST) > 0){		
		include "../banco/conecta_banco.php";

		$id = $_POST['id']; // id do chat		
		$nick = $_POST['nick'];
		// pesquisa pelo ultimo
		
		// Lista todas as pessoas no chat
		$sql = "SELECT usuario, ct_msg, time(hr_msg) from tb_msg WHERE id_chat = $id order by hr_msg"; // -------------PAREI AQ MANOOOOOOOOOOOO
		$res = $con->query($sql);
		//Quantos tem online
		$sql = "SELECT * FROM tb_usuario WHERE id_chat = $id;";
		$res2 = $con->query($sql);
		$qt_users = $res2->num_rows;
		// Exibe
		$qt_linhas = $res->num_rows;
		

		if($qt_linhas > 0){					
			$row = $res->fetch_all();
			for ($i=0; $i < $qt_linhas; $i++) {						
				$nm_integrante = $row[$i][0];
				$msg_integrante = trim($row[$i][1]);
				$hr_msg = $row[$i][2];	
				if($msg_integrante != "" && $msg_integrante != " " && !is_null($msg_integrante)){						
					if($nm_integrante == $nick){							
						echo "
														
							<ul class='collection minha-mensagem'>
								<li class='collection-item'>
									<p><label>$hr_msg</label><br> $msg_integrante</p>
								</li>
							</ul>
						";
					}else{								
						echo "
															
							<ul class='collection outra-mensagem'>
								<li class='collection-item'>
									<p><label>$hr_msg</label>&nbsp; $nm_integrante<br> $msg_integrante</p>
								</li>
							</ul>
						";
					}							
				}else{
					echo "";
				}
			}				
		}
	}
?>
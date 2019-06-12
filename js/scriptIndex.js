$(document).ready(function(){
	refresh_chat();
	$(".dropdown-trigger").dropdown();
});
function validaForm(formulario){
	if (formulario.titulo.value.trim() == "") {
		return false;
	}
	return true;
}

function refresh_chat(){
	$.ajax({
	type: 'POST',
	url: 'atualizacoes_chat/refreshChat.php',
	data: {
	}
	}).done(function(x){				
		$("#chats").html(x);
	});
	setTimeout(refresh_chat, 1000);
}
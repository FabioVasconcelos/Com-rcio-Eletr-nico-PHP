var usuario;
var email;
var senha;


function cadastraUsuario(usuario, email, senha){

if(usuario)
{
	
	if(email)
	{
		if(senha){
			var url = "trataCadastrar.php?usuario="+encodeURIComponent(usuario)+ "&email="+ encodeURIComponent(email)+ "&senha="+ encodeURIComponent(senha);
			
            requisicaoHTTP("GET", url, true);
		}
	}
}

else
{
	
	alert("Todos os campos devem ser preenchidos");
}

}
function trataDadosCadastrar(){

var info = ajax.responseText;
var div = document.getElementById("lista");
div.innerHTML = info;

}




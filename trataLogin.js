var user;
var senhalogar;


function logaUsuario(user, senhalogar){

if(user)
{
		
		if(senhalogar){
			var url = "trataLogin.php?usuario="+encodeURIComponent(user)+ "&senha="+ encodeURIComponent(senhalogar);
			
            requisicaoHTTP("GET", url, true);
		}
	
}

else
{
	
	alert("Todos os campos devem ser preenchidos");
}

}
function trataDadosLogar(){

var info = ajax.responseText;
var div = document.getElementById("lista");
div.innerHTML = info;

}






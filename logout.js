function abandonarSessao()
{
	var url = "abandonarSessao.php";
			
            requisicaoHTTP("GET", url, true);
	
}

function trataDadosAbandonar(){

var info = ajax.responseText;
var div = document.getElementById("lista");
div.innerHTML = info;

}
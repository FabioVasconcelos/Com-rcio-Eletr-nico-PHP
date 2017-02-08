function cadastrar(){

var url = "cadastrar.php";
requisicaoHTTP("GET", url, true);

}

function trataDadosCadastrar(){

var info = ajax.responseText;
var div = document.getElementById("lista");
div.innerHTML = info;

}



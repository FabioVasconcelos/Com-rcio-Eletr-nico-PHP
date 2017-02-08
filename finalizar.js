function finalizar(){

var url = "finalizar.php";
requisicaoHTTP("GET", url, true);

}

function trataDadosFinalizar(){

var info = ajax.responseText;
var div = document.getElementById("lista");
div.innerHTML = info;

}
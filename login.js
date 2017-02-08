function login(){

var url = "login.php";
requisicaoHTTP("GET", url, true);

}

function trataDadosLogin(){

var info = ajax.responseText;
var div = document.getElementById("lista");
div.innerHTML = info;

}

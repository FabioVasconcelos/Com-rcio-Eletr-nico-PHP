var categoria;

function obtemInfoCategoria(idCategoria){

if(idCategoria){

categoria = idCategoria;

var url = "trataCategoria.php?idcategoria="+idCategoria;
requisicaoHTTP("GET", url, true);

}

}

function trataDadosCategoria(){

var info = ajax.responseText;
var div = document.getElementById("lista");
div.innerHTML = info;

}




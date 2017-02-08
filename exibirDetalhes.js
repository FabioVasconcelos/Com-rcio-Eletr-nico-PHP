var idProduto;

function obtemInfoDetalhes(idproduto){

if(idproduto){

idProduto = idproduto;

var url = "exibirDetalhes.php?idproduto="+idProduto;
requisicaoHTTP("GET", url, true);

}

}

function trataDadosDetalhes(){

var info = ajax.responseText;
var div = document.getElementById("lista");
div.innerHTML = info;

}



// JavaScript Document
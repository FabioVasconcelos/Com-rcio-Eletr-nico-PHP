function addCarrinho(idProduto, acao){

if(idProduto){

if(acao){

var url = "carrinho.php?idproduto="+encodeURIComponent(idProduto)+"&acao="+encodeURIComponent(acao);

requisicaoHTTP("GET", url, true);

}
 }

}

function trataDadosCarrinho(){

var info = ajax.responseText;
var div = document.getElementById("lista");
div.innerHTML = info;

}




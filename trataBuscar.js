
window.onload = function(){
	var palavra = document.getElementById("palavra");
	if(palavra != null)
		palavra.onblur = function() { obtemInfo(palavra.value);
		
		 }
}




function obtemInfo(palavra){

if(palavra){

var url = "trataBuscar.php?palavra="+encodeURIComponent(palavra);

requisicaoHTTP("GET", url, true);

}

}

function trataDados(){

var info = ajax.responseText;
var div = document.getElementById("lista");
div.innerHTML = info;

}

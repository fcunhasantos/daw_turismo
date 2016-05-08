$(document).ready(function(){
	$("#voos").on("click", "#removeVoo", function(e){
        $(this).closest("tr").remove();
        alert('teste remover');
    });
	
	$(".removerHotel").on("click", function(e){
		carrinho = request.getSession();//.getAttribute("carrinho").length;
		
		alert("Favor informar o valor.");
	});
	
	$(".removerVoo").on("click", function(e){
		alert("Favor informar o valor.");
	});
});
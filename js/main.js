
function resetarForm(){
	$(":text").each(function(){
		$(this).val("");
	});

	$(":radio").each(function(){
		$(this).prop({checked:false})
	});

	$("input[type=number").each(function(){
		$(this).val("");
	});
}


function ajaxDelete(codigo){
	info = {"nCodigo":codigo};

	$.ajax({
		url: '../site/apagar.php',
		type: 'post',
		data: info,
		success:function(data) {
			$("input[name=codAPagar]").val();
			funcAjaxApagar(codigo);
			$("input[name=codAPagar]").focus();
		}
		
	});	
}
function funcAjaxGetEditar(codigo){

	info = {"nCodigo":codigo};

	$.ajax({
		url: '../site/carregaCamposEditar.php',
		type: 'post',
		data: info
	})
	.done(function(data) {
		data = $.parseJSON(data);
		$("input[name=tituloEditar]").val(data[0].titulo_jogo);
		$("input[name=generoEditar]").val(data[0].genero);
		$("input[name=playersEditar]").val(data[0].qnt_player);

		$("input[name=corLegenda]").val(data[0].corLegenda);
		$("input[name=corTitulo]").val(data[0].corTitulo);
		$("input[name=corConteudo]").val(data[0].corConteudo);

		$("input[value="+data[0].faixa_etaria+"]").prop('checked', 'true');
		$("input[value="+data[0].modo_jogo+"]").prop('checked', 'true');
		$("input[value="+data[0].idioma+"]").prop('checked', 'true');
	});	
}

function funcAjaxEditar (codigo,titulo,genero,players,video,faixa,modo,idioma,corLegenda,corTitulo,corConteudo) {
	info = {"codigo":codigo,"titulo":titulo,"genero":genero,"players":players,"video":video,"faixa":faixa,
		"modo":modo,"idioma":idioma,"corLegenda":corLegenda,"corTitulo":corTitulo,"corConteudo":corConteudo};

	$.ajax({
		url: '../site/editar.php',
		type: 'post',
		data:info
	})
	.done(function(data) {
		$("#boxMensagemEditar").html(data);
		resetarForm();
	});
	
}
function funcAjaxApagar(codigo){

	info = {"nome":codigo};

	$.ajax({
		url: '../site/dadosApagar.php',
		type: 'post',
		data: info,
		success:function(data) {
		data = $.parseJSON(data);
		var x = 0;
		var txt =" ";
		while(data[x]){
			txt = txt+'<tr><td>'+data[x].titulo_jogo+'<input type="button" onclick="excluir(id,name)" id="'+data[x].id_jogo+'" title="Excluir" name="'+data[x].titulo_jogo+'"></td></tr>'
			x = x +1; 
		}
		$("#tabelaApagar").html(txt);
	}
	});	
}

function excluir(id,name){
	var result = confirm("Deseja excluir o jogo " +name);
	if (result == true) {
    	ajaxDelete(id);
	};
}


$(document).ready(function() {
	
	$("input[name=codEditar]").change(function(){
		var codigo = $(this).val();
	  	funcAjaxGetEditar(codigo);
	});

	$("#botaoEditar").click(function(){
		var codigo = $("input[name=codEditar]").val();
		var titulo = $("input[name=tituloEditar]").val();
		var genero = $("input[name=generoEditar]").val();
		var players = $("input[name=playersEditar]").val();
		var video = $("input[name='videoEditar']").val();
		var faixa = $("input[name='faixaEditar']:checked").val();
		var modo = $("input[name='modoEditar']:checked").val();
		var idioma = $("input[name='idiomaEditar']:checked").val();
		var corLegenda = $("input[name=corLegendaEditar]").val();
		var corTitulo = $("input[name=corTituloEditar]").val();
		var corConteudo = $("input[name=corConteudoEditar]").val()
		video = video.replace(" ", "-").substring(12); 

	  	funcAjaxEditar(
	  			codigo,
	  			titulo,
				genero,
				players,
				video,
				faixa,
				modo,
				idioma,
				corLegenda,
				corTitulo,
				corConteudo

	  		);
	});

	$("input[name=codAPagar]").focus(function(){
		var codigo = $(this).val();
	  	funcAjaxApagar(codigo);
	});
	$("input[name=codAPagar]").keyup(function(){
		var codigo = $(this).val();
	  	funcAjaxApagar(codigo);
	});


	
	
	$('#inserir').click(function() {
		$('#gerenciadorEditar').hide();
		$('#gerenciadorApagar').hide();
		$('#gerenciadorRanking').hide();
		$('#gerenciadorInserir').show();
		$('#editar').removeClass('abaAtiva');
		$('#apagar').removeClass('abaAtiva');
		$('#ranking').removeClass('abaAtiva');
		$('#inserir').addClass('abaAtiva');
		$('.sucesso').css('display', 'none');
		$('.falha').css('display', 'none');
		$('.erro').css('display', 'none');
		$("input[name=codInserir]").focus();
	});

	$('#editar').click(function() {
		$('#gerenciadorInserir').hide();
		$('#gerenciadorApagar').hide();
		$('#gerenciadorRanking').hide();
		$('#gerenciadorEditar').show();
		$('#inserir').removeClass('abaAtiva');
		$('#apagar').removeClass('abaAtiva');
		$('#ranking').removeClass('abaAtiva');
		$('#editar').addClass('abaAtiva');
		$('.sucesso').css('display', 'none');
		$('.falha').css('display', 'none');
		$('.erro').css('display', 'none');
		$("input[name=codEditar]").focus();
	});

	$('#apagar').click(function() {
		$('#gerenciadorInserir').hide();
		$('#gerenciadorEditar').hide();
		$('#gerenciadorRanking').hide();
		$('#gerenciadorApagar').show();
		$('#inserir').removeClass('abaAtiva');
		$('#editar').removeClass('abaAtiva');
		$('#ranking').removeClass('abaAtiva');
		$('#apagar').addClass('abaAtiva');
		$('.sucesso').css('display', 'none');
		$('.falha').css('display', 'none');
		$('.erro').css('display', 'none');
		$("input[name=codAPagar]").focus();
	});

	$('#ranking').click(function() {
		$('#gerenciadorInserir').hide();
		$('#gerenciadorEditar').hide();
		$('#gerenciadorApagar').hide();
		$('#gerenciadorRanking').show();
		$('#inserir').removeClass('abaAtiva');
		$('#editar').removeClass('abaAtiva');
		$('#apagar').removeClass('abaAtiva');
		$('.sucesso').css('display', 'none');
		$('.falha').css('display', 'none');
		$('.erro').css('display', 'none');
		$('#ranking').addClass('abaAtiva');
	});

	$("#demo").click(function() {

		$corLegenda = document.getElementById("corLegenda").value;
		$resultLegenda = $corLegenda.replace(" ", "-").substring(1); 


		$corTitulo = document.getElementById("corTitulo").value;
		$resultTitulo = $corTitulo.replace(" ", "-").substring(1); 

		$corConteudo = document.getElementById("corConteudo").value;
		$resultConteudo = $corConteudo.replace(" ", "-").substring(1); 

		 window.open ("/games_preview/site/demo.php?corLegenda="+$resultLegenda+"&corTitulo="+$resultTitulo+"&corConteudo="+$resultConteudo, "_blank");
	});	

	$("#btnMenssagem").click(function() {
		$(".menssagemDiv").css('display','none');
	});


	
});


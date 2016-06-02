<?php
	    $corLegenda = isset($_GET['corLegenda']) ? $_GET['corLegenda'] : "#400080";
	    $corTitulo = isset($_GET['corTitulo']) ? $_GET['corTitulo'] : "#FFB800";
	    $corConteudo = isset($_GET['corConteudo']) ? $_GET['corConteudo'] : "#fff";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Demo</title>
</head>
<body>
		<img src="../imagens/sonic.png" alt="sonic" id="sonic" class="animacaoSonic">
		<div id="legenda" style="background:#<?= $corLegenda ?>">
			<span class="textoLegenda" id="titulo" style="color:#<?= $corConteudo ?>"><label class="atributo" style="color:#<?= $corTitulo ?>">Titulo</label> titulo do jogo</span>
		</div>

        <img src="../imagens/voltar.png" alt="voltar" id="voltar" title="Voltar para gerenciador" onclick="window.close();">

</body>
</html>

<style>
body,html
{
	width:90%;
	height:90%;
	background-color:#000;
	
}
#voltar
{
	cursor: pointer;
}
#legenda
{
	width: 70%;
	height:25%;
	position: absolute;
	z-index: 1;
	top: 65%;
	left: 14%;
	border-radius: 10px;
}

#sonic
{

	width:20%;
	height:40%;
	position: fixed;
	top: 60%;
	left:0;
	z-index: 2;
}

#logo
{
	width:15%;
	height:15%;
	position: fixed;
	top: 80%;
	left: 80%;
	opacity: 1;
}
#texto
{
	position: absolute;
}
.textoLegenda
{
	color: #fff;
	font-size: 4rem;
	position: absolute;
	top:25%;
	left:8%;
	text-align: center;
	width:88%;
	font-family: "stencil std", Georgia, Serif;

}
label
{
	width: 50%;
	position: absolute;
	top:-45px;
	left:50%;
	font-size: 2.5rem;
	color: #FFB800;
	text-align: right;
	display: inline;
}
</style>
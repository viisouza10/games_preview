<?php
	require_once "../classes/controller.class.php";
	$codigo = $_POST['nCodigo'];
	// Instância um objeto Controller passando como parâmetro o nome da tabela que será manipulada
	$controller = new controller('tb_jogos');

	// Array contendo condições para o delete
	$arrayCondicao = array('id_jogo=' => $codigo);

	// Variável contendo instrução SQL
	$sql = "SELECT video FROM tb_jogos WHERE id_jogo = ".$codigo;
	$video = $controller ->getDados($sql);

	//Apagando arquivo fisico do video
	unlink("../video/" . $video[0]->video);
	
	// Chama o método necessário INSERT, UPDATE ou DELETE
	echo $controller->delete($arrayCondicao);
	

?>
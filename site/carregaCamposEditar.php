<?php
	$id = $_POST['nCodigo'];

	require_once "../classes/controller.class.php";
	// Instância um objeto Controller passando como parâmetro o nome da tabela que será manipulada
	$controller = new controller('tab_jogos');

	// Variável contendo instrução SQL
	$sql = "SELECT * FROM tb_jogos WHERE id_jogo = '".$id."' ";
	
	$dados = $controller ->getDados($sql);

	echo json_encode($dados);
?>
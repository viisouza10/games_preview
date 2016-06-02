<?php

class objeto{
	public $titulo;
}
	$nome = $_POST['nome'];

	require_once "../classes/controller.class.php";
	// Instância um objeto Controller passando como parâmetro o nome da tabela que será manipulada
	$controller = new controller('tab_jogos');

	// Variável contendo instrução SQL
	$sql = "SELECT * FROM tb_jogos WHERE titulo_jogo LIKE '%".$nome."%' ORDER BY titulo_jogo ";
	
	$dados = $controller ->getDados($sql);

	echo json_encode($dados);

?>
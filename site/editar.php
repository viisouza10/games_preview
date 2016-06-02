<?php
	require_once "../classes/controller.class.php";

    $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : null;
 	// Instância um objeto Controller passando como parâmetro o nome da tabela que será manipulada
	$controller = new controller('tb_jogos');

	// Variável contendo instrução SQL
	$sql = "SELECT * FROM tb_jogos WHERE id_jogo = '".$codigo."' ";

	// Chama o método necessário consulta simples com vários registros de retorno
	$dadosJogos = $controller->getDados($sql);
	
	if ($dadosJogos) {
 	$video = ($_POST['video'] == "") ? $dadosJogos[0]->video : $_POST['video'];
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : null;
    $genero = isset($_POST['genero']) ? $_POST['genero'] : null; 
    $players = isset($_POST['players']) ? $_POST['players'] : null;
    $faixa = isset($_POST['faixa']) ? $_POST['faixa'] : null;
    $modo = isset($_POST['modo']) ? $_POST['modo'] : null;
    $idioma = isset($_POST['idioma']) ? $_POST['idioma'] : null;
    $corLegenda = isset($_POST['corLegenda']) ? $_POST['corLegenda'] : null;
    $corTitulo = isset($_POST['corTitulo']) ? $_POST['corTitulo'] : null;
    $corConteudo = isset($_POST['corConteudo']) ? $_POST['corConteudo'] : null;





	    // Array com dados para inserção no banco de dados
	    $arrayDados = array(
	        'id_jogo' => $codigo, 
	        'titulo_jogo' => $titulo, 
	        'idioma' => $idioma, 
	        'video' => $video, 
	        'faixa_etaria' => $faixa, 
	        'qnt_player' => $players, 
	        'modo_jogo' => $modo, 
	        'genero' => $genero,
	        'corLegenda' => $corLegenda,
	        'corTitulo' => $corTitulo,
	        'corConteudo' => $corConteudo,
	        );
		// Array contendo condições para o update
		 $arrayCondicao = array('id_jogo=' => $codigo);

		// Chama o método necessário INSERT, UPDATE ou DELETE

		echo $controller->update($arrayDados, $arrayCondicao);
		echo "<span class='sucesso'>Código editado com sucesso !</span";
	}else{
		echo "<span class='erro'>Código não cadastrado!</span";
	}

?>
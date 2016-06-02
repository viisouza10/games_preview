<?php
    // Require nos scripts necessários
    require_once "../classes/helper/helper_format.class.php";
    require_once "../classes/controller.class.php";
if (isset($_POST['cadastrar'])) {
	$msg = " ";
    $codigo = isset($_POST['codInserir']) ? $_POST['codInserir'] : null;
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : null;
    $genero = isset($_POST['genero']) ? $_POST['genero'] : null;
    $players = isset($_POST['players']) ? $_POST['players'] : null;
    $faixa = isset($_POST['faixa']) ? $_POST['faixa'] : null;
    $modo = isset($_POST['modo']) ? $_POST['modo'] : null;
    $idioma = isset($_POST['idioma']) ? $_POST['idioma'] : null;
    $video = isset($_POST['video']) ? $_POST['video'] : null;
    $corLegenda = isset($_POST['corLegenda']) ? $_POST['corLegenda'] : null;
    $corTitulo = isset($_POST['corTitulo']) ? $_POST['corTitulo'] : null;
    $corConteudo = isset($_POST['corConteudo']) ? $_POST['corConteudo'] : null;

	// Instância um objeto Controller passando como parâmetro o nome da tabela que será manipulada
	$controller = new controller('tb_jogos');

	// Variável contendo instrução SQL
	$sql = "SELECT * FROM tb_jogos WHERE id_jogo = '".$codigo."' ";

	// Chama o método necessário consulta simples com vários registros de retorno
	$dadosJogos = $controller->getDados($sql);

	$tamanhoObjeto = count($dadosJogos);
	if ($tamanhoObjeto > 0)
	{
			echo "<span class='erro'>Jogo já cadastrado! </span>";
	}
	else
	{
	    // Instância um objeto Controller passando como parâmetro o nome da tabela que será manipulada
	    $controller = new controller('tb_jogos');

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
	    if ($codigo != null) {
	        echo $controller->insert($arrayDados);
	        echo "<span class='sucesso'>Jogo cadastrado com sucesso! </span>";
	    } 		
	}
	
  }  


?>
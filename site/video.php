<?php
	require_once "../classes/controller.class.php";
$id = isset($_GET['id']) ? $_GET['id'] : "7898446730444";

// Instância um objeto Controller passando como parâmetro o nome da tabela que será manipulada
$controller = new controller('tb_jogos');

// Variável contendo instrução SQL
$sql = "SELECT * FROM tb_jogos WHERE id_jogo = '".$id."' ";
$dados = $controller ->getDados($sql);
$count = count($dados);
$visualizacao = isset($dados[0]->visualizacao) ? $dados[0]->visualizacao + 1 : 0;

if ($count <= 0) {
	echo "<link rel='stylesheet' type='text/css' href='../css/menssagem.css'><link rel='stylesheet' type='text/css' href='../css/estilo.css'>";
	echo "<div class='menssagemDiv'><h2>Jogo não cadastrado</h2></div>";
	header("refresh: 3;background.php");
}else{
	 // Array com dados para inserção no banco de dados
	    $arrayDados = array(
	        'visualizacao' => $visualizacao
	        );

		// Array contendo condições para o update
		 $arrayCondicao = array('id_jogo=' => $id);

		// Chama o método necessário INSERT, UPDATE ou DELETE

		$controller->updateVideo($arrayDados, $arrayCondicao);

?>

<!Doctype html>
<html lang="pt-br">
	<head>
	    <link rel="shortcut icon" href="../imagens/semaforo.png">
		<title>Parada Obrigatoria</title>
		<meta http-equiv="Content-Type" content="text/hmtl" charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="../css/estilo.css">
		<script type="text/javascript" src="../js/jquery.js"></script>
	</head>
	<body>
		<video id="video" autoplay="autoplay"> 
			<source src="../video/<?= $dados[0]->video ?>" type="video/mp4" id="video">
		</video>
		<img src="../imagens/sonic.png" alt="sonic" id="sonic" class="animacaoSonic">
		<img src="../imagens/logo.png" alt="logo" id="logo">

		<div id="legenda" style="background:<?= $dados[0]->corLegenda ?>">
			<span class="textoLegenda" id="titulo" style="color:<?= $dados[0]->corConteudo ?>" ><label class="atributo" style="color:<?= $dados[0]->corTitulo ?>">Titulo</label> <?= $dados[0]->titulo_jogo ?></span>
			<span class="textoLegenda" id="genero" style="color:<?= $dados[0]->corConteudo ?>" ><label class="atributo" style="color:<?= $dados[0]->corTitulo ?>">Gênero</label> <?= $dados[0]->genero ?></span>
			<?php
				if ($dados[0]->faixa_etaria == 'livre') {
			?>					
					<span class="textoLegenda" id="etaria" style="color:<?= $dados[0]->corConteudo ?>" ><label class="atributo" style="color:<?= $dados[0]->corTitulo ?>">Faixa Etária</label> <?= $dados[0]->faixa_etaria ?></span>.
			<?php		
				}else{
			?>
			<span class="textoLegenda" id="etaria" style="color:<?= $dados[0]->corConteudo ?>" ><label class="atributo" style="color:<?= $dados[0]->corTitulo ?>">Faixa Etária</label> <?= $dados[0]->faixa_etaria ?> +</span>.
			<?php		
				}
			?>
			<span class="textoLegenda" id="modo" style="color:<?= $dados[0]->corConteudo ?>" ><label class="atributo" style="color:<?= $dados[0]->corTitulo ?>">Modo de jogo</label> <?= $dados[0]->modo_jogo ?></span>
			<span class="textoLegenda" id="player" style="color:<?= $dados[0]->corConteudo ?>" ><label class="atributo" style="color:<?= $dados[0]->corTitulo ?>">Número de Players</label> <?= $dados[0]->qnt_player ?></span>
			<span class="textoLegenda" id="idioma" style="color:<?= $dados[0]->corConteudo ?>" ><label class="atributo" style="color:<?= $dados[0]->corTitulo ?>">Idioma</label> <?= $dados[0]->idioma ?></span>
		</div>
		
<?php
	}
?>
		<input type="text" onchange="mudarVideo()" autofocus="" id="texto" name="id" onkeydown="bloquearCtrlJ()">
	</body>
</html>	
<script type="text/javascript">
	function mudarVideo(){
			var txt = document.getElementById("texto").value;
			location.href="/ParadaObrigatoria/site/video.php?id="+txt;
	}

	var mp4 = document.getElementById('video');
	$(document).ready(function() {
		
		mp4.addEventListener('ended', function(){
			location.href="background.php";
		});
	});
 

</script>
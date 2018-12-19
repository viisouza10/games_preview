<?php
    require_once "../classes/controller.class.php";

    // Instância um objeto Controller passando como parâmetro o nome da tabela que será manipulada
    $controller = new controller('tab_jogos');

    $sql = "SELECT * FROM tb_jogos ORDER BY titulo_jogo";
    $jogos = $controller ->getDados($sql);


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Games Preview</title>
	<link rel="shortcut icon" href="../imagens/semaforo.png">
	<link rel="stylesheet" href="../css/owl.carousel.css">
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/owl.carousel.min.js"></script>
</head>
<script type="text/javascript">
	function mudarVideo(el){
		console.log(el.value);
		
			var txt = el.value;
			location.href="video.php?id="+txt;
	}

	$(document).ready(function() {
		/* Carrossel da Home*/
		$("#slider").owlCarousel({
		    slideSpeed : 500,
		    paginationSpeed : 500,
		    pagination : true,
		    singleItem : true,
		    itemsDesktop : [1199,1],
			itemsDesktopSmall : [980,1],
		    autoPlay: 5000
		   
	    });
	});
</script>
<style>

	*
	{
		margin:0;
		padding:0;
	}

	html,body
	{
		width:100%;
		height:100%;
		position: absolute;
		overflow:hidden;
	}

	#background
	{
		width:100%;
		height:100%;
	}

	#texto
	{
		position: absolute;
		left:-100%;
	}

	#home-slider{
	  overflow: hidden;
	}

	#home-slider ul li {
	  list-style: none;
	  margin: 0;
	}

	#slider .item img{
		width: calc(100% + 20px);
		height:100%;
		zoom:1.5!important;
	}

.owl-carousel .owl-wrapper-outer{
	top:20px;
}

.busca{
	position: absolute;
    top: 20%;
    left: 0;
    right: 0;
    z-index: 9999999999999;
    font-size:2em;
    margin: 0 auto;
    display: block;
    width: 80%;
    border-radius: 50px;
    outline: none;
		border: 3px solid #4707af;
		padding:10px 10px 10px 20px;

}
</style>

<body>
	<input type="text" class="busca" placeholder="Busque por um jogo" list="busca" id="buscaInput">

	<datalist id="busca">
	<?php foreach ($jogos as $key => $value) {?> 
			<option value="<?=$value->titulo_jogo; ?>" data-codigo="<?=$value->id_jogo;?>"></option>
	<?php }?>
	</datalist>
	<!-- INICIO CARROSSEL -->
    <section id="home-slider" class='slider-full'>
      <div id="slider" class="owl-carousel">
          <div class="item"><img src="../imagens/banner1.png" alt=""></div><!--/.item-->
          <div class="item"><img src="../imagens/banner3.png" alt=""></div><!--/.item-->
      </div><!--/.owl-carousel-->
    </section>
    <!-- FIM CARROSSEL -->
    <input type="text" onchange="mudarVideo()" id="texto" name="id" maxlength="13" autofocus>
</body>
</html>

<script type="text/javascript" >
	var my_field = document.getElementById('buscaInput');
	my_field.addEventListener("keyup", function (event) {
		if (event.keyCode == 13) {
				event.preventDefault();

				if (my_field.value.length != 0) {						
						mudarVideo(my_field);
						my_field.value = '';
				}
		}
	}, false);

</script>
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
	function mudarVideo(){
			var txt = document.getElementById("texto").value;
			location.href="/games_preview/site/video.php?id="+txt;
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

	#backgroundParada
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
</style>

<body>
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
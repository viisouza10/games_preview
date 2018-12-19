<?php
    require_once "../classes/controller.class.php";
    session_start();

    if(!$_SESSION['login']){
        header("Location: login.php");
    }
    $id = isset($_GET['id']) ? $_GET['id'] : "";

    // Instância um objeto Controller passando como parâmetro o nome da tabela que será manipulada
    $controller = new controller('tab_jogos');

    // Variável contendo instrução SQL
    $sql = "SELECT * FROM tb_jogos ORDER BY visualizacao  DESC LIMIT 10 ";
    $dados = $controller ->getDados($sql);

    $sql = "SELECT * FROM tb_jogos ORDER BY titulo_jogo";
    $jogos = $controller ->getDados($sql);


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Gerenciador</title>
    <link rel="shortcut icon" href="../imagens/semaforo.png">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/estilo_gerenciador.css">
    <link rel="stylesheet" type="text/css" href="../css/menssagem.css">
</head>
<body>

    <span class="aba abaAtiva" id="inserir"><label for="novo" class="labelAba">Novo</label></span>
    <span class="aba" id="editar"><label for="editar" class="labelAba">Editar</label></span>
    <span class="aba" id="apagar"><label for="apagar" class="labelAba">Apagar</label></span>
    <span class="aba" id="ranking"><label for="ranking" class="labelAba">Ranking</label></span>

<!-- FORM INSERIR JOGOS -->
    <form id="gerenciadorInserir" action="" method="post" enctype="multipart/form-data">  
        <fieldset class="boxGerenciador">
           <h1>Cadastrar Jogos</h1>
           <div id="cadastro">

            <label class="nomeCampo">Código:</label><input type="text" name="codInserir" class="input" id="campoCodigo" maxlength="13" required autofocus=""><br/>
            <label class="nomeCampo">Título:</label><input type="text" name="titulo" class="input" id="campoTitulo" maxlength="45" required><br/>
            <label class="nomeCampo">Genêro:</label><input type="text" name="genero" class="input" id="campoGenero" maxlength="45" required><br/>
            <label class="nomeCampo">Players:</label><input type="number" min="1" name="players" class="campoNumber" id="campoPlayers"  required>
            <div class="boxVideo">
                <label class="labelVideo">Vídeo</label><br/>
                <label id="enviarArquivo"><input type="file" name="video" value="Video" id="fileVideo" class="campoVideo" value="background.php" accept=".mp4" required></label>
            </div>
                
            
            <br><br>
            <div class="boxFaixaEtaria">
            <label class="labelBox">Faixa Etária</label><br/>
                <input type="radio" value="livre" name="faixa" class="campoRadio" id="campoLivre" required><label class="nomeCampoRadio">Livre</label>
                <input type="radio" value="10"name="faixa" class="campoRadio" id="campoDez" required><label class="nomeCampoRadio">10 anos</label>
                <input type="radio" value="12"name="faixa" class="campoRadio" id="campoDoze" required><label class="nomeCampoRadio">12 anos</label>
                <input type="radio" value="14" name="faixa" class="campoRadio" id="campoQuatorze" required> <label class="nomeCampoRadio">14 anos</label>
                <input type="radio" value="16"name="faixa" class="campoRadio" id="campoDezeseis" required><label class="nomeCampoRadio">16 anos</label>
                <input type="radio" value="18"name="faixa" class="campoRadio" id="campoDezoito" required><label class="nomeCampoRadio">18 anos</label><br/>
                
            </div>
              
            <br><br>
                <div class="boxModoJogo">
                    <label class="labelBox">Modo de Jogo</label><br/>
                    <input type="radio" value="Online" name="modo" class="campoRadio" id="campoOn" required><label class="nomeCampoRadio">On</label>
                    <input type="radio" value="Online-Offline"name="modo" class="campoRadio" id="campoOnOff" required><label class="nomeCampoRadio">On/Off</label>
                    <input type="radio" value="Offline"name="modo" class="campoRadio" id="campoOff" required><label class="nomeCampoRadio">Off</label><br/>
                </div>
                
                <div class="boxIdioma">
                    <label class="labelBox">Idioma</label><br/>
                    <input type="radio" value="português" name="idioma" class="campoRadio" id="campoIdiomaPt" required><label class="nomeCampoRadio">Português</label>
                    <input type="radio" value="legendado"name="idioma" class="campoRadio" id="campoIdiomaLegendaPt" required><label class="nomeCampoRadio">Legendado</label>
                    <input type="radio" value="inglês"name="idioma" class="campoRadio" id="campoIdiomaIngles" required>  <label class="nomeCampoRadio">Inglês</label><br/>
                </div>
       
                <div class="boxCor">  
                  
                  <div class="divCor">                                                                              
                     <label class="labelCor">Cor Legenda</label><br/>
                     <input type="color"name="corLegenda" id="corLegenda" class="cor"  value="#400080">
                  </div>
                  
                  <div class="divCor">
                    <label class="labelCor">Cor Título</label><br/>
                    <input type="color"name="corTitulo" id="corTitulo" class="cor"  value="#FFB800">
                  </div>
                  
                  <div class="divCor">
                    <label class="labelCor">Cor Conteúdo</label><br/>
                    <input type="color"name="corConteudo" id="corConteudo" class="cor"  value="#ffffff">
                  </div><br/>
                

                </div>

                    <input type="reset" name="limpar" value="Limpar" class="botao" id="botaoLimpar" onclick="info()">
                    <input type="submit" name="cadastrar" value="Enviar" class="botao" id="botaoCadastrar" >


        </fieldset>
    <div class="logo">
        <img src="../imagens/sonicDiv.png" alt="">
    </div>
    <div id="boxMensagemInserir">
        
    </div> 
</form>
<!-- FIM FORM INSERIR JOGOS -->



<!-- FORM EDITAR JOGOS -->
    <form id="gerenciadorEditar" action="" method="post">  
        <fieldset class="boxGerenciador">
           <h1>Editar Jogos</h1>
           
           <div id="cadastro">
           
            <label class="nomeCampo">Código:</label>
            <input list="inputeditar" name="codEditar" class="input"  >
                <datalist name="codEditar" class="input" id="inputeditar" >
                <?php
                    foreach ($jogos as $key => $value) {
                ?>
                    <option value="<?=$value->id_jogo;?>"><?=$value->titulo_jogo?></option>       
                <?php
                    }
                ?>
                <!-- <option value="Internet Explorer">
                <option value="Firefox">
                <option value="Chrome">
                <option value="Opera">
                <option value="Safari"> -->
                </datalist>
                <br/>
            <label class="nomeCampo">Título:</label><input type="text" name="tituloEditar" class="input" id"campoTitulo" maxlength="45" required><br/>
            <label class="nomeCampo">Genêro:</label><input type="text" name="generoEditar" class="input" id="campoGenero" maxlength="45" required><br/>
            <label class="nomeCampo">Players:</label><input type="number" min="1" name="playersEditar" class="campoNumber input" id="campoPlayers" required>
            <div class="boxVideo">
                <label class="labelVideo">Vídeo</label><br/>
                <input type="file" name="videoEditar" value="Video" id="fileVideo" class="campoVideo" value="background.php" accept=".mp4" required>
            </div>
                
            
            <br><br>
            <div class="boxFaixaEtaria">
            <label class="labelBox">Faixa Etária</label><br/>
                <input type="radio" value="livre" name="faixaEditar" class="campoRadio" id="livre" required><label class="nomeCampoRadio">Livre</label>
                <input type="radio" value="10"name="faixaEditar" class="campoRadio" id="dez" required><label class="nomeCampoRadio">10 anos</label>
                <input type="radio" value="12"name="faixaEditar" class="campoRadio" id="doze" required><label class="nomeCampoRadio">12 anos</label>
                <input type="radio" value="14" name="faixaEditar" class="campoRadio" id="quatorze" required> <label class="nomeCampoRadio">14 anos</label>
                <input type="radio" value="16"name="faixaEditar" class="campoRadio" id="dezesseis" required><label class="nomeCampoRadio">16 anos</label>
                <input type="radio" value="18"name="faixaEditar" class="campoRadio" id="dezoito" required><label class="nomeCampoRadio">18 anos</label><br/>
                
            </div>
              
            <br><br>
                <div class="boxModoJogo">
                    <label class="labelBox">Modo de Jogo</label><br/>
                    <input type="radio" value="Online" name="modoEditar" class="campoRadio" id="campoOn" required><label class="nomeCampoRadio">On</label>
                    <input type="radio" value="Online-Offline"name="modoEditar" class="campoRadio" id="campoOnOff" required><label class="nomeCampoRadio">On/Off</label>
                    <input type="radio" value="Offline"name="modoEditar" class="campoRadio" id="campoOff" required><label class="nomeCampoRadio">Off</label><br/>
                </div>
                
                <div class="boxIdioma">
                    <label class="labelBox">Idioma</label><br/>
                    <input type="radio" value="português" name="idiomaEditar" class="campoRadio" id="campoIdiomaPt" required><label class="nomeCampoRadio">Português</label>
                    <input type="radio" value="legendado"name="idiomaEditar" class="campoRadio" id="campoIdiomaLegendaPt" required><label class="nomeCampoRadio">Legendado</label>
                    <input type="radio" value="inglês"name="idiomaEditar" class="campoRadio" id="campoIdiomaIngles" required>  <label class="nomeCampoRadio">Inglês</label><br/>
                </div>
       
                <div class="boxCor">  
                  
                  <div class="divCor">                                                                              
                     <label class="labelCor">Cor Legenda</label><br/>
                     <input type="color"name="corLegendaEditar" id="corLegenda" class="cor"  value="#400080">
                  </div>
                  
                  <div class="divCor">
                    <label class="labelCor">Cor Título</label><br/>
                    <input type="color"name="corTituloEditar" id="corTitulo" class="cor"  value="#FFB800">
                  </div>
                  
                  <div class="divCor">
                    <label class="labelCor">Cor Conteúdo</label><br/>
                    <input type="color"name="corConteudoEditar" id="corConteudo" class="cor"  value="#ffffff">
                  </div><br/>
                   


                  </div>
                    <input type="reset" name="limpar" value="Limpar" class="botao" id="botaoLimpar">
                    <input type="button" name="editar" value="Editar" class="botao" id="botaoEditar">
            </div>

        </fieldset>
     <div class ="logo" style="left:68.8%">
        <img src="../imagens/tails.png" alt="" >
    </div>
    <div id="boxMensagemEditar">
        
    </div>
    </form>

<!-- FIM FORM EDITAR JOGOS     -->


<!-- FORM APAGAR JOGOS -->
        <form id="gerenciadorApagar" action="" method="post" >  
            
        <fieldset class="boxGerenciador">
           <h1>Apagar Jogos</h1>
           <div id="cadastro">
                <label class="nomeCampo">Título do Jogo:</label><input type="text" name="codAPagar" class="input" id="campoCodigo" maxlength="12" required placeholder="Digite o título do jogo"><br/>
            </div>
            <div id="boxTabela">
                <table id="tabelaApagar" class="tabela">
                    
                </table>
            </div>
        </fieldset>
    <div class ="logo" style="left:68.8%">
        <img src="../imagens/shadow.png" alt="" >
    </div>

    <div id="boxMensagemApagar">
        
    </div>
    </form>
<!-- FIM FORM APAGAR JOGOS     -->

<!--INICIO FORM RANKING-->
       <form id="gerenciadorRanking" action="" method="post">  
            
        <fieldset class="boxGerenciador">
           <h1 onclick="info()">Ranking</h1>
           <div id="cadastro">
                
            </div>
            <div id="boxTabela">
                <?php
                    $tamanho = count($dados);
                if ($tamanho <> 0) { 
                ?>
                <table  class="tabela" id="tabelaRanking">
                    <?php
                    $x = 0;
                        foreach ($dados as $dado) {
                    ?>
                    <tr>
                        <td><?= $dado->titulo_jogo ?></td>
                        <td><?= $dado->visualizacao ?></td>
                    </tr>
                    <?php

                        }
                    ?>
                </table>
                <?php 
                }else{
                    echo "<h1>Nenhum jogo visualizado</h1>";
                }
                ?>
            </div>
        </fieldset>
    <div class ="logo" style="left:68.8%">
        <img src="../imagens/knuckles.png" alt="" >
    </div>
    </form>
<!--FIM FORM RANKING-->
    <a href="../index.php">
        <img src="../imagens/voltar.png" alt="voltar" id="voltar" title="Voltar para gerenciador">
    </a>
    

    
</body>
</html>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/main.js"></script>
<?php
    require_once "../site/inserir.php";
?>
<?php
    require_once "../classes/controller.class.php";

    // Instância um objeto Controller passando como parâmetro o nome da tabela que será manipulada
    $controller = new controller('tab_jogos');
    if($_POST){
      $_POST['senha'] = md5($_POST['senha']);
      
      $sql = "SELECT id FROM login WHERE user = '".$_POST['user']."' AND senha = '".$_POST['senha']."'";
      
      $user = $controller->getDados($sql);
      if($user[0]){
        session_start();
        $_SESSION['login'] = $user[0]->id;
        header("Location: gerenciador.php");
      }
      
    }


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


<!-- FORM LOGIN  -->
    <form id="gerenciadorlogin" action="" method="post" enctype="multipart/form-data">  
        <fieldset class="boxGerenciador">
           <h1>Login</h1>
           <div id="Login">

            <label class="nomeCampo">Usuário:</label><input type="text" name="user" class="input" id="campoCodigo" maxlength="13" required autofocus=""><br/>
            <label class="nomeCampo">Senha:</label><input type="password" name="senha" class="input" maxlength="45" required><br/>
                
            <input type="submit" name="login" value="Entrar" class="botao" id="botaoLogin" >

        </fieldset>
    <div id="boxMensagemLogin">
        
    </div> 
</form>
<!-- FIM FORM LOGIN -->

    <a href="../index.php">
        <img src="../imagens/voltar.png" alt="voltar" id="voltar" title="Voltar para gerenciador">
    </a>
    
    
  </body>
</html>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/main.js"></script>

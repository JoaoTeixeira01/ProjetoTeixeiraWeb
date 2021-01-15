<?php
    // Index
    session_start();
    $sessao_user = null;
    include 'install.php';
    
    //verifica se já existe uma sessao iniciada
    if(isset($_SESSION['user']))
    {
		include 'cabecalho.php';
        echo '
        <div class="mensagem"><strong>'.$_SESSION['user'].'</strong>,  Já se encontra dentro do nosso site.<br>
        ';
        if ($_SESSION['ID_Tipo_Utilizador'] == 1)
		{
		echo '<a href="logado_admin.php">Continuar</a>';
		exit();
		}
	   else if ($_SESSION['ID_Tipo_Utilizador'] == 3)
	   {
		echo'<a href="logado.php">Continuar</a>';
		exit();
	   }
	   else
	   {
		echo'<a href="logado_funcionario.php">Continuar</a>';
		exit();
		}

      echo'
      </div>
        <center><a href="logado.php">
        
        ';
        exit;
    }

        include 'paginainicial.php';
        include 'cabecalho.php';
        echo'
        <div class="transbox">
        
        <center><img src="mensagem.png" width="600" alt="fjk"><br><br>
        <center><img src="sadgif.gif" width="250" alt="Serviços de apoio domiciliário">

        

        </div>
        <br><center><a href="login.php"> <input class ="button"type="button"value="Entrar no Site"></a><br>
        ';

  exit();   
?>

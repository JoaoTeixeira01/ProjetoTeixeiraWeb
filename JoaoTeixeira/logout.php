
<?php

 //logout
 session_start();
 include 'paginainicial.php';
include 'cabecalho.php';
 
 $mensagem="Página não disponível a visitantes.";
 if(isset($_SESSION['user']))

 echo '<center><img src="imagenslogout/logout_gif.gif" width="400" alt="S.A.D">';
 $mensagem='<strong>'.$_SESSION['user'].'</strong>';

//faz logout do utilizador
 unset($_SESSION['user']);
 
 //apresenta a caixa com a mensagem
 echo'<div class ="login_sucesso">'.$mensagem.'<br><br>
 <center><a href="index.php"><button class="button" type="submit" name="btn_submit"value="Registar">Início</button></a>
  </div>';
 
?>
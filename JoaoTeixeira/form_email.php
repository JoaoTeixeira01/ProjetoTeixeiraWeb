<?php
    //FORUM
    session_start();
    if(!isset($_SESSION['user']))   
    {
        include 'cabecalho.php';
	echo '<div class="erro "><center><img src="permissoes.png" width="400" alt="S.A.D"><br><br>
	<center><a href="index.php"> <input class ="button"type="button" value="Retroceder "></a><br><br>
	</div>';
	exit;
    }

    if ($_SESSION['ID_Tipo_Utilizador'] == 1)
    {
        include 'logado_admin.php';
    }
   else if ($_SESSION['ID_Tipo_Utilizador'] == 3)
   {
    include 'logado.php';
   }
   else
   {
    include 'logado_funcionario.php';
    }

    include 'cabecalho.php';
     //dados do utilizador que está logado
     echo '<div class="dados_utilizador">
        <img src="images/avatars/'.$_SESSION['avatar'].'" width="40"> | Conta:<span>'.$_SESSION['user'].'</span> | <a href="logout.php"><button class="button" >Sair</button></a>
        </div><hr>';

   //verificar se foram inseridos os dados
	if(!isset($_POST['btn_submit']))
    {
        ApresentarFormulario();
    }
    else
    {
        enviar_email();
    }

    function ApresentarFormulario()
{
	
//apresenta o formulario para novos tipos de serviço
 echo'
 <center>
 <br><br><br><br>
    <form  method="post" action="form_email.php?a=enviar" enctype="multipart/form-data">
    
    <img src="enviarmail.png" width="500" alt="Serviços de apoio domiciliário"><br><br>
    
	<img src="assunto.png" width="250" alt="Serviços de apoio domiciliário"><br>
    <input type="text" name="assunto" size="95"><br><br>

    <img src="mensagem2.png" width="250" alt="Serviços de apoio domiciliário"><br><br>
    <textarea rows="10" cols="97" name="mensagem"></textarea><br><br>
    
    <button class="button" type="submit" name="btn_submit" value="Enviar">Enviar</button><br>
    

	</center>
    </form>
<center><div>
    <a href="agenda.php"><input class ="button"type="button"value="Voltar à Agenda"></a><br>
    </div>
	';
}

function enviar_email()
{

    $assunto=$_POST['assunto'];
    $mensagem=$_POST['mensagem'];
    $email='gestao.sad9@gmail.com';
    $erro=false;

    //Verificações
	if(empty($assunto) || empty($mensagem))
	{
		//Erro- Não foram preenchidos os campos
		echo'
		<div class="erro">Não Foram preenchidos todos os campos necessários.</div>
		';
		$erro=true;
	} 	
	
	//verificar se existiram erros
	
	if($erro)
	{
		ApresentarFormulario();
		exit;
	}
    else
    {
    require 'enviar_email.php';
    $mail->Subject="$assunto";
    $mail->Body="$mensagem";
    $mail->addAddress($email);
    $mail->send($_SESSION['email']);
    echo '<center><img src="emailenviado.gif" width="400" alt="S.A.D">
    <center><a href="form_email.php"><button class="button">Voltar</button></a>';
    }
}
?>      
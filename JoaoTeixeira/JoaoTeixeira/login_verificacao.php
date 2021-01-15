<?php

	
	//verifica os dados do login
	
	session_start();
	
	if(isset($_SESSION['user']))
	{
		include 'paginainicial.php';
		include 'cabecalho.php';
		echo '<div class=mensagem>echo<center><img src="jaseencontra.png" width="400" alt="S.A.D"><br>
		';
		if ($_SESSION['ID_Tipo_Utilizador'] == 1)
    {
        echo '<a href="logado_admin.php">Entrar<button class="button" >Login</button></a>';
    }
   else if ($_SESSION['ID_Tipo_Utilizador'] == 3)
   {
		echo '<a href="logado.php">Entrar<button class="button" >Login</button></a>';
   }
   else
   {
		echo '<a href="logado_funcionario.php">Entrar<button class="button" >Login</button></a>';
    }
		exit();
	}


	//includes
	include 'paginainicial.php';
	
	$utilizador = "";
	$password_utilizador = ""; 
	
	if(isset($_POST['text_utilizador']))
	{
		$utilizador = $_POST['text_utilizador'];
		$password_utilizador = $_POST['text_password'];
	}

	
	//verificar se os campos foram preenchidos
	if($utilizador == "" || $password_utilizador == "")
	{
		include 'cabecalho.php';
		//erro-campos não preenchidos
		echo '

		<center><img src="imagenserro/erro.png" width="240" alt="S.A.D"><br><br><br>

		<hr><br><br>

		<center><img src="imagenserro/naopreencheu.png" width="420" alt="S.A.D"><br><br>
		

		<center><a href="login.php"><button class="button" type="submit" name="btn_submit">Tentar Novamente</button></a>
		';
		exit;
	}
	
	//verificar dos dados login
	
	$passwordEncriptada=md5($password_utilizador);
	
	include 'config.php';
	$user = "root";
	$password = "1234";
	$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
	
	//verificar se o utilizador existe ou nao
	$motor=$ligacao->prepare("SELECT * FROM utilizador where username = ? and pass_word = ?");
	
	$motor->bindParam(1, $utilizador, PDO::PARAM_STR);
	$motor->bindParam(2, $passwordEncriptada, PDO::PARAM_STR);
	$motor->execute();
	$ligacao = null; 
	
	//verifica se os dados correspondem a valores da base de dados
	if($motor->rowCount() == 0)
	{
		include 'cabecalho.php';
		//erro - dados inválidos
		echo'<div class="erro">
		Dados de login inválidos.<br><br>
		<br><center><a href="login.php"> <input class ="button"type="button"value="Tentar Novamente"></a><br>
		</div>';
		exit();
	}
	else
	{
		include 'cabecalho.php';
		///defenir os dados da sessão
		$dados_user=$motor->fetch(PDO::FETCH_ASSOC);
		$_SESSION['pass'] = $dados_user['pass_word'];
		$_SESSION['ID_Utilizador'] = $dados_user['ID_Utilizador'];
		$_SESSION['ID_Tipo_Utilizador'] = $dados_user['ID_Tipo_Utilizador'];
		$_SESSION['user'] = $dados_user['username'];
		$_SESSION['avatar'] = $dados_user['avatar'];
		$_SESSION['estado'] = $dados_user['estado'];
		$_SESSION['email'] = $dados_user['email'];
		$_SESSION['nome'] = $dados_user['nome'];
		$_SESSION['apelido'] = $dados_user['apelido'];
		
		if($dados_user['estado'] == "ativo")
		{


			echo '<center><img src="imagensbemvindo/bemvindo_gif.gif" width="400" alt="S.A.D">';
		echo'<div class="login_sucesso">
			<strong>'.$utilizador.'</strong><br><br>
			';
			
			if ($_SESSION['ID_Tipo_Utilizador'] == 1)
		{
		echo '
		<center><a href="logado_admin2.php"><button class="button" type="submit" name="btn_submit"value="Registar">Continuar para o Site</button></a>';
		exit();
		}
	   else if ($_SESSION['ID_Tipo_Utilizador'] == 3)
	   {
		echo'<center><a href="logado2.php"><button class="button" type="submit" name="btn_submit"value="Registar">Continuar para o Site</button></a>';
		exit();
	   }
	   else
	   {
		echo'<center><a href="logado_funcionario2.php"><button class="button" type="submit" name="btn_submit"value="Registar">Continuar para o Site</button></a>';
		exit();
		}
		}
		else
		{
			
		//erro - utilizador não ativo
		echo'<div>


		<center><img src="imagenserro/erro.png" width="240" alt="S.A.D"><br><br><br>

		<hr><br><br>

		<img src="imagenserro/userinativo.png" width="440" alt="S.A.D"><br><br>


		<center><a href="login.php"><button class="button" type="submit" name="btn_submit">Tentar Novamente</button></a>
		';
		session_destroy();
		exit();
		}
}


	
?>
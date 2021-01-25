<?php
	include 'paginainicial.php';
//signup

	session_start();
	unset($_SESSION['user']);

	function idade($datanascimento){
		$dn = new DateTime($datanascimento);
		$agora = new DateTime();
	
		$idade = $agora->diff($dn);
		return $idade->y;
		}
	unset($_SESSION['user']);

	include 'cabecalho.php';
//verificar se foram inseridos os dados do utilizador
	if(!isset($_POST['btn_submit']))
{
	ApresentarFormulario();
}
else
{
	RegistarUtilizador();
}



//Funcao formulario

function ApresentarFormulario()
{
	
//apresenta o formulario para novo utilizador
 echo'
 <center>
 <br><br><br><br>
 <img src="registar.png" width="350" alt="S.A.D">
	<form class="form_signup" method="post" action="registar.php?a=registar" enctype="multipart/form-data"
	<hr><br>

	
	<!-- ////////////////////////////////////////////////////// -->
 
	<center><img src="imagensregistar/username.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">

	<br> <input type="text" size="20" name="text_utilizador" required="" placeholder="Introduzir o Username"  pattern=".{5,}" title="(Tem de colocar no mínimo 5 caracteres"

	';
							if(!empty($_SESSION['username'])){
								echo 'value="'.$_SESSION['username'].'"';
								unset($_SESSION['username']);
							} echo'
							><br><br></td>
	<!-- ////////////////////////////////////////////////////// -->
 
	<center><img src="imagensregistar/nome.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="text" size="30" name="nome_utilizador" required="" placeholder="Introduzir o Nome" pattern=".{3,}" title="(Tem de colocar no mínimo 3 caracteres"
	';
							if(!empty($_SESSION['nome'])){
								echo 'value="'.$_SESSION['nome'].'"';
								unset($_SESSION['nome']);
							} echo'
							><br><br></td>

	<!-- ////////////////////////////////////////////////////// -->
	
	<center><img src="imagensregistar/apelido.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="text" size="30" name="apelido_utilizador" required="" placeholder="Introduzir o Apelido" pattern=".{5,}" title="(Tem de colocar no mínimo 5 caracteres"
	';
							if(!empty($_SESSION['apelido'])){
								echo 'value="'.$_SESSION['apelido'].'"';
								unset($_SESSION['apelido']);
							} echo'
	><br><br></td>

	<!-- ////////////////////////////////////////////////////// -->

	<center><img src="imagensregistar/password.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="password" size="20" name="text_password_1" required="" placeholder="Introduzir a Password"   pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="A password precisa de conter um número, uma letra maiúscula e pelo menos 8 caracteres"
	';
							if(!empty($_SESSION['password1'])){
								echo 'value="'.$_SESSION['password1'].'"';
								unset($_SESSION['password1']);
							} echo'
	><br><br>

	<!-- ////////////////////////////////////////////////////// -->
	
	<center><img src="imagensregistar/confirmarpassword.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="password" size="20" name="text_password_2" required="" placeholder="Confirme a Password"  pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="A password precisa de conter um numero e uma letra maiúscula e pelo menos 8 caracteres"
	';
							if(!empty($_SESSION['password2'])){
								echo 'value="'.$_SESSION['password2'].'"';
								unset($_SESSION['password2']);
							} echo'><br><br>

	<!-- ////////////////////////////////////////////////////// -->
	
	<center><img src="imagensregistar/email.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">

	<input type="email" size="40" name="email_utilizador" required="" placeholder="Introduzir o Email"
	';
							if(!empty($_SESSION['email'])){
								echo 'value="'.$_SESSION['email'].'"';
								unset($_SESSION['email']);
							} echo'><br><br>

	<!-- ////////////////////////////////////////////////////// -->
	
	<center><img src="imagensregistar/sexo.png" width="240" alt="S.A.D"><br>

	<center><img src="barra.png" width="150" alt="S.A.D"><br>
	
	<h2><input type="radio" name="sexo_utilizador" value="masculino" checked="checked"/>Masculino
                <input type="radio" name="sexo_utilizador" value="feminino"/>Feminino<br><br></h2>
	
	<!-- ////////////////////////////////////////////////////// -->

	<center><img src="imagensregistar/datanascimento.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="Date" size="20" name="data_utilizador"
	';
							if(!empty($_SESSION['data'])){
								echo 'value="'.$_SESSION['data'].'"';
								unset($_SESSION['data']);
							} echo'><br><br>

	<!-- ////////////////////////////////////////////////////// -->
	
	<center><img src="imagensregistar/morada.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="text" size="40" name="morada_utilizador" required="" placeholder="Introduzir a Morada"
	';
							if(!empty($_SESSION['morada'])){
								echo 'value="'.$_SESSION['morada'].'"';
								unset($_SESSION['morada']);
							} echo'><br><br>

	<!-- ////////////////////////////////////////////////////// -->
	
	<center><img src="imagensregistar/telemovel.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="number_format" size="9" name="telemovel_utilizador" required="" maxlength="9" minlength="9" placeholder="Introduzir o Número de Telemóvel" $pattern = "/9[1236][0-9]{7}|2[1-9]{1,2}[0-9]{7}/"; type="tel"
	';
							if(!empty($_SESSION['telemovel'])){
								echo 'value="'.$_SESSION['telemovel'].'"';
								unset($_SESSION['telemovel']);
							} echo'><br><br>

	<!-- ////////////////////////////////////////////////////// -->
	
	<center><img src="imagensregistar/nif.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="number_format" size="9" name="nif_utilizador" required="" maxlength="9" minlength="9" type="number"  placeholder="Introduzir o NIF"
	';
							if(!empty($_SESSION['nif'])){
								echo 'value="'.$_SESSION['nif'].'"';
								unset($_SESSION['nif']);
							} echo'><br><br>

	<!-- ////////////////////////////////////////////////////// -->	
	
	<input type="hidden" name="estado" value="ativo">

	<input type="hidden" name="cc" value="">

	<input type="hidden" name="cs" value="">

	<input type="hidden" name="habilitacoes" value="">

	<input type="hidden" name="tipo_conta" value="3">

	<input type="hidden" name="MAX_FILE_SIZE" value="500000">

	<!-- ////////////////////////////////////////////////////// -->

	<center><img src="imagensregistar/fotoperfil.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="file" name="imagem_avatar"><br><br>

	<small>(Imagem do tipo <strong> JPG,</strong> tamanho máximo: <strong>50kb)</strong></small><br><br>

	<!-- ////////////////////////////////////////////////////// -->
	
	<br><div  style="color:red">Nota: Todos os campos são obrigatórios com exceção da foto de perfil!</div><br><br>

	<button class="button" type="submit" name="btn_submit"value="Registar">Registar Utilizador</button>
	</center>
	
	
	</form>
	';
}
	
	
//Funcao Registar 

function RegistarUtilizador()
{
	$utilizadores = $_POST['text_utilizador'];
	$nome = $_POST['nome_utilizador'];
	$apelido = $_POST['apelido_utilizador'];
	$password_1 = $_POST['text_password_1'];
	$password_2 = $_POST['text_password_2'];
	$email = $_POST['email_utilizador'];
	$sexo = $_POST['sexo_utilizador'];
	$data_nasc = $_POST['data_utilizador'];
	$morada = $_POST['morada_utilizador'];
	$telemovel = $_POST['telemovel_utilizador'];
	$nif = $_POST['nif_utilizador'];
	$cc = $_POST['cc'];
	$cs = $_POST['cs'];
	$hab = $_POST['habilitacoes'];
	$estado = $_POST['estado'];
	$id_tipo_utilizador = $_POST['tipo_conta'];
	
	//avatar
	$avatar = $_FILES['imagem_avatar'];
	$avatar_default = 'default.png';
	$erro=false;
	
	//Verificações
	if(empty($utilizadores) || empty($nome) || empty($apelido)|| empty($password_1) || empty($password_2)  || empty($email) || empty($sexo) || empty($data_nasc) || empty($morada) || empty($telemovel) )
	{
		//Erro- Não foram preenchidos os campos
		echo'
		<div class="erro">Não Foram preenchidos todos os campos necessários.</div>
		';
				$_SESSION['username'] = $utilizadores;
				$_SESSION['nome'] = $nome;
				$_SESSION['apelido'] = $apelido;
				$_SESSION['password1'] = $password_1;
				$_SESSION['password2'] = $password_2;
				$_SESSION['email'] = $email;
				$_SESSION['data'] = $data_nasc;
				$_SESSION['morada'] = $morada;
				$_SESSION['telemovel'] = $telemovel;
				$_SESSION['nif'] = $nif;

		$erro=true;
	} 	
	else if($password_1 != $password_2)
	{
		//ERRO - verificar passwords iguais
		echo '
		<div class="erro">As passwords são diferentes.</div>
		';
		$_SESSION['username'] = $utilizadores;
				$_SESSION['nome'] = $nome;
				$_SESSION['apelido'] = $apelido;
				$_SESSION['password1'] = $password_1;
				$_SESSION['password2'] = $password_2;
				$_SESSION['email'] = $email;
				$_SESSION['data'] = $data_nasc;
				$_SESSION['morada'] = $morada;
				$_SESSION['telemovel'] = $telemovel;
				$_SESSION['nif'] = $nif;
		$erro=true;
	}
	else if($data_nasc > date('Y-m-j', time()) )
	{
		//erro data
		echo'
		<div class="erro">Data De nascimento superior à atual!</div>
		';
		$_SESSION['username'] = $utilizadores;
				$_SESSION['nome'] = $nome;
				$_SESSION['apelido'] = $apelido;
				$_SESSION['password1'] = $password_1;
				$_SESSION['password2'] = $password_2;
				$_SESSION['email'] = $email;
				$_SESSION['data'] = $data_nasc;
				$_SESSION['morada'] = $morada;
				$_SESSION['telemovel'] = $telemovel;
				$_SESSION['nif'] = $nif;
		$erro=true;
	}
	else if(idade($data_nasc) < 18)
        {
			echo '<div class="erro">Não são permitidos utilizadores menores de 18 anos de idade.<br></div>
			';
			$_SESSION['username'] = $utilizadores;
				$_SESSION['nome'] = $nome;
				$_SESSION['apelido'] = $apelido;
				$_SESSION['password1'] = $password_1;
				$_SESSION['password2'] = $password_2;
				$_SESSION['email'] = $email;
				$_SESSION['data'] = $data_nasc;
				$_SESSION['morada'] = $morada;
				$_SESSION['telemovel'] = $telemovel;
				$_SESSION['nif'] = $nif;
            $erro = true;

        }
	//erro avatar
	
	else if($avatar['name'] != "" && $avatar['size'] > $_POST['MAX_FILE_SIZE'])
	{
		//erro tamanho de ficheiro
		echo'
		<div class="erro">Ficheiro de imagem maior do que o permitido!</div>
		';
		$_SESSION['username'] = $utilizadores;
				$_SESSION['nome'] = $nome;
				$_SESSION['apelido'] = $apelido;
				$_SESSION['password1'] = $password_1;
				$_SESSION['password2'] = $password_2;
				$_SESSION['email'] = $email;
				$_SESSION['data'] = $data_nasc;
				$_SESSION['morada'] = $morada;
				$_SESSION['telemovel'] = $telemovel;
				$_SESSION['nif'] = $nif;
		$erro=true;
	}
	else if($avatar['name'] == "")
	{
		$avatar['name'] = $avatar_default;
	}

	//verificar se existiram erros
	
	if($erro)
	{
		ApresentarFormulario();
		exit;
	}
	
	//Processamento do registo do novo utilizador
	include 'config.php';
	$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
	
	//verificar se já existe um utilizador com o mesmo username
	
	$motor=$ligacao->prepare("Select username FROM utilizador WHERE username = ?");
	$motor->bindParam(1, $utilizadores, PDO::PARAM_STR);
	$motor->execute();
	
	if($motor->rowCount() != 0)
	{
		//erro-Utilizador já se encontra registado
		echo'<div class="erro">Já existe um utilizador com o mesmo username.</div>';
		$ligacao=null;
		ApresentarFormulario();
		exit;

	}
	else
	{
		//registo do utilizador
		$motor=$ligacao->prepare("SELECT MAX(id_utilizador) AS MaxID FROM utilizador");
		$motor->execute();
		$id_temp=$motor->fetch(PDO::FETCH_ASSOC)['MaxID'];
		
		if($id_temp==null)
			$id_temp==0;
		else
			$id_temp++;
		
		//encriptar password
		$passwordEncriptada=md5($password_1);
		
		$sql="INSERT INTO utilizador VALUES( :ID_Utilizador, :nome, :apelido, :user, :email, :pass_word, :estado, :morada, :sexo, :data_nascimento, :telemovel, :avatar, :cc, :nif, :cs, :habilitacoes, :ID_Tipo_Utilizador)";

		$motor=$ligacao->prepare($sql);
		$motor->bindParam(":ID_Utilizador", $id_temp, PDO::PARAM_INT);
		$motor->bindParam(":nome", $nome, PDO::PARAM_STR);
		$motor->bindParam(":apelido", $apelido, PDO::PARAM_STR);
		$motor->bindParam(":user", $utilizadores, PDO::PARAM_STR);
		$motor->bindParam(":email", $email, PDO::PARAM_STR);
		$motor->bindParam(":pass_word", $passwordEncriptada, PDO::PARAM_STR);
		$motor->bindParam(":estado", $estado, PDO::PARAM_STR);
		$motor->bindParam(":morada", $morada, PDO::PARAM_STR);
		$motor->bindParam(":sexo", $sexo, PDO::PARAM_STR);
		$motor->bindParam(":data_nascimento", $data_nasc, PDO::PARAM_STR);
		$motor->bindParam(":telemovel", $telemovel, PDO::PARAM_INT);
		$motor->bindParam(":avatar", $avatar['name'], PDO::PARAM_STR);
		$motor->bindParam(":cc", $cc, PDO::PARAM_STR);
		$motor->bindParam(":nif", $nif, PDO::PARAM_INT);
		$motor->bindParam(":cs", $cs, PDO::PARAM_INT);
		$motor->bindParam(":habilitacoes", $hab, PDO::PARAM_STR);
		$motor->bindParam(":ID_Tipo_Utilizador", $id_tipo_utilizador, PDO::PARAM_INT);

		$motor->execute();
		$ligacao=null;

		move_uploaded_file($avatar['tmp_name'], "images/avatars/".$avatar['name']);
		
		}
		//upload do ficheiro de imagem do avatar para o servidor WEB
		//apresentar uma mensagem de boas vindas ao utilizador
		echo'<center><img src="imagensbemvindo/bemvindo_gif.gif" width="400" alt="S.A.D">
		<div class="login_sucesso">
			<strong>'.$utilizadores.'</strong><br><br>
			<a href="login.php"><button class="button" >Login</button></a>
		</div>
		';
		
	
}
?>

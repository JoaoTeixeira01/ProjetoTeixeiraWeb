<?php
	include 'logado_admin.php';
//signup

	session_start();

	function idade($datanascimento){
		$dn = new DateTime($datanascimento);
		$agora = new DateTime();
	
		$idade = $agora->diff($dn);
		return $idade->y;
		}

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
	<form class="form_signup" method="post" action="adicionar_func.php?a=funcionario" enctype="multipart/form-data"
	<hr><br>

	
	<!-- ////////////////////////////////////////////////////// -->
 
	<center><img src="imagensregistar/username.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">

	<br> <input type="text" size="20" name="text_utilizador" required="" placeholder="Introduzir o Username" pattern=".{5,}" title="(Tem de colocar no mínimo 5 caracteres"><br><br></td>

	<!-- ////////////////////////////////////////////////////// -->
 
	<center><img src="imagensregistar/nome.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="text" size="30" name="nome_utilizador" required="" placeholder="Introduzir o Nome" pattern=".{3,}" title="(Tem de colocar no mínimo 3 caracteres"><br><br></td>

	<!-- ////////////////////////////////////////////////////// -->
	
	<center><img src="imagensregistar/apelido.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="text" size="30" name="apelido_utilizador" required="" placeholder="Introduzir o Apelido" pattern=".{5,}" title="(Tem de colocar no mínimo 5 caracteres"><br><br></td>

	<!-- ////////////////////////////////////////////////////// -->

	<center><img src="imagensregistar/password.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="password" size="20" name="text_password_1" required="" placeholder="Introduzir a Password"  pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="A password precisa de conter um número, uma letra maiúscula e pelo menos 8 caracteres"><br><br>

	<!-- ////////////////////////////////////////////////////// -->
	
	<center><img src="imagensregistar/confirmarpassword.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="password" size="20" name="text_password_2" required="" placeholder="Confirme a Password"   pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="A password precisa de conter um numero e uma letra maiúscula e pelo menos 8 caracteres"><br><br>

	<!-- ////////////////////////////////////////////////////// -->
	
	<center><img src="imagensregistar/email.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">

	<input type="email" size="40" name="email_utilizador" required="" placeholder="Introduzir o Email"><br><br>

	<!-- ////////////////////////////////////////////////////// -->
	
	<center><img src="imagensregistar/sexo.png" width="240" alt="S.A.D"><br>

	<center><img src="barra.png" width="150" alt="S.A.D"><br>
	
	<h2><input type="radio" name="sexo_utilizador" value="masculino" checked="checked"/>Masculino
                <input type="radio" name="sexo_utilizador" value="feminino"/>Feminino<br><br></h2>
	
	<!-- ////////////////////////////////////////////////////// -->

	<center><img src="imagensregistar/datanascimento.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="Date" size="20" name="data_utilizador"><br><br>

	<!-- ////////////////////////////////////////////////////// -->
	
	<center><img src="imagensregistar/morada.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="text" size="40" name="morada_utilizador" required="" placeholder="Introduzir a Morada"><br><br>

	<!-- ////////////////////////////////////////////////////// -->
	
	<center><img src="imagensregistar/telemovel.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="number_format" size="9" name="telemovel_utilizador" required="" maxlength="9" placeholder="Introduzir o Número de Telemóvel" $pattern = "/9[1236][0-9]{7}|2[1-9]{1,2}[0-9]{7}/"; type="tel"><br><br>

	<!-- ////////////////////////////////////////////////////// -->
	
	<center><img src="imagensregistar/nif.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="number_format" size="9" name="nif_utilizador" required="" maxlength="9" minlength="9" type="number" placeholder="Introduzir o NIF"><br><br>

	<!-- ////////////////////////////////////////////////////// -->	
	
	<input type="hidden" name="estado" value="ativo">

	<input type="hidden" name="tipo_conta" value="2">

	<center><img src="cartaocidadao.png" width="250" alt="Serviços de apoio domiciliário"></center>
	<center><img src="barra.png" width="150" alt="S.A.D"><br>
	<input type="text" name="cc" value="" required="" pattern="[a-zA-Z0-9]+" type="text" maxlength="13" minlength="12" placeholder="Introduzir o Número do Cartão de Cidadão"><br><br>

	<center><img src="segurancasocial.png" width="250" alt="Serviços de apoio domiciliário"></center>
	<center><img src="barra.png" width="150" alt="S.A.D"><br>
	<input type="text" name="cs" value=""  placeholder="Introduzir o Número da Segurança Social" maxlength="11" minlength="11" type="number" ><br><br>

	<center><img src="habilitacoes.png" width="250" alt="Serviços de apoio domiciliário"></center>
	<center><img src="barra.png" width="150" alt="S.A.D"><br>
	<h2><input type="radio" name="habilitacoes" checked="checked" value="12º Ano ou equivalente"/>12º Ano ou equivalente<br>
	<input type="radio" name="habilitacoes" value="Superior"/>Superior<br></h2>

	<input type="hidden" name="MAX_FILE_SIZE" value="50000">

	<!-- ////////////////////////////////////////////////////// -->

	<center><img src="imagensregistar/fotoperfil.png" width="240" alt="S.A.D">

	<center><img src="barra.png" width="150" alt="S.A.D">
	
	<input type="file" name="imagem_avatar"><br><br>

	<small>(Imagem do tipo <strong> JPG,</strong> tamanho máximo: <strong>50kb)</strong></small><br><br>

	<!-- ////////////////////////////////////////////////////// -->
	
	<br><h3 style="color: red">Nota: Todos os campos são obrigatórios!</h3><br><br>

	<button class="button" type="submit" name="btn_submit"value="Registar">Registar Funcionário</button><br>
	</form>
	
	<a href="painelcontrolo.php"><input class ="button"type="button"value="Voltar"></a><br>
	</center>
	
	
	
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
	$avatar_empty = 'default.jpg';
	$avatar=$_FILES['imagem_avatar'];
	$erro=false;
	
	//Verificações
	if(empty($utilizadores) || empty($nome) || empty($apelido)|| empty($password_1) || empty($password_2)  || empty($email) || empty($sexo) || empty($data_nasc) || empty($morada) || empty($telemovel) || empty($nif) || empty($cc) || empty($cs) || empty($hab))
	{
		//Erro- Não foram preenchidos os campos
		echo'
		<div class="erro">Não Foram preenchidos todos os campos necessários.</div>
		';
		$erro = true;
	} 	
	else if($password_1 != $password_2)
	{
		//ERRO - verificar passwords iguais
		echo '
		<div class="erro">As passwords são diferentes.</div>
		';
		$erro = true;
	}
	else if($data_nasc > date('Y-m-j', time()) )
	{
		//erro data
		echo'
		<div class="erro">Data De nascimento superior à atual!</div>
		';
		$erro=true;
	}
		elseif(idade($data_nasc)<18)
        {
			echo '<div class="erro">Não são permitidos utilizadores menores de 18 anos de idade.<br></div>
			';
            $erro = true;
        }
	
	else if($avatar['name'] != "" && $avatar['size'] > $_POST['MAX_FILE_SIZE'])
	{
		//erro tamanho de ficheiro
		echo'
		<div class="erro">Ficheiro de imagem maior do que o permitido!</div>
		';
		$erro = true;
	}
	
	
	//verificar se existiram erros
	
	if($erro)
	{
		ApresentarFormulario();
		exit;
	}
	
	//Processamento do registo do novo utilizador
	include 'config.php';
	$user = "root";
	$password = "1234";
	$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
	
	//verificar se já existe um utilizador com o mesmo username
	
	$motor=$ligacao->prepare("Select username FROM utilizador WHERE username = ?");
	$motor->bindParam(1, $utilizadores, PDO::PARAM_STR);
	$motor->execute();
	
	if($motor->rowCount() != 0)
	{
		//erro-Utilizador já se encontra registado
		echo'<div class="erro">Já existe um utilizador com o mesmo username.</div>';
		$ligacao = null;
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
		
		$sql="INSERT INTO utilizador VALUES( :id_utilizador, :nome, :apelido, :user, :email, :pass_word, :estado, :morada, :sexo, :data_nascimento, :telemovel, :avatar, :cc, :nif, :cs, :habili, :id_tipo_utilizador)";

		$motor = $ligacao->prepare($sql);
		$motor->bindParam(":id_utilizador", $id_temp, PDO::PARAM_INT);
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
		$motor->bindParam(":habili", $hab, PDO::PARAM_STR);
		$motor->bindParam(":id_tipo_utilizador", $id_tipo_utilizador, PDO::PARAM_INT);

		$motor->execute();
		$ligacao = null;
		
		//upload do ficheiro de imagem do avatar para o servidor WEB
		move_uploaded_file ($avatar['name'], "images/avatars/".$avatar['name']);
	
		echo'
		<div class="novo_registo_sucesso"><h3>A conta com o username: <strong>'.$utilizadores.'</strong><br> foi adicionado com sucesso!</h3><br><br>
		<br><br>
		<a href="painelcontrolo.php">Painel de Controlo</a>
		</div>
		';
	}
}
?>
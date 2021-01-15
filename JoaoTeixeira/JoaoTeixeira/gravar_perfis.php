<?php
//Gravar Post

 session_start();
    if(!isset($_SESSION['user']))
    {
        include 'cabecalho.php';
	echo '<div class="erro "><center><img src="permissoes.png" width="400" alt="S.A.D"><br><br>
	<center><a href="index.php"> <input class ="button"type="button" value="Retroceder "></a><br><br>
	</div>';
	exit;
    } 

    
    include 'cabecalho.php';

    
    //dados do utilizador que está logado
    echo '<div class="dados_utilizador">
        <img src="images/avatars/'.$_SESSION['avatar'].'" width="40"> | Conta:<span>'.$_SESSION['user'].'</span> | <a href="logout.php"><button class="button" >Sair</button></a>
        </div><hr>';

    //Buscar dados dos perfil
        $ID_Utilizador = $_POST['ID_Utilizador'];
        $nome = $_POST['nome'];
        $apelido = $_POST['apelido'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pass_word = $_POST['password'];
        $estado = $_POST['estado'];
        $morada = $_POST['morada'];
        $data_nascimento = $_POST['data'];
        $telemovel = $_POST['telemovel'];
        $nif = $_POST['nif'];
        $avatar = $_POST['imagem_avatar'];
        $editar = false;

        if($pass_word == ""  )
    {
		//erro-campos não preenchidos
		echo '<div class="erro">
		A Palavra-Passe tem de ser alterada ou escrita novamente! <br><br>
		<a href="editor_perfis.php?pid='.$_SESSION['ID_Utilizador'].'">Tente Novamente</a>
		</div>';
		exit;
    }
    //Verificar se os campos estão preenchidos
    if($nome == "" || $apelido == "" || $username == "" || $email == ""  || $morada == ""  || $data_nascimento == "" || $telemovel == "" || $nif == "" )
    {
		//erro-campos não preenchidos
		echo '<div class="erro">
		Não Foram preenchidos os campos necessários.<br><br>
		<a href="editor_perfis.php">Tente Novamente</a>
		</div>';
		exit;
    }

     //Abrir ligação à base de dados
     include 'config.php';
     $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

    if($ID_Utilizador == -1)
    {
        //Vai buscar o id_utilizador disponivel
        $motor=$ligacao->prepare("SELECT MAX(ID_Utilizador) AS MaxID FROM utilizador");
        $motor->execute();
        $ID_Utilizador=$motor->fetch(PDO::FETCH_ASSOC) ['MaxID'];
        
        if($ID_Utilizador == null)
        {
        $ID_Utilizador = 0;
        }
        else
        {
        $ID_Utilizador++;
        $editar = false;
        }
    }
    else    
    {
        $editar=true;
    }

    if($_SESSION['ID_Utilizador'] != $ID_Utilizador)
    {
        if(!$editar)
    {

        $motor = $ligacao->prepare("INSERT INTO utilizador VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
        $motor->bindParam(1, $ID_Utilizador, PDO::PARAM_INT);
        $motor->bindParam(2, $nome, PDO::PARAM_STR);
        $motor->bindParam(3, $apelido, PDO::PARAM_STR);
        $motor->bindParam(4, $username, PDO::PARAM_STR);
        $motor->bindParam(5, $email, PDO::PARAM_STR);
        $motor->bindParam(7, $estado, PDO::PARAM_STR);
        $motor->bindParam(8, $morada, PDO::PARAM_STR);
        $motor->bindParam(9, $sexo, PDO::PARAM_STR);
        $motor->bindParam(10, $data_nascimento, PDO::PARAM_STR);
        $motor->bindParam(11, $telemovel, PDO::PARAM_INT);
        $motor->bindParam(12, $nif, PDO::PARAM_INT);
        $motor->bindParam(13, $avatar, PDO::PARAM_STR);
        $motor->execute();
    }
    else
    {
        $motor = $ligacao->prepare("UPDATE utilizador SET nome = :nome, apelido = :apelido, username = :username, email = :email,estado = :estado, morada = :morada, data_nascimento = :datanas, telemovel = :tele, nif = :nif, avatar = :avatar WHERE ID_Utilizador = :pid ");
        $motor->bindParam(":pid", $ID_Utilizador, PDO::PARAM_INT);
        $motor->bindParam(":nome", $nome, PDO::PARAM_STR);
        $motor->bindParam(":apelido", $apelido, PDO::PARAM_STR);
        $motor->bindParam(":username", $username, PDO::PARAM_STR);
        $motor->bindParam(":email", $email, PDO::PARAM_STR);
        $motor->bindParam(":estado", $estado, PDO::PARAM_STR); 
        $motor->bindParam(":morada", $morada, PDO::PARAM_STR);
        $motor->bindParam(":datanas", $data_nascimento, PDO::PARAM_STR);
        $motor->bindParam(":tele", $telemovel, PDO::PARAM_INT);
        $motor->bindParam(":nif", $nif, PDO::PARAM_INT);
        $motor->bindParam(":avatar", $avatar, PDO::PARAM_STR);
        $motor->execute();
    }
}
else
{
    
    //se for para editar
    if(!$editar)
    {

        $motor=$ligacao->prepare("INSERT INTO utilizador VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $motor->bindParam(1, $ID_Utilizador, PDO::PARAM_INT);
        $motor->bindParam(2, $nome, PDO::PARAM_STR);
        $motor->bindParam(3, $apelido, PDO::PARAM_STR);
        $motor->bindParam(4, $username, PDO::PARAM_STR);
        $motor->bindParam(5, $email, PDO::PARAM_STR);
        $motor->bindParam(6, $pass_word, PDO::PARAM_STR);
        $motor->bindParam(7, $estado, PDO::PARAM_STR);
        $motor->bindParam(8, $morada, PDO::PARAM_STR);
        $motor->bindParam(9, $sexo, PDO::PARAM_STR);
        $motor->bindParam(10, $data_nascimento, PDO::PARAM_STR);
        $motor->bindParam(11, $telemovel, PDO::PARAM_INT);
        $motor->bindParam(12, $nif, PDO::PARAM_INT);
        $motor->bindParam(13, $avatar, PDO::PARAM_STR);
        move_uploaded_file ($avatar['tmp_name'], "images/avatars/".$avatar['name']);
        $motor->execute();
    }
    else
    {
        $motor=$ligacao->prepare("UPDATE utilizador SET nome = :nome, apelido = :apelido, username = :username, email = :email, pass_word = md5(:pass),estado = :estado, morada = :morada, data_nascimento = :datanas, telemovel = :tele, nif = :nif, avatar = :avatar WHERE ID_Utilizador = :pid ");
        $motor->bindParam(":pid", $ID_Utilizador, PDO::PARAM_INT);
        $motor->bindParam(":nome", $nome, PDO::PARAM_STR);
        $motor->bindParam(":apelido", $apelido, PDO::PARAM_STR);
        $motor->bindParam(":username", $username, PDO::PARAM_STR);
        $motor->bindParam(":email", $email, PDO::PARAM_STR);
        $motor->bindParam(":pass", $pass_word, PDO::PARAM_STR);
        $motor->bindParam(":estado", $estado, PDO::PARAM_STR); 
        $motor->bindParam(":morada", $morada, PDO::PARAM_STR);
        $motor->bindParam(":datanas", $data_nascimento, PDO::PARAM_STR);
        $motor->bindParam(":tele", $telemovel, PDO::PARAM_INT);
        $motor->bindParam(":nif", $nif, PDO::PARAM_INT);
        $motor->bindParam(":avatar", $avatar, PDO::PARAM_STR);
        $motor->execute();
    }

}
    //gravado com sucesso
     echo '<center><img src="perfilgravado.gif" width="400" alt="S.A.D"><br>
		';
			if ($_SESSION['user'] == "admin")
			{
                echo' <center><a href="perfis.php"><button class="button">Voltar</button></a>';
			}
			else
			{
                echo' <center><a href="logado.php"><button class="button">Voltar</button></a>';
			}
?>
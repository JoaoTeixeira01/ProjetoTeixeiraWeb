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

    //Buscar dados dos posts
    $ID_Utilizador = $_POST['ID_Utilizador'];
    $ID_Resposta = $_POST['ID_Resposta'];
    $ID_Post = $_POST['ID_Post'];
    $mensagem = $_POST['mensagem'];
    $estado_respostas = $_POST['estado_resposta'];
    $data_resposta = date('Y-m-d h:i:s', time());
    $editar = false;

    //Verificar se os campos estão preenchidos
    if( $mensagem == "" )
    {
        include 'cabecalho.php';
		//erro-campos não preenchidos
		echo '<div class="erro">
		Não Foram preenchidos os campos necessários.<br><br>
		<a href="editor_resposta.php">Tente Novamente</a>
		</div>';
		exit;
    }

    //Abrir ligação à base de dados
    include 'config.php';
    $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

    if($ID_Resposta == -1)
    {
        //Vai buscar o id_resposta disponivel
        $motor=$ligacao->prepare("SELECT MAX(ID_Resposta) AS MaxID FROM resposta_posts");
        $motor->execute();
        $ID_Post=$motor->fetch(PDO::FETCH_ASSOC) ['MaxID'];
        
        if($ID_Resposta == null)
        {
        $ID_Resposta = 0;
        }
        else
        {
        $ID_Resposta++;
        $editar = false;
        }
    }
    else    
    {
        $editar=true;
    }

    //se for para editar
    if(!$editar)
    {
        $data = date('Y-m-d h:i:s', time());

        $motor=$ligacao->prepare("INSERT INTO resposta_posts VALUES(?,?,?,?,?,?)");
        $motor->bindParam(1, $ID_Resposta, PDO::PARAM_INT);
        $motor->bindParam(2, $mensagem, PDO::PARAM_STR);
        $motor->bindParam(3, $estado_respostas, PDO::PARAM_STR);
        $motor->bindParam(4, $data_resposta, PDO::PARAM_STR);
        $motor->bindParam(5, $ID_Utilizador, PDO::PARAM_STR);
        $motor->bindParam(6, $ID_Post, PDO::PARAM_INT);
        $motor->execute();
    }
    else
    {
        //atualizar os dados  do post 
        $data = date('Y-m-d h:i:s', time());

        $motor=$ligacao->prepare("UPDATE resposta_posts SET mensagem = :mess, estado_resposta    = :esta, data_resposta = :dat , ID_Utilizador = :id_user  WHERE ID_Resposta = :pid ");
        $motor->bindParam(":pid", $ID_Resposta, PDO::PARAM_INT);
        $motor->bindParam(":mess", $mensagem, PDO::PARAM_STR);
        $motor->bindParam(":esta", $estado_respostas, PDO::PARAM_STR);
        $motor->bindParam(":dat", $data_resposta, PDO::PARAM_STR);   
        $motor->bindParam(":id_user",$ID_Utilizador, PDO::PARAM_INT);   
        $motor->execute();

    }

    //gravado com sucesso
    echo '<div class="login_sucesso">
        Resposta gravada com sucesso.<br><br>
        <a href="forum.php">Voltar</a>
    </div>';
?>
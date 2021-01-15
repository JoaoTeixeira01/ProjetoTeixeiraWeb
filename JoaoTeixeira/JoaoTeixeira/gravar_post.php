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
    $ID_Post = $_POST['ID_Post'];
    $titulo = $_POST['titulo'];
    $mensagem = $_POST['mensagem'];
    $estado = $_POST['estados'];
    $editar = false;

    //Verificar se os campos estão preenchidos
    if($titulo == "" || $mensagem == "" )
    {
        include 'cabecalho.php';
		//erro-campos não preenchidos
		echo '<div class="erro">
		Não Foram preenchidos os campos necessários.<br><br>
		<a href="editor_post.php">Tente Novamente</a>
		</div>';
		exit;
    }

    //Abrir ligação à base de dados
    include 'config.php';
    $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

    if($ID_Post == -1)
    {
        //Vai buscar o id_post disponivel
        $motor=$ligacao->prepare("SELECT MAX(ID_Post) AS MaxID FROM posts");
        $motor->execute();
        $ID_Post=$motor->fetch(PDO::FETCH_ASSOC) ['MaxID'];
        
        if($ID_Post == null)
        {
        $ID_Post = 0;
        }
        else
        {
        $ID_Post++;
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

        $motor=$ligacao->prepare("INSERT INTO posts VALUES(?,?,?,?,?,?)");
        $motor->bindParam(1, $ID_Post, PDO::PARAM_INT);
        $motor->bindParam(2, $titulo, PDO::PARAM_STR);
        $motor->bindParam(3, $mensagem, PDO::PARAM_STR);
        $motor->bindParam(4, $estado, PDO::PARAM_STR);
        $motor->bindParam(5, $data, PDO::PARAM_STR);
        $motor->bindParam(6, $ID_Utilizador, PDO::PARAM_INT);
        $motor->execute();
    }
    else
    {
        //atualizar os dados  do post 
        $data = date('Y-m-d h:i:s', time());

        $motor=$ligacao->prepare("UPDATE posts SET titulo = :tit, mensagem = :mess, estados    = :esta, data_post = :dat WHERE ID_Post = :pid ");
        $motor->bindParam(":pid", $ID_Post, PDO::PARAM_INT);
        $motor->bindParam(":tit", $titulo, PDO::PARAM_STR);
        $motor->bindParam(":mess", $mensagem, PDO::PARAM_STR);
        $motor->bindParam(":esta", $estado, PDO::PARAM_STR);
        $motor->bindParam(":dat", $data, PDO::PARAM_STR);   
        $motor->execute();

    }

    //gravado com sucesso
    echo'
    <center><img src="postgravado.gif" width="400" alt="S.A.D">
    <center><a href="forum.php"><button class="button">Fórum</button></a>';
?>
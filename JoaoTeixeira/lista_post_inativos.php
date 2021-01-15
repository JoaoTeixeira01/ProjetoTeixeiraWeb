<?php
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

    if($_SESSION['ID_Tipo_Utilizador'] == 1)
    {
 //dados do utilizador que está logado
 echo '<div class="dados_utilizador">
        <img src="images/avatars/'.$_SESSION['avatar'].'" width="40"> | Conta:<span>'.$_SESSION['user'].'</span> | <a href="logout.php"><button class="button" >Sair</button></a>
        </div><hr>';
    //Verificar se o utilizador quer editar
    $pid = -1;
    $editar = false;
    $mensagem = "";
    $titulo = "";

        //Buscar dados à Base de dados 
        include 'config.php';
        $user = "root";
        $password = "1234";
        $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
        $motor=$ligacao->prepare('SELECT * FROM posts  INNER JOIN utilizador ON posts.ID_Utilizador = utilizador.ID_Utilizador WHERE estados = "inativo"');
        $motor->execute();

        if ($motor->rowcount()== 0)
    {
        echo '<div class="login_sucesso">
            Não existem Dúvidas Inativas!
        </div>';
    }
    else
    {
        //Foram encontrados posts        
        foreach($motor  as  $post)
        {
            //dados do post
            $id_post = $post['ID_Post'];
            $titulo = $post['titulo'];
            $mensagem = $post['mensagem'];
            $estados = $post['estados'];
            $data_post = $post['data_post'];
            $ID_Utilizador = $post['ID_Utilizador'];

            //dados do utilizador
            $username = $post['username'];
            $avatar = $post['avatar'];


            echo '<div class="post">';

            // dados 
                
                echo '<img  src="images/avatars/"' . $avatar.'">';
                echo '<span id="post_username">Nome de Utilizador: ' . $username . '</span>';
                echo '<span id="post_titulo">Título: ' . $titulo . '</span>';
                echo '<span id="post_titulo">Estado: ' . $estados . '</span>';
                echo '<hr>';
                
                echo '<div id="post_mensagem"><h3>Mensagem: ' . $mensagem .'</h3></div>';

        
                 //Data e hora do post
                echo '<div id="post_data">';

                 //Adicionar o link para editar
                 if($ID_Utilizador == $_SESSION['ID_Utilizador'] || $_SESSION['user'] == "admin" )
                  {
                echo '<a href="editor_post.php?pid='.$id_post.'" id="editar" ><img src="edit.png" alt="servico" style="width:42px;height:42px;"> </a>';
                  }
                  echo $data_post;
                  echo '<div id="id_post">Post nº'. $id_post. '</div>';
                  echo ' </div></div>';
                }


    //Formulário do forum
    echo '<center><div>
    <a href="forum.php"><input class ="button"type="button"value="Voltar ao Fórum"></a><br>
    </div>';    
}
}

else
{
 //dados do utilizador que está logado
 echo '<div class="dados_utilizador">
        <img src="images/avatars/'.$_SESSION['avatar'].'" width="40"> | Conta:<span>'.$_SESSION['user'].'</span> | <a href="logout.php"><button class="button" >Sair</button></a>
        </div><hr>';
    //Verificar se o utilizador quer editar
    $pid = -1;
    $editar = false;
    $mensagem = "";
    $titulo = "";

    if(isset($_REQUEST['pid']))
    {
        $pid = $_REQUEST['pid'];
        $editar = true;

        //Buscar dados à Base de dados 
        include 'config.php';
        $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
        $motor=$ligacao->prepare('SELECT * FROM posts  WHERE  estados = "inativo" AND ID_Utilizador = '.$pid.' ');
        $motor->execute();

        if ($motor->rowcount()== 0)
    {
        echo '<div class="login_sucesso">
            Não existem Dúvidas Inativas!
            <center>
        </div>
        <center>
        <a href="forum.php"><input class ="button"type="button"value="Voltar ao Fórum"></a><br>
        </center>
        ';
    }
    else
    {
        //Foram encontrados posts        
        foreach($motor  as  $post)
        {
            //dados do post
            $id_post = $post['ID_Post'];
            $titulo = $post['titulo'];
            $mensagem = $post['mensagem'];
            $estados = $post['estados'];
            $data_post = $post['data_post'];
            $ID_Utilizador = $post['ID_Utilizador'];

            //dados do utilizador
            $username = $_SESSION['user'];
            $avatar = $_SESSION['avatar'];

            echo '<div class="post">';

            // dados 
                
                echo '<img  src="images/avatars/"' . $avatar.'">';
                echo '<span id="post_username">Nome de Utilizador: ' . $username . '</span>';
                echo '<span id="post_titulo">Título: ' . $titulo . '</span>';
                echo '<span id="post_titulo">Estado: ' . $estados . '</span>';
                echo '<hr>';
                
                echo '<div id="post_mensagem"><h3>Mensagem: ' . $mensagem .'</h3></div>';

        
                 //Data e hora do post
                echo '<div id="post_data">';

                 //Adicionar o link para editar
                 if($ID_Utilizador == $_SESSION['ID_Utilizador'] || $_SESSION['user'] == "admin" )
                  {
                echo '<a href="editor_post.php?pid='.$id_post.'" id="editar" ><img src="edit.png" alt="servico" style="width:42px;height:42px;"> </a>';
                  }
                  echo $data_post;
                  echo '<div id="id_post">Post nº'. $id_post. '</div>';
                  echo ' </div></div>';
                }


    //Formulário do forum
    echo '<center><div>
    <a href="forum.php"><input class ="button"type="button"value="Voltar ao Fórum"></a><br>
    </div>';
}
}
}
?>
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
    echo'<center><img src="forumm.png" width="500" alt="Serviços de apoio domiciliário"></center>';
        echo '<div class="dados_utilizador">
        <img src="images/avatars/'.$_SESSION['avatar'].'" width="40"> | Conta:<span>'.$_SESSION['user'].'</span> | <a href="logout.php"><button class="button" >Sair</button></a>
        </div><hr>';

    //Novo post
    echo '<div class="novo_post"><a href="novo_post.php"><button class="button"><b>Novo Post</b></button></a></div>';
    if($_SESSION['ID_Tipo_Utilizador'] != 1){
    echo '<div class="novo_post"><a href="form_email.php"><button class="button"><b>Enviar Email</b></button></a></div>';
    }
    echo '<div class="novo_post"><a href="lista_post_inativos.php?pid='.$_SESSION['ID_Utilizador'].'"><button class="button"><b>Dúvidas Inativas</b></button></a></div>';

    //apresentar dados da base de dados 
    include 'config.php';
    $user = "root";
	$password = "1234";
    $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

    //Dados os posts
    $sql='SELECT * FROM posts INNER JOIN utilizador ON posts.ID_Utilizador = utilizador.ID_Utilizador WHERE estados = "ativo" ';
    $motor=$ligacao->prepare($sql); 
    $motor->execute();

    if ($motor->rowcount()== 0)
    {
        echo '<div class="login_sucesso">
            Não existem Dúvidas neste momento!
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
                
                echo '<img  src="images/avatars/'.$avatar.'" width="40">';
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
                  echo '<a href="responder.php?pids='.$id_post.'" id="resposta" ><img src="responder.png" alt="servico" style="width:48px;height:48px;"></a><br><br>';
                  echo $data_post;
                  echo '<div id="id_post">Post nº'. $id_post. '</div>';
                  echo ' </div></div>';

                include 'config.php';
                $user = "root";
                $password = "1234";
                $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
            
                //Dados os posts
                $sql='SELECT * FROM resposta_posts WHERE ID_Post = '.$id_post.'';
                $motor=$ligacao->prepare($sql); 
                $motor->execute();
                
           //Foram encontrados posts        
          foreach($motor  as  $post)
              {
            //dados do post
            $id_resposta= $post['ID_Resposta'];
            $id_utilizador = $post['ID_Utilizador'];
            $mensagem = $post['mensagem'];
            $estados = $post['estado_resposta'];
            $data_post = $post['data_resposta'];
            $id_posts = $post['ID_Post'];
                
    

            //Dados os posts
            $sql='SELECT * FROM utilizador WHERE ID_Utilizador = '.$id_utilizador.'';
            $motor=$ligacao->prepare($sql); 
            $motor->execute();
            
       //Foram encontrados posts        
      foreach($motor  as  $user)
          {
        //dados do post
        $username = $user['username'];
        $avatars = $user['avatar'];

              echo '<div class="dados_utilizador">
              <img src="images/avatars/'.$avatars.'" width="40"> <span>Username: ' .$username . 
                '</span> <span>Mensagem: ' . $mensagem . '</span>  <span>Data: ' . $data_post . '</span>  '; 
                
          }
                if($id_utilizador == $_SESSION['ID_Utilizador'] || $_SESSION['user'] == "admin")
                { 
                    echo'  <a href="editor_resposta.php?pids='.$id_post.'" id="resposta" >Editar</a>';
                } 
                echo'</div>';
              }
            }
        }
?>      
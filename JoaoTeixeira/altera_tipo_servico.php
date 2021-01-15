<?php
    include 'logado_admin.php';
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


    include 'cabecalho.php';

    //dados do utilizador que está logado
    echo '<div class="dados_utilizador">
    <img src="images/avatars/'.$_SESSION['avatar'].'" width="40"> | <span>'.$_SESSION['user'].'</span> | <a href="logout.php"><button class="button" >Logout</button></a>
    </div><hr>';

    //apresentar dados da base de dados 
    include 'config.php';
    $user = "root";
	$password = "1234";
    $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

    //Dados os posts
    $sql="SELECT * FROM tiposervico";
    $motor=$ligacao->prepare($sql); 
    $motor->execute();

    if ($motor->rowcount()== 0)
    {
        echo '<div class="login_sucesso">
            Não existem Tipo de Serviço!
        </div>';
    }
    else
    {
        //Foram encontrados posts        
        foreach($motor  as  $tserv)
        {
            //dados do post
            $id_tipo_servico=$tserv['ID_Tipo_Servico'];
            $nome=$tserv['nome'];
            $descricao=$tserv['Descricao'];


            echo '<div class="post">';

            // dados 
            
                echo '<span id="post_titulo">Serviço: <b> ' . $nome . '</b> </span>';
                echo '<hr>';
                echo '<div id="post_mensagem">' . $descricao .'</div>';


                echo '<div id="post_data">';

                if ($_SESSION['user'] == "admin")
                {
                    echo '<a href="editor_tipo_servico.php?pid='.$id_tipo_servico.'" id="editar" ><img src="edit.png" alt="servico" style="width:32px;height:32px;"></a>';
                    echo '<br>';   
                }
  
                echo '<div id="id_post">Tipo de Serviço Nº'. $id_tipo_servico. '</div>';
                echo ' </div>';
                echo '<center><a href="tiposervicoeliminar.php?pid='.$id_tipo_servico.'"><button class="button"><font size="3">Eliminar Tipo de Serviço</font></button></a>';
                echo '</div>
                
                <center><img src="barra.png" width="250" alt="S.A.D"></center>';    
        }
        echo' <br><center><a href="painelcontrolo.php"> <input class ="button"type="button"value="Voltar Atrás"></a><br>';
        echo '</div>';
    }

?>
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
        <img src="images/avatars/'.$_SESSION['avatar'].'" width="40"> | Conta:<span>'.$_SESSION['user'].'</span> | <a href="logout.php"><button class="button" >Sair</button></a>
        </div><hr>';

    //apresentar dados da base de dados 
    include 'config.php';
    $user = "root";
	$password = "1234";
    $ligacao = new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

    //Dados dos materiais
    $sql="SELECT * FROM material";
    $motor=$ligacao->prepare($sql); 
    $motor->execute();

    if ($motor->rowcount()== 0)
    {
        echo '<div class="login_sucesso">
            Não existem Materiais disponíveis!
        </div>';
    }
    else
    {
        //Foram encontrados posts        
        foreach($motor  as  $mat)
        {
            //dados do post
            $id_material=$mat['ID_Material'];
            $nome=$mat['nome'];
            $descricao=$mat['Descricao'];


            echo '<div class="post">';

            // dados 
                echo '<span id="post_titulo">Nome: ' . $nome . '</span>';
                echo '<hr>';
                echo '<div id="post_mensagem">Descrição: ' . $descricao .'</div>';


                 //Numero e botao de editar
                echo '<div id="post_data">';
                
                if ($_SESSION['user'] == "admin")
                {
                    echo '<a href="editor_material.php?pid='.$id_material.'" id="editar" ><img src="edit.png" alt="servico" style="width:32px;height:32px;"></a>';
                echo '<br>';
                }
                echo '<div id="id_post">Material Nº'. $id_material. '</div>';
                echo ' </div>';
                echo '<center><a href="materialeliminar.php?pid='.$id_material.'"><button class="button"><font size="3">Eliminar Material</font></button></a>';
                echo '</div>
                <center><img src="barra.png" width="250" alt="S.A.D"></center>';


                
          
        }
        echo' <center><a href="painelcontrolo.php"><input class ="button" type="button"value="Voltar"></a><br><br>';
    }


?>
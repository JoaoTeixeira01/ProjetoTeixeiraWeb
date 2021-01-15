<?php
    include 'logado_admin.php';
    //FORUM
    session_start();
    if(!isset($_SESSION['user']))   
    {
        include 'cabecalho.php';
	echo '<div class="erro "><center><img src="permissoes.png" width="400" alt="S.A.D"><br><br>
	<center><a href="index.php"><input class ="button"type="button" value="Retroceder "></a><br><br>
	</div>';
	exit;
    }

    error_reporting(0);
    include 'cabecalho.php';

    //dados do utilizador que está logado
    echo '<div class="dados_utilizador">
        <img src="images/avatars/'.$_SESSION['avatar'].'" width="40"> | Conta:<span>'.$_SESSION['user'].'</span> | <a href="logout.php"><button class="button" >Sair</button></a>
        </div><hr>';
        echo '
        <form class="form_login" method="post" action="perfis.php">
        <center><img src="pesquisar.png" width="250" alt="Serviços de apoio domiciliário"></center><br>
        <input type="text" name="pesquisa"    placeholder="Nome do username?"> 
        <center><button class="button" type="submit" name="pesquisar_text" value="Pesquisar"><b>Pesquisar</b></button><br></center>
       

        </form>';
        
    
        if($_POST['pesquisar_text'] == "Pesquisar")
        {
             //apresentar dados da base de dados 
             $pesquisar=$_POST['pesquisa'];
    include 'config.php';
    $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

    //Dados dos perfis
    $sql="SELECT * FROM utilizador WHERE username LIKE '%$pesquisar%'";
    $motor=$ligacao->prepare($sql); 
    $motor->execute();    
        

    if ($motor->rowcount()==0)
    {
        echo '<div class="login_sucesso">
            Não existe nenhum utilizador com o username pesquisado!
        </div>';
    }
    else
    {
        //listar utilizadores      
        foreach($motor  as  $perf)
        {
            
            //dados do utilizador
            $id_utilizador = $perf['ID_Utilizador'];
            $nome = $perf['nome'];
            $username = $perf['username'];
            $avatar = $perf['avatar'];
            $tipouser = $perf['ID_Tipo_Utilizador'];

            //dados do utilizador
            $username = $perf['username'];
            $avatar = $perf['avatar'];

            echo '<div class="post">';

            // dados 
                echo '<img  src="images/avatars/' . $avatar.'">';
                echo '<span id="post_username">Username: ' . $username . '</span>';
                echo '<span id="post_username">Nome: ' . $nome . '</span>';
                if($tipouser == 1)
            {
                echo '<span id="post_username"><strong>Tipo de conta: Administrador </strong></span>';
            }
            else if($tipouser == 2)
            {
                echo '<span id="post_username"><strong>Tipo de conta: Funcionário </strong></span>';
            } 
            else
            {
                echo '<span id="post_username"><strong>Tipo de conta: Utente </strong></span>';
            }
                 //Data e hora do post
                echo '<div id="post_data">';

               //Adicionar o link para editar
               if($id_utilizador == $_SESSION['ID_Utilizador'] || $_SESSION['user'] == "admin" )
               {
             echo '
             <a href="editor_perfis.php?pid='.$id_utilizador.'" id="editar" ><img src="edit.png" alt="servico" style="width:48px;height:48px;"></a>';
               }
                  echo ' </div>';
                  echo '</div>';
          
        }
        }
        echo'<center><a href="logado_admin.php"><input class ="button"type="button"value="Voltar à Pagina Inicial"></a><br></center>';
    
    }
else
{
//apresentar dados da base de dados 
include 'config.php';
$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

//Dados dos perfis
$sql="SELECT * FROM utilizador";
$motor=$ligacao->prepare($sql); 
$motor->execute();

if ($motor->rowcount()== 0)
{
echo '<div class="login_sucesso">
    Não existem utilizadores!
</div>';
}
else
{
//listar utilizadores      
foreach($motor  as  $perf)
{
    
    //dados do utilizador   
    $id_utilizador = $perf['ID_Utilizador'];
    $nome = $perf['nome'];
    $username = $perf['username'];
    $avatar = $perf['avatar'];
    $tipouser = $perf['ID_Tipo_Utilizador'];


    //dados do utilizador
    $username = $perf['username'];
    $avatar = $perf['avatar'];

    echo '<div class="post">';

    // dados 
        echo '<img  src="images/avatars/' . $avatar.'">';
        echo '<span id="post_username">Username: ' . $username . '</span>';
        echo '<span id="post_username">Nome: ' . $nome . '</span>';
        if($tipouser == 1)
            {
                echo '<span id="post_username"><strong>Tipo de conta: Administrador</strong></span>';
            }
            else if($tipouser == 2)
            {
                echo '<span id="post_username"><strong>Tipo de conta: Funcionário </strong></span>';
            } 
            else
            {
                echo '<span id="post_username"><strong>Tipo de conta: Utente </strong></span>';
            }

         //Data e hora do post
        echo '<div id="post_data">';

       //Adicionar o link para editar
       if($id_utilizador == $_SESSION['ID_Utilizador'] || $_SESSION['user'] == "admin" )
       {
        echo '<a href="editor_perfis.php?pid='.$id_utilizador.'" id="editar" ><img src="edit.png" alt="servico" style="width:32px;height:32px;"></a>';
       }
          echo ' </div>';
          echo '</div>';
  
}
}
echo'<center><a href="logado_admin2.php"><input class ="button"type="button"value="Voltar à Pagina Inicial"></a></center><br>';
}

?>
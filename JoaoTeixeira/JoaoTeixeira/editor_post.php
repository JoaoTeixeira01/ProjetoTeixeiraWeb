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

    // Editar/Criar POST
    include 'cabecalho.php';


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
        $motor=$ligacao->prepare("SELECT * FROM posts WHERE ID_post= ".$pid);
        $motor->execute();

        $dados=$motor->fetch(PDO::FETCH_ASSOC);
        $ligacao=null;
            
        $titulo = $dados['titulo'];
        $mensagem = $dados['mensagem'];
        $estado = $dados['estados'];
    }

    //dados do utilizador que está logado
    echo '<div class="dados_utilizador">
        <img src="images/avatars/'.$_SESSION['avatar'].'" width="40"> | Conta:<span>'.$_SESSION['user'].'</span> | <a href="logout.php"><button class="button" >Sair</button></a>
        </div><hr>';

    //Formulário do forum
    echo '<div>
    <form class="form_post" method="post" action="gravar_post.php">

    <center><img src="post.png" width="500" alt="Serviços de apoio domiciliário"></center><br><br>

    <input type="hidden" name="ID_Utilizador" value='. $_SESSION['ID_Utilizador'] . '>
    <input type="hidden" name="ID_Post" value='. $pid . '>


    <center><img src="titulo.png" width="250" alt="S.A.D"><br><br> 
    <input type="text" name="titulo" size="95" value="'. $titulo .'"><br><br>

    <center><img src="mensagem2.png" width="250" alt="S.A.D"><br><br> 
    <textarea rows="10" cols="70" name="mensagem">'. $mensagem .'</textarea><br><br>

    <center><img src="estado1.png" width="250" alt="S.A.D"><br><br> 
				<select class="select select1" id="op" name="estados" value="'. $estado .'">
				<option value="ativo">Ativo</option>
				<option value="inativo">Inativo</option>
				</select><br><br>

                <center><button class="button" type="submit" name="btn_submit"><b>Gravar Alterações</b></button><br>

    <center>
    </form>
    <center><a href="forum.php" <button class="button"><b>Voltar</b></button></a>

    </div>';
?>
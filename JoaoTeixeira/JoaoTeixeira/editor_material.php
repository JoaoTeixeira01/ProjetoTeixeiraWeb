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

    include 'logado_admin.php';
    // Editar/Criar Materiais
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
        $motor=$ligacao->prepare("SELECT * FROM material WHERE ID_Material=".$pid);
        $motor->execute();

        $dados=$motor->fetch(PDO::FETCH_ASSOC);
        $ligacao = null;
            
        $nome=$dados['nome'];
        $descricao=$dados['Descricao'];
    }

    //dados do utilizador que está logado
    echo '<div class="dados_utilizador">
        <img src="images/avatars/'.$_SESSION['avatar'].'" width="40"> | Conta:<span>'.$_SESSION['user'].'</span> | <a href="logout.php"><button class="button" >Sair</button></a>
        </div><hr>';

    //Formulário 
    echo '<div>
    <form class="form_post" method="post" action="gravar_material.php">

    <input type="hidden" name="ID_Material" value='. $pid . '>

    <center><img src="imagenspainel/material.png" width="250" alt="S.A.D"><br><br>
    <input type="text" name="nome" size="95" value="'. $nome .'"><br><br>

    <center><img src="imagenspainel/descricao.png" width="250" alt="S.A.D"><br><br>
    <textarea rows="5" cols="70" name="Descricao">'. $descricao .'</textarea><br><br>

    <br><h3 style="color: red">Nota: Todos os campos são obrigatórios!</h3><br><br>	
    <center><button class="button" type="submit" name="btn_submit">Guardar</button><br>
    </form>
    <center><a href="painelcontrolo.php"> <input class ="button" type="button" value="Voltar "></a><br><br>

    </div>';
?>
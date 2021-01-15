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
        $motor=$ligacao->prepare("SELECT * FROM tiposervico WHERE ID_Tipo_Servico=".$pid);
        $motor->execute();

        $dados=$motor->fetch(PDO::FETCH_ASSOC);
        $ligacao=null;
            
        $nome = $dados['nome'];
        $descricao = $dados['Descricao'];
    }

    //dados do utilizador que está logado
    echo '<div class="dados_utilizador">
    <img src="images/avatars/"' . $_SESSION['avatar'] . '><span>Conta Logada: ' . $_SESSION['user'] . '</span> | <a href="logout.php"><button class="button" >Logout</button></a>
    </div><hr>';

    //Formulário 
    echo '<div>
    <form class="form_post" method="post" action="gravar_tipo_servico.php">

    <input type="hidden" name="ID_Tipo_Servico" value='. $pid . '>

    <center><img src="imagenspainel/nomedoservico.png" width="250" alt="S.A.D"><br><br>
    <input type="text" name="nome" size="95" value="'. $nome .'"><br><br>

    <center><img src="imagenspainel/descricao.png" width="250" alt="S.A.D"><br><br>
    <textarea rows="5" cols=70 name="descricao">'. $descricao .'</textarea><br><br>

    <center><button class="button" type="submit" name="btn_submit"><b>Gravar Alterações</b></button><br>
    </form>
    <center><a href="altera_tipo_servico.php"><input class ="button"  value="Voltar "></a><br><br>
    </div>';
?>
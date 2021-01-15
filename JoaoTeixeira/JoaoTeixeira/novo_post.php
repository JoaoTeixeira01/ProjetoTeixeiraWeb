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

//verificar se foram inseridos os dados
	if(!isset($_POST['btn_submit']))
{
	ApresentarFormulario();
}
else
{
	Registarservico();
}



//Funcao formulario

function ApresentarFormulario()
{
	
    
//dados do utilizador que está logado  
echo '<div class="dados_utilizador">
        <img src="images/avatars/'.$_SESSION['avatar'].'" width="40"> | Conta:<span>'.$_SESSION['user'].'</span> | <a href="logout.php"><button class="button" >Sair</button></a>
        </div><hr>';;

    //Formulário do forum
    echo '<div>
    <form class="form_post" method="post" action="novo_post.php?a=tipomaterialservico" enctype="multipart/form-data"

	<center><img src="post.png" width="500" alt="Serviços de apoio domiciliário"></center><br><br>

    <input type="hidden" name="ID_Utilizador" value='. $_SESSION['ID_Utilizador'] . '>

	<center><img src="titulo.png" width="250" alt="S.A.D"><br><br> 
    <input type="text" name="titulo" size="95"><br><br>

    <center><img src="mensagem2.png" width="250" alt="S.A.D"><br><br> 
    <textarea rows="9" cols="90" name="mensagem"></textarea><br><br>

	<input type="hidden" name="estado" value="ativo">

	<br>Nota: Todos os campos com * são obrigatórios!<br><br>
    <center><button class="button" type="submit" name="btn_submit"><b>Gravar </b></button><br>
	</center>
	</form>

	
	</div><center><a href="forum.php"><button class="button" >Voltar</button></a><br><br>';
}
	
	
//Funcao Registar 

function Registarservico()
{
    $titulo = $_POST['titulo'];
	$mensagem = $_POST['mensagem'];
	$ID_Utilizador = $_POST['ID_Utilizador'];
	$estado = $_POST['estado'];
	$erro = false;
	
	//Verificações
	if(empty($titulo) || empty($mensagem) )
	{
		//Erro- Não foram preenchidos os campos
		echo'
		<div class="erro">Não Foram preenchidos todos os campos necessários.</div>
		';
		$erro = true;
	} 	
	
	//verificar se existiram erros
	
	if($erro)
	{
		ApresentarFormulario();
		exit;
	}
    else
    {
		include 'config.php';
		$user = "root";
		$password = "1234";
	    $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

        //registo do tipo de servico
		$motor=$ligacao->prepare("SELECT MAX(ID_Post) AS MaxID FROM posts");
		$motor->execute();
		$id_temp=$motor->fetch(PDO::FETCH_ASSOC)['MaxID'];
		
		if($id_temp == null)
			$id_temp == 0;
		else
			$id_temp++;

		//registo do Material
		$data = date('Y-m-d h:i:s', time());
		$sql="INSERT INTO posts VALUES(?,?,?,?,?,?)";

		$motor=$ligacao->prepare($sql);
		$motor->bindParam(1, $id_temp, PDO::PARAM_INT);
        $motor->bindParam(2, $titulo, PDO::PARAM_STR);
		$motor->bindParam(3, $mensagem, PDO::PARAM_STR);
		$motor->bindParam(4, $estado, PDO::PARAM_STR);
        $motor->bindParam(5, $data, PDO::PARAM_STR);
        $motor->bindParam(6, $ID_Utilizador, PDO::PARAM_INT);
		$motor->execute();
		$ligacao=null;
		
		//apresentar uma mensagem de que Material foi adicionado com sucesso
		echo'
		<center><img src="postgravado.gif" width="400" alt="S.A.D">
    <center><a href="forum.php"><button class="button">Fórum</button></a>';
    }
}
?> 	
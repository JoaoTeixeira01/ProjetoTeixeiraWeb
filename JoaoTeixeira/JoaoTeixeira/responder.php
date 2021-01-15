<?php
//signup

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
//verificar se foram inseridos os dados
	if(!isset($_POST['btn_submit']))
{
	ApresentarFormulario();
}
else
{
	Registarresposta();
}



//Funcao formulario

function ApresentarFormulario()
{
	if(isset($_REQUEST['pids']))
    {   
        $pid = $_REQUEST['pids'];
		$editar = true;
	}
//apresenta o formulario para novos tipos de serviço
 echo'
 <center>
 <br><br><br><br>
	<form class="form_material" method="post" action="responder.php?pids='.$pid.'" enctype="multipart/form-data"
 
	<center><img src="resposta.png" width="250" alt="S.A.D"><br><br> 
	<input type="text" size="20" name="resposta"><br><br>
    
    <input type="hidden" name="estados" value="ativo">

	<input type="hidden" name="id" value="'.$pid.'">

	<br>Nota: Todos os campos com * são obrigatórios!<br><br>
	<center><button class="button" type="submit" name="btn_submit"><b>Gravar Alterações</b></button><br>
    <center>
    
	</center>
		
	<center><a href="forum.php" <button class="button"><b>Voltar</b></button></a>
	
	
	';
}
	
	
//Funcao Registar 

function Registarresposta()
{

    $estado = $_POST['estados'];
	$mensagem = $_POST['resposta'];
	$id_utili = $_SESSION['ID_Utilizador'];
	$id_duvida = $_POST['id'];
	$erro = false;
	//Verificações
	if(empty($mensagem) )
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
	    $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

        //registo do tipo de servico
		$motor=$ligacao->prepare("SELECT MAX(ID_Resposta) AS MaxID FROM resposta_posts");
		$motor->execute();
		$id_temp=$motor->fetch(PDO::FETCH_ASSOC)['MaxID'];
		
		if($id_temp == null)
			$id_temp == 0;
		else
			$id_temp++;

		//registo do Material
		
		$sql="INSERT INTO resposta_posts VALUES( :id_resposta, :mensagem, :estado, :dat , :id_user, :id_post)";

        $data = date('Y-m-d h:i:s', time());

		$motor=$ligacao->prepare($sql);
		$motor->bindParam(":id_resposta", $id_temp, PDO::PARAM_INT);
		$motor->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
        $motor->bindParam(":estado", $estado, PDO::PARAM_STR);
        $motor->bindParam(":dat", $data, PDO::PARAM_STR);
        $motor->bindParam(":id_user", $id_utili, PDO::PARAM_INT);
        $motor->bindParam(":id_post", $id_duvida, PDO::PARAM_INT);
		$motor->execute();
		$ligacao = null;
		
		//apresentar uma mensagem de que Material foi adicionado com sucesso
		echo'
		<center><img src="postgravado.gif" width="400" alt="S.A.D">
    <center><a href="forum.php"><button class="button">Fórum</button></a>';
    }
}
?>
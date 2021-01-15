<?php
	include 'logado_admin.php';
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

	include 'cabecalho.php';
//verificar se foram inseridos os dados
	if(!isset($_POST['btn_submit']))
{
	ApresentarFormulario();
}
else
{
	Registarmaterial();
}



//Funcao formulario

function ApresentarFormulario()
{
	
//apresenta o formulario para novos tipos de serviço
 echo'
 <center>
 
	<form class="form_material" method="post" action="material.php?a=tipomaterialservico" enctype="multipart/form-data"
	<center><img src="imagenspainel/adicionarmaterial.png" width="500" alt="S.A.D"><br><hr><br>
 
	<center><img src="imagenspainel/material.png" width="250" alt="S.A.D"><br><br> <input type="text" size="20" name="nome" placeholder="Introduza uma categoria de materiais, Ex:Limpezas"><br><br>
	
	<center><img src="imagenspainel/descricao.png" width="250" alt="S.A.D"><br><br> <input type="text" size="30" name="Descricao" placeholder="Introduza todos os materiais da categoria acima"><br><br>
    
	<br><h3 style="color: red">Nota: Todos os campos são obrigatórios!</h3><br><br>	
    <center><button class="button" type="submit" name="btn_submit">Guardar</button><br>
    <center><a href="painelcontrolo.php"> <input class ="button"type="button"value="Voltar "></a><br><br>
	</center>
	</form>
	';
}
	
	
//Funcao Registar 

function Registarmaterial()
{
	$nome = $_POST['nome'];
	$descricao = $_POST['Descricao'];
	$erro = false;
	
	//Verificações
	if(empty($nome) || empty($descricao))
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
		$motor=$ligacao->prepare("SELECT MAX(ID_Material) AS MaxID FROM material");
		$motor->execute();
		$id_temp=$motor->fetch(PDO::FETCH_ASSOC)['MaxID'];
		
		if($id_temp == null)
			$id_temp == 0;
		else
			$id_temp++;

		//registo do Material
		
		$sql="INSERT INTO material VALUES( :id_material, :nome, :descricao)";

		$motor=$ligacao->prepare($sql);
		$motor->bindParam(":id_material", $id_temp, PDO::PARAM_INT);
		$motor->bindParam(":nome", $nome, PDO::PARAM_STR);
		$motor->bindParam(":descricao", $descricao, PDO::PARAM_STR);
		$motor->execute();
		$ligacao=null;
		
		//apresentar uma mensagem de que Material foi adicionado com sucesso
		echo'<center><img src="materialgravado.gif" width="400" alt="S.A.D">
		<center><a href="painelcontrolo.php"><button class="button">Painel de controlo</button></a>
		';
    }
}
?>
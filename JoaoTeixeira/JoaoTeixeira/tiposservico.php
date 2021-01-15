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
	Registartiposervico();
}



//Funcao formulario

function ApresentarFormulario()
{
	
//apresenta o formulario para novos tipos de serviço
 echo'
 <center>
 
	<form class="form_tipos_servico" method="post" action="tiposservico.php?a=tiposervico" enctype="multipart/form-data">
	<center><img src="imagenspainel/adicionartiposervico.png" width="500" alt="S.A.D"><br><hr><br>
 
	<center><img src="imagenspainel/nomedoservico.png" width="250" alt="S.A.D"><br><br> <input type="text" size="20" name="nome_servico" placeholder="Introduza o tipo de serviço"><br><br>
	
	<center><img src="imagenspainel/descricao.png" width="250" alt="S.A.D"><br><br> <input type="text" size="25" name="descricao" placeholder="Introduza a descrição do tipo de serviço"><br><br>
	
    
	<br><h3 style="color: red">Nota: Todos os campos são obrigatórios!</h3><br><br>	
	<center><button class="button" type="submit" name="btn_submit">Guardar</button><br><hr>
	<a href="painelcontrolo.php"><input class ="button"type="button"value="Voltar"></a><br><br>
	</form>
    
	</center>
	
	';
}
	
	
//Funcao Registar 

function Registartiposervico()
{
	$nome = $_POST['nome_servico'];
	$descricao = $_POST['descricao'];
	$erro = false;
	
	//Verificações
	if(empty($nome)  )
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
		$motor=$ligacao->prepare("SELECT MAX(id_tipo_servico) AS MaxID FROM tiposervico");
		$motor->execute();
		$id_temp=$motor->fetch(PDO::FETCH_ASSOC)['MaxID'];
		
		if($id_temp == null)
			$id_temp == 0;
		else
			$id_temp++;

		//registo do tipo de serviço
		
		$sql="INSERT INTO tiposervico VALUES( :id_tipo_servico, :nome, :descricao)";

		$motor=$ligacao->prepare($sql);
		$motor->bindParam(":id_tipo_servico", $id_temp, PDO::PARAM_INT);
		$motor->bindParam(":nome", $nome, PDO::PARAM_STR);
		$motor->bindParam(":descricao", $descricao, PDO::PARAM_STR);
		$motor->execute();
		$ligacao=null;
		
		//apresentar uma mensagem de que o tipo de serviço foi adicionado com sucesso
		echo'<center><img src="tiposervicoguardado.gif" width="400" alt="S.A.D">
	<center><a href="painelcontrolo.php"><button class="button">Painel de Controlo</button></a>
			';
    }
}
?>
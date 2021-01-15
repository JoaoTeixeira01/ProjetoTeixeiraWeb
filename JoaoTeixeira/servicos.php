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
		Registarservico();
	}



	//Funcao formulario

	function ApresentarFormulario()
	{
		
	//apresenta o formulario para novos tipos de serviço
	echo'
	<center>

		<form class="form_material" method="post" action="servicos.php?a=tipomaterialservico" enctype="multipart/form-data"
		<center><img src="imagenspainel/adicionarservido.png" width="450" alt="S.A.D"><br><br>
		
		<img src="barra.png" width="320" alt="S.A.D">
		<hr>
		
	
		<center><img src="imagenspainel/datadoservico.png" width="250" alt="S.A.D"><br><br>
		<input  name="data_inicial"  type="Date">

		<br><br>

		<input type="hidden" name="estado" value="Ativo">

		<input type="hidden" name="relatorio" value="">

		<center><img src="imagenspainel/horadeentrada.png" width="250" alt="S.A.D"><br><br> <input type="time" name="hora_chegada"><br><br>
		
		<center><img src="imagenspainel/horadesaida.png" width="250" alt="S.A.D"><br><br> <input type="time" name="hora_saida"><br><br>
		
		
		<center><img src="imagenspainel/utente.png" width="250" alt="S.A.D"><br><br>
		'; 	
		
		include 'config.php';
		$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
		$motor=$ligacao->prepare('select nome, apelido, ID_Utilizador , ID_Tipo_Utilizador From utilizador WHERE ID_Tipo_Utilizador = 3');
		$motor->execute();
		$dados=$motor->fetchAll();
		echo '
		<select class="select select1" name="id_utente" id="utilizador" >
		';
	foreach ($dados as $row): ?>
		<option value=<?=$row["ID_Utilizador"]?> ><?=$row["nome"]?> <?=$row["apelido"]?></option>
	<?php endforeach;
	

	if($_SESSION['ID_Tipo_Utilizador'] == 2)
	{
		echo '<input type="hidden" name="id_funcionario" value="'.$_SESSION['ID_Utilizador'].'"> <br>';
	}
	else
	{
	echo '
	</select>
	<br>	
	<br>
	<center><img src="imagenspainel/funcionario.png" width="250" alt="S.A.D"><br><br>
	'; 	

	include 'config.php';
	$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
	$motor=$ligacao->prepare('select nome, apelido, ID_Utilizador , ID_Tipo_Utilizador, estado From utilizador WHERE ID_Tipo_Utilizador = 2');
	$motor->execute();
	$dados=$motor->fetchAll();
	echo '
	<select class="select select1" name="id_funcionario" id="utilizador">
	';
	foreach ($dados as $row): ?>
	<option value=<?=$row["ID_Utilizador"]?> ><?=$row["nome"] ?> <?=$row["apelido"] ?></option>
	<?php endforeach;
	}
	echo '
	</select>
	<br><br>

	<br>
	<legend><center><img src="imagenspainel/tipodeservico.png" width="250" alt="S.A.D"></legend><br><br>
		'; 	

		echo'<table id="joaonanques_tabela">
		<tr>';
		include 'config.php';
		$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
		$motor=$ligacao->prepare('select nome, ID_Tipo_Servico From tiposervico');
		$motor->execute();
		$dados = $motor->fetchAll();
	foreach ($dados as $row):?>
	<th><input type="radio" name="tiposer" value=<?=$row["ID_Tipo_Servico"]?> ><?=$row["nome"] ?></th>
	<?php endforeach;
	echo '</tr>
	</table>
	</fieldset>
	<br>
		
	<br>
	<legend><center><img src="imagenspainel/materialusado.png" width="250" alt="S.A.D"></legend><br><br>
		'; 	
		echo'<table id="joaonanques_tabela">
		<tr>';
		include 'config.php';
		$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
		$motor=$ligacao->prepare('select * From material');
		$motor->execute();
		$dados=$motor->fetchAll();
	foreach ($dados as $row):?>
	<th><input type="radio" name="material" value=<?=$row["ID_Material"]?> ><?=$row["nome"]?><br><hr><?=$row["Descricao"] ?></th>
	<?php endforeach;
	echo '</tr>
	</table>';
	echo '
	</fieldset>
		<br><br>

		<br><h3 style="color: red">Nota: Todos os campos são obrigatórios!</h3><br><br></form>
		<center><button class="button" type="submit" name="btn_submit">Guardar</button><br><hr>
		<a href="painelcontrolo.php"><input class ="button"type="button"value="Voltar"></a><br><br>
		</center>
		
		';
	}
		
		
	//Funcao Registar 

	function Registarservico()
	{


		//Fim de contagem

		$data = $_POST['data_inicial'];
		$data_inicial = date('Y-m-j', strtotime($data));
		$hora_chegada = $_POST['hora_chegada'];
		$hora_saida = $_POST['hora_saida'];
		$estado = $_POST['estado'];
		$relatorio = $_POST['relatorio'];
		$utente = $_POST['id_utente'];
		$funcionario = $_POST['id_funcionario'];
		$tiposervico = $_POST['tiposer'];
		$materi =  $_POST['material'];
		$erro = false;

		$datamaxima="2022-01-01";
		//Contagem de horas
		
		//Verificações
		if(	empty($data_inicial)  || empty($hora_chegada) || empty($hora_saida)   || empty($utente) || empty($funcionario) || empty($tiposervico) || empty($materi))
		{
			//Erro- Não foram preenchidos os campos
			echo'
			<div class="erro">Não Foram preenchidos todos os campos necessários.</div>
			';
			$erro = true;
		}
		elseif ($data_inicial < date('Y-m-d ', time())) 
		{
			echo'
			<div class="erro">Data do Serviço anterior à atual ou para o dia atual!</div>
			';
			$erro = true;
		}
		elseif ($hora_chegada > $hora_saida ) 
		{
			echo'
			<div class="erro">Hora de chegada superior à hora de saída</div>
			';
			$erro = true;
		}
		elseif ($data_inicial > $datamaxima ) 
		{
			echo'
			<div class="erro">Não é possível introduzir um serviço para o próximo ano por motivos de logistica!</div>
			';
			$erro = true;
		}

		
		//verificar se existiram erros
		
		if($erro)
		{
			ApresentarFormulario();
			exit;
		}

			include 'config.php';
			$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

			//registo do tipo de servico
			$motor=$ligacao->prepare("SELECT MAX(ID_Servico) AS MaxID FROM servico");
			$motor->execute();
			$id_temp=$motor->fetch(PDO::FETCH_ASSOC)['MaxID'];
			
			if($id_temp == null)
				$id_temp == 0;
			else
				$id_temp++;

			//registo do Material
			
			$sql="INSERT INTO servico VALUES( :id_servico, :data_ini, :hora_chegada, :hora_saida, :estado, :relatorio, :id_utente, :id_funcionario, :id_tipo_servico , :id_mat)";

			$motor=$ligacao->prepare($sql);
			$motor->bindParam(":id_servico", $id_temp, PDO::PARAM_INT);
			$motor->bindParam(":data_ini", $data_inicial, PDO::PARAM_STR);
			$motor->bindParam(":hora_chegada", $hora_chegada, PDO::PARAM_STR);
			$motor->bindParam(":hora_saida", $hora_saida, PDO::PARAM_STR);
			$motor->bindParam(":estado", $estado, PDO::PARAM_STR);
			$motor->bindParam(":relatorio", $relatorio, PDO::PARAM_STR);
			$motor->bindParam(":id_utente", $utente, PDO::PARAM_INT);
			$motor->bindParam(":id_funcionario", $funcionario, PDO::PARAM_INT);
			$motor->bindParam(":id_tipo_servico", $tiposervico, PDO::PARAM_INT);
			$motor->bindParam(":id_mat", $materi, PDO::PARAM_INT);
			$motor->execute();
			$ligacao=null;
			
			//apresentar uma mensagem de que Material foi adicionado com sucesso
			echo'<center><img src="servicogravado.gif" width="400" alt="S.A.D">
	<center><a href="painelcontrolo.php"><button class="button">Painel de Controlo</button></a>
	<center><a href="agenda.php"><button class="button">Agenda</button></a>
			';
		}

	?> 	
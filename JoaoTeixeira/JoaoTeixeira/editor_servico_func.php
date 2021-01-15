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
        $motor=$ligacao->prepare("SELECT * FROM Servico WHERE ID_Servico=".$pid);
        $motor->execute();

        $dados=$motor->fetch(PDO::FETCH_ASSOC);
        $ligacao=null;
            
        $data_inical = $dados['Data_Inicial'];
        $hora_cheg = $dados['Hora_chegada'];
        $hora_sai = $dados['Hora_saida'];
        $ID_Utilizador = $dados['ID_Utente'];
        $ID_Tipo_Servico = $dados['ID_Tipo_Servico'];
    }

    //dados do utilizador que está logado
    echo '<div class="dados_utilizador">
        <img src="images/avatars/'.$_SESSION['avatar'].'" width="40"> | Conta:<span>'.$_SESSION['user'].'</span> | <a href="logout.php"><button class="button" >Sair</button></a>
        </div><hr>';

    //Formulário 
    echo '<div>
    <form class="form_post" method="post" action="gravar_material.php">


 <center>
 <br><br><br><br>
    <form class="form_material" method="post" action="servicos.php">
    
	<h1><b>Alterar dados do Serviço</h1></b><hr><br>
 
    <input type="hidden" name="ID_Servico" value='. $pid . '>

    <center><img src="imagenspainel/datadoservico.png" width="250" alt="S.A.D"><br><br>
		<input  name="data_inicial"  type="Date" value='. $data_inical .' readonly>
	<br><br>
	
	<center><img src="imagenspainel/horadeentrada.png" width="250" alt="S.A.D"><br><br> <input type="time" name="hora_chegada" value='.$hora_cheg.'  readonly><br><br> 
    
    <center><img src="imagenspainel/horadesaida.png" width="250" alt="S.A.D"><br><br> <input type="time" name="hora_saida" value='.$hora_sai.'  readonly><br><br>
	
    <center><img src="imagenspainel/utente.png" width="250" alt="S.A.D"><br><br>
	'; 	
	
	include 'config.php';
	$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
	$motor=$ligacao->prepare('select username From utilizador WHERE ID_Tipo_Utilizador = "3"');
	$motor->execute();
	$dados=$motor->fetchAll();
	echo '
		<select class="select select1" name="id_utente" id="utilizador" >
		';
 foreach ($dados as $row): ?>
    <option ><?=$row["username"]?></option>
<?php endforeach;
echo '
</select>
<br><br>

<center><img src="imagenspainel/funcionario.png" width="250" alt="S.A.D"><br><br>   
	'; 	
	
	include 'config.php';
	$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
	$motor=$ligacao->prepare('select username From utilizador WHERE ID_Tipo_Utilizador = "2"');
	$motor->execute();
	$dados=$motor->fetchAll();
	echo '
	<select class="select select1" name="id_funcionario" id="utilizador">
	';
 foreach ($dados as $row): ?>
    <option ><?=$row["username"]?></option>
<?php endforeach;
echo '
</select>
    <br><br>

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
	<th><input type="radio" name="material[]" value=<?=$row["ID_Material"]?> ><?=$row["nome"]?><br><hr><?=$row["Descricao"] ?></th>
	<?php endforeach;
	echo '</tr>
	</table>

    <br><h3 style="color: red">Nota: Todos os campos são obrigatórios!</h3><br><br>
    <center><button class="button" type="submit" name="btn_submit">Guardar</button><br>
	<a href="painelcontrolo.php"><input class ="button"type="button"value="Voltar"></a><br><br>
   
	</center>
	</form>
	
  </div>';
?>
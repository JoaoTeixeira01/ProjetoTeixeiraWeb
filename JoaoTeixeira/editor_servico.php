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


    if(isset($_REQUEST['pids']))
    {   
        $pid = $_REQUEST['pids'];
        $editar = true;

        //Buscar dados à Base de dados 
      
        include 'config.php';
        $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
        $motor=$ligacao->prepare("SELECT * FROM servico WHERE ID_Servico=".$pid);
        $motor->execute();

        $dados=$motor->fetch(PDO::FETCH_ASSOC);
        $ligacao=null;
        
        $id_servico = $pid;
        $data_inicial = $dados['Data_Inicial'];
        $hora_cheg = $dados['Hora_chegada'];
        $hora_sai = $dados['Hora_saida'];
        $estado = $dados['estado'];
        $relatorio = $dados['relatorio'];
        $ID_Utente = $dados['ID_Utente'];
        $ID_Funcionario = $dados['ID_Funcionario'];
        $ID_Tipo_Servico = $dados['ID_Tipo_Servico'];
        $ID_Material = $dados['ID_Material'];
        $datass = date('Y-m-dd h:i:s', time());
    }

        //dados do utilizador que está logado
        echo '<div class="dados_utilizador">
        <img src="images/avatars/'.$_SESSION['avatar'].'" width="40"> | Conta:<span>'.$_SESSION['user'].'</span> | <a href="logout.php"><button class="button" >Sair</button></a>
        </div><hr>';

    //Formulário 
    echo '<div>

    <form class="form_post" method="post" action="gravar_servico.php">
 <center>
 <br><br>

 <center><img src="alterardadosservico.png" width="500" alt="Serviços de apoio domiciliário"></center>
 
    <input type="hidden" name="ID_Servico" value='. $pid . '>

	<input  type="hidden" name="data_inicial"  type="Date" value='. $data_inicial .'>
	
	<input type="hidden" name="hora_chegada" value='.$hora_cheg.'><br><br> 
    
    <input type="hidden" name="hora_saida" value='.$hora_sai.'><br><br>
	
    <input type="hidden" name="id_utente" value='.$ID_Utente.'>

    <input type="hidden" name="id_funcionario" value='.$ID_Funcionario.'>

    <input type="hidden" name="id_tipo_servico" value='.$ID_Tipo_Servico.'>

    <input type="hidden" name="id_material" value='.$ID_Material.'>
	
    <center><img src="estado1.png" width="250" alt="Serviços de apoio domiciliário"></center><br>
    <select class="select select1" name="estado" id="utilizador" value='.$estado.'>
    <option >Ativo</option>
    <option >Inativo</option>
        </select><br><br>

    <center><img src="relatorio.png" width="250" alt="Serviços de apoio domiciliário"></center><br>
    <textarea rows="10" cols="70" name="relatorio"  value="'.$relatorio.'">'.$relatorio.'</textarea><br><br>

    <br><h3 style="color: red">Nota: Todos os campos são obrigatórios!</h3><br><br>
    <center><a href="gravar_servico.php?pids='.$id_servico.'"> <input class ="button"type="submit"value="Guardar "></a><br><br>
	<a href="agenda.php"><input class ="button"type="button"value="Voltar à agenda"></a><br><br>
   
	</center>
	</form>
	
  </div>';
?>
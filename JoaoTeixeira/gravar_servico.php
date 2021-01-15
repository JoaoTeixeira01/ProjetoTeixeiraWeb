<?php
//Gravar Tipo de serviço

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

    
    //dados do utilizador que está logado
    echo '<div class="dados_utilizador">
        <img src="images/avatars/'.$_SESSION['avatar'].'" width="40"> | Conta:<span>'.$_SESSION['user'].'</span> | <a href="logout.php"><button class="button" >Sair</button></a>
        </div><hr>';

    //Buscar dados dos tipos de serviço
    $ID_Servico = $_POST['ID_Servico'];
    $data_inicial = $_POST['data_inicial'];
    $hora_chegada = $_POST['hora_chegada'];
    $hora_saida = $_POST['hora_saida'];
    $estado = $_POST['estado'];
    $relatorio = $_POST['relatorio'];
    $ID_Utente = $_POST['id_utente'];
    $ID_Funcionario = $_POST['id_funcionario'];
    $ID_Tipo_Servico = $_POST['id_tipo_servico'];
    $ID_Material = $_POST['id_material'];
    $editar = false;

    //Verificar se os campos estão preenchidos
    if(	empty($data_inicial)  || empty($hora_chegada) || empty($hora_saida) || empty($estado)  || empty($ID_Utente) || empty($ID_Funcionario))
    {
        include 'cabecalho.php';
		//erro-campos não preenchidos
		echo '<div class="erro">
		Não Foram preenchidos os campos necessários.<br><br>
		<a href="agenda.php">Voltar à agenda</a>
		</div>';
		exit;
    }

    //Abrir ligação à base de dados
    include 'config.php';
    $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

    if($ID_Servico  == -1)
    {
        //Vai buscar o id_material disponivel
        $motor=$ligacao->prepare("SELECT MAX(ID_Tipo_Servico) AS MaxID FROM tiposervico");
        $motor->execute();
        $ID_Servico=$motor->fetch(PDO::FETCH_ASSOC) ['MaxID'];
        
        if($ID_Servico == null)
        {
        $ID_Servico = 0;
        }
        else
        {
        $ID_Servico++;
        $editar = false;
        }
    }
    else    
    {
        $editar=true;
    }

    //se for para editar
    if(!$editar)
    {

        $motor=$ligacao->prepare("INSERT INTO servico VALUES(?,?,?,?,?,?,?,?,?,?)");
        $motor->bindParam(1, $ID_Servico, PDO::PARAM_INT);
        $motor->bindParam(2, $$data_inicial, PDO::PARAM_STR);
        $motor->bindParam(3, $hora_chegada, PDO::PARAM_STR);
        $motor->bindParam(4, $hora_saida, PDO::PARAM_STR);
        $motor->bindParam(5, $estado, PDO::PARAM_STR);
        $motor->bindParam(6, $relatorio, PDO::PARAM_STR);
        $motor->bindParam(7, $ID_Utente, PDO::PARAM_INT);
        $motor->bindParam(8, $ID_Funcionario, PDO::PARAM_INT);
        $motor->bindParam(9, $ID_Tipo_Servico, PDO::PARAM_INT);
        $motor->bindParam(10, $ID_Material, PDO::PARAM_INT);
        $motor->execute();
    }
    else
    {
        //atualizar os dados  do post 

        $motor=$ligacao->prepare("UPDATE servico SET estado = :esta, relatorio = :relat WHERE ID_Servico = :pid ");
        $motor->bindParam(":pid", $ID_Servico, PDO::PARAM_INT);
        $motor->bindParam(":esta", $estado, PDO::PARAM_STR);
        $motor->bindParam(":relat", $relatorio, PDO::PARAM_STR);
        $motor->execute();

    }

    //gravado com sucesso
    echo'<center><img src="servicogravado.gif" width="400" alt="S.A.D">
	<center><a href="painelcontrolo.php"><button class="button">Painel de Controlo</button></a>
	<center><a href="agenda.php"><button class="button">Agenda</button></a>
			';
?>
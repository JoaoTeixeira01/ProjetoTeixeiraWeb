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
    <img src="images/avatars/"' . $_SESSION['avatar'] . '><span>Conta Logada: ' . $_SESSION['user'] . '</span> | <a href="logout.php"><button class="button" >Logout</button></a>
    </div><hr>';

    //Buscar dados dos tipos de serviço
    $ID_Tipo_Servico = $_POST['ID_Tipo_Servico'];
    $nome=$_POST['nome'];
    $descricao=$_POST['descricao'];
    $editar = false;

    //Verificar se os campos estão preenchidos
    if($nome == "" || $descricao == "" )
    {
        include 'cabecalho.php';
		//erro-campos não preenchidos
		echo '<div class="erro">
		Não Foram preenchidos os campos nome ou descrição.<br><br>
		<a href="editor_tipo_servico.php">Tente Novamente</a>
		</div>';
		exit;
    }

    //Abrir ligação à base de dados
    include 'config.php';
    $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

    if($ID_Tipo_Servico  == -1)
    {
        //Vai buscar o id_material disponivel
        $motor=$ligacao->prepare("SELECT MAX(ID_Tipo_Servico) AS MaxID FROM tiposervico");
        $motor->execute();
        $ID_Tipo_Servico=$motor->fetch(PDO::FETCH_ASSOC) ['MaxID'];
        
        if($ID_Tipo_Servico == null)
        {
        $ID_Tipo_Servico = 0;
        }
        else
        {
        $ID_Tipo_Servico++;
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

        $motor=$ligacao->prepare("INSERT INTO tiposervico VALUES(?,?,?)");
        $motor->bindParam(1, $ID_Tipo_Servico, PDO::PARAM_INT);
        $motor->bindParam(2, $nome, PDO::PARAM_STR);
        $motor->bindParam(3, $descricao, PDO::PARAM_STR);
      
        $motor->execute();
    }
    else
    {
        //atualizar os dados  do post 

        $motor=$ligacao->prepare("UPDATE tiposervico SET nome = :nome, Descricao = :descr  WHERE ID_Tipo_Servico = :pid ");
        $motor->bindParam(":pid", $ID_Tipo_Servico, PDO::PARAM_INT);
        $motor->bindParam(":nome", $nome, PDO::PARAM_STR);
        $motor->bindParam(":descr", $descricao, PDO::PARAM_STR);
      
        $motor->execute();

    }

    //gravado com sucesso
    echo'<center><img src="tiposervicoguardado.gif" width="400" alt="S.A.D">
	<center><a href="altera_tipo_servico.php"><button class="button">Voltar</button></a>
			';
?>
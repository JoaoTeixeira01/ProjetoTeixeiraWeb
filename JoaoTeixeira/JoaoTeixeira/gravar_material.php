<?php
//Gravar Material

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

    //Buscar dados dos materiais
    $ID_Material = $_POST['ID_Material'];
    $nome = $_POST['nome'];
    $Descricao = $_POST['Descricao'];
    $editar = false;

    //Verificar se os campos estão preenchidos
    if($nome === "" || $Descricao == ""  )
    {
        include 'cabecalho.php';
		//erro-campos não preenchidos
		echo '<div class="erro">
		Não Foram preenchidos os campos necessários.<br><br>
		<a href="editor_material.php">Tente Novamente</a>
		</div>';
		exit;
    }

    //Abrir ligação à base de dados
    include 'config.php';
    $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

    if($ID_Material == -1)
    {
        //Vai buscar o id_material disponivel
        $motor=$ligacao->prepare("SELECT MAX(ID_Material) AS MaxID FROM material");
        $motor->execute();
        $ID_Material=$motor->fetch(PDO::FETCH_ASSOC) ['MaxID'];
        
        if($ID_Material == null)
        {
        $ID_Material = 0;
        }
        else
        {
        $ID_Material++;
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

        $motor=$ligacao->prepare("INSERT INTO material VALUES(?,?,?,?)");
        $motor->bindParam(1, $ID_Material, PDO::PARAM_INT);
        $motor->bindParam(2, $nome, PDO::PARAM_STR);
        $motor->bindParam(3, $Descricao, PDO::PARAM_STR);

        $motor->execute();
    }
    else
    {
        //atualizar os dados  do post 

        $motor=$ligacao->prepare("UPDATE material SET nome = :nome, descricao = :descr WHERE ID_Material = :pid ");
        $motor->bindParam(":pid", $ID_Material, PDO::PARAM_INT);
        $motor->bindParam(":nome", $nome, PDO::PARAM_STR);
        $motor->bindParam(":descr", $Descricao, PDO::PARAM_STR);
 
        $motor->execute();

    }

    //gravado com sucesso
    echo '<center><img src="materialgravado.gif" width="400" alt="S.A.D">
    <center><a href="painelcontrolo.php"><button class="button">Voltar</button></a>';
?>
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

    include 'cabecalho.php';

 //dados do utilizador que está logado
 echo '<div class="dados_utilizador">
        <img src="images/avatars/'.$_SESSION['avatar'].'" width="40"> | Conta:<span>'.$_SESSION['user'].'</span> | <a href="logout.php"><button class="button" >Sair</button></a>
        </div><hr>';
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
        $motor=$ligacao->prepare("SELECT * FROM servico WHERE Data_Inicial = '$pid'");
        $motor->execute();

        if ($motor->rowcount()== 0)
    {
        echo '<div class="login_sucesso">
        '.$pid.';
            Não existem Serviços disponíveis!
        </div>';
    }
    else
    {
        //Foram encontrados posts        
        foreach($motor  as  $serv)
        {
            //dados do post
            $id_servico = $serv['ID_Servico'];
            $data_inicial = $serv['Data_Inicial'];
            $hora_che = $serv['Hora_chegada'];
            $hora_sai = $serv['Hora_saida'];
            $utente = $serv['ID_Utente'];
	        $funcionario = $serv['ID_Funcionario'];
            $servico = $serv['ID_Tipo_Servico'];
            $material = $serv['ID_Material'];
            $estado = $serv['estado'];
            $relatorio = $serv['relatorio'];

            echo '<div class="post">';

            // dados 
                echo '<span id="post_titulo">Data do Serviço: ' . $data_inicial . '</span>';
                echo '<span id="post_titulo">Hora de Chegada: ' . $hora_che . '</span>';
                echo '<span id="post_titulo">Hora de Saída: ' . $hora_sai . '</span>';
                echo '<hr>';
                include 'config.php';

                $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

                 //Dados dos materiais
                  $sql='SELECT * FROM utilizador WHERE ID_Utilizador = '.$utente.' ';
                  $motor=$ligacao -> prepare($sql); 
                  $motor->execute();
                  foreach($motor  as  $servi)
        {
            //dados do post
            $nomeutente = $servi['nome'];
            $apelidoutente =  $servi['apelido'];

                echo '<div id="post_mensagem">Nome do Utente: ' . $nomeutente .' '.$apelidoutente.'</div><br>';
        }
        include 'config.php';

        $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

       //Dados dos materiais
        $sql='SELECT * FROM utilizador WHERE ID_Utilizador = '.$funcionario.' ';
        $motor=$ligacao->prepare($sql); 
        $motor->execute();
        foreach($motor  as  $servic)
{
  //dados do post
  $nomefuncio = $servic['nome'];
  $apelidofuncio =  $servic['apelido'];

      echo '<div id="post_mensagem">Nome do Funcionário: ' . $nomefuncio .' '.$apelidofuncio.'</div><br>';
}
include 'config.php';

$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

       //Dados dos materiais
        $sql='SELECT * FROM tiposervico WHERE ID_Tipo_Servico = '.$servico.' ';
        $motor=$ligacao->prepare($sql); 
        $motor->execute();
        foreach($motor  as  $servic)
{
  //dados do post
  $nomeservico = $servic['nome'];

      echo '<div id="post_mensagem">Tipo de Serviço: ' . $nomeservico.' </div><br>';
}
include 'config.php';

$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

       //Dados dos materiais
        $sql='SELECT * FROM material WHERE ID_Material = '.$material.' ';
        $motor=$ligacao->prepare($sql); 
        $motor->execute();
        foreach($motor  as  $servico)
{
  //dados do post
  $nomematerial = $servico['nome'];
  $descricaomaterial = $servico['Descricao'];

      echo '<div id="post_mensagem">Material Usado: ' . $nomematerial. '('. $descricaomaterial.') </div><br>';
}

echo'
<br>
';
if ($_SESSION['user'] == "admin" || $funcionario == $_SESSION['ID_Utilizador'])
                {
                    echo '<div id="post_data">';
                echo '<a href="editor_servico.php?pids='.$id_servico.'" id="editar" ><img src="edit.png" alt="servico" style="width:32px;height:32px;"></a>';
                echo '</div>';

            }
                echo '</div>';
        }    
      
    }
    }

    //Formulário do forum
    echo '<center><div>
    <a href="agenda.php"><input class ="button"type="button"value="Voltar à Agenda"></a><br>
    </div>';

?>
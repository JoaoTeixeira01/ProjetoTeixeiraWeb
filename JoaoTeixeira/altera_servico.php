<?php
    //FORUM
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

    error_reporting(0);
    include 'cabecalho.php';

    //dados do utilizador que está logado
    echo '<div class="dados_utilizador">
        <img src="images/avatars/'.$_SESSION['avatar'].'" width="40"> | Conta:<span>'.$_SESSION['user'].'</span> | <a href="logout.php"><button class="button" >Sair</button></a>
        </div><hr>';





        if($_SESSION['ID_Tipo_Utilizador'] == 1 )
        {
            echo '
            <form class="form_login" method="post" action="altera_servico.php">';

            include 'config.php';
            $user = "root";
            $password = "1234";
            $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
            $motor=$ligacao->prepare('SELECT * From utilizador Where ID_Tipo_Utilizador=3');
            $dados=$motor->fetchAll();
            $motor->execute();

            $dados = $motor->fetchAll();
            echo'<center><img src="pesquisarutente.png" width="250" alt="Serviços de apoio domiciliário"><br>';
            echo'<select class="select select1" name="Utente">';
            foreach ($dados as $row): ?>
            <option value=<?=$row["ID_Utilizador"]?>><?=$row["nome"]?></option><p>
            <?php endforeach;
            echo '</select><br><br>';
            echo'<button class="button" type="submit" name="pesquisar_text" value="Pesquisar"><b>Pesquisar</b></button>
            </center>

            </form>

        ';

            if($_POST['pesquisar_text'] == "Pesquisar")
        {
             //apresentar dados da base de dados 
             $pesquisar=$_POST['Utente'];
    //apresentar dados da base de dados 
    include 'config.php';
    $user = "root";
	$password = "1234";
    $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

    //Dados dos materiais
    $sql="SELECT * FROM servico Where ID_Utente LIKE  '%$pesquisar%'";
    $motor=$ligacao->prepare($sql); 
    $motor->execute();

    if ($motor->rowcount()==0)
    {
        echo '<div class="login_sucesso">
            Não existe o Utente Pesquisado!
        </div>';
    }
    else
    {
        //Foram encontrados posts        
        foreach($motor  as  $serv)
        {
            //dados do post
            $id_servico=$serv['ID_Servico'];
            $data_inical=$serv['Data_Inicial'];
            $hora_che=$serv['Hora_chegada'];
            $hora_sai=$serv['Hora_saida'];
            $utente=$serv['ID_Utente'];
	        $funcionario=$serv['ID_Funcionario'];
            $servico=$serv['ID_Tipo_Servico'];
            $material=$serv['ID_Material'];


            echo '<div class="post">';

            // dados
                echo '<span id="post_titulo">Data do Serviço: ' . $data_inical . '</span>';
                echo '<span id="post_titulo">Hora de Chegada: ' . $hora_che . '</span>';
                echo '<span id="post_titulo">Hora de Saída: ' . $hora_sai . '</span>';
                echo '<hr>';
                
                include 'config.php';
                $user = "root";
                $password = "1234";
                $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

                 //Dados dos materiais
                  $sql='SELECT * FROM utilizador WHERE ID_Utilizador='.$utente.'';
                  $motor=$ligacao->prepare($sql); 
                  $motor->execute();
                  foreach($motor  as  $servi)
        {
            //dados do post
            $nomeutente=$servi['nome'];
            $apelidoutente=$servi['apelido'];

                echo '<div id="post_mensagem">Nome do Utente: ' . $nomeutente .' '.$apelidoutente.'</div><br>';
        }
        include 'config.php';
        $user = "root";
        $password = "1234";
        $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

       //Dados dos materiais
        $sql='SELECT * FROM utilizador WHERE ID_Utilizador='.$funcionario.'';
        $motor=$ligacao->prepare($sql); 
        $motor->execute();
        foreach($motor  as  $servic)
{
  //dados do post
  $nomefuncio=$servic['nome'];
  $apelidofuncio=$servic['apelido'];

      echo '<div id="post_mensagem">Nome do Funcionário: ' . $nomefuncio .' '.$apelidofuncio.'</div><br>';
}
include 'config.php';
$user = "root";
$password = "1234";
$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

       //Dados dos materiais
        $sql='SELECT * FROM tiposervico WHERE ID_Tipo_Servico='.$servico.'';
        $motor=$ligacao -> prepare($sql); 
        $motor->execute();
        foreach($motor  as  $servic)
{
  //dados do post
  $nomeservico=$servic['nome'];

      echo '<div id="post_mensagem">Tipo de Serviço: ' . $nomeservico.' </div><br>';
}
include 'config.php';
$user = "root";
$password = "1234";
$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

       //Dados dos materiais
        $sql='SELECT * FROM material WHERE ID_Material='.$material.'';
        $motor=$ligacao->prepare($sql); 
        $motor->execute();
        foreach($motor  as  $servico)
{
  //dados do post
  $nomematerial=$servico['nome'];
  $descricaomaterial=$servico['Descricao'];

      echo '<div id="post_mensagem">Material Usado: ' . $nomematerial.'('.$descricaomaterial.') </div><br>';
}


                 //Numero e botao de editar
                echo '<div id="post_data">';

                echo '<div id="id_post">Serviço Nº'. $id_servico. '</div>';
                echo ' </div>';
                echo '</div><br>
                <center><img src="barra.png" width="250" alt="S.A.D"></center>';
          
        }
        echo' <center><a href="painelcontrolo.php"><input class ="button"type="button"value="Voltar ao Painel de Controlo"></a><br><br>'; 
    }
        }
        else{
               //apresentar dados da base de dados 
   include 'config.php';
   $user = "root";
   $password = "1234";         
   $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

   //Dados dos materiais
   $sql='SELECT * FROM servico ';
   $motor=$ligacao->prepare($sql); 
   $motor->execute();

   if ($motor->rowcount()==0)
   {
       echo '<div class="login_sucesso">
       Não existe o Funcionário Pesquisado!
       </div>';
   }
   else
   {
       //Foram encontrados posts        
       foreach($motor  as  $serv)
       {
           //dados do post
           $id_servico=$serv['ID_Servico'];
           $data_inical=$serv['Data_Inicial'];
           $hora_che=$serv['Hora_chegada'];
           $hora_sai=$serv['Hora_saida'];
           $utente=$serv['ID_Utente'];
           $funcionario=$serv['ID_Funcionario'];
           $servico=$serv['ID_Tipo_Servico'];
           $material=$serv['ID_Material'];


           echo '<div class="post">';

           // dados
               echo '<span id="post_titulo">Data do Serviço: ' . $data_inical . '</span>';
               echo '<span id="post_titulo">Hora de Chegada: ' . $hora_che . '</span>';
               echo '<span id="post_titulo">Hora de Saída: ' . $hora_sai . '</span>';
               echo '<hr>';
               
               include 'config.php';
               $user = "root";
               $password = "1234";
               $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

                //Dados dos materiais
                 $sql='SELECT * FROM utilizador WHERE ID_Utilizador='.$utente.'';
                 $motor=$ligacao->prepare($sql); 
                 $motor->execute();
                 foreach($motor  as  $servi)
       {
           //dados do post
           $nomeutente=$servi['nome'];
           $apelidoutente=$servi['apelido'];

               echo '<div id="post_mensagem">Nome do Utente: ' . $nomeutente .' '.$apelidoutente.'</div><br>';
       }
       include 'config.php';
       $user = "root";
       $password = "1234";
       $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

      //Dados dos materiais
       $sql='SELECT * FROM utilizador WHERE ID_Utilizador='.$funcionario.'';
       $motor=$ligacao->prepare($sql); 
       $motor->execute();
       foreach($motor  as  $servic)
{
 //dados do post
 $nomefuncio=$servic['nome'];
 $apelidofuncio=$servic['apelido'];

     echo '<div id="post_mensagem">Nome do Funcionário: ' . $nomefuncio .' '.$apelidofuncio.'</div><br>';
}
include 'config.php';
$user = "root";
$password = "1234";
$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

      //Dados dos materiais
       $sql='SELECT * FROM tiposervico WHERE ID_Tipo_Servico='.$servico.'';
       $motor=$ligacao -> prepare($sql); 
       $motor->execute();
       foreach($motor  as  $servic)
{
 //dados do post
 $nomeservico=$servic['nome'];

     echo '<div id="post_mensagem">Tipo de Serviço: ' . $nomeservico.' </div><br>';
}
include 'config.php';
$user = "root";
$password = "1234";
$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

      //Dados dos materiais
       $sql='SELECT * FROM material WHERE ID_Material='.$material.'';
       $motor=$ligacao->prepare($sql); 
       $motor->execute();
       foreach($motor  as  $servico)
{
 //dados do post
 $nomematerial=$servico['nome'];
 $descricaomaterial=$servico['Descricao'];

     echo '<div id="post_mensagem">Material Usado: ' . $nomematerial.'('.$descricaomaterial.') </div><br>';
}


                //Numero e botao de editar
               echo '<div id="post_data">';

               echo '<div id="id_post">Serviço Nº'. $id_servico. '</div>';
               echo ' </div>';
               echo '</div><br>
               <center><img src="barra.png" width="250" alt="S.A.D"></center>';
         
       }
       echo' <center><a href="painelcontrolo.php"><input class ="button"type="button"value="Voltar ao Painel de Controlo"></a><br><br>'; 
   }
        }
    }
        elseif($_SESSION['ID_Tipo_Utilizador'] == 3)


{
    //apresentar dados da base de dados 
    include 'config.php';
    $user = "root";
	$password = "1234";
    $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

    //Dados dos materiais
    $sql='SELECT * FROM servico WHERE ID_Utente = '.$_SESSION['ID_Utilizador'].'';
    $motor=$ligacao->prepare($sql); 
    $motor->execute();

    if ($motor->rowcount()== 0)
    {
        echo '<div class="login_sucesso">
            Não existem Serviços disponíveis!
        </div>';
    }
    else
    {
        //Foram encontrados posts        
        foreach($motor  as  $serv)
        {
            //dados do post
            $id_servico=$serv['ID_Servico'];
            $data_inical=$serv['Data_Inicial'];
            $hora_che=$serv['Hora_chegada'];
            $hora_sai=$serv['Hora_saida'];
            $utente=$serv['ID_Utente'];
	        $funcionario=$serv['ID_Funcionario'];
            $servico=$serv['ID_Tipo_Servico'];
            $material=$serv['ID_Material'];


            echo '<div class="post">';

            // dados 
                echo '<span id="post_titulo">Data do Serviço: ' . $data_inical . '</span>';
                echo '<span id="post_titulo">Hora de Chegada: ' . $hora_che . '</span>';
                echo '<span id="post_titulo">Hora de Saída: ' . $hora_sai . '</span>';
                echo '<hr>';
                                
                include 'config.php';
                $user = "root";
                $password = "1234";
                $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

                 //Dados dos materiais
                  $sql='SELECT * FROM utilizador WHERE ID_Utilizador='.$utente.'';
                  $motor=$ligacao->prepare($sql); 
                  $motor->execute();
                  foreach($motor  as  $servi)
        {
            //dados do post
            $nomeutente=$servi['nome'];
            $apelidoutente=$servi['apelido'];

                echo '<div id="post_mensagem">Nome do Utente: ' . $nomeutente .' '.$apelidoutente.'</div><br>';
        }
        include 'config.php';
        $user = "root";
        $password = "1234";
        $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

       //Dados dos materiais
        $sql='SELECT * FROM utilizador WHERE ID_Utilizador='.$funcionario.'';
        $motor=$ligacao->prepare($sql); 
        $motor->execute();
        foreach($motor  as  $servic)
{
  //dados do post
  $nomefuncio=$servic['nome'];
  $apelidofuncio=$servic['apelido'];

      echo '<div id="post_mensagem">Nome do Funcionário: ' . $nomefuncio .' '.$apelidofuncio.'</div><br>';
}
include 'config.php';
$user = "root";
$password = "1234";
$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

       //Dados dos materiais
        $sq='SELECT * FROM tiposervico WHERE ID_Tipo_Servico='.$servico.'';
        $motor=$ligacao->prepare($sql); 
        $motor->execute();
        foreach($motor  as  $servic)
{
  //dados do post
  $nomeservico=$servic['nome'];

      echo '<div id="post_mensagem">Tipo de Serviço: ' . $nomeservico.' </div><br>';
}
include 'config.php';
$user = "root";
$password = "1234";
        $ligacao=new PDO("mysql:dbname=$base_dados; host = $host", $user, $password);

       //Dados dos materiais
        $sql='SELECT * FROM material WHERE ID_Material='.$material.'';
        $motor=$ligacao->prepare($sql); 
        $motor->execute();
        foreach($motor  as  $servico)
{
  //dados do post
  $nomematerial=$servico['nome'];
  $descricaomaterial=$servico['Descricao'];

      echo '<div id="post_mensagem">Material Usado: ' . $nomematerial.' </div><br>';
}




                 //Numero e botao de editar
                echo '<div id="post_data">';
                
                echo '<div id="id_post">Serviço Nº'. $id_servico. '</div>';
                echo ' </div>';
                echo '</div><br>
                <center><img src="barra.png" width="250" alt="S.A.D"></center>';
          
        }
}
}
else
{
    //apresentar dados da base de dados 
    include 'config.php';
    $user = "root";
	$password = "1234";
    $ligacao=new PDO("mysql:dbname=$base_dados;host = $host",$user,$password);

    //Dados dos materiais
    $sql='SELECT * FROM servico WHERE ID_Funcionario='.$_SESSION['ID_Utilizador'].'';
    $motor=$ligacao->prepare($sql); 
    $motor->execute();

    if ($motor->rowcount()==0)
    {
        echo '<div class="login_sucesso">
            Não existem Serviços disponíveis!
        </div>';
    }
    else
    {
        //Foram encontrados posts        
        foreach($motor  as  $serv)
        {
            //dados do post
            $id_servico=$serv['ID_Servico'];
            $data_inical=$serv['Data_Inicial'];
            $hora_che=$serv['Hora_chegada'];
            $hora_sai=$serv['Hora_saida'];
            $utente=$serv['ID_Utente'];
	        $funcionario=$serv['ID_Funcionario'];
            $servico=$serv['ID_Tipo_Servico'];
            $material=$serv['ID_Material'];


            echo '<div class="post">';

            // dados 
                echo '<span id="post_titulo">Data do Serviço: ' . $data_inical . '</span>';
                echo '<span id="post_titulo">Hora de Chegada: ' . $hora_che . '</span>';
                echo '<span id="post_titulo">Hora de Saída: ' . $hora_sai . '</span>';
                echo '<hr>';
                
                include 'config.php';
                $user = "root";
                $password = "1234";
                $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

                 //Dados dos materiais
                  $sql='SELECT * FROM utilizador WHERE ID_Utilizador='.$utente.'';
                  $motor=$ligacao->prepare($sql); 
                  $motor->execute();
                  foreach($motor  as  $servi)
        {
            //dados do post
            $nomeutente=$servi['nome'];
            $apelidoutente=$servi['apelido'];

                echo '<div id="post_mensagem">Nome do Utente: ' . $nomeutente .' '.$apelidoutente.'</div><br>';
        }
        include 'config.php';
        $user = "root";
        $password = "1234";
        $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
       //Dados dos materiais
        $sql='SELECT * FROM utilizador WHERE ID_Utilizador='.$funcionario.'';
        $motor=$ligacao->prepare($sql); 
        $motor->execute();
        foreach($motor  as  $servic)
{
  //dados do post
  $nomefuncio=$servic['nome'];
  $apelidofuncio=$servic['apelido'];

      echo '<div id="post_mensagem">Nome do Funcionário: ' . $nomefuncio .' '.$apelidofuncio.'</div><br>';
}
include 'config.php';
$user = "root";
$password = "1234";
$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

       //Dados dos materiais
        $sql='SELECT * FROM tiposervico WHERE ID_Tipo_Servico='.$servico.'';
        $motor=$ligacao->prepare($sql); 
        $motor->execute();
        foreach($motor  as  $servic)
{
  //dados do post
  $nomeservico=$servic['nome'];

      echo '<div id="post_mensagem">Tipo de Serviço: ' . $nomeservico.' </div><br>';
}
include 'config.php';
$user = "root";
$password = "1234";
$ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

       //Dados dos materiais
        $sql='SELECT * FROM material WHERE ID_Material='.$material.'';
        $motor=$ligacao->prepare($sql); 
        $motor->execute();
        foreach($motor  as  $servico)
{
  //dados do post
  $nomematerial=$servico['nome'];
  $descricaomaterial=$servico['Descricao'];

      echo '<div id="post_mensagem">Material Usado: ' . $nomematerial.' </div><br>';
}

                 //Numero e botao de editar
                echo '<div id="post_data">';

                echo '<div id="id_post">Serviço Nº'. $id_servico. '</div>';
                echo ' </div>';
                echo '</div><br>
                <center><img src="barra.png" width="250" alt="S.A.D"></center>';
          
        }
		
}
}
 //Formulário do forum
    echo '<center><div>
    <a href="agenda.php"><input class ="button"type="button"value="Voltar à Agenda"></a><br>
    </div>';
?>

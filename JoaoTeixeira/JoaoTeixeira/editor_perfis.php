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
    // Editar/Criar Perfil
    include 'cabecalho.php';


        //Verificar se o utilizador quer editar
		if ($_SESSION['user'] == "admin")
			{
				$pid = -1;
        $editar = false;

        if(isset($_REQUEST['pid']))
    {   
        $pid = $_REQUEST['pid'];
        $editar = true;

        //Buscar dados à Base de dados 
      
        include 'config.php';
        $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
        $motor=$ligacao->prepare("SELECT * FROM utilizador WHERE ID_Utilizador=".$pid);
        $motor->execute();


        $dados=$motor->fetch(PDO::FETCH_ASSOC);
        $ligacao=null;
         
        $nome = $dados['nome'];
        $apelido = $dados['apelido'];
        $username = $dados['username'];
        $email = $dados['email'];   
        $pass_word = $dados['pass_word'];
        $estado = $dados['estado'];
        $morada = $dados['morada'];
        $sexo = $dados['sexo'];
        $data_nascimento = $dados['data_nascimento'];
        $telemovel = $dados['telemovel'];
        $nif = $dados['nif'];
        $cc = $dados['cc'];
        $cs = $dados['cs'];
        $hab = $dados['habilitacoes'];
        $avatar = $dados['avatar'];
    }
			}
			else
			{
				$pid = $_SESSION['ID_Utilizador'];

        //Buscar dados à Base de dados 
      
        include 'config.php';
        $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
        $motor=$ligacao->prepare("SELECT * FROM utilizador WHERE ID_Utilizador=".$pid);
        $motor->execute();


        $dados=$motor->fetch(PDO::FETCH_ASSOC);
        $ligacao=null;
         
        $nome = $dados['nome'];
        $apelido = $dados['apelido'];
        $username = $dados['username'];
        $email = $dados['email'];   
        $pass_word = $dados['pass_word'];
        $morada = $dados['morada'];
        $sexo = $dados['sexo'];
        $data_nascimento = $dados['data_nascimento'];
        $telemovel = $dados['telemovel'];
        $avatar = $dados['avatar'];
        $nif = $dados['nif'];
        $cc = $dados['cc'];
        $cs = $dados['cs'];
        $hab = $dados['habilitacoes'];
        $estado = $dados['estado'];
			}
        
    //dados do utilizador que está logado
    echo '<div class="dados_utilizador">
        <img src="images/avatars/'.$_SESSION['avatar'].'" width="40"> | Conta:<span>'.$_SESSION['user'].'</span> | <a href="logout.php"><button class="button" >Sair</button></a>
        </div><hr>';

    if($pid == $_SESSION['ID_Utilizador'])
    {
    //Formulário 
    echo '<div>
    <form method="post" action="gravar_perfis.php">

    <center><img src="alterarperfil.png" width="500" alt="S.A.D"><br>

    <input type="hidden" name="ID_Utilizador" value='. $pid . '>

    <!-- --------------------------------------------- -->

    <center><img src="imagensregistar/username.png" width="280" alt="S.A.D"><br>

    <center><img src="barra.png" width="200" alt="S.A.D"><br>

    <input type="text" name="username" size="95" value="'. $username .'"><br><br>

    <!-- --------------------------------------------- -->

    <center><img src="imagensregistar/nome.png" width="280" alt="S.A.D"><br>

    <center><img src="barra.png" width="200" alt="S.A.D"><br> 
    
    <input type="text" name="nome" size="95" value="'. $nome .'"><br><br>

    <!-- --------------------------------------------- -->

    <center><img src="imagensregistar/apelido.png" width="280" alt="S.A.D"><br>

    <center><img src="barra.png" width="200" alt="S.A.D"><br>

    <input type="text" name="apelido" size="95" value="'. $apelido .'"><br><br>

    <!-- --------------------------------------------- -->

    <center><img src="imagensregistar/email.png" width="280" alt="S.A.D"><br>

    <center><img src="barra.png" width="200" alt="S.A.D"><br>

    <input type="text" name="email" size="95" value="'. $email .'"><br><br>

    <!-- --------------------------------------------- -->

    <center><img src="imagensregistar/password.png" width="280" alt="S.A.D"><br>

    <center><img src="barra.png" width="200" alt="S.A.D"><br>
    <input type="password" name="password" size="95" value="" placeholder="Introduza a Palavra-Passe"><br><br>

    <!-- --------------------------------------------- -->

    <center><img src="imagensregistar/morada.png" width="280" alt="S.A.D"><br>

    <center><img src="barra.png" width="200" alt="S.A.D"><br>
    <input type="text" name="morada" size="95" value="'. $morada .'"><br><br>

    <!-- --------------------------------------------- -->

    <center><img src="imagensregistar/datanascimento.png" width="280" alt="S.A.D"><br>

    <center><img src="barra.png" width="200" alt="S.A.D"><br>
    <input type="text" name="data" size="95" value="'. $data_nascimento .'"><br><br>

    <!-- --------------------------------------------- -->

    <center><img src="imagensregistar/telemovel.png" width="280" alt="S.A.D"><br>

    <center><img src="barra.png" width="200" alt="S.A.D"><br>
    <input type="text" name="telemovel" size="95" value="'. $telemovel .'"><br><br>

    <!-- --------------------------------------------- -->

    <center><img src="imagensregistar/nif.png" width="280" alt="S.A.D"><br>

    <center><img src="barra.png" width="200" alt="S.A.D"><br>
    <input type="text" name="nif" size="95" value="'. $nif .'"><br><br>

    <!-- --------------------------------------------- -->

    <center><img src="imagensregistar/fotoperfil.png" width="240" alt="S.A.D"><br>

	<center><img src="barra.png" width="150" alt="S.A.D"><br>
	
	<input type="file" name="imagem_avatar"><br><br>


    <!-- --------------------------------------------- -->
	';
			if ($pid != "1")
			{
				echo'
				<center><img src="estado.png" width="250" alt="Serviços de apoio domiciliário"></center><br>
				<select  class="select select1" id="op" name="estado" value="'. $estado .'">
				<option value="ativo">Ativo</option>
				<option value="inativo">Inativo</option>
				</select><br><br>
				';
				
			}
			else
			{
				echo'
				<input type="hidden" name="estado" value="ativo">
				';
            }
            if($_SESSION['ID_Tipo_Utilizador'] == 2)
            {
                echo'
                <center><img src="cartaocidadao.png" width="250" alt="Serviços de apoio domiciliário"></center><br>
                <input type="text" name="cc" value="'. $cc .'"><br><br>
                <center><img src="segurancasocial.png" width="250" alt="Serviços de apoio domiciliário"></center><br>
                <input type="text" name="cs" value="'. $cs .'"><br><br>
                <center><img src="habilitacoes.png" width="250" alt="Serviços de apoio domiciliário"></center><br>
                <input type="text" name="habilitacoes" value="'. $hab .'"><br><br>
                ';
            }
            else
            {
                echo'
                <input type="hidden" name="cc" value="">
            	<input type="hidden" name="cs" value="">
                <input type="hidden" name="habilitacoes" value="">
                ';
            }
			echo'
    <hr>

';
			
            echo'
            <center><button class="button" type="submit" name="btn_submit"><b>Gravar Alterações</b></button><br><br>
    </form>
    </div>
    ';
    if ($_SESSION['user'] == "admin")
			{

                
				echo'<center><a href="perfis.php"><input class ="button"type="button"value="Voltar"></a></center><br><br>';
			}
			else
			{
				echo'<center><a href="logado.php"><center><button class="button"><b>Voltar Atrás</b></button><br><br></a></center>';
            }
            
        }
        else
        {
           //Formulário 
    echo '<div>
    <form class="form_post" method="post" action="gravar_perfis.php">

    <center><img src="alterarperfil.png" width="500" alt="S.A.D"><br>

    <input type="hidden" name="ID_Utilizador" value='. $pid . '>

    <center><img src="imagensregistar/username.png" width="280" alt="S.A.D"><br>

    <center><img src="barra.png" width="200" alt="S.A.D"><br>
    <input   readonly type="text" name="username" size="95" value="'. $username .'" ><br><br>

    <center><img src="imagensregistar/nome.png" width="280" alt="S.A.D"><br>

    <center><img src="barra.png" width="200" alt="S.A.D"><br> 
    <input  readonly type="text" name="nome" size="95" value="'. $nome .'"><br><br>

    <center><img src="imagensregistar/apelido.png" width="280" alt="S.A.D"><br>

    <center><img src="barra.png" width="200" alt="S.A.D"><br>
    <input readonly type="text" name="apelido" size="95" value="'. $apelido .'"><br><br>

     <center><img src="imagensregistar/email.png" width="280" alt="S.A.D"><br>

    <center><img src="barra.png" width="200" alt="S.A.D"><br>

    <input readonly type="text" name="email" size="95" value="'. $email .'"><br><br>

    
    <input  type="hidden" type="password" name="password" size="95" value="'. $pass_word .'">

    <input  type="hidden" type="text" name="morada" size="95" value="'. $morada .'">

    
    <input  type="hidden" type="text" name="data" size="95" value="'. $data_nascimento .'">

    <center><img src="imagensregistar/telemovel.png" width="280" alt="S.A.D"><br>

    <center><img src="barra.png" width="200" alt="S.A.D"><br>
    <input  readonly type="text" name="telemovel" size="95" value="'. $telemovel .'"><br><br>

    
    <input  type="hidden" type="text" name="nif" size="95" value="'. $nif .'">
    
    <center><img src="imagensregistar/fotoperfil.png" width="240" alt="S.A.D"><br>
    <center><img src="barra.png" width="150" alt="S.A.D"><br>
    <input type="file" name="imagem_avatar" value="'. $avatar .'"><br><br>

	';
			if ($pid != "1")
			{
				echo'
                <center><img src="estado.png" width="250" alt="Serviços de apoio domiciliário"></center><br>
				<select  class="select select1" id="op" name="estado" value="'. $estado .'">
				<option value="ativo">Ativo</option>
				<option value="inativo">Inativo</option>
				</select><br><br>
				';
				
			}
			else
			{
				echo'
				<input type="hidden" name="estado" value="ativo">
				';
            }
            echo'
            <center>
            <center><button class="button" type="submit" name="btn_submit">Guardar</button><br>
</form>
';
			if ($_SESSION['user'] == "admin")
			{
                echo'
                <center><a href="perfis.php"> <input class ="button"type="button"value="Voltar "></a><br><br>
                ';
			}
			else
			{
                echo'
                <center><a href="logado.php"> <input class ="button"type="button"value="Voltar "></a><br><br>
                ';
			}
			echo'
    </div>
    '; 
        }
?>
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

    //Apresentar Formulário

    include 'cabecalho.php';
    if ($_SESSION['user'] == "admin")
    {
        Apresentarbotao1();
    }
   else
   {
    Apresentarbotao2();
   }


   //Funções

function Apresentarbotao1()
{
	
//apresenta os botões com opções de controlo
 echo'
 <center>
 
 <img src="painelcontrolo.png" width="430" alt="nao sei"><br><br>
 <hr>

    <table border="0">
    <tr>
        <td></td>
        <td></td>
        <td align="center"><a href="tiposservico.php"><button class="button" type="submit" value="Submit">Tipos de Serviço</button></a></td>
    </tr>
    <tr>
        <td><img src="adicionar.png" width="240" alt="nao sei"></td>
        <td></td>
        <td align="center"><a href="material.php"><button class="button" type="submit" value="Submit">Material</button></a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td align="center"><a href="servicos.php"><button class="button" type="submit" value="Submit">Serviço</button></a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td align="center"><br><a href="adicionar_func.php"><button class="button" type="submit" value="Submit">Funcionário</button></a></td>
    </tr>
    </table>
    <br>

    <img src="barra.png" width="220" alt="nao sei"><img src="barra.png" width="220" alt="nao sei"><br><br>

    <table border="0">

    <tr>
      <td></td>
      <td></td>
      <td align="center"><a href="altera_tipo_servico.php"><button class="button" type="submit" value="Submit">Tipos de Serviço</button></a></td>
    </tr>
    <tr>
      <td><img src="listaralterar.png" width="220" alt="nao sei"></td>
      <td></td>
      <td align="center"><a href="altera_material.php"><button class="button" type="submit" value="Submit">Material</button></a></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td align="center"><a href="altera_servico.php"><button class="button" type="submit" value="Submit">Serviços</button></a></td>
    </tr>
  </table>
  <br>

  <hr><br>

  <a href="logado_admin2.php"><input class ="button"type="button"value="Voltar à Pagina de Administrador"></a><br>


	';
}

function Apresentarbotao2()
{
	
//apresenta os botões com opções de controlo
 echo'
 <center>
 
 <img src="painelcontrolo.png" width="430" alt="nao sei"><br><br>
 <hr>

    <table border="0">
    <tr>
        <td></td>
        <td></td>
        <td</td>
    </tr>
    <tr>
        <td><img src="adicionar.png" width="240" alt="nao sei"></td>
        <td></td>
        <td align="center"><a href="servicos.php"><button class="button" type="submit" value="Submit">Serviço</button></a></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td </td>
    </tr>
    </table>
    <br>

    <img src="barra.png" width="220" alt="nao sei"><img src="barra.png" width="220" alt="nao sei"><br><br>

    <table border="0">

    <tr>
      <td></td>
      <td></td>
      <td align="center"><a href="altera_tipo_servico.php"><button class="button" type="submit" value="Submit">Tipos de Serviço</button></a></td>
    </tr>
    <tr>
      <td><img src="listar2.png" width="220" alt="nao sei"></td>
      <td></td>
      <td align="center"><a href="altera_material.php"><button class="button" type="submit" value="Submit">Material</button></a></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td align="center"><a href="altera_servico.php"><button class="button" type="submit" value="Submit">Serviços</button></a></td>
    </tr>
  </table>
  <br>

  <hr><br>

  <a href="logado_funcionario.php"><input class ="button"type="button"value="Voltar à Pagina Inicial"></a><br>

	';
}
?>
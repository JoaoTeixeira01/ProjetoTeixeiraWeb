<?php

session_start();
$utilizador = $_SESSION['user'];

    include 'logado_admin.php';
 
include 'cabecalho.php';

    $pid = -1;
    $editar = false;

    if(isset($_REQUEST['pid']))
    {
        $tiposervico=$_REQUEST['pid'];

        include 'config.php';

        $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

        $sql='DELETE FROM tiposervico WHERE ID_Tipo_Servico='.$tiposervico.'';

        $motor=$ligacao->prepare($sql); 

        $motor->execute();
    }

    echo '

    <center>Tipo de Serviço Eliminado com Sucesso.<br><br>
    
    <center><a href="altera_tipo_servico.php"><div class="button">Página de Alteração de Tipo Serviço</div><a>';

?>
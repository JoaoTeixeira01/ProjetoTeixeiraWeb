<?php

session_start();
$utilizador = $_SESSION['user'];

    include 'logado_admin.php';
 
include 'cabecalho.php';

    $pid = -1;
    $editar = false;

    if(isset($_REQUEST['pid']))
    {
        $material=$_REQUEST['pid'];

        include 'config.php';

        $ligacao=new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);

        $sql='DELETE FROM material WHERE ID_material='.$material.'';

        $motor=$ligacao->prepare($sql); 

        $motor->execute();
    }

    echo '
<div>
<center>Material Eliminado com Sucesso.<br><br>
    
    <a href="altera_material.php"><div class="button">Página de Alteração de Material</div></div><a>';

?>
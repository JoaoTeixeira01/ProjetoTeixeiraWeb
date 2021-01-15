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


//Admin

if($_SESSION['ID_Tipo_Utilizador'] == 1 )
{
echo '
<center>
<a href="servicos.php"><input class ="button"type="button"value="Adicionar Serviço"><img src="add.png" alt="servico" style="width:48px;height:48px;"></a><br>
<a href="altera_servico.php?a='.$_SESSION['ID_Utilizador'].'"><input class ="button"type="button"value="Listar Todos os Serviços"><img src="listar.png" alt="servico" style="width:48px;height:48px;"></a><br>
<a href="altera_servico_inativo.php"><input class ="button"type="button"value="Listar Todos os Serviços Inativos"><img src="listar.png" alt="servico" style="width:48px;height:48px;"></a>
</center>
';


// Timezone
date_default_timezone_set('Europe/Lisbon');
// mês anterior e próximo
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // este mês
    $ym = date('Y-m');
}
// verificar formato
$timestamp = strtotime($ym . '-01');
if ($timestamp == false) 
{
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}
// Hoje

$today = date('Y-m-j', time());

// Título H3
$html_title = date('Y / m ', $timestamp);

// Criar mês anterior e próximo
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
$day_count = date('t', $timestamp);
 

$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

// Criação do Calendário!!
$weeks = array();
$week = '';


$week .= str_repeat('<td></td>', $str);



for ( $day = 1; $day <= $day_count; $day++, $str++) {

            include 'config.php';
            $user = "root";
            $password = "1234";
    $ligacao = new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
    //Dados os posts
    $sql =  "SELECT * FROM servico";
    $motor=$ligacao->prepare($sql); 
    $motor->execute();
    if ($motor->rowcount()==0)
                      {
                         echo '<div class="login_sucesso">
                        Não existem Serviços!!
                         </div>';
                         break;
                     }
              else
              {
    foreach($motor  as  $post)
    {

        $id_servico = $post['ID_Servico'];
        $data= $post['Data_Inicial'];
        $id_tipo_servico = $post['ID_Tipo_Servico'];
        $id_funcionario = $post['ID_Funcionario'];
        $id_utente = $post['ID_Utente'];
        $estado = $post['estado'];
        
    $date = $ym . '-' . $day;
    $datass = date('Y-m-d', time());

    //Serviço ativo
    if($data == $date && $data > $datass && $estado == "Ativo")
    {
        $week .= '<td class="servico" style="width:180px;" >' . $day;
        $week .= '-<strong>Serviço Marcado</strong><br>
        <center><a href="detalhe_servico.php?pid='.$data.'" id="detalhes" ><img src="service.png" alt="servico" style="width:48px;height:48px;"></a>
        </td>';
        break;
    }
   elseif($date == $today && $date == $data && $estado == "Ativo")
   {
    $week .= '<td class="today" style="width:170px;">' . $day;
    $week .= '-<strong>Dia Atual<br>Serviço Marcado</strong>
    <center><a href="detalhe_servico.php?pid='.$data.'" id="detalhes" ><img src="service.png" alt="servico" style="width:48px;height:48px;"></a>
    </td>
    ';
    break;
   }
   elseif ($data == $date && $data < $datass && $data != $today && $estado == "Ativo")
   {
    $week .= '<td class="servicorealizado" style="width:180px;" >' . $day;
    $week .= '-<strong>Serviço já Realizado</strong><br>
    <center><a href="detalhe_servico.php?pid='.$data.'" id="detalhes" ><img src="service.png" alt="servico" style="width:48px;height:48px;"></a>
    </td>';
    break;
   }
   
    }
     //Data de hoje
    if($today == $date && $date != $data)
     {
         $week .= '<td class="today" style="width:170px;">' . $day;
        $week .= '-<strong>Dia Atual</strong></td>
        ';
     }      
         elseif ($data != $date )
         {
             $week .= '<td style="width:170px;"> ' . $day;
             $week .= '</td>';
         } 
        
    // Fim do mês ou fim do ano
    if ($str % 7 == 6 || $day == $day_count) {
        if ($day == $day_count) {
            
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }
        $weeks[] = '<tr>' . $week . '</tr>';
        // Nova semana
        $week = '';
    }
}
}
}

//Funcionario

else if($_SESSION['ID_Tipo_Utilizador'] == 3)
{
    
    echo '
    <center>
    <a href="altera_servico.php?a='.$_SESSION['ID_Utilizador'].'"><input class ="button"type="button"value="Listar Todos os Meus Serviços"><img src="listar.png" alt="servico" style="width:48px;height:48px;"></a>
    </center>
    ';

// Timezone
date_default_timezone_set('Europe/Lisbon');
// mês anterior e próximo
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // este mês
    $ym = date('Y-m');
}
// verificar formato
$timestamp = strtotime($ym . '-01');
if ($timestamp == false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}
// Hoje

$today = date('Y-m-j', time());

// Título H3
$html_title = date('Y / m ', $timestamp);

// Criar mês anterior e próximo
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
$day_count = date('t', $timestamp);
 

$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

// Criação do Calendário!!
$weeks = array();
$week = '';


$week .= str_repeat('<td></td>', $str);


for ( $day = 1; $day <= $day_count; $day++, $str++) {

            include 'config.php';
            $user = "root";
            $password = "1234";
    $ligacao = new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
    //Dados os posts
    $sql =  'SELECT * FROM servico Where ID_Utente = '.$_SESSION['ID_Utilizador'].'';
    $motor=$ligacao->prepare($sql); 
    $motor->execute();
    if ($motor->rowcount()== 0)
                      {
                         echo '<div class="login_sucesso">
                        Não existem Serviços!!
                         </div>';
                         break;
                     }
              else
              {
    foreach($motor  as  $post)
    {

        $id_servico = $post['ID_Servico'];
        $data= $post['Data_Inicial'];
        $id_tipo_servico = $post['ID_Tipo_Servico'];
        $id_funcionario = $post['ID_Funcionario'];
        $id_utente = $post['ID_Utente'];
        $estado = $post['estado'];

    $date = $ym . '-' . $day;

    $datass = date('Y-m-d', time());

    //Serviço ativo
    if($data == $date && $data > $datass && $estado == "Ativo")
    {
        $week .= '<td class="servico" style="width:180px;" >' . $day;
        $week .= '-<strong>Serviço Marcado</strong><br>
        <center><a href="detalhe_servico.php?pid='.$data.'" id="detalhes" ><img src="service.png" alt="servico" style="width:48px;height:48px;"></a>
        </td>';
        break;
    }
    elseif($date == $today && $date == $data && $estado == "Ativo")
   {
    $week .= '<td class="today" style="width:170px;">' . $day;
    $week .= '-<strong>Dia Atual<br>Serviço Marcado</strong>
    <center><a href="detalhe_servico.php?pid='.$data.'" id="detalhes" ><img src="service.png" alt="servico" style="width:48px;height:48px;"></a>
    </td>
    ';
    break;
   }
   elseif ($data == $date && $data < $datass && $data != $today && $estado == "Ativo")
   {
    $week .= '<td class="servicorealizado" style="width:180px;" >' . $day;
    $week .= '-<strong>Serviço já Realizado</strong><br>
    <center><a href="detalhe_servico.php?pid='.$data.'" id="detalhes" ><img src="service.png" alt="servico" style="width:48px;height:48px;"></a>
    </td>';
    break;
   }
  
    }
     //Data de hoje
    if($today == $date && $date != $data)
     {
         $week .= '<td class="today" style="width:170px;">' . $day;
        $week .= '-<strong>Dia Atual</strong></td>
        ';
     }      
         elseif ($data != $date )
         {
             $week .= '<td style="width:170px;"> ' . $day;
             $week .= '</td>';
         } 
        
    // Fim do mês ou fim do ano
    if ($str % 7 == 6 || $day == $day_count) {
        if ($day == $day_count) {
            
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }
        $weeks[] = '<tr>' . $week . '</tr>';
        // Nova semana
        $week = '';
    }
}
}
}

//Utente

else
{
        
    echo '
    <center>
    <a href="servicos.php"><input class ="button"type="button"value="Adicionar Serviço"><img src="add.png" alt="servico" style="width:48px;height:48px;"></a><br>
    <a href="altera_servico.php?a='.$_SESSION['ID_Utilizador'].'"><input class ="button"type="button"value="Listar Todos os Meus Serviços"><img src="listar.png" alt="servico" style="width:48px;height:48px;"></a>
    </center>
    ';


// Timezone
date_default_timezone_set('Europe/Lisbon');
// mês anterior e próximo
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // este mês
    $ym = date('Y-m');
}
// verificar formato
$timestamp = strtotime($ym . '-01');
if ($timestamp == false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}
// Hoje

$today = date('Y-m-j', time());

// Título H3
$html_title = date('Y / m ', $timestamp);

// Criar mês anterior e próximo
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
$day_count = date('t', $timestamp);
 

$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

// Criação do Calendário!!
$weeks = array();
$week = '';


$week .= str_repeat('<td></td>', $str);


for ( $day = 1; $day <= $day_count; $day++, $str++) {

            include 'config.php';
            $user = "root";
            $password = "1234";
    $ligacao = new PDO("mysql:dbname=$base_dados;host=$host",$user,$password);
    //Dados os posts
    $sql =  'SELECT * FROM servico Where ID_Funcionario = '.$_SESSION['ID_Utilizador'].'';
    $motor=$ligacao->prepare($sql); 
    $motor->execute();
    if ($motor->rowcount()== 0)
                      {
                         echo '<div class="login_sucesso">
                        Não existem Serviços!!
                         </div>';
                         break;
                     }
              else
              {
    foreach($motor  as  $post)
    {

        $id_servico = $post['ID_Servico'];
        $data = $post['Data_Inicial'];
        $id_tipo_servico = $post['ID_Tipo_Servico'];
        $id_funcionario = $post['ID_Funcionario'];
        $id_utente = $post['ID_Utente'];
        $estado = $post['estado'];


    $date = $ym . '-' . $day;
    
    $datass = date('Y-m-d h:i:s', time());

    //Serviço ativo
    if($data == $date && $data > $datass && $estado == "Ativo")
    {
        $week .= '<td class="servico" style="width:180px;" >' . $day;
        $week .= '-<strong>Serviço Marcado</strong><br>
        <center><a href="detalhe_servico.php?pid='.$data.'" id="detalhes" ><img src="service.png" alt="servico" style="width:48px;height:48px;"></a>
        </td>';
        break;
    }
   elseif($date == $today && $date == $data && $estado == "Ativo")
   {
    $week .= '<td class="today" style="width:170px;">' . $day;
    $week .= '-<strong>Dia Atual<br>Serviço Marcado</strong>
    <center><a href="detalhe_servico.php?pid='.$data.'" id="detalhes" ><img src="service.png" alt="servico" style="width:48px;height:48px;"></a>
    </td>
    ';
    break;
   }
   elseif ($data == $date && $data < $datass && $data != $today && $estado == "Ativo")
   {
    $week .= '<td class="servicorealizado" style="width:180px;" >' . $day;
    $week .= '-<strong>Serviço já Realizado</strong><br>
    <center><a href="detalhe_servico.php?pid='.$data.'" id="detalhes" ><img src="service.png" alt="servico" style="width:48px;height:48px;"></a>
    </td>';
    break;
   }
   
    }
     //Data de hoje
    if($today == $date && $date != $data)
     {
         $week .= '<td class="today" style="width:170px;">' . $day;
        $week .= '-<strong>Dia Atual</strong></td>
        ';
     }      
         elseif ($data != $date )
         {
             $week .= '<td style="width:170px;"> ' . $day;
             $week .= '</td>';
         } 
         
     // Fim do mês ou fim do ano
     if ($str % 7 == 6 || $day == $day_count) {
         if ($day == $day_count) {
             
             $week .= str_repeat('<td></td>', 6 - ($str % 7));
         }
         $weeks[] = '<tr>' . $week . '</tr>';
         // Nova semana
         $week = '';
     }
}
}
}


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <style>
        .container {
            font-family: 'Noto Sans', sans-serif;
            margin-top: 80px;
        }
        h3 {
            margin-bottom: 30px;
            text-align:center;
            border: 3px solid black;
        }
        th {
            height: 30px;
            text-align: center;
        }
        td {
            height: 100px;
        }
        .today {
            background: orange;
        }   
        .servicorealizado{
            background-color: #47d147;
        }
        .servico{
            background-color: #1e94f4;
        }

        .weekdays {
	background: #8e352e;  
        }
    .weekdays th {
	text-align: center;
	text-transform: uppercase;
	line-height: 20px;
	border: none ;
	padding: 10px 6px;
	color: #fff;
	font-size: 13px;
}
table {
      background: #fff;
      border-collapse: collapse;
      color: #222;
      font-family: 'PT Sans', sans-serif;
      font-size: 13px;
      width: 100%;
    }

    </style>
</head>
<body>
    <div class="container">
        <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
        <table class="table table-bordered">
            <tr class="weekdays">
                <th bgcolor="#1e94f4" >Domingo</th>
                <th>Segunda</th>
                <th>Terça</th>
                <th>Quarta</th>
                <th>Quinta</th>
                <th>Sexta</th>
                <th >Sábado</th>
            </tr>
            <?php
                foreach ($weeks as $week) {
                    echo $week;
                }
            ?>
        </table>
    </div>
</body>
</html>
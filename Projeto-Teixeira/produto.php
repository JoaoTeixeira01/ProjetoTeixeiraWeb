<?php
    include 'includes/config.php';
    
    $idmarca = $_GET['idmarca'];
    $select = "select * from marca where idMarca=$idmarca";
    $connect = mysqli_query($conn, $select);

    while($search = mysqli_fetch_array($connect)){
        $marca = $search['nome'];
    }
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo "GoNext > $marca"; ?></title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
        <?php include 'includes/header.php'; ?>
        <div class="centerItems">
            <div class="containerItems">
				<div class="produto">
					<?php
						$idcomputador = $_GET['idcomputador'];
						$idmarca = $_GET['idmarca'];
						$select = "select * from computador where idcomputador=$idcomputador";
						$connect = mysqli_query($conn, $select);

						while($search = mysqli_fetch_array($connect)){
							$foto = $search['foto'];
							$nome = $search['nome'];
							$cpu = $search['cpu'];
							$cpuCooler = $search['cpuCooler'];
							$caixa = $search['caixa'];
							$motherboard = $search['motherboard'];
							$gpu = $search['gpu'];
							$ram = $search['ram'];
							$armazenamento = $search['armazenamento'];
							$fonte = $search['fonte'];

							if ($idmarca == 9){
								echo '
									<div class="imgProduto">
										<img src="img/computador/'.$foto.'" alt="'.$nome.'">
									</div>
									<div class="textProduto">
										<p id="produtoNome">'.$nome.'</p><br>
										<p>CPU: '.$cpu.'</p>
										<p>CPU COOLER: '.$cpuCooler.'</p>
										<p>CAIXA: '.$caixa.'</p>
										<p>MOTHERBOARD: '.$motherboard.'</p>
										<p>GPU: '.$gpu.'</p>
										<p>RAM: '.$ram.'</p>
										<p>ARMAZENAMENTO: '.$armazenamento.'</p>
										<p>FONTE DE ALIMENTAÇÃO: '.$fonte.'</p>
									</div>
								';
							} else {
								echo '
									<div class="imgProduto">
										<img src="img/computador/'.$foto.'" alt="'.$nome.'">
									</div>
									<div class="textProduto">
										<p id="produtoNome">'.$nome.'</p><br>
										<p>CPU: '.$cpu.'</p>
										<p>GPU: '.$gpu.'</p>
										<p>RAM: '.$ram.'</p>
										<p>ARMAZENAMENTO: '.$armazenamento.'</p>
									</div>
								';
							}
						}
					?>
				</div>
            </div>
        </div>
	</body>
</html>
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
				<div class='itemRow'>
                    <?php
						$select = "select * from computador where idMarca=$idmarca order by idMarca ASC LIMIT 4";
						$connect = mysqli_query($conn, $select);

						while($search = mysqli_fetch_array($connect)){
                            $id = $search['idComputador'];
                            $marca = $search['idMarca'];
							$nome = $search['nome']; 
							$foto = $search['foto'];
							echo '
									<a class="item" href="produto.php?idcomputador='.$id.'&idmarca='.$marca.'">
										<div class="itemImg">
											<img src="img/computador/'.$foto.'" alt="'.$nome.'">
										</div>
										<div class="itemNome">
											'.$nome.'
										</div>
									</a>
								
							';
						}
					?>
				</div>
            </div>
        </div>
	</body>
</html>
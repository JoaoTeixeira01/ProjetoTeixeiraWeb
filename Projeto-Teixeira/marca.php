<?php include 'includes/config.php'; ?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>GoNext > Portáteis</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
        <?php include 'includes/header.php'; ?>
        <div class="centerItems">
            <div class="containerItems">
				<div class='itemRow'>
					<?php
						$select = "select * from marca order by idMarca ASC LIMIT 4";
						$connect = mysqli_query($conn, $select);

						while($search = mysqli_fetch_array($connect)){
							$id = $search['idMarca'];
							$marca = $search['nome']; 
							$foto = $search['foto'];
							echo '
									<a class="item" href="produto_select.php?idmarca='.$id.'">
										<div class="itemImg">
											<img src="img/marca/'.$foto.'" alt="'.$marca.'">
										</div>
										<div class="itemNome">
											'.$marca.'
										</div>
									</a>
								
							';
						}
					?>
				</div>
				<div class='itemRow'>
					<?php
						$select = "select * from marca where idMarca>4 order by idMarca ASC LIMIT 4";
						$connect = mysqli_query($conn, $select);

						while($search = mysqli_fetch_array($connect)){
							$id = $search['idMarca'];
							$marca = $search['nome']; 
							$foto = $search['foto'];
							echo '
									<a class="item" href="produto_select.php?idmarca='.$id.'">
										<div class="itemImg">
											<img src="img/marca/'.$foto.'" alt="'.$marca.'">
										</div>
										<div class="itemNome">
											'.$marca.'
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
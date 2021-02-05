<?php include 'includes/config.php'; ?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>GoNext > Componentes</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
        <?php include 'includes/header.php'; ?>
        <div class="centerItems">
            <div class="containerItems">
				<div class='itemRow'>
					<?php
						$select = "select * from componente order by idComponente ASC LIMIT 4";
						$connect = mysqli_query($conn, $select);

						while($search = mysqli_fetch_array($connect)){
							$nome = $search['nome']; 
							$foto = $search['foto'];
							echo '
									<div class="itemComponente">
										<div class="itemImg">
											<img src="img/componentes/'.$foto.'" alt="'.$nome.'">
										</div>
										<div class="itemNome">
											'.$nome.'
										</div>
									</div>
							';
						}
					?>
				</div>
				<div class='itemRow'>
					<?php
						$select = "select * from componente where idComponente>4 order by idComponente ASC LIMIT 4";
						$connect = mysqli_query($conn, $select);

						while($search = mysqli_fetch_array($connect)){
							$nome = $search['nome']; 
							$foto = $search['foto'];
							echo '
									<div class="itemComponente">
										<div class="itemImg">
											<img src="img/componentes/'.$foto.'" alt="'.$nome.'">
										</div>
										<div class="itemNome">
											'.$nome.'
										</div>
									</div>
							';
						}
					?>
				</div>
            </div>
        </div>
	</body>
</html>
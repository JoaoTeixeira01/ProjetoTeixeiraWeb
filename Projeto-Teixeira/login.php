<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>GoNext > Login</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
        <?php include 'includes/header.php'; ?>
        <div class="centerItems">
            <div class="containerItems">
				<div class="centerLogin">
					<div class="itemLogin">
						<form class="form_login" method="post" action="includes/login.inc.php">
							<div class="containerLogin">
								<?php
									if(isset($_GET["error"])) {
										if($_GET["error"] == "wronglogin") {
											echo "<p class='error'>Login inválido!</p><br>";
										}
										elseif($_GET["error"] == "none") {
											echo "<p class='success'>Conta criada com sucesso!</p><br>";
										}
									}
								?>
								<b>Username/Email</b>
								<input type="text" placeholder="Enter username/email..." name="uid" required>
								<br>
								<b>Password</b>
								<input type="password" placeholder="Enter password..." name="pwd" required>
								
								<button type="submit" name="submit">Login</button>
								<br><p><a class="textRedirect" href="signup.php">Criar uma conta</a></p>
							</div>	
						</form>
					</div>
				</div>
			</div>
        </div>
	</body>
</html>
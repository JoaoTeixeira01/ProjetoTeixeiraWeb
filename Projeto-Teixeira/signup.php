<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>GoNext > Signup</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
        <?php include 'includes/header.php'; ?>
        <div class="centerItems">
            <div class="containerItems">
				<div class="centerLogin">
					<div class="itemLogin">
						<form class="form_login" method="post" action="includes/signup.inc.php">	
							<div class="containerLogin">
								<?php
									if(isset($_GET["error"])) {
										if($_GET["error"] == "invalidusername") {
											echo "<p class='error'>Username inválido!</p><br>";
										}
										elseif($_GET["error"] == "invalidemail") {
											echo "<p class='error'>Email inválido!</p><br>";
										}
										elseif($_GET["error"] == "passwordsdontmatch") {
											echo "<p class='error'>As passwords devem ser iguais!</p><br>";
										}
										elseif($_GET["error"] == "usernametaken") {
											echo "<p class='error'>O username já existe!</p><br>";
										}
										elseif($_GET["error"] == "stmtfailed") {
											echo "<p class='error'>Ocorreu um erro. Por favor tente mais tarde!</p><br>";
										}
										elseif($_GET["error"] == "none") {
											header("Location: login.php?error=none");
										}
									}
								?>
								<b>Username</b>
								<input type="text" placeholder="Enter username..." name="uid" required>
								<br>
								<b>Email</b>
								<input type="email" placeholder="Enter email..." name="email" required>
								<br>
								<b>Password</b>
								<input type="password" placeholder="Enter password..." name="pwd" required>
								<br>
								<b>Repeat password</b>
								<input type="password" placeholder="Repeat password..." name="pwdrepeat" required>
								
								<button type="submit" name="submit">Signup</button>
								<br><p><a class="textRedirect" href="login.php">Já tem conta?</a></p>
							</div>
						</form>
					</div>
				</div>
			</div>
        </div>
	</body>
</html>

<?php
 include 'paginainicial.php';
 include 'cabecalho.php';
//Login
	
	echo ' 
	<center>
	
		<form class="form_login" method="post" action="login_verificacao.php">
		
		<span style="opacity:0;">Isto</span><img src="login.png" width="350" alt="S.A.D"><br><br>
		<span style="opacity:0;">Isto</span><img src="barra.png" width="150" alt="S.A.D"><span style="opacity:0;">i</span><img src="barra.png" width="150" alt="S.A.D"><br><br><br>
		
		<img src="imagensform/username.png" width="200" alt="S.A.D"><br>
		<span style="opacity:0;">Isto</span><img src="barra.png" width="150" alt="S.A.D"><br>
		<input type="text" size="20" name="text_utilizador" placeholder="Introduzir o Nome de Utilizador"><br><br><br>
		

		<img src="imagensform/password.png" width="200" alt="S.A.D"><br>
		<span style="opacity:0;">This</span><span style="opacity:0;">T</span> <img src="barra.png" width="150" alt="S.A.D"><br>
		<input type="password" size="20" name="text_password" placeholder="Introduzir a Password"><br><br>

		<center><button class="button" type="submit" name="btn_submit"value="Registar">Entrar</button>
		
		</form>
<hr>
		
		<center><a href="registar.php"><img src="imagensform/criarconta.png" width="240" alt="S.A.D"></a>
		
	';
	
?>

<html>
<head><title>SAD Oficial</title></head>
	<body background="imagensadmin/fundo.png">

	<link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="icon" href="favicon.ico" type="image/icon" sizes="16x16">

<div id='cssmenu'>
<ul>
    <li><a href='index.php'><img src="logo_png.png" width="20"></a></li>
   <li><a href='login.php'>Login</a></li>
   <li><a href='registar.php'>Criar conta</a></li>
</ul>
</div>


<script>

window.onscroll = function() {scrollfunction()}

function scrollfunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("myBtn").style.display = "block";
   } else {
      document.getElementById("myBtn").style.display = "none";
      }
  }
  
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0; 

  }
</script>



	</body>
</html>
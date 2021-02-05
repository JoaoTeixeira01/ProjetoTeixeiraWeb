<header>
    <ul>
    <li><a href="index.php"><img src="img/logo.png" alt="GoNext"></a></li>
    <li><a href="tipo_computador.php">Computadores</a></li>
    <li><a href="componentes.php">Componentes</a></li>
    <?php
        session_start();
        include 'config.php';
        if(isset($_SESSION["idUtilizador"])) {
            $iduser = $_SESSION["idUtilizador"];
            $select = "select * from utilizador where idUtilizador='$iduser'";
            $connect = mysqli_query($conn, $select);

            while($search = mysqli_fetch_array($connect)){
                $nome = $search['username'];
                echo '
                    <li style="float:right">
                        <div class="logout">
                            <a href="logout.php">Logout</a>
                        </div>
                    </li>   
                    <li style="float:right">
                            <div class="active"">'.$nome.'</div>
                    </li>
                ';
            }

        } else if (!isset($_SESSION["idUtilizador"]))  {
            echo '<li style="float:right"><a class="active" href="login.php">Login</a></li>';
        } else {
            echo '<li style="float:right"><a class="active" href="login.php">Login</a></li>';
        }
    ?>
    
    </ul>
</header>
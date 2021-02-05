<?php
    if(isset($_POST["submit"])) {
        
        $username = $_POST["uid"];
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];
        $pwdRepeat = $_POST["pwdrepeat"];

        require 'config.php';
        require 'functions.inc.php';

        if(invalidusername($username) !== false) {
            header("Location: ../signup.php?error=invalidusername");
            exit();
        }

        if(invalidemail($email) !== false) {
            header("Location: ../signup.php?error=invalidemail");
            exit();
        }

        if(pwdMatch($pwd, $pwdRepeat) !== false) {
            header("Location: ../signup.php?error=passwordsdontmatch");
            exit();
        }

        if(usernameExists($conn, $username, $email) !== false) {
            header("Location: ../signup.php?error=usernametaken");
            exit();
        }

        createUser($conn, $username, $email, $pwd);

    } else {
        header("Location: ../signup.php");
    }
?>
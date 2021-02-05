<?php
    if(isset($_POST["submit"])) {
        
        $username = $_POST["uid"];
        $pwd = $_POST["pwd"];

        require 'config.php';
        require 'functions.inc.php';

        loginUser($conn, $username, $pwd);
    
    } else {
        header("Location: ../login.php");
        exit();
    }
?>
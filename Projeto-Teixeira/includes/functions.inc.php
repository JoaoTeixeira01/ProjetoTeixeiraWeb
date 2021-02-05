<?php
    function invalidusername($username) {
        $result;
        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function invalidemail($email) {
        $result;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function pwdMatch($pwd, $pwdRepeat) {
        $result;
        if($pwd !== $pwdRepeat) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function usernameExists($conn, $username, $email) {
        $sql = "select * from utilizador where idUtilizador = ? or email = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    function createUser($conn, $username, $email, $pwd) {
        $sql = "insert into utilizador (username, email, password) values (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=stmtfailed");
            exit();
        }

        $hashedPwd = md5($pwd);

        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: ../signup.php?error=none");
        exit();
    }

    function loginUser($conn, $username, $pwd) {
        $pwdEncriptada = md5($pwd);
        $select = "select * from utilizador where username='$username' or email='$username' and password='$pwdEncriptada'";
        $connect = mysqli_query($conn, $select);
        $rows = mysqli_num_rows($connect);
        if($rows == 1) {
            while($search = mysqli_fetch_array($connect)){
                $iduser = $search['idUtilizador'];
                $nomeuser = $search['username'];
                $emailuser = $search['email'];
            }
            session_start();
            $_SESSION["idUtilizador"] = $iduser;
            $_SESSION["username"] = $nomeuser;
            $_SESSION["email"] = $emailuser;
            header("Location: ../index.php");
            exit();
        } else {
            header("Location: ../login.php?error=wronglogin");
        }
    }
?>
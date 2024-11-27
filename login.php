<?php
session_start();
if (isset($_SESSION["user"])) {
    echo '<script>
        alert("You are already logged in!");
        window.location.href = "index.php";
    </script>';
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <?php include "header.php" ?>
    <div>
        <?php 
            if (isset($_POST["login"])){
                $email = $_POST["email"];
                $password = $_POST["password"];
                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user){
                    if (password_verify($password, $user["password"])){
                        session_start();
                        $_SESSION["user"] = "yes";
                        header("Location: index.php");
                        die();
                    } else {
                        echo "<div>Password does not match XD</div>";
                    }
                } else {
                    echo "<div>Email does not match XD</div>";
                }
            }
        ?>
        <form action="login.php" method="post">
            <input type="text" placeholder="Email:" name="email"> <br>
            <input type="password" placeholder="Password:" name="password"><br>
            <input type="submit" value="Login" name="login">
        </form>
    </div>
</body>
</html>
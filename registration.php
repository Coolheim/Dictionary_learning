<?php
session_start();
if (isset($_SESSION["user"])){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <?php include "header.php" ?>
    <?php
        if (isset($_POST["submit"])){
            $nickname = $_POST["nickname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if (empty($nickname) OR empty($email) OR empty($password) OR empty($passwordRepeat)){
                array_push($errors, "All fields are required");
            } if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors, "Email is not valid");
            } if (strlen($password) < 8){
                array_push($errors, "Password must be at least 8 characters long");
            } if ($password!==$passwordRepeat){
                array_push($errors, "Passsword does not match");
            }

            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount > 0){
                array_push($errors, "Email already exists!");
            }

            if (count($errors)>0){
                foreach ($errors as $error){
                    echo "<div>$error</div>";
                }
            } else {
                
                $sql = "INSERT INTO users (nickname, email, password) VALUES ( ?, ?, ? )";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt){
                    mysqli_stmt_bind_param($stmt, "sss", $nickname, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div>You are registered successfully.</div>";
                } else {
                    die("Something went wrong XD");
                }
            }
        }
    ?>
    <form action="" method="post">
        <input type="text" placeholder="Nickname:" name="nickname"><br>
        <input type="email" placeholder="Email:" name="email"><br>
        <input type="password" placeholder="Password:" name="password"><br>
        <input type="password" placeholder="Password again:" name="repeat_password"><br>
        <input type="submit" name="submit" value="register">
     </form>
</body>
</html>
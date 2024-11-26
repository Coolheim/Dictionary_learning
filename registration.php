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

            if (count($errors)>0){
                foreach ($errors as $error){
                    echo "<div>$error</div>";
                }
            } else {

            }
        }
    ?>
    <form action="">
        <input type="text" placeholder="username"><br>
        <input type="email" placeholder="email"><br>
        <input type="password" placeholder="password"><br>
        <input type="password-again" placeholder="password again"><br>
        <input type="submit">
     </form>
</body>
</html>
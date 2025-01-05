<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../../styles/login_register.css">
</head>
<body>
    <header class="header">
        <a href="../../index.php" class="logo">Dictionary Learning</a>
        <div class="header-buttons">
            <a href="login.php" class="btn">Sign In</a>
            <a href="registration.php" class="btn">Sign Up</a>
        </div>
    </header>

    <div class="form-container">
        <h2 class="form-title">Register</h2>

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
                } if ($password !== $passwordRepeat){
                    array_push($errors, "Passwords do not match");
                }

                require_once "../database.php";
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount > 0){
                    array_push($errors, "Email already exists!");
                }

                if (count($errors) > 0){
                    foreach ($errors as $error){
                        echo "<div class='error-msg'>$error</div>";
                    }
                } else {
                    $sql = "INSERT INTO users (nickname, email, password) VALUES (?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)){
                        mysqli_stmt_bind_param($stmt, "sss", $nickname, $email, $passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='success-msg'>You are registered successfully!</div>";
                        header("Location: login.php");
                    } else {
                        echo "<div class='error-msg'>Something went wrong, try again.</div>";
                    }
                }
            }
        ?>

        <form action="registration.php" method="post" class="form">
            <input type="text" placeholder="Nickname" name="nickname" class="input-field" required><br>
            <input type="email" placeholder="Email" name="email" class="input-field" required><br>
            <input type="password" placeholder="Password" name="password" class="input-field" required><br>
            <input type="password" placeholder="Confirm Password" name="repeat_password" class="input-field" required><br>
            <input type="submit" name="submit" value="Register" class="submit-btn">
        </form>
    </div>

</body>
</html>

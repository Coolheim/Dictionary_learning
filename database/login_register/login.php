<?php
session_start();

// Pokud je uživatel již přihlášen, přesměrujte ho na hlavní stránku
if (isset($_SESSION["user_id"])) {
    header("Location: ../../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <h2 class="form-title">Login</h2>

        <?php 
        if (isset($_POST["login"])) {
            // Získání vstupů z formuláře
            $email = $_POST["email"];
            $password = $_POST["password"];

            require_once "../database.php"; // Připojení k databázi

            // Dotaz pro získání uživatele podle emailu
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql); // Použijeme prepared statement pro bezpečnost
            $stmt->bind_param("s", $email); // Nahrazení parametru emailu
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user) {
                // Ověření hesla
                if (password_verify($password, $user["password"])) {
                    // Nastavení session
                    $_SESSION["user_id"] = $user["id"]; // ID uživatele
                    $_SESSION["nickname"] = $user["nickname"]; // Přezdívka uživatele (volitelně)

                    // Přesměrování na hlavní stránku
                    header("Location: ../../index.php");
                    exit();
                } else {
                    echo "<div class='error-msg'>Password does not match.</div>";
                }
            } else {
                echo "<div class='error-msg'>Email does not exist.</div>";
            }

            $stmt->close();
        }
        ?>

        <form action="login.php" method="post" class="form">
            <input type="email" placeholder="Email" name="email" class="input-field" required><br>
            <input type="password" placeholder="Password" name="password" class="input-field" required><br>
            <input type="submit" value="Login" name="login" class="submit-btn">
        </form>
    </div>
</body>
</html>

<?php
// Start the session at the beginning of the page
session_start();


if (isset($_POST["login"])) { // Zkontrolujeme, zda byl formulář odeslán
    // Získání vstupů z formuláře
    $admin_name = $_POST["admin_name"];
    $password = $_POST["password"];

    require_once "../database.php"; // Připojení k databázi

    // Dotaz pro získání admina podle admin_name
    $sql = "SELECT * FROM admins WHERE admin_name = ?";
    $stmt = $conn->prepare($sql); // Použijeme prepared statement pro bezpečnost
    $stmt->bind_param("s", $admin_name); // Nahrazení parametru admin_name
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc(); // Uložení výsledku do proměnné $admin


    if ($admin) { // Kontrola, zda admin existuje
        // Ověření hesla
        if (password_verify($password, $admin["password"])) { // Ověření hashovaného hesla
            // Nastavení session proměnných
            $_SESSION["admin_id"] = $admin["id"];
            $_SESSION["admin_name"] = $admin["admin_name"]; // Ukládáme jméno admina
        
            // Přesměrování na dashboard
            header("Location: ../../subpages\pages_for_admin\admin_page.php");
            exit();
        } else {
            echo "<div class='error-msg'>Password does not match.</div>";
        }
    } else {
        echo "<div class='error-msg'>Admin name does not exist.</div>";
    }

    $stmt->close(); // Zavřeme prepared statement
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login for Admin</title>
    <link rel="stylesheet" href="../../styles/login_register.css">
</head>
<body>
    <header class="header">
        <a href="../../index.php" class="logo">Learning</a>
        <div class="header-buttons">
            <a href="login.php" class="btn">Sign In</a>
            <a href="registration.php" class="btn">Sign Up</a>
            <a href="login_for_admin.php" class="btn">Sign In (admin)</a>
        </div>
    </header>

    <div class="form-container">
        <h2 class="form-title">Login (Admin)</h2>

        <form action="login_for_admin.php" method="post" class="form">
            <input type="text" placeholder="Admin name" name="admin_name" class="input-field" required><br>
            <input type="password" placeholder="Password" name="password" class="input-field" required><br>
            <input type="submit" value="Login" name="login" class="submit-btn">
        </form>
    </div>
</body>
</html>

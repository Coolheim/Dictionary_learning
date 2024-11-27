<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: database/login_register/login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>
    <header class="header">
        <a href="index.php" class="logo">Dictionary Learning</a>
        <div class="centered-buttons">
            <a href="" class="classy-btn">About me</a>
            <a href="" class="classy-btn">Privacy Policy</a>
        </div>

        <div class="header-buttons">
            <a href="database/login_register/login.php" class="btn">Sign In</a>
            <a href="database/login_register/registration.php" class="btn">Sign Up</a>
        </div>
    </header>

    <div class="dashboard-container">
        <h1 class="dashboard-title">Welcome to your Dashboard</h1>
        <a href="database/login_register/logout.php" class="logout-btn">Logout</a>
    </div>

    <div class="links-container">
        <div class="links">
            <a href="" class="link-btn">Dictionary Settings</a>
            <a href="" class="link-btn">Learning</a>
            <a href="" class="link-btn">Check your understanding</a>
        </div>
        <img src="img/dictionaries.png" alt="Dictionaries" class="dashboard-image">
    </div>
</body>
</html>

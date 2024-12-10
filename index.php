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

        <div class="header-buttons">
            <a href="subpages/about_me.php">About me</a>
            <a href="subpages/privacy_policy.php">Privacy Policy</a>
            <a href="subpages/profile.php">Profile</a>
            <a href="database/login_register/login.php">Sign In</a>
            <a href="database/login_register/registration.php">Sign Up</a>
            <a href="database/login_register/logout.php">Logout</a>
        </div>
    </header>

    <div class="dashboard-container">
        <h1 class="dashboard-title">Welcome to your Dashboard</h1>
    </div>

    <div class="links-container">
        <div class="links">
            <a href="subpages/dictionary_pages/dictionary_setting.php" class="link-btn">Dictionary Settings</a>
            <a href="subpages/dictionary_pages/dictionary_learning.php" class="link-btn">Learning</a>
            <a href="subpages/dictionary_pages/dictionary_test.php" class="link-btn">Check your understanding</a>
        </div>
        <img src="img/dictionaries.png" alt="Dictionaries" class="dashboard-image">
    </div>
</body>
</html>

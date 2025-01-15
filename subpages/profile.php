<?php
// Start the session
session_start();

// Include database connection
require_once "../database/database.php"; // Upravte cestu podle umístění vašeho souboru

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    // If not logged in, redirect to login page
    header("Location: ../login_register/login.php");
    exit();
}

// Fetch user data based on session user_id
$user_id = $_SESSION["user_id"];
$sql = "SELECT nickname, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../styles/profile.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
</head>
<body>
    <header class="header">
        <a href="first_page_after_login.php" class="logo">Dictionary Learning</a>
        <div class="header-buttons">
            <a href="about_me.php">About me</a>
            <a href="privacy_policy.php">Privacy Policy</a>
            <a href="profile.php">Profile</a>
            <a href="../database/login_register/logout.php">Logout</a>
        </div>
    </header>

    <div class="dashboard-container">
        <h1 class="dashboard-title">User profile</h1>
    </div>

    <div class="dashboard-container">
        <p><strong>Nickname:</strong> <?php echo htmlspecialchars($user["nickname"]); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user["email"]); ?></p>
    </div>

    
</body>
</html>

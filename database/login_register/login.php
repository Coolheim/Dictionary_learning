<?php
// Start session at the beginning of the page
session_start();

if (isset($_POST["login"])) {
    // Get inputs from the form
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Ensure the inputs are not empty
    if (empty($email) || empty($password)) {
        echo "<div class='error-msg'>Both fields are required.</div>";
    } else {
        try {
            // Include the database connection
            require_once "../database.php";

            // Prepare the SQL statement to prevent SQL injection
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . $conn->error);
            }

            // Bind email parameter and execute the query
            $stmt->bind_param("s", $email);
            $stmt->execute();

            // Get the result of the query
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user) {
                // Verify the password
                if (password_verify($password, $user["password"])) {
                    // Set session variables
                    $_SESSION["user_id"] = $user["id"];
                    $_SESSION["user"] = $user["id"];
                    $_SESSION["nickname"] = htmlspecialchars($user["nickname"], ENT_QUOTES, 'UTF-8');

                    // Redirect to the dashboard
                    header("Location: ../../subpages/first_page_after_login.php");
                    exit();
                } else {
                    echo "<div class='error-msg'>Invalid password.</div>";
                }
            } else {
                echo "<div class='error-msg'>No account found with that email.</div>";
            }

            // Close the statement
            $stmt->close();
        } catch (Exception $e) {
            // Handle database connection or query errors
            echo "<div class='error-msg'>An error occurred: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</div>";
        }
    }
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
            <a href="login_for_admin.php" class="btn">Sign In (Admin)</a>
        </div>
    </header>

    <div class="form-container">
        <h2 class="form-title">Login</h2>

        <form action="login.php" method="post" class="form">
            <input type="email" placeholder="Email" name="email" class="input-field" required><br>
            <input type="password" placeholder="Password" name="password" class="input-field" required><br>
            <input type="submit" value="Login" name="login" class="submit-btn">
        </form>
    </div>
</body>
</html>

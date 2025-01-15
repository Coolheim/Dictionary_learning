<?php
// Start the session
session_start();

// Include database connection
require_once "../../database/database.php"; // Upravte cestu podle své složky

// Handle delete request
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];

    // SQL query to delete the user
    $delete_sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('User deleted successfully!');</script>";
    } else {
        echo "<script>alert('Failed to delete user.');</script>";
    }

    $stmt->close();
}

// Fetch all users
$sql = "SELECT id, nickname, email FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins page</title>
    <link rel="stylesheet" href="../../styles/admin_page.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
</head>
<body>
    <header class="header">
        <a href="admin_page.php" class="logo">Dictionary Learning</a>
        <div class="header-buttons">
            <a href="../../database/login_register/logout.php">Logout</a>
        </div>
    </header>

    <div class="dashboard-container">
        <h1 class="dashboard-title">Admin page</h1>

        <div class="users-container">
            <h2 class="section-title">User List</h2>
            <table class="users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nickname</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nickname']}</td>
                                <td>{$row['email']}</td>
                                <td>
                                    <form method='post' action=''>
                                        <input type='hidden' name='user_id' value='{$row['id']}'>
                                        <button type='submit' name='delete_user' class='delete-btn'>Delete</button>
                                    </form>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No users found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

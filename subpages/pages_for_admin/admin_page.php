<?php
// Start the session
session_start();

// Include database connection
require_once "../../database/database.php"; // Upravte cestu podle své složky

// Handle delete request
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $delete_sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}

// Handle add admin request
if (isset($_POST['add_admin'])) {
    $admin_name = $_POST['admin_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $insert_sql = "INSERT INTO admins (admin_name, password) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("ss", $admin_name, $hashed_password);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "<script>alert('Passwords do not match!');</script>";
    }
    echo "<script>alert('New admin was successfully added!');</script>";
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

        <div class="add-admin-container">
            <h2 class="section-title">Add New Admin</h2>
            <form method="post" action="">
                <label for="admin_name">Admin Name:</label>
                <input type="text" name="admin_name" required>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" required>
                <button type="submit" name="add_admin">Add Admin</button>
            </form>
        </div>
    </div>
</body>
</html>
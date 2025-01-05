<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning</title>
    <link rel="stylesheet" href="../../styles/dictionary_pages.css">
</head>
<body>
    <header class="header">
        <a href="../../index.php" class="logo">Dictionary Learning</a>
        <div class="header-buttons">
            <a href="../about_me.php">About me</a>
            <a href="../privacy_policy.php">Privacy Policy</a>
            <a href="../profile.php">Profile</a>
            <a href="../../database/login_register/logout.php">Logout</a>
        </div>
    </header>

    <div class="dashboard-container">
        <h1 class="dashboard-title">Learning</h1>
    </div>

    <h2>Use some of your dictionaries to learn.</h2>

    <div class="dictionaries-container">
        <?php
        // Zahrnutí souboru pro připojení k databázi
        require '../../database/database.php';

        // Start session (pokud ještě není spuštěná)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Získání ID aktuálního uživatele ze session
        $user_id = $_SESSION['user_id']; // Ujisti se, že tento klíč je nastavený při přihlášení uživatele

        // Načtení slovníků pro daného uživatele
        $sql = "SELECT dictionary_name FROM dictionaries WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Kontrola, zda byly nalezeny slovníky
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Vykreslení názvu slovníku a tlačítka
                echo "<div class='dictionary-item'>";
                echo "<p>" . htmlspecialchars($row['dictionary_name']) . "</p>";
                echo "<button>Use this dic</button>";
                echo "</div>";
            }
        } else {
            echo "<p>No dictionaries found.</p>";
        }

        // Zavření připojení
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>

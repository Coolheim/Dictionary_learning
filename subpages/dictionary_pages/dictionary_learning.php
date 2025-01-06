<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dictionary Learning</title>
    <link rel="stylesheet" href="../../styles/dictionary_pages.css">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <style>
        /* Styl pro skrytí divu */
        .hidden {
            display: none;
        }
    </style>
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

    <!-- První div (viditelný na začátku) -->
    <div class="main-content-container" id="target">
        <h2>Use some of your dictionaries to learn.</h2>

        <div class="dictionaries-container">
            <?php
            // Připojení k databázi
            require '../../database/database.php';

            // Zahájení session, pokud ještě neběží
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Získání ID aktuálního uživatele ze session
            $user_id = $_SESSION['user_id'];

            // Načtení slovníků pro uživatele
            $sql = "SELECT dictionary_name FROM dictionaries WHERE user_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Zobrazení slovníků
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='dictionary-item'>";
                    echo "<p>" . htmlspecialchars($row['dictionary_name']) . "</p>";
                    echo "<button onClick=\"toggleDivs('target', 'replace_target')\">Use this dictionary</button>";
                    echo "</div>";
                }
            } else {
                echo "<p>No dictionaries found.</p>";
            }

            // Uzavření připojení
            mysqli_close($conn);
            ?>
        </div>
    </div>

    <!-- Druhý div (skrytý na začátku) -->
    <div class="main-content-container hidden" id="replace_target">
        <div>
            <button>Previous</button>
            <button>WORD</button>
            <button>Next</button>
        </div>    
        <button onClick="toggleDivs('replace_target', 'target')">Exit</button>
    </div>

    <!-- JavaScript -->
    <script>
        // Funkce pro přepínání viditelnosti divů
        function toggleDivs(hideId, showId) {
            // Skrytí prvního divu
            document.getElementById(hideId).classList.add("hidden");
            // Zobrazení druhého divu
            document.getElementById(showId).classList.remove("hidden");
        }
    </script>
</body>
</html>

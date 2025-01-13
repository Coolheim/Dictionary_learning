<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dictionary Learning</title>
    <link rel="stylesheet" href="../../styles/dictionary_learning.css">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="../first_page_after_login.php" class="logo">Dictionary Learning</a>
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

    <div class="main-content-container" id="target">
        <h2>Use some of your dictionaries to learn.</h2>

        <div class="dictionaries-container">
            <?php
            // Připojení k databázi
            require '../../database/database.php';

            // Zahájení session
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Získání ID uživatele
            $user_id = $_SESSION['user_id'];

            // Načtení slovníků uživatele
            $sql = "SELECT dictionary_name FROM dictionaries WHERE user_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Zobrazení seznamu slovníků
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='dictionary-item'>";
                    echo "<p>" . htmlspecialchars($row['dictionary_name']) . "</p>";
                    echo "<button class='btn btn-secondary' data-dictionary-name='" . htmlspecialchars($row['dictionary_name']) . "' onClick=\"loadDictionary(this)\">Use this dictionary</button>";
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

    <div class="main-content-container hidden" id="replace_target">
        <button id="word-button" onClick="toggleWord()">Word</button>
        <div class="button-group">
            <button class="prev-next-btn" onClick="prevWord()">Previous</button>
            <button class="prev-next-btn" onClick="nextWord()">Next</button>
        </div>
        <button class="exit-btn" onClick="toggleDivs('replace_target', 'target')">Exit</button>
    </div>

    <script>
    let dictionaryData = []; // Pole pro uložení slovníku
    let currentIndex = 0; // Aktuální index slova

    // Přepínání mezi divy
    function toggleDivs(hideId, showId) {
        document.getElementById(hideId).classList.add("hidden");
        document.getElementById(showId).classList.remove("hidden");
    }

    // Načítání dat slovníku
    function loadDictionary(button) {
        const dictionaryName = button.getAttribute('data-dictionary-name');

        fetch(`../../database/dictionaries/get_dictionary.php?dictionary_name=${encodeURIComponent(dictionaryName)}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    dictionaryData = Object.entries(data); // Převod objektu na pole dvojic [key, value]
                    currentIndex = 0; // Nastavení na první slovo
                    updateWordButton();
                    toggleDivs('target', 'replace_target');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Aktualizace tlačítka WORD podle aktuálního slova
    function updateWordButton() {
        const wordButton = document.getElementById('word-button');
        const [key, value] = dictionaryData[currentIndex]; // Získání aktuálního páru
        wordButton.textContent = key; // Nastavení textu tlačítka na klíč
        wordButton.dataset.key = key; // Uložení klíče do atributu
        wordButton.dataset.value = value; // Uložení hodnoty do atributu
    }

    // Přepnutí mezi klíčem a hodnotou
    function toggleWord() {
        const wordButton = document.getElementById('word-button');
        const isKey = wordButton.textContent === wordButton.dataset.key;
        wordButton.textContent = isKey ? wordButton.dataset.value : wordButton.dataset.key;
    }

    // Přechod na předchozí slovo (cyklické)
    function prevWord() {
        currentIndex = (currentIndex === 0) ? dictionaryData.length - 1 : currentIndex - 1;
        updateWordButton();
    }

    // Přechod na další slovo (cyklické)
    function nextWord() {
        currentIndex = (currentIndex === dictionaryData.length - 1) ? 0 : currentIndex + 1;
        updateWordButton();
    }
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dictionary settings</title>
    <link rel="stylesheet" href="../../styles\dictionary_pages.css">
</head>
<body>
    <header class="header">
        <a href="../../index.php" class="logo">Dictionary Learning</a>
        <div class="header-buttons">
            <a href="../about_me.php">About me</a>
            <a href="../privacy_policy.php">Privacy Policy</a>
            <a href="../profile.php">Profile</a>
            <a href="../../database/login_register/login.php">Sign In</a>
            <a href="../../database/login_register/registration.php">Sign Up</a>
            <a href="../../database/login_register/logout.php">Logout</a>
        </div>
    </header>

    <div class="dashboard-container">
        <h1 class="dashboard-title">Dictionary settings</h1>
    </div>

    <div class="settings-container">
        <div>
            <form action="">
                <input type="text" placeholder="English" id="En_textBox">
                <input type="text" placeholder="Czech" id="Cz_textBox">
                <button type="button" onclick="funAddWordToSelectElement()">Add word</button>
            </form>
            <button onclick="funSaveDic()">Save dictionary</button>
        </div>
        <div>
            <select name="Words" id="selectElement" multiple="multiple"></select>  
        </div>
    </div>

    <script>
        const dictionary = {};

        const funAddWordToSelectElement = () => {
            const en_word_input = document.getElementById("En_textBox");
            const cz_word_input = document.getElementById("Cz_textBox");
            const en_word = en_word_input.value.trim();
            const cz_word = cz_word_input.value.trim();

            console.log(en_word); // Display the English word
            console.log(cz_word); // Display the Czech word

            if (en_word === "") {
                alert("En input is empty.");
                return;
            }
            if (cz_word === "") {
                alert("Cz input is empty.");
                return;
            }
            if (!dictionary[en_word]) {
                dictionary[en_word] = cz_word;

                const select = document.getElementById("selectElement");
                const opt = document.createElement("option");
                opt.value = en_word;
                opt.innerHTML = `${en_word} : ${cz_word}`;
                select.appendChild(opt);

                en_word_input.value = "";
                cz_word_input.value = "";
            } else {
                alert("This English word is already added");
            }        

            console.log(dictionary);
        }

        const funSaveDic = () => {
            if (Object.keys(dictionary).length === 0){
                alert("No words to save.");
                return;
            }

            const jsonData = JSON.stringify(dictionary);

            fetch('save_dictionary.php', {
                method: 'POST',
                header: { 'Content-Type': 'application/json' },
                body: jsonData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success){
                    alert("Dictionary saved successfully.");
                } else {
                    alert("Failed to save dictionary.");
                }
            })
            .catch(error => {
                console.error('Error saving dictionary: ', error);
            })

            console.log("Saved dic: ", jsonData);
        }

    </script>

</body>
</html>

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
                <button type="button" onclick="fun1()">Add word</button>
            </form>
            <button>Save dictionary</button>
        </div>
        <div>
            <select name="Words" id="selectElement" multiple="multiple">  

            </select>  
        </div>
    </div>

    <script>
        console.log("Dobre propojeno");

        const fun1 = () => {
            const en_word_input = document.getElementById("En_textBox");
            const cz_word_input = document.getElementById("Cz_textBox");
            const en_word = en_word_input.value;
            const cz_word = cz_word_input.value;

            console.log(en_word); // Display the English word
            console.log(cz_word); // Display the Czech word

            let select = document.getElementById("selectElement");
            let opt = document.createElement("option");
            let enAcz = en_word + " : " + cz_word;
            opt.value = enAcz;
            console.log(enAcz);
            opt.innerHTML = enAcz;
            select.appendChild(opt);

            en_word_input.value = "";
            cz_word_input.value = "";
        }
    </script>

</body>
</html>

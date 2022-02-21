<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styl4.css">
    <title>Forum o psach</title>
</head>
<body>
    <div id="banner">
        <h1>Forum wielbicieli psów</h1>
    </div>
    <div id="left-block">
        <img src="obraz.jpg" alt="foksterier">
    </div>
    <div id="center-block">
        <h2>Zapisz się</h2>
        <form method="POST" action="?">
            login: <input type="text" name="login"><br>
            hasło: <input type="password" name="password"><br>
            powtórz hasło: <input type="password" name="repeatPassword"><br>
            <input type="submit" value="Zapisz">
        </form>
        <?php
        ini_set("display_errors", 1);
            $db = new mysqli("localhost", "root", "", "psy");
          
            $settedFields = 0;
            if(!empty($_POST["login"])){
                $settedFields += 1;
            }
            if (!empty($_POST["password"])) {
                $settedFields += 1;
            }
            if (!empty($_POST["repeatPassword"])) {
                $settedFields += 1;
            }

            if ($settedFields < 3 && $settedFields != 0) {
                echo "<p>wypełnij wszystkie pola</p>";
            }else if ($settedFields == 3) {
                $usernames = $db->query("SELECT login FROM uzytkownicy;");
                while($username = $usernames->fetch_assoc()) {
                    $err = false;
                    if($_POST["login"] == $username["login"]){
                        $err = true;
                        echo "<p>login występuje w bazie danych, konto nie zostało dodane.</p>";
                        break;
                    }
                }
                if (!$err) {
                    $err = $_POST["password"] != $_POST["repeatPassword"];
                    if ($err) {
                        echo "<p>hasła nie są takie same, konto nie zostało dodane</p>";
                    }else {
                        $encryptedPassword = sha1($_POST["password"]);
                        $stmt = $db->prepare("INSERT INTO uzytkownicy (login, haslo) VALUES (?, ?);");
                        $stmt->bind_param("ss", $_POST["login"], $encryptedPassword);
                        $stmt->execute();
                        echo "<p>Konto zostało dodane</p>";
                    }
                }
            }

            $db->close();
        ?>
    </div>
    <div id="right-block">
        <h2>Zapraszamy wszystkich</h2>
        <ol>
            <li>właścicieli psów</li>
            <li>weterynarzy</li>
            <li>tych, co chcą kupić psa</li>
            <li>tych, co lubią psy</li>
        </ol>
        <a href="regulamin.html">
            Przeczytaj regulamin forum
        </a>
    </div>
    <div class="float-fix"></div>
    <div id="footer">
        Strone wykonał: PESEL
    </div>
</body>
</html>
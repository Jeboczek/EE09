<?php
    ini_set("display_errors", 1);
    $db = new mysqli("localhost", "root", "", "egzamin");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>piłka nożna</title>
    <link rel="stylesheet" href="styl2.css">
</head>
<body>
    <div id="banner">
        <h3>Reprezentacja polski w piłce nożnej</h3>
        <img src="obraz1.jpg" alt="reprezentacja">
    </div>
    <div id="left-block">
        <form action="?" method="post">
            <select name="soccer_category">
                <option value="1">Bramkarze</option>
                <option value="2">Obrońcy</option>
                <option value="3">Pomocnicy</option>
                <option value="4">Napastnicy</option>
            </select>
            <input type="submit" value="Zobacz">
        </form>
        <img src="zad2.png" alt="piłka" >
        <p>Autor: 000000000</p>
    </div>
    <div id="right-block">
        <ol>
            <?php
                if (isset($_POST["soccer_category"])) {
                    $soccer_category = $_POST["soccer_category"];
                    $stmt = $db->prepare("SELECT imie, nazwisko FROM zawodnik INNER JOIN pozycja ON pozycja.id = zawodnik.pozycja_id WHERE pozycja.id = ?;");
                    $stmt->bind_param("i", $soccer_category);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($data = $result->fetch_assoc()) {
                        echo "<li>" . $data["imie"] . " " . $data["nazwisko"] .  "</li>";
                    }
                    $result->close();
                    $stmt->close();
                }
            ?>
        </ol>
    </div>
    <div id="main-block">
        <h3>Liga mistrzów</h3>
    </div>
    <div id="liga">
        <?php
            $result = $db->query("SELECT zespol, punkty, grupa FROM liga ORDER BY punkty DESC;");
            while ($a = $result->fetch_assoc()) {
                echo "<div class=\"team-info\">";
                echo "<h2>" . $a["zespol"] . "</h2>";
                echo "<h1>" . $a["punkty"] . "</h1>";
                echo "<p>grupa: " . $a["zespol"] . "</p>";
                echo "</div>";
            }
            $result->close();
        ?>
    </div>
    <?php
        $db->close();    
    ?>
</body>
</html>
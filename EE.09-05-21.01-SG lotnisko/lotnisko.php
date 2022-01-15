<?php
$db = new mysqli("localhost", "root", "", "egzamin");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styl5.css">
    <title>Port Lotniczy</title>
</head>
<body>
    <div id="banner">
        <div id="banner-1">
            <img src="zad5.png" alt="logo lotnisko">
        </div>
        <div id="banner-2">
            <h1>Przyloty</h1>
        </div>
        <div id="banner-3">
            <h3>Przydatne linki</h3>
            <a href="kwerendy.txt">Pobierz...</a>
        </div>
        <div class="float-fix"></div>
    </div>
    <div id="main-block">
        <table>
            <tr>
                <th>czas</th>
                <th>kierunek</th>
                <th>numer rejsu</th>
                <th>status</th>
            </tr>
            <?php

                function wrapForTable(string $data) : string{
                    $toReturn = "<td>";
                    $toReturn .= $data;
                    $toReturn .= "</td>";
                    return $toReturn;
                }

                $results = $db->query("SELECT czas, kierunek, nr_rejsu, status_lotu FROM przyloty ORDER BY czas ASC;");
                while ($result = $results->fetch_assoc()) {
                    echo "<tr>";
                    echo wrapForTable($result["czas"]);
                    echo wrapForTable($result["kierunek"]);
                    echo wrapForTable($result["nr_rejsu"]);
                    echo wrapForTable($result["status_lotu"]);
                    echo "</tr>";
                }
                $results->close();
            ?>
        </table>
    </div>
    <div id="footer-block-1">
    <?php
    if (!isset($_COOKIE["visited"])) {
        setcookie("visited", true, time() + 60*60*2);
        echo "<p> Dzień dobry! Strona lotniska używa ciasteczek </p>";
    }else{
        echo "<p> Witaj ponownie na stronie lotniska </p>";
    }
    ?>
    </div>
    <div id="footer-block-2">
        Autor: 000000000
    </div>
    <div class="float-fix"></div>
</body>
</html>
<?php
$db->close();
?>
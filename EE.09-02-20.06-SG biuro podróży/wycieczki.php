<?php
    $db = new mysqli("localhost", "root", "", "egzamin3");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styl3.css">
    <title>Wycieczki i urlopy</title>
</head>
<body>
    <div id="banner">
        <h1>BIURO PODRÓŻY</h1>
    </div>
    <div id="left-block">
        <h2>KONTAKT</h2>
        <a href="mailto://biuro@wycieczki.pl">napisz do nas</a>
        <p>telefon: 555666777</p>
    </div>
    <div id="center-block">
        <h2>GALERIA</h2>
        <?php
            $results = $db->query("SELECT nazwaPliku, podpis FROM zdjecia ORDER BY podpis ASC;");
            while ($result = $results->fetch_assoc()) {
                echo "<img src=\"" . $result["nazwaPliku"] . "\" alt=\"" . $result["podpis"] . "\">";
            }
            $results->close();
        ?>
    </div>
    <div id="right-block">
        <h2>PROMOCJE</h2>
        <table>
            <tr>
                <td>Jesień</td>
                <td>Grupa 4+</td>
                <td>Grupa 10+</td>
            </tr>
            <tr>
                <td>5%</td>
                <td>10%</td>
                <td>15%</td>
            </tr>
        </table>
    </div>
    <div class="float-fix"></div>
    <div id="data-block">
        <h2>LISTA WYCIECZEK</h2>
        <?php
            $results = $db->query("SELECT id, dataWyjazdu, cel, cena FROM wycieczki WHERE dostepna = 1;");
            while ($result = $results->fetch_assoc()) {
                echo $result["id"] . ". " . join(", ", [$result["dataWyjazdu"], $result["cel"], "cena: " . $result["cena"]]) . "<br>"; 
            }
            $results->close();
        ?>
    </div>
    <div id="footer">
        <p>Stronę wykonał: PESEL</p>
    </div>
</body>
</html>
<?php
    $db->close();
?>
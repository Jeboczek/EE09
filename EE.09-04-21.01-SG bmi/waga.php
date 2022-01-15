<?php
    $db = new mysqli("localhost", "root", "", "egzamin"); 
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styl4.css">
    <title>Twój wskaźnik BMI</title>
</head>
<body>
    <div id="banner">
        <h2>Oblicz wskaźnik BMI</h2>
    </div>
    <div id="logo">
        <img src="wzor.png" alt="liczymy BMI">
    </div>
    <div class="float-fix"></div>
    <div id="left-block">
        <img src="rys1.png" alt="zrzuć kalorie!">
    </div>
    <div id="right-block">
        <h1>Podaj dane</h1>
        <form action="?" method="post">
            Waga: <input type="number" name="weight"><br>
            Wzrost [cm]: <input type="number" name="height"><br>
            <input type="submit" value="Licz BMI i zapisz wynik">
        </form>
        <?php 
            function getBMIid(float $bmi) : int{
                global $db;
                $results = $db->query(" SELECT id, wart_min, wart_max FROM bmi;");
                while ($result = $results->fetch_assoc()) {
                    if ($bmi >= $result["wart_min"] && $bmi <= $result["wart_max"]) {
                        return $result["id"];
                    }
                }
            }
            function sendBMIToDatabase(float $bmi) {
                global $db;
                $stmt = $db->prepare("INSERT INTO wynik (bmi_id, data_pomiaru, wynik) VALUES (?, NOW(), ?);");
                $bmiId = getBMIid($bmi);
                $stmt->bind_param("ii", $bmiId, $bmi);
                $stmt->execute();
            }

            if (isset($_POST["weight"]) && isset($_POST["height"])) {
                $weight = intval($_POST["weight"]);
                $height = intval($_POST["height"]);

                $bmi = ($weight / pow($height, 2)) * 10000;

                echo "<p>Troja waga: $weight; Twój wzrost: $height <br> BMI wynosi: $bmi</p>";
                sendBMIToDatabase($bmi);
            }
        ?>
    </div>
    <div class="float-fix"></div>
    <div id="main-block">
        <table>
            <tr>
                <th>
                    lp.
                </th>
                <th>
                    Interpretacja
                </th>
                <th>
                    zaczyna się od...
                </th>
            </tr>
            <?php 
                $results = $db->query("SELECT id, informacja, wart_min FROM bmi;");
                while ($result = $results->fetch_assoc()) {
                    echo "<tr><td>" . $result['id'] . "</td> <td>" . $result['informacja'] . "</td> <td>" . $result['wart_min'] . "</td></tr>";
                }
            ?>
        </table>
    </div>
    <div id="footer">
        Autor: PESEL
        <a href="kw2.jpg">Wynik działania kwerendy 2</a>
    </div>
</body>
</html>
<?php 
    $db->close();
?>
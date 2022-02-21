<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Prognoza pogody Wrocław</title>
    <link rel="stylesheet" href="styl2.css">
</head>
<body>
    <div id="banner-left">
        <img src="logo.png" alt="meteo">
    </div>
    <div id="banner-center">
        <h1>
            Prognoza dla Wrocławia
        </h1>
    </div>
    <div id="banner-right">
        <p>maj, 2019r</p>
    </div>
    <div class="float-fix"></div>
    <div id="main-block">
        <table>
            <tr>
                <th>
                    DATA
                </th>
                <th>
                    TEMPERATURA W NOCY
                </th>
                <th>
                    TEMPERATURA W DZIEŃ
                </th>
                <th>
                    OPADY [mm/h]
                </th>
                <th>
                    CIŚNIENIE [hPa]
                </th>
            </tr>
            <?php 
                $db = new mysqli("localhost", "root", "", "pogoda");

                $results = $db->query('SELECT * FROM pogoda WHERE miasta_id = 1 ORDER BY data_prognozy ASC;');
                while ($result = $results->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $result["data_prognozy"] . "</td>";
                    echo "<td>" . $result["temperatura_noc"] . "</td>";
                    echo "<td>" . $result["temperatura_dzien"] . "</td>";
                    echo "<td>" . $result["opady"] . "</td>";
                    echo "<td>" . $result["cisnienie"] . "</td>";
                    echo "</tr>";
                
                }
                $results->close();
                $db->close();
            ?>
        </table>
    </div>
    <div id="left-block">
        <img src="obraz.jpg" alt="Polska, Wrocław">
    </div>
    <div id="right-block">
        <a href="kwerendy.txt">Pobierz kwerendy</a>
    </div>
    <div class="float-fix"></div>
    <div id="footer">
        <p>
            Strone wykonał: PESEL
        </p>
    </div>
</body>
</html>
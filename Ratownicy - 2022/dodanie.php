<?php

$db = new mysqli("localhost", "root", "", "ee09");

if (isset($_POST["ambulanceId"]) && isset($_POST["firstParamedic"]) && isset($_POST["secondParamedic"]) && isset($_POST["thirdParamedic"])) {
    $ambulanceId = $_POST["ambulanceId"];
    $firstParamedic = $_POST["firstParamedic"];
    $secondParamedic = $_POST["secondParamedic"];
    $thirdParamedic = $_POST["thirdParamedic"];

    $stmt = $db->prepare("INSERT INTO ratownicy (nrKaretki, ratownik1, ratownik2, ratownik3) VALUES (?, ?, ?, ?);");
    $stmt->bind_param("isss", $ambulanceId, $firstParamedic, $secondParamedic, $thirdParamedic);

    $stmt->execute();

    $zapytanie = "INSERT INTO ratownicy (nrKaretki, ratownik1, ratownik2, ratownik3) VALUES (\"$ambulanceId\", \"$firstParamedic\", \"$secondParamedic\", \"$thirdParamedic\");";
    echo "Do bazy zostało wysłane zapytanie: $zapytanie";


    $stmt->close();
    $db->close();
}
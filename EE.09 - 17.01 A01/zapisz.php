<?php
if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["address"])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $address = $_POST["address"];

    $db = new mysqli("localhost", "root", "", "wedkowanie");
    $stmt = $db->prepare("INSERT INTO karty_wedkarskie (imie, nazwisko, adres, data_zezwolenia, punkty) VALUES (?, ?, ?, NULL, NULL);");
    $stmt->bind_param("sss", $firstName, $lastName, $address);
    $stmt->execute();
    $stmt->close();
    $db->close();
}
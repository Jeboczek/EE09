<?php 

$db = new mysqli("localhost", "root", "", "dane");

if (isset($_POST["year"]) && isset($_POST["genre"]) && isset($_POST["score"]) && isset($_POST["title"])) {
    $title = $_POST["title"];
    $year = $_POST["year"];
    $genre = $_POST["genre"];
    $score = $_POST["score"];

    $stmt = $db->prepare("INSERT INTO filmy (tytul, rok, gatunki_id, ocena, rezyserzy_id) VALUES (?, ?, ?, ?, 1);");
    $stmt->bind_param("siii", $title, $year, $genre, $score);
    $stmt->execute();

    echo "Film $title został dodany do bazy";

}
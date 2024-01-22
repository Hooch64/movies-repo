<?php

$results = '';
try {
    $requete = "SELECT id, title, releaseDate, casting, director, duration FROM movies";
    $stmt = $db->prepare($requete);
    $stmt->execute();
    $results = (array) $stmt->fetchAll();
    $movies = json_decode(json_encode($results), true);
} catch (PDOException $e) {
    dump($e->getMessage());
    die;
}

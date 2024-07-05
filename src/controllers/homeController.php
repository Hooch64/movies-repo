<?php

require_once '../src/includes/functions.php';

$data['movies'] = getMovies();
$data['get'] = array_map(function ($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}, $_GET);

if (!empty($data['get']['search'])) {
    $search = $data['get']['search'];
    $data['movies'] = array_filter($data['movies'], function ($movie) use ($search) {
        return searchByName($movie->title, $search); // Utilisation de la notation objet
    });
}

echo $twig->render('home.twig', $data);

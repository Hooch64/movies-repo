<?php

$data['movies'] = getMovies();
$data['get'] = $_GET;

// if (!empty($_GET['search'])) {
//     searchByName($data['movies']['title'], $_GET['search']);
// }

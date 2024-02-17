<?php

/**
 * Get all movies from db
 */
function getMovies()
{
    global $db;
    $sql = 'SELECT slug, title, poster, pressRating, casting, director, duration, releaseDate FROM movies ORDER BY created ASC';
    $query = $db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
}

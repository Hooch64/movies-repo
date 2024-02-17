<?php

/**
 * Get all details from db for specific movie
 */
function detailMovie()
{
    global $db;
    $sql = 'SELECT title, releaseDate, duration, synopsis, poster, casting, director, pressRating, trailer FROM movies WHERE slug = :slug';
    $query = $db->prepare($sql);
    $query->execute(['slug' => $_GET['slug']]);
    return $query->fetch();
}

<?php

/**
 * Delete movie from db
 */
function deleteMovie()
{
    global $db;
    global $router;

    try {
        $requete = 'DELETE FROM movies WHERE id = :id';
        $query = $db->prepare($requete);
        $query->bindParam(':id', $_GET['id']);
        $query->execute();
        header('Location: ' . $router->generate('moviesList'));
    } catch (PDOException $e) {
        dump($e->getMessage());
        die;
    }
}

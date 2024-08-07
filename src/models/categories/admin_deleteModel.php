<?php

/**
 * Delete a category from db
 */
function deleteCategory()
{
    global $db;
    global $router;

    try {
        $requete = 'DELETE FROM genres WHERE id = :id';
        $query = $db->prepare($requete);
        $query->bindParam(':id', $_GET['id']);
        $query->execute();
        alert('la catégorie a bien été supprimée', 'success');
        header('Location: ' . $router->generate('categoriesList'));
        die;
    } catch (PDOException $e) {
        if ($_ENV['DEBUG'] == 'true') {
            dump($e->getMessage());
            die;
        } else {
            alert('Une erreur est survenue. Merci de réessayer plus tard.', 'danger');
        }
    }
}

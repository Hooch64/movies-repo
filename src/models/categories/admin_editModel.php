<?php

/**
 * Add new category to db
 */
function addCategory()
{
    global $db;
    global $router;

    try {
        $requeteAjout = "INSERT INTO genres (name) VALUES (:name)";
        $ajouterCategory = $db->prepare($requeteAjout);

        $ajouterCategory->bindParam(':name', $_POST['category']);

        $ajouterCategory->execute();
        alert('Catégorie ajouté avec succès.', 'success');
        header('Location: ' . $router->generate('categoriesList'));
        die;
    } catch (PDOException $e) {
        dump($e->getMessage());
        die;
    }
}

/**
 * Check if there is already a category with same name in db
 */
function checkAlreadyExistCategory(): mixed
{
    global $db;
    $requete = 'SELECT name FROM genres WHERE name = :name';
    $query = $db->prepare($requete);
    $query->bindParam(':name', $_POST['category'], PDO::PARAM_STR);
    $query->execute();

    return $query->fetch();
}

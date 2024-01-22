<?php

function addCategory()
{
    global $db;
    global $router;

    try {
        $requeteAjout = "INSERT INTO categories (name) VALUES (:name)";
        $ajouterCategory = $db->prepare($requeteAjout);

        $ajouterCategory->bindParam(':name', $_POST['name']);

        $ajouterCategory->execute();

        die;
    } catch (PDOException $e) {
        dump($e->getMessage());
        die;
    }
}

function checkAlreadyExistCategory(): mixed
{
    global $db;
    $requete = 'SELECT name FROM categories WHERE name = :name';
    $query = $db->prepare($requete);
    $query->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $query->execute();

    return $query->fetch();
}

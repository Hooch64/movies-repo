<?php

function addCategory()
{
    global $db;
    global $router;

    try {
        $requeteAjout = "INSERT INTO categories (cat) VALUES (:cat)";
        $ajouterCategory = $db->prepare($requeteAjout);

        $ajouterCategory->bindParam(':cat', $_POST['category']);

        $ajouterCategory->execute();
        alert('Catégorie ajouté avec succès.', 'success');
        header('Location: https://movies.test/admin/categories/editer');
        die;
    } catch (PDOException $e) {
        dump($e->getMessage());
        die;
    }
}

function checkAlreadyExistCategory(): mixed
{
    global $db;
    $requete = 'SELECT cat FROM categories WHERE cat = :cat';
    $query = $db->prepare($requete);
    $query->bindParam(':cat', $_POST['category'], PDO::PARAM_STR);
    $query->execute();

    return $query->fetch();
}

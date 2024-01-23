<?php


if (!empty($_GET['id'])) {
    deleteCategory();
} else {
    alert('Impossible de supprimer cet utilisateur');
}
header('Location: ' . $router->generate('categoriesList'));
die;

<?php


if (!empty($_GET['id']) && !empty(getAlreadyExistId()->id) && countUsers() > 1) {
    deleteUser();
} else {
    alert('Impossible de supprimer cet utilisateur');
}
header('Location: ' . $router->generate('userList'));
die;

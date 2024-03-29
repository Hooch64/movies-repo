<?php

$errorMessage = [
    'email' => false,
    'pwd' => false,
    'pwd-conf' => false
];

if (!empty($_POST)) {
    // Check email format and if already exists
    if (!empty($_POST['email'])) {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errorMessage['email'] = 'L\'adresse email n\'est pas valide';
        } else if (checkAlreadyExistEmail()) {
            $errorMessage['email'] = 'L\'adresse email existe déjà';
        }
    };

    // Check password format and match with password confirm
    if (!empty($_POST['pwd'])) {
        $password = $_POST['pwd'];
        if (!preg_match('/^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{12,}$/', $password)) {
            $errorMessage['pwd'] = 'Mot de passe invalide';
        } else if ($_POST['pwd'] !== $_POST['pwd-conf']) {
            $errorMessage['pwd-conf'] = 'Le mdp et la conf doivent etre identique';
        }
    };

    // Save user in database
    if (!empty($_POST['email']) && !empty($_POST['pwd']) && !empty($_POST['pwd-conf'])) {
        if (!$errorMessage['email'] && (!$errorMessage['pwd']) && (!$errorMessage['pwd-conf'])) {

            if (!empty($_GET['id'])) {
                updateUser();
            } else {
                addUser();
            }
            // header('Location: ' . $router->generate('userList'));
            unset($_POST['email']);
        } else {
            alert('Erreur lors de l\'ajout de l\'utilisateur.');
        }
    } else {
        alert('Erreur lors de l\'ajout de l\'utilisateur.');
    }
} else if (!empty($_GET['id'])) {
    $_POST = (array) getUser();
}

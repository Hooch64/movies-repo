<?php

$errorMessage = [
    'state' => false,
    'class' => false,
    'message' => false
];

if (!empty($_POST)) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
            alert('Une erreur est survenue.', 'danger');
            unset($_SESSION['user']);
            header('Location: ' . $router->generate('login'));
            die;
        }

        // Check title validity
        if (empty($_POST['category'])) {
            $errorMessage['state'] = true;
            $errorMessage['class'] = 'is-invalid';
            $errorMessage['message'] = '<span class="invalid-feedback">Merci de renseigner ce champ</span>';
        } elseif (checkAlreadyExistCategory()) {
            $errorMessage['state'] = true;
            $errorMessage['class'] = 'is-invalid';
            $errorMessage['message'] = '<span class="invalid-feedback">Cette catégorie existe déjà</span>';
        }

        if (!empty($_POST['category'])) {
            if (!$errorMessage['state']) {

                alert('Catégorie ajouté avec succès.', 'success');
                addCategory();
            } else {
                alert('Erreur lors de l\'ajout de la catégorie.');
            }
        } else {
            alert('Erreur lors de l\'ajout de la catégorie.');
        }
    }
};

$csrfToken = generateCSRFToken();

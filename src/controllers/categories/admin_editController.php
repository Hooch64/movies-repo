<?php

$errorMessage = [
    'state' => false,
    'class' => false,
    'message' => false
];

if (!empty($_POST)) {

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

            unset($_POST['email']);
        } else {
            alert('Erreur lors de l\'ajout de la catégorie.');
        }
    } else {
        alert('Erreur lors de l\'ajout de la catégorie.');
    }
}

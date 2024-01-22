<?php

$errorMessage = [
    'title' =>
    [
        'state' => false,
        'class' => false,
        'message' => false
    ],
    'releaseDate' =>
    [
        'state' => false,
        'class' => false,
        'message' => false
    ],
    'synopsis' =>
    [
        'state' => false,
        'class' => false,
        'message' => false
    ],
    'casting' =>
    [
        'state' => false,
        'class' => false,
        'message' => false
    ],
    'director' =>
    [
        'state' => false,
        'class' => false,
        'message' => false
    ],
    'duration' =>
    [
        'state' => false,
        'class' => false,
        'message' => false
    ],
    'pressRating' =>
    [
        'state' => false,
        'class' => false,
        'message' => false
    ],
];

$pageInfo = [
    'pageTitle' => 'Ajouter un film',
    'title' => 'Ajouter un film',
    'button' => 'Ajouter'
];

if (!empty($_POST)) {

    // Check title validity
    if (empty($_POST['title'])) {
        $errorMessage['title']['state'] = true;
        $errorMessage['title']['class'] = 'is-invalid';
        $errorMessage['title']['message'] = '<span class="invalid-feedback">Merci de renseigner ce champ</span>';
    } elseif (checkAlreadyExistMovie() && empty($_GET['id'])) {
        $errorMessage['title']['state'] = true;
        $errorMessage['title']['class'] = 'is-invalid';
        $errorMessage['title']['message'] = '<span class="invalid-feedback">Ce film existe déjà</span>';
    }

    // Check date format
    if (empty($_POST['releaseDate'])) {
        $errorMessage['releaseDate']['state'] = true;
        $errorMessage['releaseDate']['class'] = 'is-invalid';
        $errorMessage['releaseDate']['message'] = '<span class="invalid-feedback">Merci de renseigner ce champ</span>';
    } else {
        $date = $_POST['releaseDate'];
        if (!validateDate($date)) {
            $errorMessage['releaseDate']['state'] = true;
            $errorMessage['releaseDate']['class'] = 'is-invalid';
            $errorMessage['releaseDate']['message'] = '<span class="invalid-feedback">Date non valide</span>';
        }
    }

    // Check synopsis validity
    if (empty($_POST['synopsis'])) {
        $errorMessage['synopsis']['state'] = true;
        $errorMessage['synopsis']['class'] = 'is-invalid';
        $errorMessage['synopsis']['message'] = '<span class="invalid-feedback">Merci de renseigner ce champ</span>';
    }

    // Check casting validity
    if (empty($_POST['casting'])) {
        $errorMessage['casting']['state'] = true;
        $errorMessage['casting']['class'] = 'is-invalid';
        $errorMessage['casting']['message'] = '<span class="invalid-feedback">Merci de renseigner ce champ</span>';
    }

    // Check director validity
    if (empty($_POST['director'])) {
        $errorMessage['director']['state'] = true;
        $errorMessage['director']['class'] = 'is-invalid';
        $errorMessage['director']['message'] = '<span class="invalid-feedback">Merci de renseigner ce champ</span>';
    }

    // Check duration format
    if (empty($_POST['duration'])) {
        $errorMessage['duration']['state'] = true;
        $errorMessage['duration']['class'] = 'is-invalid';
        $errorMessage['duration']['message'] = '<span class="invalid-feedback">Merci de renseigner ce champ</span>';
    } else {
        if (!preg_match('/^\d{1,3}$/', $_POST['duration'])) {
            $errorMessage['duration']['state'] = true;
            $errorMessage['duration']['class'] = 'is-invalid';
            $errorMessage['duration']['message'] = '<span class="invalid-feedback">Durée non valide</span>';
        }
    }

    // Check pressRating format
    if (empty($_POST['pressRating'])) {
        $errorMessage['pressRating']['state'] = true;
        $errorMessage['pressRating']['class'] = 'is-invalid';
        $errorMessage['pressRating']['message'] = '<span class="invalid-feedback">Merci de renseigner ce champ</span>';
    } else {
        if (!is_numeric($_POST['pressRating'])) {
            $errorMessage['pressRating']['state'] = true;
            $errorMessage['pressRating']['class'] = 'is-invalid';
            $errorMessage['pressRating']['message'] = '<span class="invalid-feedback">Note non valide</span>';
        }
    }

    // Save movie in database
    if (!empty($_POST['title']) && !empty($_POST['releaseDate']) && !empty($_POST['synopsis']) && !empty($_POST['casting']) && !empty($_POST['director']) && !empty($_POST['duration']) && !empty($_POST['pressRating'])) {
        if (!$errorMessage['title']['state'] && !$errorMessage['releaseDate']['state'] && !$errorMessage['synopsis']['state'] && !$errorMessage['casting']['state'] && !$errorMessage['director']['state'] && !$errorMessage['duration']['state'] && !$errorMessage['pressRating']['state']) {

            if (!empty($_GET['id'])) {
                alert('Film modifié avec succès.', 'success');
                updateMovie();
            } else {
                alert('Film ajouté avec succès.', 'success');
                addMovie();
            }

            unset($_POST['email']);
        } else {
            alert('Erreur lors de l\'ajout du film.');
        }
    } else {
        alert('Erreur lors de l\'ajout du film.');
    }
} else if (!empty($_GET['id'])) {
    retrieveId();
    $pageInfo = [
        'pageTitle' => 'Modifier un film',
        'title' => 'Modifier un film',
        'button' => 'Modifier'
    ];
}

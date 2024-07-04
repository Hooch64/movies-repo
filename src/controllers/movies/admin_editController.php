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
    'poster' =>
    [
        'state' => false,
        'class' => false,
        'message' => false
    ],
    'trailer' =>
    [
        'state' => false,
        'class' => false,
        'message' => false
    ]
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



    // dump($_FILES);

    /**	
     * Upload file
     * 
     * @param string $path to save file
     * @param string $field name of input type file
     */
    function uploadFile(string $field, array $exts = ['jpg', 'png', 'jpeg'], int $maxSize = 2097152): string
    {
        return '';
        // Check submit form with post method
        if (empty($_FILES)) :
            return '';
        endif;

        // Check not empty input file
        if (empty($_FILES[$field]['name'])) :
            return 'Merci d\'uploader un fichier';
        endif;

        // Check exts
        $currentExt = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
        $currentExt = strtolower($currentExt);
        if (!in_array($currentExt, $exts)) :
            $exts = implode(', ', $exts);
            return 'Merci de charger un fichier avec l\'une de ces extensions : ' . $exts . '.';
        endif;

        // Check no error into current file
        if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) :
            return 'Merci de sélectionner un autre fichier.';
        endif;

        // Check max size current file
        if ($_FILES[$field]['size'] > $maxSize) :
            return 'Merci de charger un fichier ne dépassant pas cette taille : ' . formatBytes($maxSize);
        endif;
    }

    echo uploadFile('poster');


    // Save movie in database
    if (!empty($_POST['title']) && !empty($_POST['releaseDate']) && !empty($_POST['synopsis']) && !empty($_POST['casting']) && !empty($_POST['director']) && !empty($_POST['duration']) && !empty($_POST['pressRating']) && !empty($_FILES)) {
        if (!$errorMessage['title']['state'] && !$errorMessage['releaseDate']['state'] && !$errorMessage['synopsis']['state'] && !$errorMessage['casting']['state'] && !$errorMessage['director']['state'] && !$errorMessage['duration']['state'] && !$errorMessage['pressRating']['state']) {

            $targetToSave = '';
            if (!empty($_FILES['poster']['name'])) {
                $path = '../public/images';
                $filename = pathinfo($_FILES['poster']['name'], PATHINFO_FILENAME);
                $filename = renameFile($filename);
                $currentExt = pathinfo($_FILES['poster']['name'], PATHINFO_EXTENSION);
                $currentExt = strtolower($currentExt);
                $targetToSave = $path . '/' . $filename . '.' . $currentExt;

                move_uploaded_file($_FILES['poster']['tmp_name'], $targetToSave);
            }

            if (!empty($_GET['id'])) {
                alert('Film modifié avec succès.', 'success');
                updateMovie($targetToSave);
            } else {
                alert('Film ajouté avec succès.', 'success');
                addMovie($targetToSave);
            }
            resize($targetToSave, 250);
            header('Location: ' . $router->generate('moviesList'));
            die;
        } else {
            alert('Erreur lors de l\'ajout du film.');
        }
    } else {
        alert('Erreur lors de l\'ajout du film.');
    }
} else if (!empty($_GET['id'])) {
    retrieveId();
    $categoriesMovie = getCategoriesByID($_GET['id']);
    $pageInfo = [
        'pageTitle' => 'Modifier un film',
        'title' => 'Modifier un film',
        'button' => 'Modifier'
    ];
}

$categories = getCategories();

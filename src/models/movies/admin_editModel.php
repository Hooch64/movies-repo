<?php

function addMovie()
{
    global $db;
    global $router;

    try {
        $requeteAjout = "INSERT INTO movies (title, releaseDate, duration, synopsis, casting, director, pressRating) 
        VALUES (:title, :releaseDate, :duration, :synopsis, :casting, :director, :pressRating)";
        $ajouterFilm = $db->prepare($requeteAjout);

        $ajouterFilm->bindParam(':title', $_POST['title']);
        $ajouterFilm->bindParam(':releaseDate', $_POST['releaseDate']);
        $ajouterFilm->bindParam(':duration', $_POST['duration']);
        $ajouterFilm->bindParam(':synopsis', $_POST['synopsis']);
        $ajouterFilm->bindParam(':casting', $_POST['casting']);
        $ajouterFilm->bindParam(':director', $_POST['director']);
        $ajouterFilm->bindParam(':pressRating', $_POST['pressRating']);

        $ajouterFilm->execute();

        header('Location: ' . $router->generate('moviesList'));
        die;
    } catch (PDOException $e) {
        dump($e->getMessage());
        die;
    }
}

function updateMovie()
{
    global $router;
    global $db;

    $data = [
        'title' => $_POST['title'],
        'releaseDate' => $_POST['releaseDate'],
        'duration' => $_POST['duration'],
        'synopsis' => $_POST['synopsis'],
        'casting' => $_POST['casting'],
        'director' => $_POST['director'],
        'pressRating' => $_POST['pressRating'],
        'id' => $_GET['id']
    ];

    try {
        $requeteAjout = 'UPDATE movies SET title = :title, releaseDate = :releaseDate, duration = :duration, synopsis = :synopsis, casting = :casting, director = :director, pressRating = :pressRating WHERE id = :id';
        $query = $db->prepare($requeteAjout);
        $query->execute($data);
        header('Location: ' . $router->generate('moviesList'));
        die;
    } catch (PDOException $e) {
        dump($e->getMessage());
        die;
    }
}

function checkAlreadyExistMovie(): mixed
{
    global $db;
    $requete = 'SELECT title FROM movies WHERE title = :title';
    $query = $db->prepare($requete);
    $query->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
    $query->execute();

    return $query->fetch();
}

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // Retourne true si la date est valide et correspond au format, false sinon
    return $d && $d->format($format) === $date;
}

function retrieveId()
{
    global $db;
    $currentId = $_GET['id'];

    try {
        $requete = "SELECT title, releaseDate, synopsis, casting, director, duration, pressRating FROM movies WHERE id= :id";
        $stmt = $db->prepare($requete);
        $stmt->bindParam(':id', $currentId);
        $stmt->execute();
        $_POST = (array) $stmt->fetch();
    } catch (PDOException $e) {
        dump($e->getMessage());
        die;
    }
}

<?php

/**
 * Add new movie to db
 * @param string $targetToSave
 * @return void
 */
function addMovie($targetToSave)
{
    global $db;

    try {
        $requeteAjout = "INSERT INTO movies (title, releaseDate, duration, synopsis, casting, director, pressRating, poster, trailer, slug, category1, category2, category3) 
        VALUES (:title, :releaseDate, :duration, :synopsis, :casting, :director, :pressRating, :poster, :trailer, :slug, :category1, :category2, :category3)";
        $ajouterFilm = $db->prepare($requeteAjout);

        $ajouterFilm->bindParam(':title', $_POST['title']);
        $ajouterFilm->bindParam(':releaseDate', $_POST['releaseDate']);
        $ajouterFilm->bindParam(':duration', $_POST['duration']);
        $ajouterFilm->bindParam(':synopsis', $_POST['synopsis']);
        $ajouterFilm->bindParam(':casting', $_POST['casting']);
        $ajouterFilm->bindParam(':director', $_POST['director']);
        $ajouterFilm->bindParam(':pressRating', $_POST['pressRating']);
        $ajouterFilm->bindParam(':poster', $targetToSave);
        $ajouterFilm->bindParam(':trailer', $_POST['trailer']);
        $ajouterFilm->bindParam(':slug', renameFile($_POST['title']));
        $ajouterFilm->bindParam(':category1', $_POST['category1']);
        $ajouterFilm->bindParam(':category2', $_POST['category2']);
        $ajouterFilm->bindParam(':category3', $_POST['category3']);

        $ajouterFilm->execute();
    } catch (PDOException $e) {
        dump($e->getMessage());
        die;
    }
}

/**
 * Update existing movie from db
 * @param string $targetToSave
 * @return void
 */
function updateMovie($targetToSave)
{
    global $db;

    $data = [
        'title' => $_POST['title'],
        'releaseDate' => $_POST['releaseDate'],
        'duration' => $_POST['duration'],
        'synopsis' => $_POST['synopsis'],
        'casting' => $_POST['casting'],
        'director' => $_POST['director'],
        'pressRating' => $_POST['pressRating'],
        'trailer' => $_POST['trailer'],
        'id' => $_GET['id'],
        'slug' => renameFile($_POST['title']),
        'category1' => $_POST['category1'],
        'category2' => $_POST['category2'],
        'category3' => $_POST['category3'],
    ];

    if (!empty($targetToSave)) {

        $data['poster'] = $targetToSave;
        $requeteAjout = 'UPDATE movies SET 
            title = :title,
            releaseDate = :releaseDate,
            director = :director,
            casting = :casting,
            synopsis = :synopsis,
            duration = :duration,
            pressRating = :pressRating,
            poster = :poster,
            trailer = :trailer,
            slug = :slug,
            category1 = :category1,
            category2 = :category2,
            category3 = :category3
            WHERE id = :id';
    } else {

        $requeteAjout = 'UPDATE movies SET 
            title = :title,
            releaseDate = :releaseDate,
            director = :director,
            casting = :casting,
            synopsis = :synopsis,
            duration = :duration,
            pressRating = :pressRating,
            trailer = :trailer,
            slug = :slug,
            category1 = :category1,
            category2 = :category2,
            category3 = :category3
            WHERE id = :id';
    }

    try {
        $query = $db->prepare($requeteAjout);
        $query->execute($data);
    } catch (PDOException $e) {
        dump($e->getMessage());
        die;
    }
}

/**
 * Check if movie title already exists in db
 */
function checkAlreadyExistMovie(): mixed
{
    global $db;
    $requete = 'SELECT title FROM movies WHERE title = :title';
    $query = $db->prepare($requete);
    $query->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
    $query->execute();

    return $query->fetch();
}

/**
 * Check if inserted date match format
 * @param string $date
 * @param string $format
 * @return bool
 */
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // Retourne true si la date est valide et correspond au format, false sinon
    return $d && $d->format($format) === $date;
}

/**
 * Retrieve ID from existing movie in case of an update
 */
function retrieveId()
{
    global $db;
    $currentId = $_GET['id'];

    try {
        $requete = "SELECT title, releaseDate, synopsis, casting, director, duration, pressRating, poster, trailer FROM movies WHERE id= :id";
        $stmt = $db->prepare($requete);
        $stmt->bindParam(':id', $currentId);
        $stmt->execute();
        $_POST = (array) $stmt->fetch();
    } catch (PDOException $e) {
        dump($e->getMessage());
        die;
    }
}

/**
 * Get categories from db
 */
function getCategories()
{
    global $db;

    $sql = "SELECT id, cat FROM categories";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $categories;
};

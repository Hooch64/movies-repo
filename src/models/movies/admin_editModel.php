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
        $requeteAjout = "INSERT INTO movies (title, releaseDate, duration, synopsis, casting, director, pressRating, poster, trailer, slug) 
                         VALUES (:title, :releaseDate, :duration, :synopsis, :casting, :director, :pressRating, :poster, :trailer, :slug)";
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

        $ajouterFilm->execute();

        $movieId = $db->lastInsertId();
        $genres = [];
        if (!empty($_POST['category1'])) {
            $genres[] = $_POST['category1'];
        }
        if (!empty($_POST['category2'])) {
            $genres[] = $_POST['category2'];
        }
        if (!empty($_POST['category3'])) {
            $genres[] = $_POST['category3'];
        }

        if (!empty($genres)) {
            foreach ($genres as $genreId) {
                $requeteAjoutGenres = "INSERT INTO movies_genres (movie_ID, genre_ID) VALUES (:movie_ID, :genre_ID)";
                $ajouterGenres = $db->prepare($requeteAjoutGenres);

                $ajouterGenres->bindParam(':movie_ID', $movieId);
                $ajouterGenres->bindParam(':genre_ID', $genreId);
                $ajouterGenres->execute();
            }
        }
    } catch (PDOException $e) {
        dump($e->getMessage());
        die;
    }
}


/**
 * Update existing movie in db
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
            slug = :slug
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
            slug = :slug
            WHERE id = :id';
    }

    try {
        $query = $db->prepare($requeteAjout);
        $query->execute($data);

        $movieId = $_GET['id'];

        $requeteSuppressionGenres = "DELETE FROM movies_genres WHERE movie_ID = :movie_ID";
        $supprimerGenres = $db->prepare($requeteSuppressionGenres);
        $supprimerGenres->bindParam(':movie_ID', $movieId);
        $supprimerGenres->execute();

        $genres = [];
        if (!empty($_POST['category1'])) {
            $genres[] = $_POST['category1'];
        }
        if (!empty($_POST['category2'])) {
            $genres[] = $_POST['category2'];
        }
        if (!empty($_POST['category3'])) {
            $genres[] = $_POST['category3'];
        }

        if (!empty($genres)) {
            $requeteAjoutGenres = "INSERT INTO movies_genres (movie_ID, genre_ID) VALUES (:movie_ID, :genre_ID)";
            $ajouterGenres = $db->prepare($requeteAjoutGenres);

            foreach ($genres as $genreId) {
                $ajouterGenres->bindParam(':movie_ID', $movieId);
                $ajouterGenres->bindParam(':genre_ID', $genreId);
                $ajouterGenres->execute();
            }
        }
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

    $sql = "SELECT id, name FROM genres";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $categories;
};

/**
 * Get categories from db if a movie update is required
 */
function getCategoriesByID($id)
{
    global $db;

    $sql = "SELECT genres.name, genres.id
            FROM movies 
            JOIN movies_genres ON movies.id = movies_genres.movie_ID 
            JOIN genres ON movies_genres.genre_ID = genres.id 
            WHERE movies.id = $id";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $categories;
};

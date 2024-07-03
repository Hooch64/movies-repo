<?php

/**
 * Get the header
 * @param string $title title of the page
 * @param string $layout layout to use
 * @return void
 */
function get_header(string $title, string $layout = 'public'): void
{
    global $router;
    require_once '../src/views/layouts/' . $layout . '/header.php';
};

/**
 * Get the footer
 * @param string $title title of the page
 * @param string $layout layout to use
 * @return void
 */
function get_footer(string $layout = 'public'): void
{
    require_once '../src/views/layouts/' . $layout . '/footer.php';
};

/**
 * Create the alert
 * @param string $message the message to save in the alert
 * @param string $type the type of alert
 * @return void
 */
function alert(string $message, string $type = 'danger'): void
{
    $_SESSION['alert'] = [
        'message' => $message,
        'type' => $type
    ];
};

/**
 * Display alert session
 * @return void
 */
function displayAlert(): void
{
    if (!empty($_SESSION['alert'])) {
        echo '<div class="alert alert-' . $_SESSION['alert']['type'] . '" role="alert">' . $_SESSION['alert']['message'] . '</div>';
        unset($_SESSION['alert']);
    }
}


/**
 * Check if admin is logged in
 * @param array $match
 * @param AltoRouter $router
 */
function checkAdmin(array $match, AltoRouter $router)
{
    $existAdmin = strpos($match['target'], 'admin_');
    if (($existAdmin !== false) && (empty($_SESSION['user']['id']))) {
        header('Location: ' . $router->generate('login'));
        die;
    }
}


/**
 * check if then email already exists in the database
 */
function checkAlreadyExistEmail($emailToCheck): mixed
{
    global $db;
    if (!empty($_GET['id'])) {
        $email = getUser()->email;
        if ($email === $emailToCheck) {
            return false;
        }
    }
    $requete = 'SELECT email FROM users WHERE email = :email';
    $query = $db->prepare($requete);
    $query->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $query->execute();

    return $query->fetch();
}

/**
 * Allow a user to search a movie by name 
 * @param string $movieName
 * @param string $search
 * @return bool
 */
function searchByName(string $movieName, string $search): bool
{
    $checkPos = strpos(strtolower($movieName), strtolower($search));
    if ($checkPos === false) {
        return false;
    } else {
        return true;
    }
}

/**
 * Log out user after a certain time for security reasons
 */
function logoutTimer()
{
    global $router;
    if (!empty($_SESSION['user']['lastLogin'])) {
        $expireHour = 1;

        $now = new DateTime();
        $now->setTimeZone(new DateTimeZone('Europe/Paris'));

        $lastLogin = new DateTime($_SESSION['user']['lastLogin']);


        if ($now->diff($lastLogin)->h >= $expireHour) {
            unset($_SESSION['user']);
            alert('Vous avez été déconnecté pour inactivité', 'danger');
            header('Location: ' . $router->generate('login'));
        }
    }
}

/**
 * Format and round the size of a new file 
 * @param int $size
 * @param int $precision
 * @return int
 */
function formatBytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = ['', 'Ko', 'Mo', 'Go', 'To'];

    return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
}

/**
 * Rename a file when uploaded with a clean, special character free synthax
 * @param string $name
 * @return string
 */
function renameFile(string $name)
{
    $name = trim($name);
    $name = strip_tags($name);
    $name = removeAccent($name);
    $name = preg_replace('/[\s-]+/', ' ', $name);  // Clean up multiple dashes and whitespaces
    $name = preg_replace('/[\s_]/', '-', $name); // Convert whitespaces and underscore to dash
    $name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
    $name = strtolower($name);
    $name = trim($name, '-');

    return $name;
}

/**
 * Normalize file name by removing all accents
 * @param string $string
 * @return string
 */
function removeAccent($string)
{
    $string = str_replace(
        ['à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'],
        ['a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y'],
        $string
    );
    return $string;
}

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

/**
 * Resize an image when uploaded with modifiable size
 * @param string $targetToSave
 * @param int $size
 * @return string
 */
function resize(string $targetToSave, int $size)
{
    $manager = new ImageManager(new Driver());
    $image = $manager->read($targetToSave);
    $image->scale(width: $size);
    $image->save($targetToSave);
    return $targetToSave;
}

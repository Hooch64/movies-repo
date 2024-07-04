<?php

if (!isset($_SESSION['failedAttempts'])) {
    $_SESSION['failedAttempts'] = 0;
}

if (!empty($_POST['email']) && !empty($_POST['pwd']) && empty($_POST['pseudo'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['pwd'];

    if (checkAlreadyExistEmail($email)) {
        $accessUser = checkUserAccess($email, $password);
        if (!empty($accessUser)) {
            $_SESSION['user'] = [
                'id' => $accessUser,
                'lastLogin' => date('Y-m-d H:i:s'),

            ];

            saveLastLogin($accessUser);

            unset($_SESSION['failedAttempts']);
            alert('Connexion réussie', 'success');
            header('Location: ' . $router->generate('moviesList'));
            die;
        } else {
            $_SESSION['failedAttempts'] += 1;
            alert('Identifiants incorrects');
        }
    } else {
        $_SESSION['failedAttempts'] += 1;
        alert('Identifiants incorrects');
    }
}

// dump($_SESSION['failedAttempts']);
// unset($_SESSION['ipBan']);

function getIp()
{
    $ipAddress = '';
    if (isset($_SERVER['REMOTE_ADDR'])) {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $ipAddress;
}

function ipBan($ipAddress)
{
    $_SESSION['ipBan'][] = $ipAddress;
}

function checkIpBan($ipAddress)
{
    return isset($_SESSION['ipBan']) && in_array($ipAddress, $_SESSION['ipBan']);
}

$currentIp = getIp();

if (checkIpBan($currentIp)) {
    header('Location: ' . $router->generate('jail'));
    die;
}

$maxFailedAttempts = 3;

if ($_SESSION['failedAttempts'] >= $maxFailedAttempts) {
    ipBan($currentIp);
}

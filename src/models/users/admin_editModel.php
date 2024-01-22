<?php

/**
 * check if then email already exists in the database
 */
function checkAlreadyExistEmail(): mixed
{
    global $db;
    if (!empty($_GET['id'])) {
        $email = getUser()->email;
        if ($email === $_POST['email']) {
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
 * Add an user in the database
 */
function addUser()
{
    global $db;
    //Autre methode que le bindParam
    $data = [
        'email' => $_POST['email'],
        'pwd' => password_hash($_POST['pwd'], PASSWORD_DEFAULT),
        'role_id' => 1
    ];

    try {
        $requeteAjout = 'INSERT INTO users (id, email, pwd, role_id) 
                    VALUES (UUID(), :email, :pwd, :role_id)';
        $query = $db->prepare($requeteAjout);
        $query->execute($data);
        alert('Un utilisateur a bien été ajouté', 'success');
    } catch (PDOException $e) {
        if ($_ENV['DEBUG'] == 'true') {
            dump($e->getMEssage());
            die;
        } else {
            alert('Une erreur est survenue. Merci de réessayer plus tard.', 'danger');
        }
    }
}


function updateUser()
{
    global $db;
    $data = [
        'email' => $_POST['email'],
        'pwd' => password_hash($_POST['pwd'], PASSWORD_DEFAULT),
        'id' => $_GET['id']
    ];

    try {
        $requeteAjout = 'UPDATE users SET email = :email, pwd = :pwd WHERE id = :id';
        $query = $db->prepare($requeteAjout);
        $query->execute($data);
        alert('Un utilisateur a bien été modifié', 'success');
    } catch (PDOException $e) {
        if ($_ENV['DEBUG'] == 'true') {
            dump($e->getMEssage());
            die;
        } else {
            alert('Une erreur est survenue. Merci de réessayer plus tard.', 'danger');
        }
    }
}

function getUser()
{
    global $db;
    try {
        $sql = 'SELECT email FROM users WHERE id = :id';
        $query = $db->prepare($sql);
        $query->bindParam(':id', $_GET['id']);
        $query->execute();

        return $query->fetch();
    } catch (PDOException $e) {
        if ($_ENV['DEBUG'] == 'true') {
            dump($e->getMEssage());
            die;
        } else {
            alert('Une erreur est survenue. Merci de réessayer plus tard.', 'danger');
        }
    }
}

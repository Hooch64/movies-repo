<?php

/**
 * Add new user in db
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

/**
 * Update existing user from db
 */
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

/**
 * Get user's email if it's already in db
 */
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

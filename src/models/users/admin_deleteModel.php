<?php
function deleteUser()
{
    global $db;
    global $router;

    try {
        $requete = 'DELETE FROM users WHERE id = :id';
        $query = $db->prepare($requete);
        $query->bindParam(':id', $_GET['id']);
        $query->execute();
        alert('l\'utilisateur a bien été supprimé', 'success');
        header('Location: ' . $router->generate('userList'));
    } catch (PDOException $e) {
        if ($_ENV['DEBUG'] == 'true') {
            dump($e->getMEssage());
            die;
        } else {
            alert('Une erreur est survenue. Merci de réessayer plus tard.', 'danger');
        }
    }
}

function getAlreadyExistId()
{
    try {
        global $db;
        $sql = 'SELECT id FROM users WHERE id = :id';
        $query = $db->prepare($sql);
        $query->execute(['id' => $_GET['id']]);

        return $query->fetch();
    } catch (PDOException $e) {
        if ($_ENV['DEBUG'] == 'true') {
            dump($e->getMessage());
            die;
        } else {
            alert('Une erreur est survenue. Merci de réessayer plus tard.', 'danger');
        }
    }
}

function countUsers()
{
    global $db;
    $sql = 'SELECT COUNT(*) FROM users';
    $query = $db->prepare($sql);
    $query->execute();

    return $query->fetchColumn();
}

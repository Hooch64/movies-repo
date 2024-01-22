<?php

// $results = '';
// try {
//     $requete = "SELECT id, email, role_id, created FROM users";
//     $stmt = $db->prepare($requete);
//     $stmt->execute();
//     $results = (array) $stmt->fetchAll();
//     $users = json_decode(json_encode($results), true);
// } catch (PDOException $e) {
//     dump($e->getMessage());
//     die;
// }

/**
 * Get all users
 */
function getUsers()
{
    global $db;

    $sql = 'SELECT id, email, role_id, created FROM users';
    $query = $db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
}

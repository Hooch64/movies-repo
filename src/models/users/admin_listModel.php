<?php

/**
 * Get all users from db
 */
function getUsers()
{
    global $db;

    $sql = 'SELECT id, email, pseudo, created_at FROM users';
    $query = $db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
}

<?php

/**
 * Get all users from db
 */
function getUsers()
{
    global $db;

    $sql = 'SELECT id, email, role_id, created FROM users';
    $query = $db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
}

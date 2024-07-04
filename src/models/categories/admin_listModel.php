<?php

/**
 * Get all categories from db
 */
function getCategories()
{
    global $db;

    $sql = 'SELECT id, name, created_at FROM genres';
    $query = $db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
}

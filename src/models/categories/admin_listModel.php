<?php

/**
 * Get all categories
 */
function getCategories()
{
    global $db;

    $sql = 'SELECT id, cat, created FROM categories';
    $query = $db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
}

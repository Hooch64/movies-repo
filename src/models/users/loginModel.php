<?php

/**
 * Check if user can access admin according to infos in db
 */
function checkUserAccess()
{
    global $db;
    $sql = 'SELECT id, pwd FROM users WHERE email = :email';
    $query = $db->prepare($sql);
    $query->execute(['email' => $_POST['email']]);

    $user = $query->fetch();

    if (password_verify($_POST['pwd'], $user->pwd)) {
        return $user->id;
    } else {
        return false;
    }
}

/**
 * Update in db last login date from user
 */
function saveLastLogin(string $userid)
{
    global $db;
    $sql = 'UPDATE users SET lastLogin = NOW() WHERE id = :id';
    $query = $db->prepare($sql);
    $query->execute(['id' => $userid]);
}

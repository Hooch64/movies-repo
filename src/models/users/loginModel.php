<?php

/**
 * Check if user can access admin according to infos in db
 */
function checkUserAccess($email, $password)
{
    global $db;
    $sql = 'SELECT id, password FROM users WHERE email = :email';
    $query = $db->prepare($sql);
    $query->execute(['email' => $email]);

    $user = $query->fetch();

    if (password_verify($password, $user->password)) {
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

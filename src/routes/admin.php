<?php
$admin = '/' . $_ENV['ADMIN_FOLDER'];


$router->addMatchTypes(['uuid' => '[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}']);

//users
$router->map('GET|POST', $admin . '/connexion', 'users/login', 'login');
$router->map('GET', $admin . '/deconnexion', 'users/admin_logout', 'logout');
$router->map('GET', $admin . '/utilisateurs', 'users/admin_list', 'userList');
$router->map('GET|POST', $admin . '/utilisateurs/editer/[uuid:id]', 'users/admin_edit', 'userEdit');
$router->map('GET|POST', $admin . '/utilisateurs/editer', 'users/admin_edit', 'addUser');
$router->map('GET', $admin . '/utilisateurs/supprimer/[uuid:id]', 'users/admin_delete', 'deleteUser');
$router->map('GET', $admin . '/prison', 'users/tempBan', 'jail');

//gestion films
$router->map('GET', $admin . '/film/liste', 'movies/admin_list', 'moviesList');
$router->map('GET|POST', $admin . '/film/editer/[i:id]', 'movies/admin_edit', '');
$router->map('GET|POST', $admin . '/film/editer', 'movies/admin_edit', 'moviesEdit');
$router->map('GET', $admin . '/film/supprimer/[i:id]', 'movies/admin_delete', 'moviesDelete');

//categories
$router->map('GET', $admin . '/categories', 'categories/admin_list', 'categoriesList');
$router->map('GET|POST', $admin . '/categories/editer', 'categories/admin_edit', 'editCategory');
$router->map('GET', $admin . '/categories/supprimer/[i:id]', 'categories/admin_delete', 'deleteCategory');

<?php
$admin = '/' . $_ENV['ADMIN_FOLDER'];


$router->addMatchTypes(['uuid' => '[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}']);

//users
$router->map('GET|POST', $admin . '/connexion', 'users/admin_login', 'logInAdmin'); // 3 
$router->map('GET', $admin . '/deconnexion', 'logOutAdmin', 'logOutAdmin'); // 4 
$router->map('GET', $admin . '/mdp-oublie', 'forgottenPasswordAdmin', 'lostPassword'); // 7
$router->map('GET', $admin . '/utilisateurs', 'users/admin_list', 'userList'); // 1 (SELECT & foreach)
$router->map('GET|POST', $admin . '/utilisateurs/editer/[uuid:id]', 'users/admin_edit', ''); // 2 / 5 (modif)
$router->map('GET|POST', $admin . '/utilisateurs/editer', 'users/admin_edit', ''); // 2 / 5 (modif)
$router->map('GET', $admin . '/utilisateurs/supprimer/[i:id]', 'deleteUser', 'deleteUser'); // 6

//gestion films
$router->map('GET', $admin . '/film/liste', 'movies/admin_list', 'moviesList');
$router->map('GET|POST', $admin . '/film/editer/[i:id]', 'movies/admin_edit', '');
$router->map('GET|POST', $admin . '/film/editer', 'movies/admin_edit', 'moviesEdit');
$router->map('GET', $admin . '/film/supprimer/[i:id]', 'movies/admin_delete', 'moviesDelete');

//categories
$router->map('GET', $admin . '/categories', 'genreList', 'genreList');
$router->map('GET|POST', $admin . '/categories/editer', 'categories/admin_edit', 'editGenre');
$router->map('GET', $admin . '/categories/supprimer/[i:id]', 'deleteGenre', 'deleteGenre');
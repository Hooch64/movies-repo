<?php
$router->addMatchTypes(['slug' => '[a-z0-9]+(?:-[a-z0-9]+)*']);

// movies
$router->map('GET', '/', 'home', 'home');
$router->map('GET', '/resultat-recherche', 'searchResults', 'searchResults');
$router->map('GET', '/film/[slug:slug]', 'detailsMovie', 'details');

// pages
$router->map('GET', '/mentions-legales', 'legalNotice', 'legalNotice');
$router->map('GET', '/politique-confidentialite', 'privacy', 'privacy');

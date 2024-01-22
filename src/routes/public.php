<?php

// pages
$router->map('GET', '/mentions-legales', 'legalNotice', 'legalNotice');
$router->map('GET', '/politique-confidentialite', 'privacy', 'privacy');

// movies
$router->map('GET', '/', 'home', 'home');
$router->map('GET', '/resultat-recherche', 'searchResults', 'searchResults');
$router->map('GET', '/details', 'details', 'details');

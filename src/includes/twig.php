<?php

/**
 * Get back Url to redirect on router
 * @param string $name
 * @param $params
 * @return string
 */
$twig->addFunction(new Twig\TwigFunction('getUrl', function ($name, $params = []) {
    global $router;
    return $router->generate($name, $params);
}));

/**
 * Allow a user to search a movie by name 
 * @param string $movieName
 * @param string $search
 * @return bool
 */
$twig->addFunction(new Twig\TwigFunction('searchByName', function ($name, $search) {
    $pos = strpos(strtolower($name), strtolower($search));
    return ($pos === false) ? false : true;
}));

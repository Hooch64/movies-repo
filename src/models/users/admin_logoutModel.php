<?php
unset($_SESSION['user']);
alert('Vous avez été déconnecté', 'success');
header('Location: ' . $router->generate('login'));
die;

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Cine Qua Non</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body mb-4" data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand" href="#">Admin - Cine Qua Non</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Films</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= $router->generate('moviesList') ?>"> Liste des films</a></li>
                                <li><a class="dropdown-item" href="<?= $router->generate('moviesEdit') ?>"> Ajouter un film</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Utilisateurs</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= $router->generate('userList') ?>"> Liste des utilisateurs</a></li>
                                <li><a class="dropdown-item" href="<?= $router->generate('addUser') ?>"> Ajouter un utilisateur </a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Catégories</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= $router->generate('categoriesList') ?>"> Liste des catégories</a></li>
                                <li><a class="dropdown-item" href="<?= $router->generate('editCategory') ?>"> Ajouter une catégorie </a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="navbar-text">
                        <a href="" class="btn btn-danger">Déconnexion</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="container mb-5">
        <?php displayAlert(); ?>
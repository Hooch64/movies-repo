<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Cine Qua Non</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/main.css">
</head>

<body>
    <header>
        <div class="headerWrapper">
            <div class="bandeauContent">
                <div class="logo">
                    <img src="../public/images/logo_cine_qua_non.jpeg" width="120" height="120" alt="logo">
                </div>
                <form action="<?= $router->generate('searchResults'); ?>" method="get">
                    <input type="text" name="search" placeholder="Rechercher un film" class="searchBar">
                    <button type="submit" class="submit">
                        <img src="../public/images/icons8-loupe.svg" width="35" alt="search">
                    </button>
                </form>
                <div>
                    <a href="" class="sub" id="sub1">Se Connecter</a>
                    <a href="" class="sub">S'inscrire</a>
                </div>
            </div>
        </div>
    </header>
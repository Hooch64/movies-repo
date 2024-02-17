<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banned</title>
</head>

<body>
    <div style="text-align: center;">
        <img src="../../../public/images/go_to-jail.jpg" alt="jail">
    </div>
    <div style="text-align: center;">
        <button>
            <a href="<?= $router->generate('login') ?>">Essaies encore</a>
        </button>
    </div>
    <?php unset($_SESSION['ipBan']);
    die; ?>
</body>

</html>
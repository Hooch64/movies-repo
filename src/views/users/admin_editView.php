<?php get_header('Editer un untilisateur', 'admin'); ?>

<h1 class="mb-4">Editer un utilisateur</h1>

<form action="" method="post" novalidate>
    <div class="mb-4">
        <?php $error = checkEmptyFields('email'); ?>
        <label for="email" class="form-label">Adresse email : *</label>
        <input type="email" name="email" id="email" value="<?= getValue('email'); ?>" class="form-control <?= $error['class']; ?>">
        <?= $error['message']; ?>
        <?= $errorMessage['email'] ?>
    </div>
    <div class="mb-4">
        <?php $error = checkEmptyFields('pseudo'); ?>
        <label for="pseudo" class="form-label">Pseudo : *</label>
        <input type="pseudo" name="pseudo" id="pseudo" value="<?= getValue('pseudo'); ?>" class="form-control <?= $error['class']; ?>">
        <?= $error['message']; ?>
        <?= $errorMessage['pseudo'] ?>
    </div>
    <div class="mb-4">
        <?php $error = checkEmptyFields('pwd'); ?>
        <label for="pwd" class="form-label">Mot de passe : *</label>
        <input type="password" name="pwd" id="pwd" class="form-control <?= $error['class']; ?>">
        <p class="form-text mb-0"></p>
        <?= $error['message']; ?>
        <?= $errorMessage['pwd']; ?>
    </div>
    <div class="mb-4">
        <?php $error = checkEmptyFields('pwd-conf'); ?>
        <label for="pwd-conf" class="form-label">Confirmation mot de passe : *</label>
        <input type="password" name="pwd-conf" id="pwd-conf" class="form-control <?= $error['class']; ?>">
        <?= $error['message']; ?>
        <?= $errorMessage['pwd-conf'] ?>
    </div>
    <div>
        <input type="submit" class="btn btn-success" value="Sauvegarder">
    </div>
</form>

<?php get_footer('admin'); ?>
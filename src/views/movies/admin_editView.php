<?php get_header($pageInfo['pageTitle'], 'admin'); ?>

<form class=" container mt-5" style="max-width: 800px;" method="post">
    <h2 class="mb-4"><?= $pageInfo['title']; ?></h2>
    <div class="row">
        <div class="form-group col-md-8">
            <label for="titre">Titre du Film</label>
            <input type="titre" class="form-control <?= $errorMessage['title']['class']; ?>" value="<?= getValue('title'); ?>" id="titre" name="title">
            <?= $errorMessage['title']['message']; ?>
        </div>
        <div class="form-group col-md-4">
            <label for="annee">Date de Sortie</label>
            <input type="date" class="form-control <?= $errorMessage['releaseDate']['class']; ?>" value="<?= getValue('releaseDate'); ?>" id="annee" name="releaseDate" required pattern="\d{4}-\d{2}-\d{2}">
            <?= $errorMessage['releaseDate']['message']; ?>
        </div>
    </div>
    <div class="form-group">
        <label for="synopsis">Synopsis</label>
        <textarea type="text" class="form-control <?= $errorMessage['synopsis']['class']; ?>" id="synopsis" style="resize: none" name="synopsis"><?= getValue('synopsis'); ?></textarea>
        <?= $errorMessage['synopsis']['message']; ?>
    </div>
    <div class="form-group">
        <label for="casting">Acteurs</label>
        <input type="text" class="form-control <?= $errorMessage['casting']['class']; ?>" value="<?= getValue('casting'); ?>" id="casting" name="casting">
        <?= $errorMessage['casting']['message']; ?>
    </div>
    <div class="row">
        <div class="form-group col-md-5">
            <label for="director">Réalisateur</label>
            <input type="text" class="form-control <?= $errorMessage['director']['class']; ?>" value="<?= getValue('director'); ?>" id="director" name="director">
            <?= $errorMessage['director']['message']; ?>
        </div>
        <div class="form-group col-md-3">
            <label for="category">Categorie</label>
            <select id="category" class="form-control">
                <option selected>--</option>
                <option>Action</option>
                <option>Drame</option>
                <option>Horreur</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="duration">Durée</label>
            <input type="number" class="form-control <?= $errorMessage['duration']['class']; ?>" value="<?= getValue('duration'); ?>" id="duration" name="duration">
            <?= $errorMessage['duration']['message']; ?>
        </div>
        <div class="form-group col-md-2">
            <label for="pressNote">Note Presse</label>
            <input type="number" step="0.1" min="0" max="20" class="form-control <?= $errorMessage['pressRating']['class']; ?>" value="<?= getValue('pressRating'); ?>" id="pressNote" name="pressRating">
            <?= $errorMessage['pressRating']['message']; ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mb-4 mt-3"><?= $pageInfo['button']; ?></button>
</form>

<?php get_footer('admin'); ?>
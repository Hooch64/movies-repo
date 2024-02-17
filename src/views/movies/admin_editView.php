<?php get_header($pageInfo['pageTitle'], 'admin'); ?>

<form class=" container mt-5" style="max-width: 800px;" method="post" enctype="multipart/form-data">
    <h2 class="mb-4"><?= $pageInfo['title']; ?></h2>
    <div class="row">
        <div class="form-group col-md-8">
            <label for="titre">Titre du Film *</label>
            <input type="titre" class="form-control <?= $errorMessage['title']['class']; ?>" value="<?= getValue('title'); ?>" id="titre" name="title">
            <?= $errorMessage['title']['message']; ?>
        </div>
        <div class="form-group col-md-4">
            <label for="annee">Date de Sortie *</label>
            <input type="date" class="form-control <?= $errorMessage['releaseDate']['class']; ?>" value="<?= getValue('releaseDate'); ?>" id="annee" name="releaseDate" required pattern="\d{4}-\d{2}-\d{2}">
            <?= $errorMessage['releaseDate']['message']; ?>
        </div>
    </div>
    <div class="form-group">
        <label for="synopsis">Synopsis *</label>
        <textarea type="text" class="form-control <?= $errorMessage['synopsis']['class']; ?>" id="synopsis" style="resize: none" name="synopsis"><?= getValue('synopsis'); ?></textarea>
        <?= $errorMessage['synopsis']['message']; ?>
    </div>
    <div class="form-group">
        <label for="casting">Acteurs *</label>
        <input type="text" class="form-control <?= $errorMessage['casting']['class']; ?>" value="<?= getValue('casting'); ?>" id="casting" name="casting">
        <?= $errorMessage['casting']['message']; ?>
    </div>
    <div class="row">
        <div class="form-group col-md-8">
            <label for="director">Réalisateur *</label>
            <input type="text" class="form-control <?= $errorMessage['director']['class']; ?>" value="<?= getValue('director'); ?>" id="director" name="director">
            <?= $errorMessage['director']['message']; ?>
        </div>
        <div class="form-group col-md-2">
            <label for="duration">Durée *</label>
            <input type="number" class="form-control <?= $errorMessage['duration']['class']; ?>" value="<?= getValue('duration'); ?>" id="duration" name="duration">
            <?= $errorMessage['duration']['message']; ?>
        </div>
        <div class="form-group col-md-2">
            <label for="pressNote">Note Presse *</label>
            <input type="number" step="0.1" min="0" max="20" class="form-control <?= $errorMessage['pressRating']['class']; ?>" value="<?= getValue('pressRating'); ?>" id="pressNote" name="pressRating">
            <?= $errorMessage['pressRating']['message']; ?>
        </div>
        <div class="form-group col-md-4">
            <label for="category1">Categorie 1 *</label>
            <select id="category1" name="category1" class="form-control">
                <option selected>--</option>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category['cat'] ?>"><?= $category['cat'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="category2">Categorie 2</label>
            <select id="category2" name="category2" class="form-control">
                <option selected>--</option>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category['cat'] ?>"><?= $category['cat'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="category3">Categorie 3</label>
            <select id="category3" name="category3" class="form-control">
                <option selected>--</option>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category['cat'] ?>"><?= $category['cat'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="poster">Affiche *</label>
        <input type="file" class="form-control <?= $errorMessage['poster']['class']; ?>" value="tg" id="poster" name="poster">
        <?= $errorMessage['poster']['message']; ?>
    </div>
    <div class="form-group">
        <label for="trailer">Lien de la bande annonce</label>
        <input type="text" class="form-control <?= $errorMessage['trailer']['class']; ?>" value="<?= getValue('trailer'); ?>" id="trailer" name="trailer">
        <?= $errorMessage['trailer']['message']; ?>
    </div>
    <button type="submit" class="btn btn-primary mb-4 mt-3"><?= $pageInfo['button']; ?></button>
</form>

<?php get_footer('admin'); ?>
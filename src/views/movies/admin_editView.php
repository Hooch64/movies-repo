<?php get_header($pageInfo['pageTitle'], 'admin'); ?>

<form class="container mt-5" style="max-width: 800px;" method="post" enctype="multipart/form-data">
    <h2 class="mb-4"><?= htmlspecialchars($pageInfo['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
    <div class="row">
        <div class="form-group col-md-8">
            <label for="titre">Titre du Film *</label>
            <input type="text" class="form-control <?= htmlspecialchars($errorMessage['title']['class'], ENT_QUOTES, 'UTF-8'); ?>" value="<?= htmlspecialchars(getValue('title'), ENT_QUOTES, 'UTF-8'); ?>" id="titre" name="title">
            <?= htmlspecialchars($errorMessage['title']['message'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
        <div class="form-group col-md-4">
            <label for="annee">Date de Sortie *</label>
            <input type="date" class="form-control <?= htmlspecialchars($errorMessage['releaseDate']['class'], ENT_QUOTES, 'UTF-8'); ?>" value="<?= htmlspecialchars(getValue('releaseDate'), ENT_QUOTES, 'UTF-8'); ?>" id="annee" name="releaseDate" required pattern="\d{4}-\d{2}-\d{2}">
            <?= htmlspecialchars($errorMessage['releaseDate']['message'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="synopsis">Synopsis *</label>
        <textarea type="text" class="form-control <?= htmlspecialchars($errorMessage['synopsis']['class'], ENT_QUOTES, 'UTF-8'); ?>" id="synopsis" style="resize: none" name="synopsis"><?= htmlspecialchars(getValue('synopsis'), ENT_QUOTES, 'UTF-8'); ?></textarea>
        <?= htmlspecialchars($errorMessage['synopsis']['message'], ENT_QUOTES, 'UTF-8'); ?>
    </div>
    <div class="form-group">
        <label for="casting">Acteurs *</label>
        <input type="text" class="form-control <?= htmlspecialchars($errorMessage['casting']['class'], ENT_QUOTES, 'UTF-8'); ?>" value="<?= htmlspecialchars(getValue('casting'), ENT_QUOTES, 'UTF-8'); ?>" id="casting" name="casting">
        <?= htmlspecialchars($errorMessage['casting']['message'], ENT_QUOTES, 'UTF-8'); ?>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="director">Réalisateur *</label>
            <input type="text" class="form-control <?= htmlspecialchars($errorMessage['director']['class'], ENT_QUOTES, 'UTF-8'); ?>" value="<?= htmlspecialchars(getValue('director'), ENT_QUOTES, 'UTF-8'); ?>" id="director" name="director">
            <?= htmlspecialchars($errorMessage['director']['message'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
        <div class="form-group col-md-2">
            <label for="duration">Durée *</label>
            <input type="number" class="form-control <?= htmlspecialchars($errorMessage['duration']['class'], ENT_QUOTES, 'UTF-8'); ?>" value="<?= htmlspecialchars(getValue('duration'), ENT_QUOTES, 'UTF-8'); ?>" id="duration" name="duration">
            <?= htmlspecialchars($errorMessage['duration']['message'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
        <div class="form-group col-md-2">
            <label for="pressNote">Note Presse *</label>
            <input type="number" step="0.1" min="0" max="20" class="form-control <?= htmlspecialchars($errorMessage['pressRating']['class'], ENT_QUOTES, 'UTF-8'); ?>" value="<?= htmlspecialchars(getValue('pressRating'), ENT_QUOTES, 'UTF-8'); ?>" id="pressNote" name="pressRating">
            <?= htmlspecialchars($errorMessage['pressRating']['message'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="category1">Catégorie 1 *</label>
            <select id="category1" name="category1" class="form-control">
                <?php if (!getValue('pressRating')) { ?>
                    <option value="" selected>--</option>
                <?php } else { ?>
                    <option value="<?= $categoriesMovie[0]['id']; ?>" selected><?= $categoriesMovie[0]['name']; ?></option>
                <?php } ?>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="category2">Catégorie 2</label>
            <select id="category2" name="category2" class="form-control">
                <?php if (!getValue('pressRating') || count($categoriesMovie) < 2) { ?>
                    <option value="" selected>--</option>
                <?php } else { ?>
                    <option value="<?= $categoriesMovie[1]['id']; ?>" selected><?= $categoriesMovie[1]['name']; ?></option>
                <?php } ?>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="category3">Catégorie 3</label>
            <select id="category3" name="category3" class="form-control">
                <?php if (!getValue('pressRating') || count($categoriesMovie) < 3) { ?>
                    <option value="" selected>--</option>
                <?php } else { ?>
                    <option value="<?= $categoriesMovie[2]['id']; ?>" selected><?= $categoriesMovie[2]['name']; ?></option>
                <?php } ?>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="poster">Affiche *</label>
        <input type="file" class="form-control <?= htmlspecialchars($errorMessage['poster']['class'], ENT_QUOTES, 'UTF-8'); ?>" id="poster" name="poster">
        <?= htmlspecialchars($errorMessage['poster']['message'], ENT_QUOTES, 'UTF-8'); ?>
    </div>
    <div class="form-group">
        <label for="trailer">Lien de la bande annonce</label>
        <input type="text" class="form-control <?= htmlspecialchars($errorMessage['trailer']['class'], ENT_QUOTES, 'UTF-8'); ?>" value="<?= htmlspecialchars(getValue('trailer'), ENT_QUOTES, 'UTF-8'); ?>" id="trailer" name="trailer">
        <?= htmlspecialchars($errorMessage['trailer']['message'], ENT_QUOTES, 'UTF-8'); ?>
    </div>
    <button type="submit" class="btn btn-primary mb-4 mt-3"><?= htmlspecialchars($pageInfo['button'], ENT_QUOTES, 'UTF-8'); ?></button>
</form>

<?php get_footer('admin'); ?>
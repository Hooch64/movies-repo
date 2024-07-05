<?php get_header('Liste des films', 'admin'); ?>

<h2>Liste des films</h2>

<form action="" method="get" class="d-flex mx-auto" style="width: 600px;">
    <input type="text" name="search" class="form-control mb-2" placeholder="Rechercher un film" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8') : '' ?>">
    <input type="submit" class="btn btn-secondary" style="height: 38px" value="Rechercher">
</form>

<a href="<?= $router->generate('moviesEdit') ?>" class="btn btn-success">Ajouter</a>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Titre</th>
            <th class="text-center" scope="col">Date de sortie</th>
            <th scope="col">Acteurs</th>
            <th scope="col">Réalisateur</th>
            <th scope="col">Durée</th>
            <th scope="col">Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($movies as $movie) {
            if (empty($_GET['search']) || (!empty($_GET['search']) && searchByName($movie['title'], htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8')))) { ?>
                <tr>
                    <td class="align-middle"><a href="https://movies.test/admin/film/editer/<?= htmlspecialchars($movie['id'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($movie['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                    <td class="text-center align-middle"><?= htmlspecialchars($movie['releaseDate'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="align-middle"><?= htmlspecialchars($movie['casting'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="align-middle"><?= htmlspecialchars($movie['director'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="text-center align-middle"><?= htmlspecialchars($movie['duration'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="text-center align-middle"><a href="<?= $router->generate('moviesDelete') . htmlspecialchars($movie['id'], ENT_QUOTES, 'UTF-8'); ?>" onclick="return confirm('êtes-vous sûr de vouloir supprimer <?= htmlspecialchars($movie['title'], ENT_QUOTES, 'UTF-8') ?> ?')"><img src="../../../public/images/trash-svgrepo-com.svg" alt="trash icon"></a></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>

<?php get_footer('admin'); ?>
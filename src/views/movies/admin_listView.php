<?php get_header('Liste des films', 'admin'); ?>

<h2>Liste des films</h2>

<form action="" method="get" class="d-flex mx-auto" style="width: 600px;">
    <input type="text" name="search" class="form-control mb-2" placeholder="Rechercher un film">
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
            if (empty($_GET['search']) || (!empty($_GET['search']) && searchByName($movie['title'], $_GET['search']))) { ?>
                <tr>
                    <td class="align-middle"><a href="https://movies.test/admin/film/editer/<?= $movie['id'] ?>"><?= $movie['title']; ?></a></td>
                    <td class="text-center align-middle"><?= $movie['releaseDate']; ?></td>
                    <td class="align-middle"><?= $movie['casting']; ?></td>
                    <td class="align-middle"><?= $movie['director']; ?></td>
                    <td class="text-center align-middle"><?= $movie['duration']; ?></td>
                    <td class="text-center align-middle"><a href="<?= $router->generate('moviesDelete') . $movie['id']; ?>" onclick="return confirm('êtes-vous sûr de vouloir supprimer <?= $movie['title'] ?> ?')"><img src="../../../public/images/trash-svgrepo-com.svg" alt="trash icon"></a></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>

<?php get_footer('admin'); ?>
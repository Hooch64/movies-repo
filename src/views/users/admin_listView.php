<?php
get_header('liste des utilisateurs', 'admin'); ?>

<h2>Liste des utilisateurs</h2>

<form action="" method="get" class="d-flex mx-auto" style="width: 600px;">
    <input type="text" name="search" class="form-control mb-2" placeholder="Rechercher un utilisateur">
    <input type="submit" class="btn btn-secondary" style="height: 38px" value="Rechercher">
</form>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Email</th>
            <th class="text-center" scope="col">Statut</th>
            <th scope="col">date de création du profil</th>
            <th scope="col">Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) {
            if (empty($_GET['search']) || (!empty($_GET['search']) && searchByName($user['email'], $_GET['search']))) { ?>
                <tr>
                    <td class="align-middle"><a href="https://movies.test/admin/film/editer/<?= $movie['id'] ?>"><?= $movie['title']; ?></a></td>
                    <td class="text-center align-middle"><?= $movie['releaseDate']; ?></td>
                    <td class="align-middle"><?= $movie['casting']; ?></td>
                    <td class="text-center align-middle"><a href="<?= $router->generate('moviesDelete') . $movie['id']; ?>" onclick="return confirm('êtes-vous sûr de vouloir supprimer <?= $movie['title'] ?> ?')"><img src="../../../public/images/trash-svgrepo-com.svg" alt="trash icon"></a></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>


<?php get_footer('admin'); ?>
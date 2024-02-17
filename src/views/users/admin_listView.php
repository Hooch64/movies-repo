<?php
get_header('Liste des utilisateurs', 'admin'); ?>

<h2>Liste des utilisateurs</h2>

<a href="<?= $router->generate('addUser') ?>" class="btn btn-success">Ajouter</a>

<form action="" method="get" class="d-flex mx-auto" style="width: 600px;">
    <input type="text" name="search" class="form-control mb-2" placeholder="Rechercher un utilisateur">
    <input type="submit" class="btn btn-secondary" style="height: 38px" value="Rechercher">
</form>

<table class="table table-striped table-hover container" style="width: 900px;">
    <thead>
        <tr>
            <th scope="col">Email</th>
            <th class="text-center" scope="col">Statut</th>
            <th scope="col">Date de création du profil</th>
            <th class="text-center" scope="col">Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) {
            if (empty($_GET['search']) || (!empty($_GET['search']) && searchByName($user->email, $_GET['search']))) { ?>
                <tr>
                    <td class="align-middle"><a href="<?= $router->generate('userEdit', ['id' =>  $user->id]); ?>"><?= htmlentities($user->email); ?></a></td>
                    <td class="text-center align-middle"><?= $user->role_id; ?></td>
                    <td class="align-middle"><?= $user->created; ?></td>
                    <td class="text-center align-middle"><a href="<?= $router->generate('deleteUser', ['id' =>  $user->id]); ?>" onclick="return confirm('êtes-vous sûr de vouloir supprimer <?= $user->email ?> ?')"><img src="../../../public/images/trash-svgrepo-com.svg" alt="trash icon"></a></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>


<?php get_footer('admin'); ?>
<?php
get_header('Liste des utilisateurs', 'admin'); ?>

<h2>Liste des utilisateurs</h2>

<a href="<?= $router->generate('addUser') ?>" class="btn btn-success">Ajouter</a>

<form action="" method="get" class="d-flex mx-auto" style="width: 600px;">
    <input type="text" name="search" class="form-control mb-2" placeholder="Rechercher un utilisateur" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8') : '' ?>">
    <input type="submit" class="btn btn-secondary" style="height: 38px" value="Rechercher">
</form>

<table class="table table-striped table-hover container" style="width: 900px;">
    <thead>
        <tr>
            <th scope="col">Email</th>
            <th class="text-center" scope="col">Pseudo</th>
            <th scope="col">Date de création du profil</th>
            <th class="text-center" scope="col">Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) {
            if (empty($_GET['search']) || (!empty($_GET['search']) && searchByName($user->email, htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8')))) { ?>
                <tr>
                    <td class="align-middle"><a href="<?= $router->generate('userEdit', ['id' =>  $user->id]); ?>"><?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></a></td>
                    <td class="text-center align-middle"><?= htmlspecialchars($user->pseudo, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="align-middle"><?= htmlspecialchars($user->created_at, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="text-center align-middle"><a href="<?= $router->generate('deleteUser', ['id' =>  $user->id]); ?>" onclick="return confirm('êtes-vous sûr de vouloir supprimer <?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?> ?')"><img src="../../../public/images/trash-svgrepo-com.svg" alt="trash icon"></a></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>

<?php get_footer('admin'); ?>
<?php
get_header('Liste des catégories', 'admin'); ?>

<h2>Liste des catégories</h2>

<a href="<?= $router->generate('editCategory') ?>" class="btn btn-success">Ajouter</a>

<form action="" method="get" class="d-flex mx-auto" style="width: 600px;">
    <input type="text" name="search" class="form-control mb-2" placeholder="Rechercher une catégorie" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8') : '' ?>">
    <input type="submit" class="btn btn-secondary" style="height: 38px" value="Rechercher">
</form>

<table class="table table-striped table-hover container" style="width: 900px;">
    <thead>
        <tr>
            <th scope="col">Catégorie</th>
            <th scope="col">Date de création de la catégorie</th>
            <th class="text-center" scope="col">Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category) {
            if (empty($_GET['search']) || (!empty($_GET['search']) && searchByName($category->name, htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8')))) { ?>
                <tr>
                    <td class="align-middle"><?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="align-middle"><?= htmlspecialchars($category->created_at, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="text-center align-middle"><a href="<?= $router->generate('deleteCategory', ['id' =>  $category->id]); ?>" onclick="return confirm('êtes-vous sûr de vouloir supprimer <?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?> ?')"><img src="../../../public/images/trash-svgrepo-com.svg" alt="trash icon"></a></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>

<?php get_footer('admin'); ?>
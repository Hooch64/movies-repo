<?php get_header('Créer une catégorie', 'admin'); ?>

<form class="container mt-5" style="max-width: 800px;" method="post" action="https://movies.test/admin/categories/editer">
    <h2 class="mb-4">Ajouter une catégorie</h2>
    <div class="row">
        <div class="form-group">
            <label for="category">Nouvelle catégorie</label>
            <input type="text" class="form-control <?= $errorMessage['class']; ?> mt-2" id="category" name="category">
            <?= $errorMessage['message']; ?>
        </div>
        <button type="submit" class="btn btn-primary mb-4 mt-3">Ajouter</button>
</form>

<?php get_footer('admin'); ?>
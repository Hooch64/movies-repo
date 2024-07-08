<?php get_header('Créer une catégorie', 'admin'); ?>

<form class="container mt-5" style="max-width: 800px;" method="post" action="https://movies.test/admin/categories/editer">
    <h2 class="mb-4">Ajouter une catégorie</h2>
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="row">
        <div class="form-group">
            <label for="category">Nouvelle catégorie</label>
            <input type="text" class="form-control <?= $errorMessage['class']; ?> mt-2" id="category" name="category" value="<?= htmlspecialchars(getValue('category'), ENT_QUOTES, 'UTF-8'); ?>">
            <?= $errorMessage['message']; ?>
        </div>
        <button type="submit" class="btn btn-primary mb-4 mt-3">Ajouter</button>
    </div>
</form>

<?php get_footer('admin'); ?>
<?php
if (isset($_SESSION['success'])) {
    $class = $_SESSION['success'] ? 'alert-success' : 'alert-danger';

    echo "<div class='alert $class'> {$_SESSION['msg']} </div>";

    unset($_SESSION['success']);
    unset($_SESSION['msg']);
}
?>

<?php if(!empty($_SESSION['errors'])): ?>

    <div class="alert alert-danger">
        <ul>
            <?php foreach($_SESSION['errors'] as $value): ?>
                <li><?= $value ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif; ?>

<form action="<?= BASE_URL_ADMIN . '&action=books-store' ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3 mt-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $_SESSION['old']['title'] ?? '' ?>">
    </div>

    <div class="mb-3 mt-3">
        <label for="category_id" class="form-label">Category:</label>

        <select class="form-control" id="category_id" name="category_id">
            <option value=""></option>
            <?php foreach ($categoryPluck as $id => $name): ?>

                <option value="<?= $id ?>" <?= $_SESSION['old']['category_id'] ?? '' == $id ? 'selected' : ''?>>
                    <?= $name ?>
                </option>

            <?php endforeach; ?>
        </select>

    </div>

    <div class="mb-3 mt-3">
        <label for="author" class="form-label">Author:</label>
        <input type="text" class="form-control" id="author" name="author" value="<?= $_SESSION['old']['author'] ?? ''?>">
    </div>
    <div class="mb-3 mt-3">
        <label for="published_year" class="form-label">Published Year:</label>
        <input type="number" class="form-control" id="published_year" name="published_year" value="<?= $_SESSION['old']['published_year'] ?? '' ?>">
    </div>
    <div class="mb-3">
        <label for="img_cover" class="form-label">Img Cover:</label>
        <input type="file" class="form-control" id="img_cover" name="img_cover">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>

    <a href="<?= BASE_URL_ADMIN . '&action=books-index' ?>" class="btn btn-info">Quay lại danh sách</a>
</form>

<?php
if (isset($_SESSION['old'])) {
    unset($_SESSION['old']);
}
?>
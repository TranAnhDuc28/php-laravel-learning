<?php
    if(isset($_SESSION['success'])) {
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

<form action="<?= BASE_URL_ADMIN . '&action=users-store' ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3 mt-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $_SESSION['old']['name'] ?? null ?>">
    </div>
    <div class="mb-3 mt-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= $_SESSION['old']['email'] ?? null ?>">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="text" class="form-control" id="password" name="password" value="<?= $_SESSION['old']['password'] ?? null ?>">
    </div>
    <div class="mb-3">
        <label for="avatar" class="form-label">Avatar:</label>
        <input type="file" class="form-control" id="avatar" name="avatar">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>

    <a href="<?= BASE_URL_ADMIN . '&action=users-index' ?>" class="btn btn-info">Quay lại danh sách</a>
</form>

<?php
    if (isset($_SESSION['old'])) {
        unset($_SESSION['old']);
    }
?>
<?php
if (isset($_SESSION['success'])) {
    $class = $_SESSION['success'] ? 'alert-success' : 'alert-danger';

    echo "<div class='alert $class'> {$_SESSION['msg']} </div>";
}
?>

<form action="<?= BASE_URL_ADMIN . '&action=login' ?>" method="post">
    <div class="mb-3 mt-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="mb-3 ">
        <label for="password" class="form-label">Password:</label>
        <div class="position-relative">
            <input type="password"
                   class="form-control show-password-input <?= isset($_SESSION['success']) ? 'is-invalid' : '' ?>"
                   id="password" name="password">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
unset($_SESSION['success']);
unset($_SESSION['msg']);
?>

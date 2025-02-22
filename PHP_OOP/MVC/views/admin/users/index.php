<div class="row my-3">
    <div class="col-12">
        <a class="btn btn-primary" href="<?= BASE_URL_ADMIN . '&action=users-create' ?>" role="button">Thêm mới</a>
    </div>
</div>

<?php
    if(isset($_SESSION['success'])) {
        $class = $_SESSION['success'] ? 'alert-success' : 'alert-danger';

        echo "<div class='alert $class'> {$_SESSION['msg']} </div>";

        // xóa key thông báo trong session
        unset($_SESSION['success']);
        unset($_SESSION['msg']);
    }
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>AVATAR</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $user): ?>
        <tr>
            <td><?= $user['id']; ?></td>
            <td>
                <?php if(!empty($user['avatar'])): ?>
                    <img src="<?= BASE_ASSETS_UPLOADS . $user['avatar']; ?>" alt="" width="100">
                <?php endif; ?>
            </td>
            <td><?= $user['name']; ?></td>
            <td><?= $user['email']; ?></td>
            <td class="d-flex justify-content-center gap-4">
                <a href="<?= BASE_URL_ADMIN . '&action=users-show&id=' . $user['id'] ?>" class="btn btn-info">Xem</a>
                <a href="<?= BASE_URL_ADMIN . '&action=users-edit&id=' . $user['id'] ?>" class="btn btn-warning">Sửa</a>
                <a href="<?= BASE_URL_ADMIN . '&action=users-delete&id=' . $user['id'] ?>" class="btn btn-danger" onclick="return confirm('Có chắc xóa không?')">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?? 'Admin Dashboard' ?></title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="<?= BASE_ASSETS_ADMIN . 'css/style.css' ?>" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
<!-- menu -->
<nav class="navbar navbar-expand-xxl bg-light justify-content-center">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-uppercase" href="<?= BASE_URL_ADMIN ?>"><b>Dashboard</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-uppercase" href="<?= BASE_URL_ADMIN . '&action=users-index' ?>"><b>Quản lý User</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-uppercase" href="<?= BASE_URL_ADMIN . '&action=books-index' ?>"><b>Quản lý Book</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-uppercase" href="<?= BASE_URL_ADMIN . '&action=change-password' ?>"><b>Test</b></a>
        </li>
        <?php if (!empty($_SESSION['user'])): ?>
            <li class="nav-item">
                <a class="nav-link text-uppercase text-danger"
                   href="<?= BASE_URL_ADMIN . '&action=logout' ?>"
                   onclick="return confirm('Bạn có chắc đăng xuất không?')"
                >
                    <b>Đăng xuất</b></a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

<!-- main content -->
<div class="container">
    <h1 class="mt-3 mb-3"><?= $title ?? 'Admin Dashboard' ?></h1>

    <div class="row">
        <?php
        if (isset($view)) {
//            echo PATH_VIEW_ADMIN . $view;
//            die;
            require_once PATH_VIEW_ADMIN . $view . '.php';
        }
        ?>
    </div>
</div>

<script src="<?= BASE_ASSETS_ADMIN . 'js/main.js' ?>"></script>

</body>
</html>

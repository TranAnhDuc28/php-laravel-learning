<table class="table">
    <thead>
    <tr>
        <th>TRƯỜNG DỮ LIỆU</th>
        <th>GIÁ TRỊ</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($user as $key => $value): ?>
        <tr>
            <td><?= strtoupper($key) ?></td>
            <td>
                <?php
                if ($key == 'avatar') {
                    if (!empty($value)) {
                        $link = BASE_ASSETS_UPLOADS . $value;
                        echo '<img src="' . BASE_ASSETS_UPLOADS . $value . '" alt="" width="100">';
                    }

                } else {
                    echo $value;
                }
                ?>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<div>
    <a href="<?= BASE_URL_ADMIN . '&action=users-index' ?>" class="btn btn-info">Quay lại danh sách</a>
</div>

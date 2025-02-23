<table class="table">
    <tr>
        <th>TRƯỜNG DỮ LIỆU</th>
        <th>GIÁ TRỊ</th>
    </tr>

    <?php foreach ($book as $key => $value): ?>
        <tr>
            <td><?= strtoupper($key) ?></td>
            <td>
                <?php
                if ($key == 'b_img_cover') {
                    if (!empty($value)) {
                        $link = BASE_ASSETS_UPLOADS . $value;
                        echo "<img src='$link' width='100px' alt=''>";
                    }

                } else {
                    echo $value;
                }
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<div>
    <a href="<?= BASE_URL_ADMIN . '&action=books-index' ?>" class="btn btn-info">Quay lại danh sách</a>
</div>

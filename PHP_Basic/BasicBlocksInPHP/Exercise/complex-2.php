<?php

$classes = [
    [
        "class_name" => "Lớp 10A1",
        "students" => [
            ["name" => "Anh", "age" => 16, "score" => 8.5],
            ["name" => "Bình", "age" => 17, "score" => 9.0],
            ["name" => "Châu", "age" => 16, "score" => 6.5],
            ["name" => "Dương", "age" => 17, "score" => 7.0]
        ]
    ],
    [
        "class_name" => "Lớp 10A2",
        "students" => [
            ["name" => "Hoàng", "age" => 16, "score" => 9.5],
            ["name" => "Minh", "age" => 16, "score" => 5.0],
            ["name" => "Lan", "age" => 17, "score" => 7.5],
            ["name" => "Tùng", "age" => 16, "score" => 6.0]
        ]
    ]
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <style>
        .class {
            margin-bottom: 20px;
        }

        .student {
            margin-left: 20px;
            padding: 5px;
        }

        .excellent {
            font-weight: bold;
            color: green;
        }

        .average {
            color: orange;
        }

        .fail {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Danh sách lớp học và học sinh</h1>
    <div class="class-list">
        <?php foreach ($classes as $class): ?>
            <h2><?= $class['class_name'] ?></h2>

            <ul>
                <?php foreach ($class['students'] as $student): ?>
                    
                    <?php 
                        // Phân loại học sinh dựa trên điểm số
                        $status = '';
                        if ($student['score'] >= 9):
                            $status = 'excellent';
                        elseif ($student['score'] >= 7):
                            $status = 'average';
                        else:
                            $status = 'fail';
                        endif;
                    ?>

                    <li class="student <?= $status; ?>">

                        <?= $student['name'] ?>
                        (<?= $student['age'] ?> tuổi) - Điểm: <?php echo $student['score'] ?>
                        
                        <?php if($student['score'] >= 9): ?>
                            - <strong>Xuất sắc</strong>
                        <?php elseif($student['score'] >= 7): ?>
                            - Khá
                        <?php else: ?>
                            - <em>Yếu</em>
                        <?php endif; ?>


                    </li>


                <?php endforeach; ?>
            </ul>

        <?php endforeach; ?>

    </div>

</body>

</html>
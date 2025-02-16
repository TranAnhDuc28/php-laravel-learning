<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
</head>

<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="avatar">Chọn file để upload:</label>

        <input type="file" name="avatar" id="avatar">

        <input type="submit" value="Upload File" name="submit">
    </form>
</body>

</html>
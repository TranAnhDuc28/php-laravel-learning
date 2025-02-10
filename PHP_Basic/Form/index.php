<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM</title>
</head>
<body>

    <h1>FORM GET</h1>

    <form action="./get.php" method="get" enctype="multipart/form-data">
        <label for="username">Username</label>
        <input type="text" name="username">
        <br><br>
        <label for="password">Password</label>
        <input type="password" name="password">
        <br><br>
        <label for="avatar">Avatar</label>
        <input type="file" name="avatar">

        <button type="submit">Submit</button>
    </form>

    <br><br>

    <h1>FORM POST</h1>

    <form action="./post.php" method="post" enctype="multipart/form-data">
        <label for="username">Username</label>
        <input type="text" name="username">
        <br><br>
        <label for="password">Password</label>
        <input type="password" name="password">
        <br><br>
        <label for="avatar">Avatar</label>
        <input type="file" name="avatar">

        <button type="submit">Submit</button>
    </form>
</body>
</html>
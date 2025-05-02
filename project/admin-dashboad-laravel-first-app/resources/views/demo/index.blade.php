<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redux Toolkit API Call</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        button {
            padding: 10px 20px;
            margin-bottom: 10px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            padding: 5px 0;
        }

        .error {
            color: red;
        }

        .loading {
            color: blue;
        }
    </style>
</head>
<body>
<h1>Users List</h1>
<button id="fetchUsers">Fetch Users</button>
<div id="status"></div>
<ul id="usersList"></ul>

@vite('resources/js/demo/index.js')
</body>
</html>

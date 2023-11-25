<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/connection.php";

    $username = $mysqli->real_escape_string($_POST["username"]);
    $password = $_POST["password"];

    // Check if the login is for admin
    if ($username === "admin" && $password === "admin") {
        session_start();
        $_SESSION["user_id"] = "admin";
        header("location: mainadmin.php");
        exit;
    }

    $sql = sprintf("SELECT * FROM pengunjung
            WHERE email = '%s'",
            $mysqli->real_escape_string($username));

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    if ($user) {
        if (password_verify($password, $user["password_hash"])) {
            session_start();
            $_SESSION["user_id"] = $user["id_anggota"];
            header("location: main.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    
    <h1> Admin</h1>

    <form method="post">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button>Login</button>
    </form>

    <p> Note : untuk username dan passwordnya itu "admin"</p>

</body>
</html>
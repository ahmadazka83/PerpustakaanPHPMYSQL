<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/connection.php";

    $sql = sprintf("SELECT * FROM pengunjung
            WHERE email = '%s'",
            $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
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
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="/js/validation.js" defer></script>
</head>
<body>
    
    <h1>Login</h1>

    <form method="post">
        <label for="email">email</label>
        <input type="email" id="email" name="email">

        <label for="password">Password</label>
        <input type="password" id="password" name="password">

        <button>Login</button>

        <br>
        <label for="login">Belum memiliki akun?</label>
        <a href="signup.html">Daftar</a>
    </form>

</body>
</html>
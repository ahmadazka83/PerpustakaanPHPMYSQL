<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit;
}

$mysqli = require __DIR__ . "/connection.php";

$sql = "SELECT * FROM pengunjung
        WHERE id_anggota = {$_SESSION["user_id"]}";

$result = $mysqli->query($sql);

$user = $result->fetch_assoc();

if (!$user) {
    die("User not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Profile</h1>

    <p>Nama  : <?= htmlspecialchars($user["nama"]) ?></p>
    <p>Email : <?= htmlspecialchars($user["email"]) ?></p>
    <p>NIK: <?= htmlspecialchars($user["NIK"]) ?></p>
    <p>Alamat: <?= htmlspecialchars($user["Alamat"]) ?></p>
    <p>Umur: <?= htmlspecialchars($user["Umur"]) ?></p>
    <p>Jenis Kelamin: <?= htmlspecialchars($user["jenis_kelamin"]) ?></p>
    <br>
    <p><a href="updateprofile.php">Update Profile</a></p>
    <p><a href="main.php">Menu</a></p>
</body>
</html>

<?php
session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] !== "admin") {
    header("location: loginadmin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Main Admin Page</h1>

    <p><a href="bukuadmin.php">Buku</a></p>
    <p><a href="peminjamanadmin.php">Peminjaman</a></p>
    <p><a href="kategoriadmin.php">Kategori</a></p>
    <p><a href="penerbitadmin.php">Penerbit</a></p>
    <p><a href="anggotaadmin.php">Anggota</a></p>
    <p><a href="pengunjungadmin.php">Pengunjung</a></p>
    <p><a href="adminadmin.php">Admin</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>

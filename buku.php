<?php
$mysqli = require __DIR__ . "/connection.php";

$sql = "SELECT buku.no_buku, buku.judul, buku.ID_penerbit, penerbit.Nama_penerbit, buku.tahun_terbit, kategori.Jenis
        FROM buku
        JOIN kategori ON buku.no_kategori = kategori.no_kategori
        JOIN penerbit ON buku.ID_penerbit = penerbit.ID_penerbit";

$result = $mysqli->query($sql);

if (!$result) {
    die("Query error: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Daftar Buku</h1>
    <p><a href="main.php">Kembali</a></p>
    <table>
        <thead>
            <tr>
                <th>No. Buku</th>
                <th>Judul</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['no_buku']) ?></td>
                    <td><?= htmlspecialchars($row['judul']) ?></td>
                    <td><?= htmlspecialchars($row['Nama_penerbit']) ?></td>
                    <td><?= htmlspecialchars($row['tahun_terbit']) ?></td>
                    <td><?= htmlspecialchars($row['Jenis']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

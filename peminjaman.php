<?php
$mysqli = require __DIR__ . "/connection.php";

session_start();

// Ambil ID anggota dari sesi atau formulir
$id_anggota = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : (isset($_GET["id_anggota"]) ? $_GET["id_anggota"] : null);

if (!$id_anggota) {
    die("ID anggota tidak valid");
}

// Ambil data peminjaman untuk anggota tertentu
$sql = "SELECT peminjaman.ID_peminjaman, peminjaman.Tanggal_pinjam, peminjaman.Tanggal_kembali, peminjaman.Tarif_denda, peminjaman.Keterangan_denda, buku.judul
        FROM peminjaman
        JOIN buku ON peminjaman.no_buku = buku.no_buku
        WHERE peminjaman.ID_anggota = '$id_anggota'";

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
    <title>Daftar Peminjaman</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Daftar Peminjaman</h1>

    <p><a href="main.php">Kembali ke Halaman Utama</a></p>

    <p>ID Anggota: <?= htmlspecialchars($id_anggota) ?></p>

    <table>
        <thead>
            <tr>
                <th>ID Peminjaman</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Tarif Denda</th>
                <th>Keterangan Denda</th>
                <th>Judul Buku</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['ID_peminjaman']) ?></td>
                    <td><?= htmlspecialchars($row['Tanggal_pinjam']) ?></td>
                    <td><?= htmlspecialchars($row['Tanggal_kembali']) ?></td>
                    <td><?= htmlspecialchars($row['Tarif_denda']) ?></td>
                    <td><?= htmlspecialchars($row['Keterangan_denda']) ?></td>
                    <td><?= htmlspecialchars($row['judul']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

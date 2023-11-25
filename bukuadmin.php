<?php
$mysqli = require __DIR__ . "/connection.php";

// Proses Tambah Buku
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
    if ($_POST["action"] === "add") {
        // Proses penambahan buku
        $no_buku = $mysqli->real_escape_string($_POST["no_buku"]);
        $judul = $mysqli->real_escape_string($_POST["judul"]);
        $ID_penerbit = $mysqli->real_escape_string($_POST["ID_penerbit"]);
        $tahun_terbit = (int)$_POST["tahun_terbit"];
        $no_kategori = $mysqli->real_escape_string($_POST["no_kategori"]);

        $sqlInsert = "INSERT INTO buku (no_buku, judul, ID_penerbit, tahun_terbit, no_kategori) VALUES ('$no_buku','$judul', '$ID_penerbit', $tahun_terbit, '$no_kategori')";
        $resultInsert = $mysqli->query($sqlInsert);

        if (!$resultInsert) {
            die("Error: " . $mysqli->error);
        }
    }

    // Proses Hapus Buku
    elseif ($_POST["action"] === "delete") {
        // Proses penghapusan buku
        $no_buku = $mysqli->real_escape_string($_POST["no_buku"]);

        $sqlDelete = "DELETE FROM buku WHERE no_buku='$no_buku'";
        $resultDelete = $mysqli->query($sqlDelete);

        if (!$resultDelete) {
            die("Error: " . $mysqli->error);
        }
    }
}

// Ambil data buku
$sqlSelect = "SELECT buku.no_buku, buku.judul, buku.ID_penerbit, penerbit.Nama_penerbit, buku.tahun_terbit, kategori.Jenis
              FROM buku
              JOIN kategori ON buku.no_kategori = kategori.no_kategori
              JOIN penerbit ON buku.ID_penerbit = penerbit.ID_penerbit";

$resultSelect = $mysqli->query($sqlSelect);

if (!$resultSelect) {
    die("Query error: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

<!-- Formulir Tambah Buku -->
<h1>Buku</h1>
<p><a href="mainadmin.php">Kembali ke Halaman Admin</a></p>

<h2>Tambah Buku</h2>
<form method="post" action="">
    <input type="hidden" name="action" value="add">
    <label for="judul">No Buku:</label>
    <input type="text" id="no_buku" name="no_buku" required>
    <label for="judul">Judul:</label>
    <input type="text" id="judul" name="judul" required>
    <label for="ID_penerbit">ID Penerbit:</label>
    <input type="text" id="ID_penerbit" name="ID_penerbit" required>
    <label for="tahun_terbit">Tahun Terbit:</label>
    <input type="number" id="tahun_terbit" name="tahun_terbit" required>
    <label for="no_kategori">No. Kategori:</label>
    <input type="text" id="no_kategori" name="no_kategori" required>
    <button type="submit">Tambah</button>
</form>

<h1>Daftar Buku </h1>
<table>
    <thead>
    <tr>
        <th>No. Buku</th>
        <th>Judul</th>
        <th>ID Penerbit</th>
        <th>Nama Penerbit</th>
        <th>Tahun Terbit</th>
        <th>Kategori</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = $resultSelect->fetch_assoc()) : ?>
        <tr>
            <td><?= htmlspecialchars($row['no_buku']) ?></td>
            <td><?= htmlspecialchars($row['judul']) ?></td>
            <td><?= htmlspecialchars($row['ID_penerbit']) ?></td>
            <td><?= htmlspecialchars($row['Nama_penerbit']) ?></td>
            <td><?= htmlspecialchars($row['tahun_terbit']) ?></td>
            <td><?= htmlspecialchars($row['Jenis']) ?></td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="no_buku" value="<?= htmlspecialchars($row['no_buku']) ?>">
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>

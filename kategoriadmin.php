<?php
$mysqli = require __DIR__ . "/connection.php";

// Proses Tambah Kategori
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
    if ($_POST["action"] === "add") {
        // Proses penambahan kategori
        $no_kategori = $mysqli->real_escape_string($_POST["no_kategori"]);
        $jenis_kategori = $mysqli->real_escape_string($_POST["jenis_kategori"]);

        $sqlInsert = "INSERT INTO kategori (no_kategori, Jenis) VALUES ('$no_kategori', '$jenis_kategori')";
        $resultInsert = $mysqli->query($sqlInsert);

        if (!$resultInsert) {
            die("Error: " . $mysqli->error);
        }
    } elseif ($_POST["action"] === "delete") {
        // Proses penghapusan kategori
        $no_kategori = $mysqli->real_escape_string($_POST["no_kategori"]);

        $sqlDelete = "DELETE FROM kategori WHERE no_kategori='$no_kategori'";
        $resultDelete = $mysqli->query($sqlDelete);

        if (!$resultDelete) {
            die("Error: " . $mysqli->error);
        }
    }
}

// Ambil data kategori
$sqlSelect = "SELECT * FROM kategori";
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
    <title>Manajemen Kategori</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Kategori</h1>

    <p><a href="mainadmin.php">Kembali ke Halaman Admin</a></p>

    <!-- Formulir Tambah Kategori -->
    <h2>Tambah Kategori</h2>
    <form method="post" action="">
        <input type="hidden" name="action" value="add">
        <label for="no_kategori">Nomor Kategori:</label>
        <input type="text" id="no_kategori" name="no_kategori" required>
        <label for="jenis_kategori">Jenis Kategori:</label>
        <input type="text" id="jenis_kategori" name="jenis_kategori" required>
        <button type="submit">Tambah</button>
    </form>

    <!-- Tabel Daftar Kategori -->
    <h2>Daftar Kategori</h2>
    <table>
        <thead>
            <tr>
                <th>Nomor Kategori</th>
                <th>Jenis Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultSelect->fetch_assoc()) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['no_kategori']) ?></td>
                    <td><?= htmlspecialchars($row['Jenis']) ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="no_kategori" value="<?= htmlspecialchars($row['no_kategori']) ?>">
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

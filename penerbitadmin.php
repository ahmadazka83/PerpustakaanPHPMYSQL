<?php
$mysqli = require __DIR__ . "/connection.php";

// Proses Tambah Penerbit
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
    if ($_POST["action"] === "add") {
        // Proses penambahan penerbit
        $ID_penerbit = $mysqli->real_escape_string($_POST["ID_penerbit"]);
        $Nama_penerbit = $mysqli->real_escape_string($_POST["Nama_penerbit"]);

        $sqlInsert = "INSERT INTO penerbit (ID_penerbit, Nama_penerbit) VALUES ('$ID_penerbit', '$Nama_penerbit')";
        $resultInsert = $mysqli->query($sqlInsert);

        if (!$resultInsert) {
            die("Error: " . $mysqli->error);
        }
    } elseif ($_POST["action"] === "delete") {
        // Proses penghapusan penerbit
        $ID_penerbit = $mysqli->real_escape_string($_POST["ID_penerbit"]);

        $sqlDelete = "DELETE FROM penerbit WHERE ID_penerbit='$ID_penerbit'";
        $resultDelete = $mysqli->query($sqlDelete);

        if (!$resultDelete) {
            die("Error: " . $mysqli->error);
        }
    }
}

// Ambil data penerbit
$sqlSelect = "SELECT * FROM penerbit";
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
    <title>Manajemen Penerbit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Penerbit</h1>

    <p><a href="mainadmin.php">Kembali ke Halaman Admin</a></p>

    <!-- Formulir Tambah Penerbit -->
    <h2>Tambah Penerbit</h2>
    <form method="post" action="">
        <input type="hidden" name="action" value="add">
        <label for="ID_penerbit">ID Penerbit:</label>
        <input type="text" id="ID_penerbit" name="ID_penerbit" required>
        <label for="Nama_penerbit">Nama Penerbit:</label>
        <input type="text" id="Nama_penerbit" name="Nama_penerbit" required>
        <button type="submit">Tambah</button>
    </form>

    <!-- Tabel Daftar Penerbit -->
    <h2>Daftar Penerbit</h2>
    <table>
        <thead>
            <tr>
                <th>ID Penerbit</th>
                <th>Nama Penerbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultSelect->fetch_assoc()) : ?>
                <tr>
                <td><?= isset($row['ID_penerbit']) ? htmlspecialchars($row['ID_penerbit']) : '' ?></td>
                <td><?= isset($row['Nama_penerbit']) ? htmlspecialchars($row['Nama_penerbit']) : '' ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="ID_penerbit" value="<?= htmlspecialchars($row['ID_penerbit']) ?>">
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

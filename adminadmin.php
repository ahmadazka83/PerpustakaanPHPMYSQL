<?php
$mysqli = require __DIR__ . "/connection.php";

// Menampilkan daftar admin
$sqlSelect = "SELECT * FROM Admin";
$resultSelect = $mysqli->query($sqlSelect);

if (!$resultSelect) {
    die("Query error: " . $mysqli->error);
}

// Proses Tambah Admin dan Hapus Admin
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
    if ($_POST["action"] === "add") {
        // Proses penambahan Admin
        $ID_admin = $mysqli->real_escape_string($_POST["ID_admin"]);
        $nama = $mysqli->real_escape_string($_POST["nama"]);
        $ID_peminjaman = $mysqli->real_escape_string($_POST["ID_peminjaman"]);

        $sqlInsert = "INSERT INTO Admin (ID_admin, nama, ID_peminjaman) 
                      VALUES ('$ID_admin', '$nama', '$ID_peminjaman')";
        $resultInsert = $mysqli->query($sqlInsert);

        if (!$resultInsert) {
            die("Error: " . $mysqli->error);
        }
    } elseif ($_POST["action"] === "delete") {
        // Proses penghapusan Admin
        $id_admin_delete = $mysqli->real_escape_string($_POST["id_admin_delete"]);

        $sqlDelete = "DELETE FROM Admin WHERE ID_admin='$id_admin_delete'";
        $resultDelete = $mysqli->query($sqlDelete);

        if (!$resultDelete) {
            die("Error: " . $mysqli->error);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Admin</h1>
    <p><a href="mainadmin.php">Kembali ke Halaman Admin</a></p>

    <!-- Tambah Admin Form -->
    <h2>Tambah Admin</h2>
    <form method="post" action="">
        <input type="hidden" name="action" value="add">
        <label for="ID_admin">ID admin:</label>
        <input type="text" id="ID_admin" name="ID_admin" required>
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>
        <label for="ID_peminjaman">ID Peminjaman:</label>
        <input type="text" id="ID_peminjaman" name="ID_peminjaman" required>
        <button type="submit">Tambah</button>
    </form>

    <!-- Daftar admin Table -->
    <h2>Daftar Admin</h2>
    <table>
        <thead>
            <tr>
                <th>ID Admin</th>
                <th>Nama</th>
                <th>ID Peminjaman</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultSelect->fetch_assoc()) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['ID_admin']) ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['ID_peminjaman']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Hapus Admin Form -->
    <h2>Hapus Admin</h2>
    <form method="post" action="">
        <input type="hidden" name="action" value="delete">
        <label for="id_admin_delete">ID Admin:</label>
        <input type="text" id="id_admin_delete" name="id_admin_delete" required>
        <button type="submit">Hapus Admin</button>
    </form>
</body>
</html>

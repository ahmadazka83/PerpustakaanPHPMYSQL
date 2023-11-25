<?php
$mysqli = require __DIR__ . "/connection.php";

// Ambil data anggota
$sqlAnggota = "SELECT id_anggota, nama FROM pengunjung";
$resultAnggota = $mysqli->query($sqlAnggota);

if (!$resultAnggota) {
    die("Query error: " . $mysqli->error);
}

// Proses Tambah Pengunjung
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
    if ($_POST["action"] === "add") {
        // Proses penambahan pengunjung
        $id_anggota = $mysqli->real_escape_string($_POST["id_anggota"]);
        $email = $mysqli->real_escape_string($_POST["email"]);
        $nama = $mysqli->real_escape_string($_POST["nama"]);
        $nik = $mysqli->real_escape_string($_POST["nik"]);
        $alamat = $mysqli->real_escape_string($_POST["alamat"]);
        $umur = (int)$_POST["umur"];
        $jenis_kelamin = $mysqli->real_escape_string($_POST["jenis_kelamin"]);

        $sqlInsert = "INSERT INTO pengunjung (id_anggota, email, nama, nik, alamat, umur, jenis_kelamin) 
                      VALUES ('$id_anggota', '$email', '$nama', '$nik', '$alamat', $umur, '$jenis_kelamin')";
        $resultInsert = $mysqli->query($sqlInsert);

        if (!$resultInsert) {
            die("Error: " . $mysqli->error);
        }
        
    }

    // Proses Hapus Pengunjung
    elseif ($_POST["action"] === "delete") {
        // Proses penghapusan pengunjung
        $id_anggota_delete = $mysqli->real_escape_string($_POST["id_anggota_delete"]);

        $sqlDelete = "DELETE FROM pengunjung WHERE id_anggota='$id_anggota_delete'";
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
    <title>Manajemen Pengunjung</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1> Anggota</h1>

    <p><a href="mainadmin.php">Kembali ke Halaman Admin</a></p>

    <h2>Daftar Anggota</h2>
    <table>
        <thead>
            <tr>
                <th>ID Anggota</th>
                <th>Nama</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($rowAnggota = $resultAnggota->fetch_assoc()) : ?>
                <tr>
                    <td><?= htmlspecialchars($rowAnggota['id_anggota']) ?></td>
                    <td><?= htmlspecialchars($rowAnggota['nama']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h2>Hapus Anggota</h2>
    <form method="post" action="">
        <input type="hidden" name="action" value="delete">
        <label for="id_anggota_delete">ID Anggota:</label>
        <input type="text" id="id_anggota_delete" name="id_anggota_delete" required>
        <button type="submit">Hapus Anggota</button>
    </form>

</body>
</html>

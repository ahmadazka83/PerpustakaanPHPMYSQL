<?php
$mysqli = require __DIR__ . "/connection.php";

// Menampilkan daftar pengunjung
$sqlSelect = "SELECT * FROM Pengunjungperpus";
$resultSelect = $mysqli->query($sqlSelect);

if (!$resultSelect) {
    die("Query error: " . $mysqli->error);
}

// Proses Tambah Pengunjung
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
    if ($_POST["action"] === "add") {
        // Proses penambahan pengunjung
        $nik = $mysqli->real_escape_string($_POST["nik"]);
        $nama = $mysqli->real_escape_string($_POST["nama"]);
        $alamat = $mysqli->real_escape_string($_POST["alamat"]);
        $email = $mysqli->real_escape_string($_POST["email"]);
        $umur = (int)$_POST["umur"];
        $jenis_kelamin = $mysqli->real_escape_string($_POST["jenis_kelamin"]);

        $sqlInsert = "INSERT INTO Pengunjungperpus (NIK, nama, Alamat, email, Umur, jenis_Kelamin) 
                      VALUES ('$nik', '$nama', '$alamat', '$email', $umur, '$jenis_kelamin')";
        $resultInsert = $mysqli->query($sqlInsert);

        if (!$resultInsert) {
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
    <title>Daftar Pengunjung</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Pengunjung</h1>
    <p><a href="mainadmin.php">Kembali ke Halaman Admin</a></p>

    <!-- Tambah Pengunjung Form -->
    <h2>Tambah Pengunjung</h2>
    <form method="post" action="">
        <input type="hidden" name="action" value="add">
        <label for="nik">NIK:</label>
        <input type="text" id="nik" name="nik" required>
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>
        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="umur">Umur:</label>
        <input type="number" id="umur" name="umur" required>
        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
        <button type="submit">Tambah</button>
    </form>

    <!-- Daftar Pengunjung Table -->
    <h2>Daftar Pengunjung</h2>
    <table>
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Umur</th>
                <th>Jenis Kelamin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultSelect->fetch_assoc()) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['NIK']) ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['Alamat']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['Umur']) ?></td>
                    <td><?= htmlspecialchars($row['jenis_Kelamin']) ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="NIK" value="<?= htmlspecialchars($row['NIK']) ?>">
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php
    // Proses Hapus Pengunjung
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
        if ($_POST["action"] === "delete") {
            // Proses penghapusan pengunjung
            $NIK = $mysqli->real_escape_string($_POST["NIK"]);

            $sqlDelete = "DELETE FROM Pengunjungperpus WHERE NIK='$NIK'";
            $resultDelete = $mysqli->query($sqlDelete);

            if (!$resultDelete) {
                die("Error: " . $mysqli->error);
            }
        }
    }

    $mysqli->close();
    ?>
</body>
</html>

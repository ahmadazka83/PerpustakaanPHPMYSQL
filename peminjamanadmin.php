<?php
$mysqli = require __DIR__ . "/connection.php";

// Proses Tambah Peminjaman
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
    if ($_POST["action"] === "add") {
        // Proses penambahan peminjaman
        $ID_peminjaman = $mysqli->real_escape_string($_POST["ID_peminjaman"]);
        $tanggal_pinjam = $mysqli->real_escape_string($_POST["tanggal_pinjam"]);
        $tanggal_kembali = $mysqli->real_escape_string($_POST["tanggal_kembali"]);
        $tarif_denda = (int)$_POST["tarif_denda"];
        $keterangan_denda = $mysqli->real_escape_string($_POST["keterangan_denda"]);
        $id_anggota = $mysqli->real_escape_string($_POST["id_anggota"]);
        $no_buku = $mysqli->real_escape_string($_POST["no_buku"]);

        $sqlInsert = "INSERT INTO peminjaman (ID_peminjaman, Tanggal_pinjam, Tanggal_kembali, Tarif_denda, Keterangan_denda, ID_anggota, no_buku) VALUES ('$ID_peminjaman', '$tanggal_pinjam', '$tanggal_kembali', $tarif_denda, '$keterangan_denda', '$id_anggota', '$no_buku')";
        $resultInsert = $mysqli->query($sqlInsert);

        if (!$resultInsert) {
            die("Error: " . $mysqli->error);
        }
    }

    // Proses Hapus peminjaman
    elseif ($_POST["action"] === "delete") {
        // Proses penghapusan peminjaman
        $ID_peminjaman = $mysqli->real_escape_string($_POST["ID_peminjaman"]);

        $sqlDelete = "DELETE FROM peminjaman WHERE ID_peminjaman='$ID_peminjaman'";
        $resultDelete = $mysqli->query($sqlDelete);

        if (!$resultDelete) {
            die("Error: " . $mysqli->error);
        }
    }
}

// Ambil data anggota dan buku
$sqlAnggota = "SELECT id_anggota, nama FROM pengunjung";
$resultAnggota = $mysqli->query($sqlAnggota);

$sqlBuku = "SELECT no_buku, judul FROM buku";
$resultBuku = $mysqli->query($sqlBuku);

// Ambil data peminjaman
$sqlPeminjaman = "SELECT peminjaman.ID_peminjaman, peminjaman.Tanggal_pinjam, peminjaman.Tanggal_kembali, peminjaman.Tarif_denda, peminjaman.Keterangan_denda, pengunjung.nama AS nama_anggota, buku.judul
        FROM peminjaman
        JOIN pengunjung ON peminjaman.ID_anggota = pengunjung.id_anggota
        JOIN buku ON peminjaman.no_buku = buku.no_buku";

$resultPeminjaman = $mysqli->query($sqlPeminjaman);

if (!$resultPeminjaman) {
    die("Query error: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Peminjaman</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Peminjaman</h1>

    <p><a href="mainadmin.php">Kembali ke Halaman Admin</a></p>

    <!-- Formulir Tambah Peminjaman -->

    <h2>Tambah Peminjaman</h2>

    <form method="post" action="">
        <input type="hidden" name="action" value="add">
        <label for="ID_peminjaman">ID Peminjaman:</label>
        <input type="text" id="ID_peminjaman" name="ID_peminjaman" required>
        <label for="tanggal_pinjam">Tanggal Pinjam:</label>
        <input type="text" id="tanggal_pinjam" name="tanggal_pinjam" required>
        <label for="tanggal_kembali">Tanggal Kembali:</label>
        <input type="text" id="tanggal_kembali" name="tanggal_kembali" required>
        <label for="tarif_denda">Tarif Denda:</label>
        <input type="number" id="tarif_denda" name="tarif_denda" required>
        <label for="keterangan_denda">Keterangan Denda:</label>
        <input type="text" id="keterangan_denda" name="keterangan_denda" required>
        <label for="id_anggota">Nama Anggota:</label>
        <select id="id_anggota" name="id_anggota" required>
            <?php while ($rowAnggota = $resultAnggota->fetch_assoc()) : ?>
                <option value="<?= htmlspecialchars($rowAnggota['id_anggota']) ?>"><?= htmlspecialchars($rowAnggota['nama']) ?></option>
            <?php endwhile; ?>
        </select>
        <label for="no_buku">Judul Buku:</label>
        <select id="no_buku" name="no_buku" required>
            <?php while ($rowBuku = $resultBuku->fetch_assoc()) : ?>
                <option value="<?= htmlspecialchars($rowBuku['no_buku']) ?>"><?= htmlspecialchars($rowBuku['judul']) ?></option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Tambah</button>
    </form>

    <!-- Tabel Daftar Peminjaman -->
    <h2>Daftar Peminjaman</h2>
    <table>
        <thead>
            <tr>
                <th>ID Peminjaman</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Tarif Denda</th>
                <th>Keterangan Denda</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($rowPeminjaman = $resultPeminjaman->fetch_assoc()) : ?>
                <tr>
                    <td><?= htmlspecialchars($rowPeminjaman['ID_peminjaman']) ?></td>
                    <td><?= htmlspecialchars($rowPeminjaman['Tanggal_pinjam']) ?></td>
                    <td><?= htmlspecialchars($rowPeminjaman['Tanggal_kembali']) ?></td>
                    <td><?= htmlspecialchars($rowPeminjaman['Tarif_denda']) ?></td>
                    <td><?= htmlspecialchars($rowPeminjaman['Keterangan_denda']) ?></td>
                    <td><?= htmlspecialchars($rowPeminjaman['nama_anggota']) ?></td>
                    <td><?= htmlspecialchars($rowPeminjaman['judul']) ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="ID_peminjaman" value="<?= htmlspecialchars($rowPeminjaman['ID_peminjaman']) ?>">
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

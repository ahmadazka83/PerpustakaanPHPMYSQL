<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit;
}

$mysqli = require __DIR__ . "/connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $sql = "UPDATE pengunjung
            SET nama = ?, NIK = ?, Alamat = ?, Umur = ?, Jenis_Kelamin = ?
            WHERE id_anggota = ?";

    $stmt = $mysqli->stmt_init();

    if (!$stmt->prepare($sql)) {
        die("SQL error: " . $mysqli->error);
    }

    $stmt->bind_param("sssssi", $_POST["nama"],$_POST["NIK"], $_POST["Alamat"], $_POST["Umur"], $_POST["Jenis_Kelamin"], $_SESSION["user_id"]);

    if ($stmt->execute()) {
        header("location: profile.php");
        exit;
    } else {
        die("Error updating profile: " . $mysqli->error);
    }
} 
else {
   
    $sql = "SELECT * FROM pengunjung
            WHERE id_anggota = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if (!$user) {
        die("User not found");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Update Profile</h1>

    <form method="post">
        <label for="nama">Name</label>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($user["nama"]) ?>">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user["email"]) ?>">

        <label for="NIK">NIK</label>
        <input type="text" id="NIK" name="NIK" value="<?= htmlspecialchars($user["NIK"]) ?>">

        <label for="Alamat">Alamat</label>
        <input type="text" id="Alamat" name="Alamat" value="<?= htmlspecialchars($user["Alamat"]) ?>">

        <label for="Umur">Umur</label>
        <input type="number" id="Umur" name="Umur" value="<?= htmlspecialchars($user["Umur"]) ?>">

        <label for="Jenis_Kelamin">Jenis Kelamin</label>
        <select id="Jenis_Kelamin" name="Jenis_Kelamin">
            <option value="L" <?= (isset($user["Jenis_Kelamin"]) && $user["Jenis_Kelamin"] == 'L') ? 'selected' : '' ?>>Laki-laki</option>
            <option value="P" <?= (isset($user["Jenis_Kelamin"]) && $user["Jenis_Kelamin"] == 'P') ? 'selected' : '' ?>>Perempuan</option>
        </select>

        <button>Update Profile</button>
        <p><a href="profile.php">batal</a></p>
    </form>
</body>
</html>

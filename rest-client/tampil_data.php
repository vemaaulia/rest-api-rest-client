<?php
include_once("config.php");

// URL API
$url = "http://localhost/api/tampil_data.php";

// Ambil data dari API
$data = http_request_get($url);

// Konversi JSON ke array
$hasil = json_decode($data, true);

// Cek apakah JSON valid
if($hasil === null){
    die("Response API tidak valid: ".$data);
}

// Cek apakah ada data
$rows = $hasil['data'] ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pengurus REST Client</title>
</head>
<body>
<h1>Data Pengurus</h1>
<a href="tambah_data.php">Tambah Data</a>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Gender</th>
        <th>Gaji</th>
        <th>Aksi</th>
    </tr>

    <?php if(empty($rows)) : ?>
        <tr>
            <td colspan="6" style="text-align:center">Data tidak ditemukan</td>
        </tr>
    <?php else : ?>
        <?php foreach($rows as $row) : ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['alamat']) ?></td>
            <td><?= htmlspecialchars($row['gender']) ?></td>
            <td><?= htmlspecialchars($row['gaji']) ?></td>
            <td>
                <a href="edit_data.php?id=<?= $row['id'] ?>">Edit</a> | 
                <a href="hapus_data.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>
</body>
</html>

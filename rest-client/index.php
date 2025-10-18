<?php
include "config.php";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $api_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
curl_close($curl);

$data = json_decode($response, true);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">

    <h2>Data Mahasiswa</h2>
    <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Data</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $mhs): ?>
            <tr>
                <td><?= $mhs['nim'] ?></td>
                <td><?= $mhs['nama'] ?></td>
                <td><?= $mhs['alamat'] ?></td>
                <td>
                    <a href="edit.php?nim=<?= $mhs['nim'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus.php?nim=<?= $mhs['nim'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
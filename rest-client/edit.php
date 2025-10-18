<?php
include "config.php";

$nim = $_GET['nim'] ?? '';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "$api_url?nim=$nim");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);

$mhs = json_decode($response, true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'nim' => $_POST['nim'],
        'nama' => $_POST['nama'],
        'alamat' => $_POST['alamat']
    ];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $api_url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_exec($curl);
    curl_close($curl);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">

    <h2>Edit Data Mahasiswa</h2>

    <form method="post">
        <div class="mb-3">
            <label>NIM</label>
            <input type="text" name="nim" value="<?= $mhs['nim'] ?>" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="<?= $mhs['nama'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required><?= $mhs['alamat'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>

</body>
</html>

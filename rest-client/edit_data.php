<?php
include_once("config.php"); // pastikan path sesuai

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : '';
if(empty($id)) die("ID tidak ditemukan.");

// Ambil data dari API
$url = "http://localhost/api/tampil_data.php?id=".$id;
$data = http_request_get($url);
$hasil = json_decode($data, true);

if(!isset($hasil['data'][0])){
    die("Data tidak ditemukan.");
}

$row = $hasil['data'][0]; // ambil data pertama
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ubah Data Pengurus</title>
</head>
<body>
    <h1>Ubah Data Pengurus</h1>

    <form method="POST" action="ubah_data.php">
        <table>
            <tr>
                <td>ID</td>
                <td><input type="text" name="id" value="<?= htmlspecialchars($row['id']) ?>" readonly></td>
            </tr>
            <tr>
                <td>NAMA</td>
                <td><input type="text" name="nama" value="<?= htmlspecialchars($row['nama']) ?>" required></td>
            </tr>
            <tr>
                <td>ALAMAT</td>
                <td><textarea name="alamat" required><?= htmlspecialchars($row['alamat']) ?></textarea></td>
            </tr>
            <tr>
                <td>GENDER</td>
                <td>
                    <select name="gender">
                        <option value="L" <?= $row['gender']=='L'?'selected':'' ?>>Laki-laki</option>
                        <option value="P" <?= $row['gender']=='P'?'selected':'' ?>>Perempuan</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>GAJI</td>
                <td><input type="number" name="gaji" value="<?= htmlspecialchars($row['gaji']) ?>" required></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="ubah">UBAH</button>
                    <button type="reset">BATAL</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

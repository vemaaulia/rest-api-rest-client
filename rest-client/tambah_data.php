<?php
include_once("config.php"); // pastikan path config.php benar

// Jika tombol simpan diklik
if(isset($_POST['simpan'])) {

    // Ambil data dari form
    $id     = $_POST['id'];
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $gender = $_POST['gender'];
    $gaji   = $_POST['gaji'];

    // Buat array data
    $data = [
        'id' => $id,
        'nama' => $nama,
        'alamat' => $alamat,
        'gender' => $gender,
        'gaji' => $gaji
    ];

    // URL API tambah data
    $url = "http://localhost/api/tambah_data.php";

    // Kirim POST ke API dengan format JSON
    $hasil = http_request_post($url, $data);

    // Decode response dari API
    $response = json_decode($hasil, true);

    // Tampilkan hasil
    if(isset($response['status']) && $response['status'] == 'success'){
        echo "<script>alert('Data berhasil disimpan'); window.location='tambah_data.php';</script>";
    } else {
        $pesan = isset($response['message']) ? $response['message'] : 'Gagal menyimpan data';
        echo "<script>alert('".$pesan."'); window.history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data dengan cURL</title>
</head>
<body>
    <h1>Input Data Pengurus</h1>
    <form method="POST">
        <table>
            <tr>
                <td>ID</td>
                <td><input type="text" name="id" required></td>
            </tr>
            <tr>
                <td>NAMA</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>ALAMAT</td>
                <td><textarea name="alamat" required></textarea></td>
            </tr>
            <tr>
                <td>GENDER</td>
                <td>
                    <select name="gender" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>GAJI</td>
                <td><input type="number" name="gaji" required></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="simpan">SIMPAN</button>
                    <button type="reset">BATAL</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

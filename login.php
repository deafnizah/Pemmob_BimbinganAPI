<?php
require 'koneksi.php';
$input = file_get_contents('php://input');
$data = json_decode($input, true);
$pesan = [];
$username = trim($data['username']);
$password = md5(trim($data['password']));

$query = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$jumlah = mysqli_num_rows($query);

if ($jumlah != 0) {
    $value = mysqli_fetch_object($query);
    
    // Mengambil role pengguna
    $pesan['username'] = $value->username;
    $pesan['role'] = $value->role; // Menyertakan role dalam respons
    $pesan['token'] = time() . '_' . $value->password;
    $pesan['status_login'] = 'berhasil';
} else {
    $pesan['status_login'] = 'gagal';
}

echo json_encode($pesan);
echo mysqli_error($con);
?>

<?php
require 'koneksi.php';

// Ambil data JSON dari request
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Ambil data input yang diperlukan
$username = trim($data['username']);
$email = trim($data['email']);
$password = trim($data['password']);
$role = trim($data['role']);  // Menyimpan role (student atau lecturer)

// Cek apakah data yang dibutuhkan ada
if ($username != '' && $email != '' && $password != '' && $role != '') {
    // Enkripsi password menggunakan MD5
    $password_encrypted = md5($password);
    
    // Query untuk insert data pengguna ke dalam tabel users
    $query = mysqli_query($koneksi, "INSERT INTO users (username, email, password, role) 
                                     VALUES ('$username', '$email', '$password_encrypted', '$role')");
    
    // Mengecek apakah query berhasil
    if ($query) {
        // Jika berhasil, kirim status true
        $pesan = ['status' => true, 'message' => 'Registrasi berhasil'];
    } else {
        // Jika gagal, kirim status false dan pesan error
        $pesan = ['status' => false, 'message' => 'Registrasi gagal, coba lagi'];
    }
} else {
    // Jika ada data yang kosong, kirim status false
    $pesan = ['status' => false, 'message' => 'Semua data harus diisi'];
}

// Menampilkan hasil dalam format JSON
echo json_encode($pesan);

// Menampilkan error jika ada
echo mysqli_error($koneksi);
?>

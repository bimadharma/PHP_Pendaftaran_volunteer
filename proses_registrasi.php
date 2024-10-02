<?php
include 'koneksi.php'; // Menghubungkan dengan file koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari form registrasi
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = "user"; // Default role adalah 'user'

    // Hashing password sebelum disimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Membuat prepared statement untuk menambah data user
    $stmt = $link->prepare("INSERT INTO user (nama, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $email, $hashed_password, $role);

 // Eksekusi query dan memeriksa apakah berhasil
if ($stmt->execute()) {
    // Jika berhasil, tampilkan alert dan redirect ke halaman login
    echo "<script>
            alert('Registrasi berhasil! Silahkan login kembali!');
            window.location.href = 'login.php';
          </script>";
} else {
    // Jika gagal, arahkan ke halaman registrasi dengan pesan gagal
    header("location:registrasi.php?pesan=gagal");
    exit();
}


    // Menutup statement dan koneksi
    $stmt->close();
    $link->close();
}
?>

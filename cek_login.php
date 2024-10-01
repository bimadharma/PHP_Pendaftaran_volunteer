<?php
include 'koneksi.php'; // Menghubungkan dengan file koneksi database
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Mendapatkan data dari form login
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Membuat prepared statement untuk mengambil data user berdasarkan email
        $stmt = $link->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Memeriksa apakah email ada di database
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); // Ambil data pengguna
            $hashed_password = $row['password'];

            // Verifikasi password yang diinput pengguna dengan yang ada di database
            if (password_verify($password, $hashed_password)) {
                $_SESSION['nama'] = $row['nama']; // Menyimpan nama pengguna dalam session
                $_SESSION['email'] = $email; // Menyimpan email pengguna dalam session

                header("Location: dashboard.php");
                exit();
            } else {
                // Password tidak cocok
                header("location:login.php?pesan=gagal");
                exit();
            }
        } else {
            // Email tidak ditemukan
            header("location:login.php?pesan=gagal");
            exit();
        }

        // Menutup prepared statement
        $stmt->close();
    } else {
        // Form tidak lengkap
        header("location:login.php?pesan=empty");
        exit();
    }

    // Menutup koneksi
    $link->close();
}
?>

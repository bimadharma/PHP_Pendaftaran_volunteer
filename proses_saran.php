<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $saran = $_POST['saran'];

    // Menyimpan data ke dalam tabel
    $sql = "INSERT INTO saran (nama, email, saran) VALUES ('$nama', '$email', '$saran')";
    
    if ($link->query($sql) === TRUE) {
        echo "<script>alert('Saran berhasil dikirim! Terima kasih.'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $link->error . "'); window.location.href='index.html';</script>";
    }

    $link->close();
}
?>

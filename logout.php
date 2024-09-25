<?php
session_start(); // Memulai session

// Menghapus semua session
session_destroy(); // Menghancurkan session
header("Location: index.html"); // Mengarahkan ke halaman index.html
exit();
?>

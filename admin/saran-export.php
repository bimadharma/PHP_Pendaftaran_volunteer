<?php
// Memanggil atau membutuhkan file koneksi database
require '../koneksi.php';

// Menampilkan semua data dari tabel peserta berdasarkan id secara Descending
$peserta = query("SELECT nama, email, saran FROM saran ORDER BY id DESC");

// Membuat nama file
$filename = "data_saran_pengguna_" . date('Ymd') . ".xls";

// Header untuk export ke Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$filename");

?>

<table class="text-center" border="1">
    <thead class="text-center">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Saran</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php $no = 1; ?>
        <?php foreach ($peserta as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['saran']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

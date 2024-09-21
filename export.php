<?php
// Memanggil atau membutuhkan file function.php
require 'koneksi.php';

// Menampilkan semua data dari table Mahasiswa berdasarkan nim secara Descending
$peserta = query("SELECT * FROM peserta ORDER BY id DESC");

// Membuat nama file
$filename = "data peserta volunteer" . date('Ymd') . ".xls";

// export ke excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Peserta.xls");

?>
<table class="text-center" border="1">
    <thead class="text-center">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Jenis kelamin</th>
            <th>Minat keterampilan</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php $no = 1; ?>
        <?php foreach ($peserta as $row) : ?>
            <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td><?= $row['jenis_kelamin']; ?></td>
            <td><?= $row['minat_keterampilan']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
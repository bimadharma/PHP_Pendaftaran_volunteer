<?php
include "../koneksi.php";

// Menghapus akun
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $link->query("DELETE FROM user WHERE id='$id'");
}

// Mengedit akun
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Jika password baru diinput, hash dan update
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $link->query("UPDATE user SET nama='$nama', email='$email', password='$password', role='$role' WHERE id='$id'");
    } else {
        $link->query("UPDATE user SET nama='$nama', email='$email', role='$role' WHERE id='$id'");
    }
    // Alert untuk memberi tahu bahwa data berhasil disimpan
    echo "<script>alert('Data berhasil disimpan!'); window.location.href='akun.php';</script>";
}

// Mengambil semua akun
$result = $link->query("SELECT * FROM user");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
        background-color: #361337;
    }

    h2 {
        color: white;
        margin-bottom: 3rem;
    }
</style>

<body>
    <?php include("header.php") ?>

    <div class="container mt-5">
        <h2 class="text-center">Manajemen Akun Admin</h2>

        <!-- Tabel untuk menampilkan semua akun -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="text-center">Aksi</th>
                </tr>


            </thead>

            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['role']; ?></td>
                        <td class="text-center">
                            <!-- Tombol Edit -->
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id']; ?>">Edit</button>
                            <!-- Tombol Hapus -->
                            <a href="?action=delete&id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus akun ini?');">Hapus</a>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal<?= $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Akun</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" name="nama" class="form-control" value="<?= $row['nama']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" value="<?= $row['email']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <select name="role" class="form-select" required>
                                                <option value="admin" <?= ($row['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                                <option value="user" <?= ($row['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" name="edit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="form-akun.php" class="btn btn-primary" role="button">Tambah Data</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #361337;
            color: white;
        }
    </style>
</head>
<body>

<?php 
include "../koneksi.php";
// Menambah akun baru
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO user (nama, email, password, role) VALUES ('$nama', '$email', '$password', '$role')";
     
    if ($link->query($sql) === TRUE) {
        echo "<script>alert('Akun berhasil ditambahkan!'); window.location.href='akun.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan akun: " . $link->error . "');</script>";
    }

} ?>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="w-100" style="max-width: 500px;">
            <!-- Form untuk menambah akun -->
            <form method="POST" class="mb-4">
                <h4 class="text-center">Tambah Akun Baru</h4>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukan Nama anda.." required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukan email anda.." required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label" >Password</label>
                    <input type="password" name="password" placeholder="Masukan password.." class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah Akun</button>
                <button class="btn btn-secondary" onclick="window.location.href='akun.php'">Kembali</button>
            </form>
        </div>
    </div>
</body>
</html>

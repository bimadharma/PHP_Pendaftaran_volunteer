<?php
  session_start(); // Memulai session

  // Memeriksa apakah pengguna sudah login dengan email
  if (!isset($_SESSION['email'])) {
    // Jika tidak ada session email, arahkan ke halaman login
    header("Location: login.php");
    exit();
  }

  ?>


<?php
// Include file koneksi untuk menghubungkan ke database
include "koneksi.php";

// Fungsi untuk mengamankan input pengguna
function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Cek apakah ada ID yang dikirim melalui URL
if (isset($_GET['id'])) {
    $id = input($_GET["id"]);

    // Ambil data peserta berdasarkan ID
    $query = "SELECT * FROM peserta WHERE id='$id'";
    $result = mysqli_query($link, $query);
    $data = mysqli_fetch_assoc($result);

    // Jika data tidak ditemukan, arahkan kembali ke halaman 
    if (!$data) {
        header("Location: dashboard.php");
    }
}

// Proses saat form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = input($_POST["id"]);
    $nama = input($_POST["nama"]);
    $email = input($_POST["email"]);
    $alamat = input($_POST["alamat"]);
    $jenis_kelamin = input($_POST["jenis_kelamin"]);
    $minat_keterampilan = input($_POST["minat_keterampilan"]);

    // Query untuk update data
    $sql = "UPDATE peserta SET 
            nama='$nama', 
            email='$email', 
            alamat='$alamat', 
            jenis_kelamin='$jenis_kelamin', 
            minat_keterampilan='$minat_keterampilan' 
            WHERE id='$id'";

    // Eksekusi query
    $hasil = mysqli_query($link, $sql);

    // Cek apakah query berhasil di-eksekusi
    if ($hasil) {
        header("Location: dashboard.php");
    } else {
        echo "<div class='alert alert-danger'> Data Gagal diupdate.</div>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Data Peserta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Update Data Peserta</h2>

        <!-- Form Update -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
            
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required />
            </div>
            
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" required />
            </div>
            
            <div class="form-group">
                <label>Alamat:</label>
                <textarea name="alamat" class="form-control" rows="5" required><?php echo $data['alamat']; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="laki-laki" <?php if ($data['jenis_kelamin'] == 'laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="perempuan" <?php if ($data['jenis_kelamin'] == 'perempuan') echo 'selected'; ?>>Perempuan</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Minat Keterampilan:</label>
                <input type="text" name="minat_keterampilan" class="form-control" value="<?php echo $data['minat_keterampilan']; ?>" required />
            </div>
            <a href="dashboard.php" class="btn btn-secondary" role="button">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>

</html>

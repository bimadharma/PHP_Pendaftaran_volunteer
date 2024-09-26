<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
  body {
    background-color: #361337;
    color: white;
  }
</style>

<body>
  <?php
  session_start(); // Memulai session

  // Memeriksa apakah pengguna sudah login dengan email
  if (!isset($_SESSION['email'])) {
    // Jika tidak ada session email, arahkan ke halaman login
    header("Location: login.php");
    exit();
  }

  ?>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-black">
    <div class="container-fluid">
      <!-- Logo -->
      <a class="navbar-brand" href="dashboard.php">
        <img src="assets/Volunteer.png" alt="Logo" width="120px;" class="d-inline-block align-text-top">
      </a>

      <!-- Toggle button for mobile view -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar items -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- Menu Dashboard -->
          <li class="nav-item">
            <a class="nav-link text-white active" aria-current="page" href="dashboard.php">Dashboard</a>
          </li>

          <!-- Menu Saran -->
          <li class="nav-item">
            <a class="nav-link text-white" href="saran.php">Saran</a>
          </li>
        </ul>

        <!-- User Icon Dropdown -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="assets/me.jpeg" alt="User" width="50" height="50" class="rounded-circle">
            </a>
            <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="navbarDropdown">
              <!-- Profile Option -->
              <li><a class="dropdown-item" href="#">Profile</a></li>

              <!-- Logout Option -->
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <br>
    <h2>
      <center>Selamat datang di halaman, <?php echo $_SESSION['nama']; ?></center>
    </h2>
    <h2>
      <center>Peserta Volunteer </center>
    </h2>
    <?php
    include "koneksi.php";

    if (isset($_GET['id'])) {
      $id = htmlspecialchars($_GET["id"]);

      $sql = "delete from peserta where id='$id'";
      $hasil = mysqli_query($link, $sql);

      if ($hasil) {
        header("Location:dashboard.php");
      } else {
        echo "<div class='alert alert-denger'> Data Gagal dihapus.</div>";
      }
    }

    ?>

    <a href="export.php" target="_blank" class="btn btn-success ms-1"><i class="bi bi-file-earmark-spreadsheet-fill"></i>&nbsp;Ekspor ke Excel</a>

    <div class="table-responsive my-3">
      <table class="my-3 table table-bordered">
        <thead>
          <tr class="table-info">
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Alamat</th>
            <th scope="col">Jenis kelamin</th>
            <th scope="col">Minat keterampilan</th>
            <th colspan='2'>Aksi</th>
          </tr>
        </thead>

        <?php
        include_once 'koneksi.php';
        $sql = "select * from peserta order by id desc";

        $hasil = mysqli_query($link, $sql);
        $no = 0;
        while ($data = mysqli_fetch_array($hasil)) {
          $no++;


        ?>
          <tbody>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $data["nama"]; ?></td>
              <td><?php echo $data["email"];   ?></td>
              <td><?php echo $data["alamat"];   ?></td>
              <td><?php echo $data["jenis_kelamin"];   ?></td>
              <td><?php echo $data["minat_keterampilan"];   ?></td>
              <td>
                <a href="update.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-warning" role="button">Update</a>
                <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $data['id']; ?>"
                  class="btn btn-danger"
                  role="button"
                  onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</a>

              </td>
            </tr>
          </tbody>
        <?php
        }
        ?>
      </table>

    </div>
    <a href="tambah.php" class="btn btn-primary" role="button">Tambah Data</a>
  </div>
  

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>
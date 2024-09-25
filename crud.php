<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

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
        header("Location:crud.php");
      } else {
        echo "<div class='alert alert-denger'> Data Gagal dihapus.</div>";
      }
    }

    ?>


      <a href="export.php" target="_blank" class="btn btn-success ms-1"><i class="bi bi-file-earmark-spreadsheet-fill"></i>&nbsp;Ekspor ke Excel</a>
    <table class="my-3 table table-bordered">
      <thead>
        <tr class="table-info">
          <th scope="col">No</th>
          <th scope="col">nama</th>
          <th scope="col">email</th>
          <th scope="col">alamat</th>
          <th scope="col">jenis kelamin</th>
          <th scope="col">minat keterampilan</th>
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
    <a href="tambah.php" class="btn btn-primary" role="button">Tambah Data</a>
    <form action="logout.php" method="post">
    <button type="submit" class="btn btn-danger">Logout</button>
</form>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
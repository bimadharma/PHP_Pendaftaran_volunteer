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

  @media (max-width: 768px) {
  .table-responsive-sm {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch; 
  }
  .table {
    white-space: nowrap;
}

}

</style>

<body>
<?php include("header.php")?>

  <div class="container">
    <br>
    <h2>
      <center>Selamat datang di halaman, <?php echo $_SESSION['nama']; ?></center>
    </h2>
    <h2>
      <center>Peserta Volunteer </center>
    </h2>
    <?php
    include "../koneksi.php";

    if (isset($_GET['id'])) {
      $id = htmlspecialchars($_GET["id"]);

      $sql = "delete from saran where id='$id'";
      $hasil = mysqli_query($link, $sql);

      if ($hasil) {
        header("Location:saran.php");
      } else {
        echo "<div class='alert alert-denger'> Data Gagal dihapus.</div>";
      }
    }

    ?>
    <a href="saran-export.php" target="_blank" class="btn btn-success ms-1"><i class="bi bi-file-earmark-spreadsheet-fill"></i>&nbsp;Ekspor ke Excel</a>

    <div class="table-responsive-sm">
      <table class="my-3 table table-bordered">
        <thead>
          <tr class="table-info">
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Saran</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>

        <?php
        include_once '../koneksi.php';
        $sql = "select * from saran order by id desc";

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
              <td><?php echo $data["saran"];   ?></td>
              <td>
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
  </div>
  

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Form Pendaftaran Peserta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
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
        <?php
        //Include file koneksi, untuk koneksikan ke database
        include "koneksi.php";

        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nama = input($_POST["nama"]);
            $email = input($_POST["email"]);
            $alamat = input($_POST["alamat"]);
            $jenis_kelamin = input($_POST["jenis_kelamin"]);
            $minat_keterampilan = input($_POST["minat_keterampilan"]);

            //Query input menginput data kedalam tabel anggota
            $sql = "insert into peserta(nama,email,alamat,jenis_kelamin,minat_keterampilan) values ('$nama','$email','$alamat','$jenis_kelamin','$minat_keterampilan')";

            //Mengeksekusi/menjalankan query diatas
            $hasil = mysqli_query($link, $sql);

            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($hasil) {
                header("Location:dashboard.php");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
            }
        }
        ?>
        <h2>Input Data</h2>


        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required />

            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Masukan email anda" required />
            </div>
            <div class="form-group">
                <label>Alamat :</label>
                <textarea name="alamat" class="form-control" rows="5" placeholder="Masukan Alamat" required></textarea>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis kelamin:</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                    <option value="" disabled selected>Pilih jenis kelamin</option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Minat keterampilan:</label>
                <input type="text" name="minat_keterampilan" class="form-control" placeholder="Masukan minat keterampilan anda" required />
            </div>
            <a href="dashboard.php" class="btn btn-secondary" role="button">Cancel</a>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>
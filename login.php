<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Login</title>
</head>

<body style="background-color: #361337;">

<?php

include 'koneksi.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Mendapatkan data dari form login
        $email = $_POST['email'];
        $password = $_POST['password'];

        // SQL untuk mengambil data user berdasarkan email
        $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
        $result = $link->query($sql);

        // Memeriksa apakah email ada di database
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); // Ambil data pengguna

            $_SESSION['nama'] = $row['nama']; // Menyimpan email pengguna dalam session
            $_SESSION['email'] = $email; // Menyimpan email pengguna dalam session
           
            header("Location: dashboard.php");
            exit(); 
        } else {
        
            echo "<script>alert('Email atau Password salah!');</script>";
        }
    } else {
        
        echo "<script>alert('Silakan masukkan email dan password!');</script>";
    }

    // Menutup koneksi
    $link->close();
}
?>


    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="assets/logo_login.png"
                                    alt="login form" class="mt-5 img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-3 text-black">

                                    <form method="POST" action="">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0">Volunteer Admin</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="email">Email address</label>
                                            <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Masukkan email di sini yaa.." required />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control form-control-lg"placeholder="Kalau password di sini yaa.."required />
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" name = "submit" type="submit">Login</button>
                                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-lg btn-outline-secondary" type="button" onclick="window.location.href='index.html';">Cencel</button>
                                        </div>
                                        <!-- <p class="mb-1 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!"
                                                style="color: #393f81;">Register here</a></p> -->
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
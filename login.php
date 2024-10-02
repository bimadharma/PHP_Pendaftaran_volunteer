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

                                    <form method="POST" action="cek_login.php">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0">Volunteer</span>
                                        </div>

                                        <h5 class="fw-normal mb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                                        <p>
                                            <?php
                                            if (isset($_GET['pesan'])) {
                                                if ($_GET['pesan'] == 'gagal') {
                                                    echo '<i class="text-danger">Login Gagal! Username atau Password tidak sesuai!</i>';
                                                } else if ($_GET['pesan'] == 'empty') {
                                                    echo '<i class="text-danger">Username dan Password tidak boleh kosong!</i>';
                                                } else if($_GET['pesan'] == 'notlogin') {
                                                    echo '<i class="text-danger">Anda harus login untuk mengakses halaman admin!</i>';
                                                }
                                            }
                                            ?>
                                        </p>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="email">Email address</label>
                                            <input type="text" name="email" id="email" class="form-control form-control-lg" placeholder="Masukkan email di sini yaa.." required />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Kalau password di sini yaa.." required />
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" name="submit" type="submit">Login</button>
                                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-lg btn-outline-secondary" type="button" onclick="window.location.href='index.html';">Cencel</button>
                                        </div>
                                        <p class="mb-1 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="registrasi.php"
                                                style="color: #393f81;">Register here</a></p>
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
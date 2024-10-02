<?php
  session_start(); // Memulai session

  // Memeriksa apakah pengguna sudah login dengan email
  if (!isset($_SESSION['email'])) {
    // Jika tidak ada session email, arahkan ke halaman login
    header("Location: ../login.php?pesan=notlogin");
    exit();
  }

  ?>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-black">
    <div class="container-fluid">
      <!-- Logo -->
      <a class="navbar-brand" href="dashboard.php">
        <img src="../assets/Volunteer.png" alt="Logo" width="120px;" class="d-inline-block align-text-top">
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
          <!-- <li class="nav-item">
            <a class="nav-link text-white" href="saran.php">Saran</a>
          </li> -->
        </ul>

        <!-- User Icon Dropdown -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="../assets/me.jpeg" alt="User" width="50" height="50" class="rounded-circle">
            </a>
            <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="navbarDropdown">
              <!-- Profile Option -->
              <li><a class="dropdown-item" href="#">Profile</a></li>

              <!-- Logout Option -->
              <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
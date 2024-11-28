<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #1a202c;
        }
        .sidebar a {
            color: #cbd5e0;
        }
        .sidebar a:hover {
            background-color: #2d3748;
            color: #fff;
        }
        .content {
            margin-left: 250px;
        }
        .navbar {
            background-color: #2d3748;
            color: #fff;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="sidebar position-fixed d-flex flex-column p-3 text-white shadow-lg" style="width: 250px;">
        <h3 class="text-center text-white mb-4">Dasbor Admin</h3>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="dashboard.php" class="nav-link"><i class="fas fa-home me-2"></i> Beranda</a>
            </li>
            <li class="nav-item mb-2">
                <a href="view.php" class="nav-link"><i class="fas fa-chart-pie me-2"></i> Lihat Laporan</a>
            </li>
            <li class="nav-item mb-2">
                <a href="view_users.php" class="nav-link"><i class="fas fa-users me-2"></i> Lihat Pengguna</a>
            </li>
            <li class="nav-item mb-2">
                <a href="settings.php" class="nav-link"><i class="fas fa-cogs me-2"></i> Pengaturan</a>
            </li>
            <li class="nav-item mb-2">
                <a href="logout.php" class="nav-link text-danger"><i class="fas fa-sign-out-alt me-2"></i> Keluar</a>
            </li>
        </ul>
    </div>

    <!-- Konten -->
    <div class="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Admin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-bell"></i> Notifikasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-envelope"></i> Pesan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="logout.php"><i class="fas fa-sign-out-alt"></i> Keluar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Konten Dasbor -->
        <div class="container mt-4">
            <h1>Selamat Datang, <?= htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p>Ini adalah dasbor admin Anda. Gunakan menu di samping untuk mengelola bagian lain dari sistem.</p>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-users text-primary"></i> Pengguna</h5>
                            <p class="card-text">Kelola pengguna Anda di sini.</p>
                            <a href="view_users.php" class="btn btn-primary">Lihat Pengguna</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-chart-pie text-success"></i> Laporan</h5>
                            <p class="card-text">Hasilkan laporan dan lihat analitik.</p>
                            <a href="view.php" class="btn btn-success">Lihat Laporan</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-cogs text-warning"></i> Pengaturan</h5>
                            <p class="card-text">Atur konfigurasi sistem.</p>
                            <a href="settings.php" class="btn btn-warning">Buka Pengaturan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();

// Menyertakan file konfigurasi
include('config.php');

$error_message = '';

// Memeriksa apakah form login sudah dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Mendapatkan role yang dipilih (admin atau user)

    // Proses autentikasi pengguna
    $authenticated = false;
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password && $user['role'] === $role) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['logged_in'] = true;
            $authenticated = true;
            header('Location: dashboard.php'); // Redirect ke dashboard setelah login berhasil
            exit();
        }
    }

    if (!$authenticated) {
        $error_message = "Username, password, atau role salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        /* Background Animation */
        body {
            background: linear-gradient(45deg, #ff6a00, #ee0979);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Centering the login form */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.8);
        }

        .btn-primary {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .btn-primary:hover {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        .input-group-text {
            background-color: #3b82f6;
            color: white;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .input-group .form-control {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
        }

        .form-label {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="card p-4 rounded-lg shadow-lg w-100 max-w-md">
            <div class="text-center mb-4">
                <i class="fas fa-user-lock fa-3x text-primary mb-2"></i>
                <h3 class="font-bold text-lg">Admin Login</h3>
            </div>

            <form action="login.php" method="POST">
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger text-center">
                        <?= htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>

                <div class="form-group mb-3">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username Anda" required>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password Anda" required>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="role" class="form-label">Pilih Hak Akses</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="">Pilih role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </button>

                <div class="text-center text-sm text-gray-500">
                    &copy; 2024 Admin Dashboard
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

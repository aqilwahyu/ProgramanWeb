<?php
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Dummy data pengguna (gunakan database untuk data asli)
$users = [
    ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
    ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
    ['id' => 3, 'name' => 'Mike Johnson', 'email' => 'mike@example.com']
];

// Simulasi aksi tambah, edit, atau hapus
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'add') {
            // Tambah data pengguna
            $newUser = [
                'id' => count($users) + 1,
                'name' => htmlspecialchars($_POST['name']),
                'email' => htmlspecialchars($_POST['email']),
            ];
            $users[] = $newUser;
        } elseif ($action === 'edit') {
            // Edit data pengguna
            foreach ($users as &$user) {
                if ($user['id'] == $_POST['id']) {
                    $user['name'] = htmlspecialchars($_POST['name']);
                    $user['email'] = htmlspecialchars($_POST['email']);
                    break;
                }
            }
        } elseif ($action === 'delete') {
            // Hapus data pengguna
            $users = array_filter($users, function ($user) {
                return $user['id'] != $_POST['id'];
            });
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna</title>
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
        .table-hover tbody tr:hover {
            background-color: #edf2f7;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mt-5">
        <h1 class="mb-4">Kelola Pengguna</h1>
        <table class="table table-striped table-hover shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']); ?></td>
                        <td><?= htmlspecialchars($user['name']); ?></td>
                        <td><?= htmlspecialchars($user['email']); ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editUser(<?= htmlspecialchars(json_encode($user)); ?>)">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form action="" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']); ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus pengguna ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button class="btn btn-success mb-3" onclick="showAddModal()">
            <i class="fas fa-plus"></i> Tambah Pengguna
        </button>
        <a href="dashboard.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Dasbor
        </a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" id="userForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">Tambah/Edit Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="userId">
                        <input type="hidden" name="action" id="userAction">
                        <div class="mb-3">
                            <label for="userName" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name" id="userName" required>
                        </div>
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="userEmail" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showAddModal() {
            document.getElementById('userModalLabel').textContent = 'Tambah Pengguna';
            document.getElementById('userForm').reset();
            document.getElementById('userAction').value = 'add';
            new bootstrap.Modal(document.getElementById('userModal')).show();
        }

        function editUser(user) {
            document.getElementById('userModalLabel').textContent = 'Edit Pengguna';
            document.getElementById('userId').value = user.id;
            document.getElementById('userName').value = user.name;
            document.getElementById('userEmail').value = user.email;
            document.getElementById('userAction').value = 'edit';
            new bootstrap.Modal(document.getElementById('userModal')).show();
        }
    </script>
</body>
</html>

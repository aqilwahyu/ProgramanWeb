<?php
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Dummy data pengaturan (gunakan database untuk data asli)
$settings = [
    ['key' => 'Website Name', 'value' => 'Sistem Admin'],
    ['key' => 'Email Support', 'value' => 'support@example.com'],
    ['key' => 'Version', 'value' => '1.0.0']
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mt-5">
        <h1 class="mb-4">Pengaturan</h1>
        <table class="table table-striped table-hover shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Kunci</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($settings as $setting): ?>
                    <tr>
                        <td><?= htmlspecialchars($setting['key']); ?></td>
                        <td><?= htmlspecialchars($setting['value']); ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editSetting('<?= htmlspecialchars($setting['key']); ?>', '<?= htmlspecialchars($setting['value']); ?>')">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="dashboard.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Dasbor
        </a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="settingModal" tabindex="-1" aria-labelledby="settingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="settingModalLabel">Edit Pengaturan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="settingKey" class="form-label">Kunci</label>
                            <input type="text" class="form-control" id="settingKey" name="key" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="settingValue" class="form-label">Nilai</label>
                            <input type="text" class="form-control" id="settingValue" name="value" required>
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
        function editSetting(key, value) {
            document.getElementById('settingKey').value = key;
            document.getElementById('settingValue').value = value;
            new bootstrap.Modal(document.getElementById('settingModal')).show();
        }
    </script>
</body>
</html>

<?php
session_start();
if ($_SESSION['username'] == null) {
    header('location:login.php');
    exit;
}

// Inisialisasi data tugas dalam sesi jika belum ada
if (!isset($_SESSION['tugas'])) {
    $_SESSION['tugas'] = [
        'Belum Dikerjakan' => [
            [
                'id' => 1,
                'nama_tugas' => 'IMK',
                'deskripsi' => 'Deadline 20 Oktober 2024',
                'deadline' => '2024-10-20'
            ],
            [
                'id' => 2,
                'nama_tugas' => 'Data Mining',
                'deskripsi' => 'Deadline 13 Oktober 2024',
                'deadline' => '2024-10-13'
            ],
        ],
        'Sudah Dikerjakan' => [
            [
                'id' => 1,
                'nama_tugas' => 'PCD',
                'deskripsi' => 'Selesai pada 07 Oktober 2024',
                'deadline' => '2024-10-07'
            ],
        ],
    ];
}

// Tangani aksi CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];
    $tugas = &$_SESSION['tugas'][$status];

    // Tambah Tugas
    if (isset($_POST['action']) && $_POST['action'] === 'create') {
        $newTask = [
            'id' => count($tugas) + 1,
            'nama_tugas' => $_POST['nama_tugas'],
            'deskripsi' => $_POST['deskripsi'],
            'deadline' => $_POST['deadline']
        ];
        $tugas[] = $newTask;
    }

    // Edit Tugas
    if (isset($_POST['action']) && $_POST['action'] === 'update') {
        foreach ($tugas as &$task) {
            if ($task['id'] == $_POST['id']) {
                $task['nama_tugas'] = $_POST['nama_tugas'];
                $task['deskripsi'] = $_POST['deskripsi'];
                $task['deadline'] = $_POST['deadline'];
                break;
            }
        }
    }
}

// Tangani penghapusan tugas
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $status = $_GET['status'];
    $tugas = &$_SESSION['tugas'][$status];

    foreach ($tugas as $key => $task) {
        if ($task['id'] == $_GET['id']) {
            unset($tugas[$key]);
            break;
        }
    }
}

// Mendapatkan status tugas dari URL (default: Belum Dikerjakan)
$status = $_GET['status'] ?? 'Belum Dikerjakan';

// Memastikan status valid
if (!isset($_SESSION['tugas'][$status])) {
    $status = 'Belum Dikerjakan';
}
$tugas = $_SESSION['tugas'][$status];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        /* Sama seperti kode sebelumnya */
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>Checklist Tugas</h2>
            </div>
            <ul class="nav-links">
                <li>
                    <a href="?status=Belum Dikerjakan" class="<?= $status === 'Belum Dikerjakan' ? 'active' : '' ?>">
                        <span class="link-name">Tugas yang Belum Dikerjakan</span>
                    </a>
                </li>
                <li>
                    <a href="?status=Sudah Dikerjakan" class="<?= $status === 'Sudah Dikerjakan' ? 'active' : '' ?>">
                        <span class="link-name">Tugas yang Sudah Dikerjakan</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <span class="link-name">Log out</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main-content">
            <h1>Tugas: <?= htmlspecialchars($status) ?></h1>
            <form method="POST" style="margin-bottom: 20px;">
                <h3>Tambah/Edit Tugas</h3>
                <input type="hidden" name="status" value="<?= htmlspecialchars($status) ?>">
                <input type="hidden" name="id" id="task-id">
                <input type="hidden" name="action" id="task-action" value="create">
                <input type="text" name="nama_tugas" id="task-name" placeholder="Nama Tugas" required>
                <input type="text" name="deskripsi" id="task-desc" placeholder="Deskripsi" required>
                <input type="date" name="deadline" id="task-deadline" required>
                <button type="submit">Simpan</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tugas</th>
                        <th>Deskripsi</th>
                        <th>Deadline</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($tugas) > 0): ?>
                        <?php foreach ($tugas as $index => $task): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($task['nama_tugas']) ?></td>
                                <td><?= htmlspecialchars($task['deskripsi']) ?></td>
                                <td><?= htmlspecialchars($task['deadline']) ?></td>
                                <td>
                                    <a href="javascript:void(0);" onclick="editTask(<?= htmlspecialchars(json_encode($task)) ?>)">Edit</a>
                                    <a href="?action=delete&status=<?= htmlspecialchars($status) ?>&id=<?= $task['id'] ?>" onclick="return confirm('Hapus tugas ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Tidak ada tugas untuk ditampilkan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function editTask(task) {
            document.getElementById('task-id').value = task.id;
            document.getElementById('task-name').value = task.nama_tugas;
            document.getElementById('task-desc').value = task.deskripsi;
            document.getElementById('task-deadline').value = task.deadline;
            document.getElementById('task-action').value = 'update';
        }
    </script>
</body>
</html>

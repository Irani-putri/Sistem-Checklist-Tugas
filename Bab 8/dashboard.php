<?php 
session_start();

// Periksa apakah sesi sudah diinisialisasi
if (!isset($_SESSION['username']) || $_SESSION['username'] == null) {
    header('location:login.php');
    exit;
}

// Set lokasi penyimpanan sesi (jika diperlukan)
session_save_path('/tmp');

// Logika untuk menentukan salam berdasarkan waktu
$hour = date('H');
if ($hour >= 5 && $hour < 10) {
    $salam = "Selamat Pagi";
} elseif ($hour >= 10 && $hour < 15) {
    $salam = "Selamat Siang";
} elseif ($hour >= 15 && $hour < 18) {
    $salam = "Selamat Sore";
} else {
    $salam = "Selamat Malam";
}

// Inisialisasi data tugas dalam sesi jika belum ada
if (!isset($_SESSION['tugas'])) {
    $_SESSION['tugas'] = [
        'Belum Dikerjakan' => [
            [
                'id' => 1,
                'nama_tugas' => 'IMK',
                'deskripsi' => 'Deadline 20 Oktober 2024',
                'deadline' => '2024-10-20',
            ],
            [
                'id' => 2,
                'nama_tugas' => 'Data Mining',
                'deskripsi' => 'Deadline 13 Oktober 2024',
                'deadline' => '2024-10-13',
            ],
        ],
        'Sudah Dikerjakan' => [
            [
                'id' => 1,
                'nama_tugas' => 'PCD',
                'deskripsi' => 'Selesai pada 07 Oktober 2024',
                'deadline' => '2024-10-07',
            ],
        ],
    ];
}

// Mengambil data tugas berdasarkan status
$status = $_GET['status'] ?? 'Belum Dikerjakan';
$tugas = $_SESSION['tugas'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
}

.container {
    display: flex;
    min-height: 100vh;
}

.sidebar {
    background-color: #2c3e50;
    color: white;
    width: 250px;
    padding: 20px;
    display: flex;
    flex-direction: column;
}

.sidebar-header {
    font-size: 24px;
    margin-bottom: 30px;
}

.nav-links {
    list-style: none;
    padding: 0;
}

.nav-links li {
    margin: 15px 0;
}

.nav-links a {
    text-decoration: none;
    color: white;
    display: flex;
    align-items: center;
}

.nav-links a:hover {
    background-color: #34495e;
    padding: 10px;
    border-radius: 5px;
}

.nav-links .link-name {
    margin-left: 10px;
}

.main-content {
    flex-grow: 1;
    background-color: #ecf0f1;
    padding: 20px;
}

.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.tambah-btn {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
}

.tambah-btn:hover {
    background-color: #2980b9;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #3498db;
    color: white;
}

@media screen and (max-width: 768px) {
    .container {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        padding: 10px;
    }

    .main-content {
        padding: 10px;
    }

    .top-bar {
        flex-direction: column;
        align-items: flex-start;
    }

    .tambah-btn {
        margin-top: 10px;
    }

    .menu-icon {
        margin-right: auto;
    }
}

@media screen and (max-width: 480px) {
    .nav-links li {
        margin: 10px 0;
    }

    .tambah-btn {
        width: 100%;
    }

    .sidebar-header {
        font-size: 20px;
    }

    table, th, td {
        font-size: 14px;
    }
}
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
            <div class="top-bar">
                <h1>Selamat Datang, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
            </div>
            <div class="widget-container">
                <div class="widget">
                    <h3>Belum Dikerjakan</h3>
                    <p><?= count($tugas['Belum Dikerjakan']) ?> Tugas</p>
                </div>
                <button type="button" class="btn btn-tambah">
    <a href="cetak-tugas.php?status=<?= urlencode($status) ?>" target="_blank">Cetak Tugas</a>
</button>

                <div class="widget">
                    <h3>Sudah Dikerjakan</h3>
                    <p><?= count($tugas['Sudah Dikerjakan']) ?> Tugas</p>
                </div>
            </div>
            <button type="button" class="btn btn-tambah">
    <a href="cetak-tugas.php?status=<?= urlencode($status) ?>" target="_blank">Cetak Tugas</a>
</button>



            <div class="content">
                <h2>Tugas: <?= htmlspecialchars($status) ?></h2>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tugas</th>
                            <th>Deskripsi</th>
                            <th>Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($tugas[$status])): ?>
                            <?php foreach ($tugas[$status] as $index => $task): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($task['nama_tugas']) ?></td>
                                    <td><?= htmlspecialchars($task['deskripsi']) ?></td>
                                    <td><?= htmlspecialchars($task['deadline']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">Tidak ada tugas untuk ditampilkan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

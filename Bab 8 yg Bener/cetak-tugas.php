<?php
session_start();
require_once 'dompdf/autoload.inc.php';


use Dompdf\Dompdf;

// Periksa apakah sesi sudah diinisialisasi
if (!isset($_SESSION['username']) || $_SESSION['username'] == null) {
    header('location:login.php');
    exit;
}

// Mengambil data tugas berdasarkan status
$status = $_GET['status'] ?? 'Belum Dikerjakan';
$tugas = $_SESSION['tugas'];

// Inisialisasi Dompdf
$dompdf = new Dompdf();

// Membuat HTML untuk laporan tugas
$html = '<center><h3>Checklist Tugas - ' . htmlspecialchars($status) . '</h3></center><hr/><br>';
$html .= '<table border="1" width="100%">
            <tr>
                <th>No</th>
                <th>Nama Tugas</th>
                <th>Deskripsi</th>
                <th>Deadline</th>
            </tr>';

if (!empty($tugas[$status])) {
    foreach ($tugas[$status] as $index => $task) {
        $html .= "<tr>
                    <td>" . ($index + 1) . "</td>
                    <td>" . htmlspecialchars($task['nama_tugas']) . "</td>
                    <td>" . htmlspecialchars($task['deskripsi']) . "</td>
                    <td>" . htmlspecialchars($task['deadline']) . "</td>
                </tr>";
    }
} else {
    $html .= "<tr><td colspan='4'>Tidak ada tugas untuk ditampilkan.</td></tr>";
}

$html .= "</table>";

// Load HTML ke dalam Dompdf
$dompdf->loadHtml($html);

// Set ukuran kertas dan orientasi (A4, portrait)
$dompdf->setPaper('A4', 'portrait');

// Render HTML ke PDF
$dompdf->render();

// Outputkan PDF
$dompdf->stream("tugas-{$status}.pdf", array("Attachment" => 0));
?>

<?php
session_start();

// Data login hardcoded (dapat diubah sesuai kebutuhan)
$validUsers = [
    'admin' => [
        'password' => password_hash('12345', PASSWORD_DEFAULT), // Hash password untuk keamanan
        'email' => 'admin@example.com'
    ],
    'user' => [
        'password' => password_hash('userpass', PASSWORD_DEFAULT),
        'email' => 'user@example.com'
    ]
];

// Proses login
if (isset($_POST['login'])) {
    $requestUsername = $_POST['username'];
    $requestPassword = $_POST['password'];

    // Cek apakah username terdaftar
    if (isset($validUsers[$requestUsername])) {
        // Verifikasi password
        if (password_verify($requestPassword, $validUsers[$requestUsername]['password'])) {
            // Login berhasil
            $_SESSION['username'] = $requestUsername;
            $_SESSION['email'] = $validUsers[$requestUsername]['email'];
            header('Location: dashboard.php'); // Redirect ke dashboard
            exit;
        } else {
            // Password salah
            echo "
            <script>
                alert('Password salah, silakan coba lagi');
                window.location = 'login.php';
            </script>
            ";
        }
    } else {
        // Username tidak ditemukan
        echo "
        <script>
            alert('Username tidak ditemukan, silakan coba lagi');
            window.location = 'login.php';
        </script>
        ";
    }
}
?>

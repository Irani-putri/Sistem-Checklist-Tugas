<?php
session_start();

// File untuk menyimpan data pengguna
$userFile = 'users.txt';

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Validasi input
    if (empty($email) || empty($username) || empty($_POST['password'])) {
        echo "
            <script>
                alert('Pastikan Anda Mengisi Semua Data');
                window.location = 'register.php';
            </script>
        ";
    } else {
        // Cek apakah file data pengguna ada
        if (!file_exists($userFile)) {
            file_put_contents($userFile, ""); // Buat file jika belum ada
        }

        // Cek apakah email sudah terdaftar
        $users = file($userFile, FILE_IGNORE_NEW_LINES);
        foreach ($users as $user) {
            $userData = explode('|', $user);
            if ($userData[1] === $email) {
                echo "
                    <script>
                        alert('Email sudah terdaftar, silakan gunakan email lain.');
                        window.location = 'register.php';
                    </script>
                ";
                exit;
            }
        }

        // Tambahkan pengguna baru ke file
        $newUser = $username . '|' . $email . '|' . $password . PHP_EOL;
        file_put_contents($userFile, $newUser, FILE_APPEND);

        // Set sesi login otomatis
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;

        // Redirect ke halaman login
        echo "
            <script>
                alert('Registrasi Berhasil! Anda akan langsung masuk.');
                window.location = 'login.php';
            </script>
        ";
    }
}
?>

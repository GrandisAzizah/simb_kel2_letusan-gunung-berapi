<?php
// Jangan panggil session_start() di sini karena sudah ada di config.php
require_once 'config.php';

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: mainpage.php");
    exit();
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);

    // Validasi input
    if (empty($username) || empty($password)) {
        $error = "Username dan password harus diisi!";
    } else {
        // Query untuk mencari petugas berdasarkan username
        $sql = "SELECT id_petugas, nama_petugas, username, password, role, jabatan, no_telepon, instansi 
                FROM petugas 
                WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $petugas = $result->fetch_assoc();

        if ($petugas) {
            // Verifikasi password (asumsi password disimpan dalam bentuk plain text)
            if ($password === $petugas['password']) {
                // Login berhasil
                $_SESSION['user_id'] = $petugas['id_petugas'];
                $_SESSION['username'] = $petugas['username'];
                $_SESSION['nama_petugas'] = $petugas['nama_petugas'];
                $_SESSION['role'] = $petugas['role'];
                $_SESSION['jabatan'] = $petugas['jabatan'];
                
                // Redirect ke dashboard
                header("Location: mainpage.php");
                exit();
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Username tidak ditemukan!";
        }
        
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Gunung Berapi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            width: 100%;
            max-width: 400px;
        }
        
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }
        
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        
        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        
        .submit-btn:hover {
            background-color: #45a049;
        }
        
        .link-container {
            text-align: center;
            margin-top: 15px;
        }
        
        .link-container a {
            color: #4CAF50;
            text-decoration: none;
        }
        
        .link-container a:hover {
            text-decoration: underline;
        }
        
        .error {
            background-color: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .success {
            background-color: #e8f5e8;
            color: #2e7d32;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Login</h1>
            
            <?php if (!empty($error)): ?>
                <div class="error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
                <div class="success">Registrasi berhasil! Silakan login.</div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <!-- PERBAIKAN: Gunakan button, bukan anchor tag -->
                <button type="submit" class="submit-btn">Login</button>
            </form>
            
            <div class="link-container">
                <!-- PERBAIKAN: Typo "Bekim" menjadi "Belum" -->
                <p>Belum punya akun? <a href="registrasi.php">Daftar di sini</a></p>
            </div>
        </div>
    </div>
</body>

</html>


<?php
// Jangan panggil session_start() di sini karena sudah ada di config.php
require_once 'config.php';

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: status_gunung.html");
    exit();
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_petugas = sanitize($_POST['nama_petugas']);
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);
    $jabatan = sanitize($_POST['jabatan']);
    $no_telepon = sanitize($_POST['no_telepon']);
    $instansi = sanitize($_POST['instansi']);
    
    // Validasi input
    $required_fields = ['nama_petugas', 'username', 'password', 'jabatan', 'no_telepon'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = ucfirst(str_replace('_', ' ', $field)) . " harus diisi!";
        }
    }

    if (empty($errors)) {
        // Cek apakah username sudah ada
        $check_sql = "SELECT id_petugas FROM petugas WHERE username = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        
        if ($check_result->num_rows > 0) {
            $errors[] = "Username sudah digunakan!";
        } else {
            // Default role untuk user baru
            $role = "petugas";
            
            // Insert data petugas baru
            $sql = "INSERT INTO petugas (nama_petugas, username, password, role, jabatan, no_telepon, instansi) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $nama_petugas, $username, $password, $role, $jabatan, $no_telepon, $instansi);
            
            if ($stmt->execute()) {
                header("Location: login.php?success=1");
                exit();
            } else {
                $errors[] = "Gagal melakukan registrasi: " . $conn->error;
            }
            
            $stmt->close();
        }
        $check_stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Sistem Gunung Berapi</title>
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
            max-width: 500px;
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
        }
        
        .error ul {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Registrasi</h1>
            
            <?php if (!empty($errors)): ?>
                <div class="error">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="registrasi.php" method="POST">
                <div class="form-group">
                    <label for="nama_petugas">Nama Petugas</label>
                    <input type="text" id="nama_petugas" name="nama_petugas" value="<?php echo isset($_POST['nama_petugas']) ? htmlspecialchars($_POST['nama_petugas']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan" value="<?php echo isset($_POST['jabatan']) ? htmlspecialchars($_POST['jabatan']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="no_telepon">Nomor Telepon</label>
                    <input type="text" id="no_telepon" name="no_telepon" value="<?php echo isset($_POST['no_telepon']) ? htmlspecialchars($_POST['no_telepon']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="instansi">Instansi</label>
                    <input type="text" id="instansi" name="instansi" value="<?php echo isset($_POST['instansi']) ? htmlspecialchars($_POST['instansi']) : ''; ?>">
                </div>
                
                <button type="submit" class="submit-btn">Daftar</button>
            </form>
            
            <div class="link-container">
                <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
            </div>
        </div>
    </div>
</body>
</html>
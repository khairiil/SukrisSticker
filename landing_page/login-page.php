<?php
session_start(); 
require './nodes/connection.php';

if (isset($_POST['submit'])) {
    $inquiry = mysqli_real_escape_string($conn, $_POST['x']);
    $password = $_POST['password'];
    $query = "SELECT * FROM user WHERE username = '$inquiry' OR email = '$inquiry'";
    $search = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($search) === 1) {
        $credentials = mysqli_fetch_assoc($search);
        if (password_verify($password, $credentials['user_password'])) {
            $_SESSION['session'] = true;
            $_SESSION['username'] = $credentials['username']; 
            $_SESSION['account_role'] = $credentials['role'];
            
            $role = ($_SESSION['account_role'] === 'admin') ? 'admin' : 'user';
            $welcomeMessage = ($role === 'admin') ? 'admin' : ucfirst($credentials['username']);
            
            echo "
            <script>
                alert('Login berhasil! Selamat datang $welcomeMessage.');
                document.location.href = 'index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Password salah!');
            </script>
            ";
        }
    } else {
        echo "
        <script>
            alert('Username atau email tidak ditemukan!');
        </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-in</title>
    <link rel="stylesheet" href="./styles/login-register.css">
    <link rel="icon" href="./assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
    <div class="header-logo">
        <img src="./assets/logo.png" alt="logo">
    </div>
    <div class="card">
        <form action="" method="post">
            <h1>Sign in</h1>
            <div class="input-box">
                <input type="text" name="x" id="username" placeholder="Username or email" required>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" id="password" placeholder="Password"  minlength="8" required>
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="remember">
                <label for="remember-cred">
                    <input type="checkbox" id="remember-cred" required> Setuju dengan S&K
                </label>
                <a href="./index.php">Kembali?</a>
            </div>
            <button type="submit" class="button-submit" name="submit">Masuk</button>
            <div class="refer">
                <p>Belum punya akun? <a href="./register-page.php">Daftar</a></p>
            </div>
        </form>
    </div>
</body>
</html>

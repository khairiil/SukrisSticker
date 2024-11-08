<?php
require './nodes/connection.php';

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    $user_check = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    
    if (mysqli_num_rows($user_check) > 0) {
        echo "
        <script>
            alert('Username sudah ada!');
        </script>
        ";
    } elseif ($password !== $confirm_password) {
        echo "
        <script>
            alert('Password tidak sama!');
        </script>
        ";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO user (username, email, user_password, account_role) VALUES ('$username', '$email', '$hashed_password', 'user')";
        
        if (mysqli_query($conn, $insert_query)) {
            echo "
            <script>
                alert('Daftar berhasil!');
                document.location.href = 'login-page.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Daftar gagal! Silahkan coba lagi.');
            </script>
            ";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            <h1>Sign up</h1>
            <div class="input-box">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="input-box">
                <input type="email" name="email" id="email" placeholder="Email" required>
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="input-box">
                        <input type="password" name="password" id="password" placeholder="Password" minlength="8" required>
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="input-box">
                <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password"  minlength="8" required>
                <i class="fa-solid fa-lock"></i>
            </div>
            <button type="submit" class="button-submit" name="submit">Daftar</button>
            <div class="refer"><br>
                <p>Sudah punya akun? <a href="./login-page.php">Masuk</a></p>
                <br><br>
                <a href="./index.php">Kembali?</a>
            </div>
        </form>
    </div>
</body>
</html>

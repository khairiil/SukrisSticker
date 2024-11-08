<?php
    session_start();

    $isLoggedIn = isset($_SESSION['username']);
    $username = $isLoggedIn ? ucfirst($_SESSION['username']) : '';
    $role = $isLoggedIn && $_SESSION['account_role'] === 'admin' ? 'Admin' : $username;
?>
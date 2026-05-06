<?php
session_start();

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim(strtolower($_POST['email'] ?? ""));
    $password = trim($_POST['password'] ?? "");

    // Dummy authentication (ganti dengan database check)
    $validEmail = 'endmin@gmail.com';
    $validPassword = '123';

    if ($email === $validEmail && $password === $validPassword) {
        $_SESSION['user'] = $email;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Email atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login - Endmin</title>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body {
    font-family: Arial;
    background: #0e0e0e;
    color: #fefefe;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-container {
    background: #1a1a1a;
    padding: 50px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.5);
    width: 100%;
    max-width: 400px;
}

.login-container h1 {
    text-align: center;
    margin-bottom: 10px;
    color: #ffdd57;
}

.login-container p {
    text-align: center;
    color: #d7d7d7;
    margin-bottom: 30px;
    font-size: 14px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #d7d7d7;
    font-weight: 500;
}

.form-group input {
    width: 100%;
    padding: 12px;
    border: 1px solid #444;
    border-radius: 8px;
    font-size: 14px;
    background: #111;
    color: #fefefe;
    transition: 0.3s;
    box-sizing: border-box;
}

.form-group input::placeholder {
    color: #8b8b8b;
}

.form-group input:focus {
    outline: none;
    border-color: #ffdd57;
    box-shadow: 0 0 0 2px rgba(255,221,87,0.2);
}

.error {
    background: #ffe6e6;
    color: #c33;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 14px;
}

.btn-login {
    width: 100%;
    padding: 12px;
    background: #ffdd57;
    color: #111;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
    font-size: 14px;
}

.btn-login:hover {
    background: #f2c900;
}

.register-link {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
    color: #666;
}

.register-link a {
    color: #2c2f48;
    text-decoration: none;
    font-weight: 600;
}

.register-link a:hover {
    text-decoration: underline;
}

.logo-login {
    text-align: center;
    margin-bottom: 30px;
}

.logo-login img {
    height: 100px;
}

.back-link {
    text-align: center;
    margin-top: 20px;
}

.back-link a {
    color: #ffdd57;
    text-decoration: none;
    font-size: 14px;
    transition: 0.3s;
}

.back-link a:hover {
    color: #f2c900;
    text-decoration: underline;
}
</style>
</head>
<body>

<div class="login-container">
    <div class="logo-login">
        <img src="media/enfieldlogo.png" alt="Logo">
    </div>
    
    <h1>Login</h1>
    <p>Sebagai Endmin</p>
    
    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Masukkan email Anda" required>
        </div>
        
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password Anda" required>
        </div>
        
        <button type="submit" class="btn-login">Masuk</button>
    </form>
    
    <div class="back-link">
        <a href="dashboard.php">← Kembali ke Dashboard Utama</a>
    </div>
</div>

</body>
</html>

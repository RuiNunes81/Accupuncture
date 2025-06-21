<?php
// login.php
require_once 'auth.php';
session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = check_user_credentials($username, $password);
    
    print(hash('sha256', $password))
    if ($user) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid credentials.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container" style="max-width:400px;">
    <h1>Login</h1>
    <form method="post">
        <label>Username:</label> <input name="username" required><br>
        <label>Password:</label> <input name="password" type="password" required><br>
        <input type="submit" value="Login">
    </form>
    <?php if ($error): ?>
        <div style="color:red; margin-top:10px;"> <?= htmlspecialchars($error) ?> </div>
    <?php endif; ?>
</div>
</body>
</html>

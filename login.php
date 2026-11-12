<?php
require 'config.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT id, username, password_hash FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $row = $stmt->fetch();
    if ($row && password_verify($_POST['password'], $row['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id']  = $row['id'];
        $_SESSION['username'] = $row['username'];
        header('Location: dashboard.php');
        exit;
    }
    $msg = 'Invalid username or password.';
}
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Login</title><link rel="stylesheet" href="style.css"></head>
<body><div class="box">
<h2>CNS Portal: Login</h2>
<div class="msg"><?= $msg ?></div>
<form method="POST">
  <label>Username</label><input name="username" required>
  <label>Password</label><input type="password" name="password" required>
  <button type="submit">Log in</button>
</form>
<p>No account? <a href="signup.php">Sign up</a></p>
</div></body></html>

<?php
require 'config.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $full     = trim($_POST['full_name']);
    $email    = trim($_POST['email']);
    $pw       = $_POST['password'];
    if ($username === '' || $full === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($pw) < 6) {
        $msg = 'Fill in all fields correctly (password minimum 6 characters).';
    } else {
        $hash = password_hash($pw, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, full_name, email, password_hash) VALUES (?,?,?,?)");
            $stmt->execute([$username, $full, $email, $hash]);
            $msg = '<span class="ok">Account created! <a href="login.php">Log in</a></span>';
        } catch (PDOException $e) {
            $msg = ($e->getCode() === '23505') ? 'That username or email already exists.' : 'Could not create account.';
        }
    }
}
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Sign up</title><link rel="stylesheet" href="style.css"></head>
<body><div class="box">
<h2>Create account</h2>
<div class="msg"><?= $msg ?></div>
<form method="POST">
  <label>Username</label><input name="username" required>
  <label>Full name</label><input name="full_name" required>
  <label>Email</label><input type="email" name="email" required>
  <label>Password</label><input type="password" name="password" required>
  <button type="submit">Sign up</button>
</form>
<p>Already registered? <a href="login.php">Log in</a></p>
</div></body></html>

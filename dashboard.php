<?php
require 'config.php';
if (!isset($_SESSION['username'])) { header('Location: login.php'); exit; }
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Dashboard</title><link rel="stylesheet" href="style.css"></head>
<body><div class="box">
<h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
<p>You are logged in.</p>
<p><a href="feedback.php">Course feedback form</a> | <a href="logout.php">Log out</a></p>
</div></body></html>

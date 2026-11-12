<?php
require 'config.php';
if (!isset($_SESSION['username'])) { header('Location: login.php'); exit; }
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO feedback (username, course, message) VALUES (?,?,?)");
    $stmt->execute([$_SESSION['username'], $_POST['course'], $_POST['message']]);
    $msg = '<span class="ok">Feedback saved.</span>';
}
$rows = $pdo->query("SELECT username, course, message, submitted_at FROM feedback ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Feedback</title><link rel="stylesheet" href="style.css"></head>
<body><div class="box">
<h2>Course feedback</h2>
<div><?= $msg ?></div>
<form method="POST">
  <label>Course</label><input name="course" required>
  <label>Message</label><textarea name="message" rows="3" required></textarea>
  <button type="submit">Submit</button>
</form>
<table><tr><th>User</th><th>Course</th><th>Message</th><th>Time</th></tr>
<?php foreach ($rows as $r): ?>
<tr><td><?= htmlspecialchars($r['username']) ?></td><td><?= htmlspecialchars($r['course']) ?></td>
<td><?= htmlspecialchars($r['message']) ?></td><td><?= $r['submitted_at'] ?></td></tr>
<?php endforeach; ?>
</table>
<p><a href="dashboard.php">Back</a></p>
</div></body></html>

<?php
session_start();
if(!isset($_SESSION['email'])) die("Not logged in");

$answer = $_POST['answer'];
$task_id = $_POST['task_id'];
$reward = $_POST['reward'];

// Log task completion
$log = date('Y-m-d H:i:s') . " | TASK $task_id | User: {$_SESSION['email']} | Answer: $answer\n";
file_put_contents('admin/logs/tasks.txt', $log, FILE_APPEND);

// Update balance (fake)
$conn = new mysqli('localhost', 'root', '', 'taskrewards_db');
$stmt = $conn->prepare("UPDATE users SET balance = balance + ? WHERE email = ?");
$stmt->bind_param("ds", $reward, $_SESSION['email']);
$stmt->execute();

// Redirect back
header('Location: dashboard.php?credited=1');
exit();
?>

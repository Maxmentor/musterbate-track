<?php
// ===== DATABASE CONFIG =====

// Live server details (hosting se milega)
$host = "localhost";        // usually localhost
$user = "root";     // cPanel / hosting username
$pass = "";     // database password
$db   = "database_name";         // database name

// Start session (safe)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

// Set charset (important for live)
mysqli_set_charset($conn, "utf8");
?>

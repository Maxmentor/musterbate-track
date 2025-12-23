<?php
// ===== DATABASE CONFIG =====

// Live server details (hosting se milega)
$host = "sql111.infinityfree.com";        // usually localhost
$user = "if0_40697348";     // cPanel / hosting username
$pass = "Maxpro8115";     // database password
$db   = "if0_40697348_mustor";         // database name

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

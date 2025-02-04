<?php

$host = 'localhost'; // XAMPP's default localhost
$dbname = 'event_management'; // Replace with your actual database name
$username = 'root'; // Default username for XAMPP
$password = ''; // Default password for XAMPP (empty)

// Create a PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set error mode to exception for error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Log connection errors
    error_log("Connection failed: " . $e->getMessage());
}



?>
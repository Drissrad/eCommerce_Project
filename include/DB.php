<?php
$host = 'localhost';
$dbname = 'ecommerce';
$username = 'root';
$password = ''; // Add your database password here if you have one

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

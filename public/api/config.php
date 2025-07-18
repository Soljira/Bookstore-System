<?php
$host = getenv('DB_HOST') ?: '172.29.227.92';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: 'password';
$db   = getenv('DB_NAME') ?: 'bookstoreDB';
$port = 3306;


$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>



<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'pemweb_lanjut_login';

try {
    $connectdb = mysqli_connect($host, $user, $pass, $dbname);
    $connectdb = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $connectdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
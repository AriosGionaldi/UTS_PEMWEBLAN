<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
require_once(__DIR__ . '/../config/koneksi.php');

// Check if the connection was successful
if (!$connectdb) {
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed.'
    ]);
    exit;
}

// Get user input
$nama = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['pass'] ?? '';

// Basic validation
if (empty($nama) || empty($email) || empty($password)) {
    echo json_encode([
        'success' => false,
        'message' => 'Semua kolom harus diisi.'
    ]);
    exit;
}

// Prepare the SQL statement
$query = "INSERT INTO user (Name, Email, Password) VALUES (:name, :email, :password)";
$stmt = $connectdb->prepare($query);

// Bind parameters
$stmt->bindParam(':name', $nama, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);

// Execute the statement
try {
    $result = $stmt->execute();
    if ($result) {
        echo json_encode([
            'success' => true,
            'message' => 'Registrasi berhasil!'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Registrasi gagal. Coba lagi.'
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Registrasi gagal. ' . $e->getMessage()
    ]);
}
?>
<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
require_once(__DIR__ . '/koneksi.php');

// Check if the connection was successful
if (!$connectdb) {
    die("Database connection failed: " . print_r($connectdb->errorInfo(), true));
}

$email = $_POST['Email'] ?? ''; // Use null coalescing operator for safety
$pss = $_POST['Password'] ?? '';

try {
    // Prepare the SQL statement
    $stmt = $connectdb->prepare("SELECT * FROM user WHERE Email = :email AND Password = :password");
    
    // Bind parameters
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $pss, PDO::PARAM_STR);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the number of rows returned
    $rowcount = $stmt->rowCount();

    if ($rowcount > 0) {
        session_start(); // Start the session
        $_SESSION['U'] = $email; // Store email in session
        echo "Login berhasil!";
    } else {
        echo "Email atau password salah!";
    }
} catch (PDOException $e) {
    // Log the error and return a generic error message
    error_log("Database error: " . $e->getMessage());
    echo "Terjadi kesalahan. Silakan coba lagi nanti.";
}

// The connection will be closed automatically when the script ends
?>
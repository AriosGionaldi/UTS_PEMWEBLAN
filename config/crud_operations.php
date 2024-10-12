<?php
require 'koneksi.php';

header('Content-Type: application/json');

function sanitize($input)
{
    return htmlspecialchars(strip_tags($input));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    switch ($action) {
        case 'create':
            $email = sanitize($_POST['email']);
            $password = sanitize($_POST['password']);
            $name = sanitize($_POST['name']);

            $stmt = $connectdb->prepare("INSERT INTO user (Email, Password, Name) VALUES (?, ?, ?)");
            $stmt->execute([$email, $password, $name]);

            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'User created successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to create user']);
            }
            break;

        case 'update':
            $id = intval($_POST['id']);
            $email = sanitize($_POST['email']);
            $name = sanitize($_POST['name']);

            // Only update password if a new one is provided
            if (!empty($_POST['password'])) {
                $password = sanitize($_POST['password']);
                $stmt = $connectdb->prepare("UPDATE user SET Email = ?, Password = ?, Name = ? WHERE id_user = ?");
                $stmt->execute([$email, $password, $name, $id]);
            } else {
                $stmt = $connectdb->prepare("UPDATE user SET Email = ?, Name = ? WHERE id_user = ?");
                $stmt->execute([$email, $name, $id]);
            }

            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'User updated successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'No changes made or user not found']);
            }
            break;

        case 'delete':
            $id = intval($_POST['id']);
            $stmt = $connectdb->prepare("DELETE FROM user WHERE id_user = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'User deleted successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'User not found or already deleted']);
            }
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
            break;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'read') {
    $id = intval($_GET['id']);
    $stmt = $connectdb->prepare("SELECT id_user, Email, Password, Name FROM user WHERE id_user = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode(['success' => true, 'data' => $user]);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
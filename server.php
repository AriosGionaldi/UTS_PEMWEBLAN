<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

require 'koneksi.php';
require 'Datatables.php';

$dataTables = new Datatables();

$query = "SELECT id_user, Email, Password, Name FROM user";
$where = null;
$isWhere = null;
$search = ['id_user', 'Email', 'Password', 'Name'];

try {
    $response = $dataTables->getQuery($connectdb, $query, $where, $isWhere, $search);
    echo $response;
} catch (Exception $e) {
    echo json_encode([
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
}
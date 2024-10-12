<?php
require 'koneksi.php';

$stmt = $connectdb->query("SELECT * FROM user");
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);

?>
<?php
include 'db_conn.php';

// Query to get seller locations
$stmt = $conn->prepare("SELECT * FROM sellers WHERE latitude IS NOT NULL AND longitude IS NOT NULL");
$stmt->execute();
$sellers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output seller locations as JSON
header('Content-Type: application/json');
echo json_encode($sellers);
?>

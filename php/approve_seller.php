<?php
include "../db_conn.php";
include 'User.php';

session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['fname'])) {
    $user = getUserById($_SESSION['user_id'], $conn);

    if ($user) {
        if (isset($_GET['id'])) {
            $sellerId = $_GET['id'];

            approveSeller($sellerId, $conn);

            header("Location: ../sellers.php");
            exit;
        } else {
            header("Location: ../sellers.php");
            exit;
        }
    } else {
        header("Location: login.php");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}

function approveSeller($sellerId, $conn) {
    $sql = "UPDATE sellers SET status = 'approved' WHERE seller_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$sellerId]);
}
?>

<?php
include "db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $businessname = $_POST['businessname'];
    $businessnumber = $_POST['businessnumber'];
    $location = $_POST['location'];
    $date = $_POST['date_registered']; 
    $sql = "INSERT INTO registereddti (fname, businessname, businessnumber, location, date_registered) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([$fullname, $businessname, $businessnumber, $location, $date])) {
        echo 'success'; 
    } else {
        echo 'error'; 
    }
}
?>

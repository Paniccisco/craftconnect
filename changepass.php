<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['fname'])) {
    header("Location: login.php");
    exit;
}

include "db_conn.php";
include 'php/User.php';

$user = getUserById($_SESSION['user_id'], $conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];


    if (password_verify($currentPassword, $user['password'])) {

        if ($newPassword === $confirmPassword) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password = :password WHERE user_id = :user_id");
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':user_id', $user['user_id']);
            $stmt->execute();

            header("Location: login.php");
            exit;
        } else {
            $error = "New password and confirm password do not match.";
        }
    } else {
        $error = "Current password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.png">
    <title>User Change Password</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <form class="shadow w-450 p-3" action="" method="post">
            <h4 class="display-4 fs-1">Change Password</h4><br>
            <button>
                <a href="userhome.php" class="btn btn-primary">Back</a>
            </button>
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <div class="mb-3">
                <label class="form-label">Current Password</label>
                <input type="password" class="form-control" name="current_password">
            </div>

            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="password" class="form-control" name="new_password">
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password">
            </div>

            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>
    </div>
</body>

</html>
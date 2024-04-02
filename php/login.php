<?php
session_start();

if (isset($_POST['uname']) && isset($_POST['pass'])) {
    include "../db_conn.php";

    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $data = "uname=" . $uname;

    if (empty($uname)) {
        $em = "User name is required";
        exit;
    } else if (empty($pass)) {
        $em = "Password is required";
        exit;
    } else {

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$uname]);
        $user = $stmt->fetch();

        if ($user && password_verify($pass, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['fname'] = $user['fname'];
            $_SESSION['pp'] = $user['pp'];

            header("Location: userhome.php");
            exit;
        }

        $stmt = $conn->prepare("SELECT * FROM sellers WHERE username = ?");
        $stmt->execute([$uname]);
        $seller = $stmt->fetch();

        if ($seller && password_verify($pass, $seller['password'])) {
            if ($seller['status'] == 'approved') {
                $_SESSION['seller_id'] = $seller['seller_id'];
                $_SESSION['fname'] = $seller['businessname'];
                $_SESSION['pp'] = $seller['pp'];

                header("Location: sellerhome.php");
                exit;
            } elseif ($seller['status'] == 'pending') {
                $em = "Your account is still pending approval. Please wait for admin approval.";
                echo "<script>window.alert('$em')</script>";
                echo "<script>window.location.href='../login.php'</script>";
                exit;
            } else {
                $em = "Your account has not been approved. Please contact the admin for assistance.";
                echo "<script>window.alert('$em')</script>";
                echo "<script>window.location.href='../login.php'</script>";
                exit;
            }
        }

        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
        $stmt->execute([$uname]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($pass, $admin['password'])) {
            $_SESSION['id'] = $admin['id'];
            $_SESSION['fname'] = "Admin";
            $_SESSION['pp'] = "";

            header("Location: ./adminhome.php");
            exit;
        } else {
            $em = "Invalid username or password";
            echo "<script>window.alert('$em')</script>";
            echo "<script>window.location.href='../login.php'</script>";

            exit;
        }
    }
} else {
    $em = "Invalid username or password";
    echo "window.alert('$em')";
    echo "window.location.href='../login.php";
    exit;
}

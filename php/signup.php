<?php
session_start();
if (
    isset($_POST['fname']) &&
    isset($_POST['uname']) &&
    isset($_POST['pass']) &&
    isset($_POST['mob']) &&
    isset($_POST['address']) &&
    isset($_POST['email'])
) {

    include "../db_conn.php";

    $fname = $_POST['fname'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $mob = $_POST['mob'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    $data = "fname=" . $fname . "&uname=" . $uname . "&mob=" . $mob . "&address=" . $address . "&email=" . $email;

    if (empty($fname) || empty($mob) || empty($address) || empty($email)) {
        $em = "Full name, email, mobile number, and address are required";
        header("Location: ../login.php?error=$em&$data");
        exit;
    } else if (empty($uname)) {
        $em = "User name is required";
        header("Location: ../login.php?error=$em&$data");
        exit;
    } else if (empty($pass)) {
        $em = "Password is required";
        header("Location: ../login.php?error=$em&$data");
        exit;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $em = "Invalid email format";
        header("Location: ../login.php?error=$em&$data");
        exit;
    } else {

        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $new_img_name = null; // Initialize $new_img_name

        if (isset($_FILES['pp']['name']) and !empty($_FILES['pp']['name'])) {

            $img_name = $_FILES['pp']['name'];
            $tmp_name = $_FILES['pp']['tmp_name'];
            $error = $_FILES['pp']['error'];

            if ($error === 0) {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_to_lc = strtolower($img_ex);

                $allowed_exs = array('jpg', 'jpeg', 'png');
                if (in_array($img_ex_to_lc, $allowed_exs)) {
                    $new_img_name = uniqid($uname, true) . '.' . $img_ex_to_lc;
                    $img_upload_path = '../upload/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                } else {
                    $em = "You can't upload files of this type";
                    header("Location: ../login.php?error=$em&$data");
                    exit;
                }
            } else {
                $em = "Unknown error occurred!";
                header("Location: ../login.php?error=$em&$data");
                exit;
            }
        }

        $pp_value = $new_img_name ? $new_img_name : 'default_pp.png';

        $sql = "INSERT INTO users(fname, username, password, pp, mobile, address, email) 
                VALUES(?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$fname, $uname, $pass, $pp_value, $mob, $address, $email]);

        $_SESSION['success'] = "Your account has been created successfully";
        header("Location: ../login.php");
        exit;
    }
} else {
    header("Location: ../login.php?error=error");
    exit;
}
?>

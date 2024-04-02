<?php

session_start();

if (isset($_SESSION['user_id']) && isset($_POST['uname'])) {

    include "../db_conn.php";

    $uname = $_POST['uname'];
    $old_pp = $_POST['old_pp'];
    $id = $_SESSION['user_id'];

    if (empty($uname)) {
        $em = "username are required";
        header("Location: ../accountsettings.php?error=$em");
        exit;
    } else {

        if (isset($_FILES['pp']['name']) && !empty($_FILES['pp']['name'])) {
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
                    $old_pp_des = "../upload/$old_pp";

                    if (unlink($old_pp_des)) {
                        move_uploaded_file($tmp_name, $img_upload_path);
                    } else {
                        move_uploaded_file($tmp_name, $img_upload_path);
                    }

                    $sql = "UPDATE users 
                            SET username=?, pp=?
                            WHERE user_id=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$uname, $new_img_name, $id]);

                    $_SESSION['success'] = "Your account has been updated successfully";
                    header("Location: ../accountsettings.php");
                    exit;
                } else {
                    $em = "You can't upload files of this type";
                    header("Location: ../accountsettings.php?error=$em");
                    exit;
                }
            } else {
                $em = "Unknown error occurred!";
                header("Location: ../accountsettings.php?error=$em");
                exit;
            }
        } else {
            $sql = "UPDATE users 
                    SET username=?
                    WHERE user_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$uname, $id]);

            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Your account has been updated successfully";
            header("Location: ../accountsettings.php");
            exit;
        }
    }

} else {
    header("Location: ../accountsettings.php");
    exit;
}
?>

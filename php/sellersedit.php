<?php
session_start();

if (isset($_SESSION['seller_id']) && isset($_SESSION['fname'])) {

    if (
        isset($_POST['fname']) &&
        isset($_POST['uname']) &&
        isset($_POST['mobile']) &&
        isset($_POST['businessname']) &&
        isset($_POST['location']) &&
        isset($_POST['typeofcraft'])
    ) {

        include "../db_conn.php";

        $fname = $_POST['fname'];
        $uname = $_POST['uname'];
        $mobile = $_POST['mobile'];
        $businessname = $_POST['businessname'];
        $location = $_POST['location'];
        $typeofcraft = $_POST['typeofcraft'];
        $old_pp = $_POST['old_pp'];
        $id = $_SESSION['seller_id'];

        if (empty($fname) || empty($mobile) || empty($businessname) || empty($location) || empty($typeofcraft)) {
            $em = "All fields are required";
            header("Location: ../sellersedit.php?error=$em");
            exit;
        } else {

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

                        $old_pp_des = "../upload/$old_pp";
                        if (unlink($old_pp_des)) {
                            move_uploaded_file($tmp_name, $img_upload_path);
                        } else {
                            move_uploaded_file($tmp_name, $img_upload_path);
                        }

                        $sql = "UPDATE sellers 
                                SET fname=?, username=?, mobile=?, businessname=?, location=?, typeofcraft=?, pp=?
                                WHERE seller_id=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([$fname, $uname, $mobile, $businessname, $location, $typeofcraft, $new_img_name, $id]);
                        $_SESSION['fname'] = $fname;
                        $_SESSION['success'] = "Your account has been updated successfully";
                        header("Location: ../selleredit.php");
                        exit;
                    } else {
                        $em = "You can't upload files of this type";
                        header("Location: ../sellersedit.php?error=$em");
                        exit;
                    }
                } else {
                    $em = "unknown error occurred!";
                    header("Location: ../sellersedit.php?error=$em");
                    exit;
                }
            } else {
                $sql = "UPDATE sellers 
                        SET fname=?, username=?, mobile=?, businessname=?, location=?, typeofcraft=?
                        WHERE seller_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$fname, $uname, $mobile, $businessname, $location, $typeofcraft, $id]);
                $_SESSION['success'] = "Your account has not been updated successfully";
                header("Location: ../sellersedit.php");
                exit;
            }
        }
    } else {
        $_SESSION['error'] = "Your account has not been updated successfully";
        header("Location: ../sellersedit.php");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}

<?php
session_start();
if (
    isset($_POST['fname']) &&
    isset($_POST['mobile']) &&
    isset($_POST['uname']) &&
    isset($_POST['pass']) &&
    isset($_POST['businessname']) &&
    isset($_POST['location']) &&
    isset($_POST['typeofcraft']) &&
    isset($_POST['latitude']) &&
    isset($_POST['longitude']) &&
    isset($_POST['businessnumber']) &&
    isset($_POST['email']) // Added email field check
) {

    include "../db_conn.php";

    $fname = $_POST['fname'];
    $mobile = $_POST['mobile'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $businessname = $_POST['businessname'];
    $location = $_POST['location'];
    $typeofcraft = $_POST['typeofcraft'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $businessnumber = $_POST['businessnumber'];
    $email = $_POST['email']; // Added email field

    $data = "fname=" . $fname . "&mobile=" . $mobile . "&uname=" . $uname . "&businessname=" . $businessname . "&location=" . $location . "&typeofcraft=" . $typeofcraft . "&latitude=" . $latitude . "&longitude=" . $longitude . "&businessnumber=" . $businessnumber . "&email=" . $email;

    $stmt = $conn->prepare("SELECT * FROM sellers WHERE username = ?");
    $stmt->execute([$uname]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $em = "Username already exists";
        header("Location: ../regseller.php?error=$em&$data");
        exit;
    }

    if (empty($fname)) {
        $em = "Full name is required";
        header("Location: ../regseller.php?error=$em&$data");
        exit;
    } else if (empty($mobile)) {
        $em = "Mobile number is required";
        header("Location: ../regseller.php?error=$em&$data");
        exit;
    } else if (empty($uname)) {
        $em = "User name is required";
        header("Location: ../regseller.php?error=$em&$data");
        exit;
    } else if (empty($pass)) {
        $em = "Password is required";
        header("Location: ../regseller.php?error=$em&$data");
        exit;
    } else if (empty($businessname)) {
        $em = "Business name is required";
        header("Location: ../regseller.php?error=$em&$data");
        exit;
    } else if (empty($location)) {
        $em = "Location is required";
        header("Location: ../regseller.php?error=$em&$data");
        exit;
    } else if (empty($typeofcraft)) {
        $em = "Type of craft is required";
        header("Location: ../regseller.php?error=$em&$data");
        exit;
    } else if (empty($email)) {
        $em = "Email is required";
        header("Location: ../regseller.php?error=$em&$data");
        exit;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $em = "Invalid email format";
        header("Location: ../regseller.php?error=$em&$data");
        exit;
    } else {

        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $new_img_name = null;

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

                    $pp_value = $new_img_name ? $new_img_name : 'default_pp.png';

                    $sql = "INSERT INTO sellers(fname, mobile, username, password, businessname, location, typeofcraft, pp, status, latitude, longitude, businessnumber, email) 
                            VALUES(?,?,?,?,?,?,?, 'pending',?,?,?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$fname, $mobile, $uname, $pass, $businessname, $location, $typeofcraft, $new_img_name, $latitude, $longitude, $businessnumber, $email]);

                    header("Location: ../regseller.php?success=Your account has been created successfully. Waiting for admin approval.");
                    exit;
                } else {
                    $em = "You can't upload files of this type";
                    header("Location: ../regseller.php?error=$em&$data");
                    exit;
                }
            } else {
                $em = "Unknown error occurred!";
                header("Location: ../regseller.php?error=$em&$data");
                exit;
            }
        } else {
            $pp_value = $new_img_name ? $new_img_name : 'default_pp.png';

            $sql = "INSERT INTO sellers(fname, mobile, username, password, pp, businessname, location, typeofcraft, status, latitude, longitude, businessnumber, email) 
                    VALUES(?,?,?,?,?,?,?,?, 'pending',?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fname, $mobile, $uname, $pass, $pp_value, $businessname, $location, $typeofcraft, $latitude, $longitude, $businessnumber, $email]);

            header("Location: ../regseller.php?success=Your account has been created successfully. Waiting for admin approval.");
            exit;
        }
    }
} else {
    header("Location: ../regseller.php?error=error");
    exit;
}
?>

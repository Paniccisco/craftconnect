<?php
session_start();

if (!isset($_SESSION['seller_id']) || !isset($_SESSION['fname'])) {
    header("Location: login.php");
    exit;
}

include "db_conn.php";
include 'php/Seller.php';

$user = getUserById($_SESSION['seller_id'], $conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if (password_verify($currentPassword, $user['password'])) {

        if ($newPassword === $confirmPassword) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE sellers SET password = :password WHERE seller_id = :seller_id");
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':seller_id', $user['seller_id']);
            $stmt->execute();

            header("Location: sellersedit.php?success=true");
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
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Aria is a business focused HTML landing page template built with Bootstrap to help you create lead generation websites for companies and their services.">
    <meta name="author" content="Inovatik">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content="" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>CraftConnect | <?= $user['fname'] ?></title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <link href="css/swiper.css" rel="stylesheet">
    <link href="css/magnific-popup.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="images/favicon2.png">
</head>
<style>
    div.elem-group {
        margin-bottom: 20px;
    }

    div.elem-group.inlined {
        width: 100%;
        display: flex;
    }

    label {
        display: block;
        font-family: 'Nanum Gothic';
        font-size: 1.30em;
    }

    input,
    select,
    textarea {
        border-radius: 2px;
        border: 2px solid #777;
        box-sizing: border-box;
        font-size: 1.25em;
        font-family: 'Nanum Gothic';
        width: 100%;
        padding: 10px;
    }

    div.elem-group.inlined input {
        width: 90%;
        height: 45px;
        width: 30%;
        margin-right: 30px;
        display: inline-block;
    }

    div.elem-group.inlined label {
        width: 15%;
        margin-right: -50px;
    }

    textarea {
        height: 150px;
        width: 100%;
    }

    hr {
        border: 1px dotted #ccc;
        margin: 20px 0;
    }

    h2 {
        color: white;
        text-align: center;
    }

    button {
        height: 50px;
        background: #ff5500;
        border: none;
        color: white;
        font-size: 1.25em;
        font-family: 'Nanum Gothic';
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        border: 1px solid #fff;
    }

    /* #booking-form {
                background-color: #113448;
                width: 100%;
                border: 1px solid rgb(0, 0, 0);
                padding: 50px;
                margin: auto;
                margin-top: -50px;
            } */
</style>

<body data-spy="scroll" data-target=".fixed-top">

    <!-- Preloader -->
    <div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- end of preloader -->


    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark navbar-custom fixed-top">
        <!-- Text Logo - Use this if you don't have a graphic logo -->
        <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Aria</a> -->

        <!-- Image Logo -->
        <a class="navbar-brand logo-image" href="sellerhome.php"><img src="images/favicon2.png" alt="alternative"></a>

        <!-- Mobile Menu Toggle Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-awesome fas fa-bars"></span>
            <span class="navbar-toggler-awesome fas fa-times"></span>
        </button>
        <!-- end of mobile menu toggle button -->

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="sellerhome.php">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link page-scroll" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        MY PAGE
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Set up Page</a>
                        <a class="dropdown-item" href="#">Add Product</a>
                        <a class="dropdown-item" href="#">Pending Orders</a>
                        <a class="dropdown-item" href="#">Revenue</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="sellersedit.php">PROFILE</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="upload/<?= $user['pp'] ?>" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Hello, <?= $user['username'] ?>!</a>
                        <a class="dropdown-item" href="logout.php">Sign Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav> <!-- end of navbar -->
    <!-- end of navbar -->

    <!-- Header -->
    <header id="header" class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>PROFILE</h1>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of ex-header -->

    <!-- Breadcrumbs -->
    <div class="ex-basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs">
                        <a href="sellerhome.php">Home</a><i class="fa fa-angle-double-right"></i><span>Profile</span>
                    </div> <!-- end of breadcrumbs -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of ex-basic-1 -->
    <!-- end of breadcrumbs -->


    <!-- Privacy Content -->
    <div class="ex-basic-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <section id="booking-form">
                        <form class="shadow w-450 p-3" action="php/sellersedit.php" method="post" enctype="multipart/form-data">
                            <?php if (isset($_GET['error'])) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $_GET['error']; ?>
                                </div>
                            <?php } ?>

                            <?php if (isset($_SESSION['success'])) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $_SESSION['success']; ?>
                                </div>
                            <?php
                                unset($_SESSION['success']);
                            } ?>
                            <div class="elem-group">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="fname" value="<?php echo $user['fname'] ?>">
                            </div>

                            <div class="elem-group">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="uname" value="<?php echo $user['username'] ?>">
                            </div>

                            <div class="elem-group">
                                <label class="form-label">Mobile</label>
                                <input type="text" class="form-control" name="mobile" value="<?php echo $user['mobile'] ?>">
                            </div>

                            <div class="elem-group">
                                <label class="form-label">Business Name</label>
                                <input type="text" class="form-control" name="businessname" value="<?php echo $user['businessname'] ?>">
                            </div>

                            <div class="elem-group">
                                <label class="form-label">Business Number</label>
                                <p class="form-control"><?php echo $user['businessnumber'] ?></p>
                            </div>

                            <div class="elem-group">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="location" value="<?php echo $user['location'] ?>">
                            </div>

                            <div class="elem-group">
                                <label for="typeofcraft" class="form-label">Type of Handicraft</label>
                                <select class="custom-select" id="typeofcraft" name="typeofcraft" autocomplete="off" required>
                                    <option value="">Select Your Type of Handicraft</option>
                                    <option value="Agimats amulets" <?php echo ($user['typeofcraft'] === 'Agimats amulets') ? 'selected' : ''; ?>>Agimats amulets</option>
                                    <option value="Lapida" <?php echo ($user['typeofcraft'] === 'Lapida') ? 'selected' : ''; ?>>Lapida</option>
                                    <option value="Palayok" <?php echo ($user['typeofcraft'] === 'Palayok') ? 'selected' : ''; ?>>Palayok</option>
                                    <option value="Wood Carving" <?php echo ($user['typeofcraft'] === 'Wood Carving') ? 'selected' : ''; ?>>Wood Carving</option>
                                    <option value="Weaving" <?php echo ($user['typeofcraft'] === 'Weaving') ? 'selected' : ''; ?>>Weaving</option>
                                </select>
                            </div>

                            <div class="elem-group">
                                <label class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" name="pp">
                                <img src="upload/<?= $user['pp'] ?>" class="rounded-circle" style="width: 70px">
                                <input type="text" hidden="hidden" name="old_pp" value="<?= $user['pp'] ?>">
                            </div>

                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changePasswordModal">Change Password</button>
                        </form>
                    </section>
                </div> <!-- end of col-->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of ex-basic-2 -->
    <!-- end of privacy content -->

    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to save changes?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmSave">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this modal at the end of your HTML body -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="currentPassword">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" name="current_password" required>
                        </div>
                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="new_password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                        </div>
                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($error_current_password)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_current_password; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($error_confirm_password)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_confirm_password; ?>
                            </div>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="passwordChangeSuccessModal" tabindex="-1" role="dialog" aria-labelledby="passwordChangeSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordChangeSuccessModalLabel">Password Change Successfully</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.href='login.php'">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    You have been logged out for security reasons.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Stay on Page</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumbs -->
    <div class="ex-basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs">
                        <a href="sellerhome.php">Home</a><i class="fa fa-angle-double-right"></i><span>Profile</span>
                    </div> <!-- end of breadcrumbs -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of ex-basic-1 -->
    <!-- end of breadcrumbs -->


    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-container about">
                        <h4>Few Words About IslandHopper</h4>
                        <p class="white">Join us at IslandHopper and unlock the door to a realm of island enchantment. Your next idyllic retreat awaits, and we're here to make the journey as enchanting as the destination itself.</p>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-md-2">
                    <div class="text-container">
                        <h4>Links</h4>
                        <ul class="list-unstyled li-space-lg white">
                            <li>
                                <a class="about-us" href="aboutus.html">About us</a>
                            </li>
                            <li>
                                <a class="terms-of-service-link" href="#">Terms of Service</a>
                            </li>
                            <li>
                                <a class="privacy-policy-link" href="#">Privacy Policy</a>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-md-2">
                    <div class="text-container">
                        <h4>Partners</h4>
                        <ul class="list-unstyled li-space-lg">
                            <li>
                                <a class="white" href="unicorns.com">unicorns.com</a>
                            </li>
                            <li>
                                <a class="white" href="staffmanager.com">staffmanager.com</a>
                            </li>
                            <li>
                                <a class="white" href="association.gov">association.gov</a>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->
                </div>
                <div class="col-md-2">
                    <div class="text-container">
                        <h4>Partners</h4>
                        <ul class="list-unstyled li-space-lg">
                            <li>
                                <a class="white" href="#SkyTeam.com">SkyTeam.com</a>
                            </li>
                            <li>
                                <a class="white" href="StarAlliance.com">StarAlliance.com</a>
                            </li>
                            <li>
                                <a class="white" href="Oneworld.com">Oneworld.com</a>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col --> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of footer -->
    <!-- end of footer -->



    <!-- Scripts -->
    <script src="js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="js/morphext.min.js"></script> <!-- Morphtext rotating text in the header -->
    <script src="js/isotope.pkgd.min.js"></script> <!-- Isotope for filter -->
    <script src="js/validator.min.js"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
    <script src="js/index.js"></script>
    <script src="sellerusername_checker.js"></script>
</body>

</html>
<?php

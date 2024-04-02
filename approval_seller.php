<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['fname'])) {

    include "db_conn.php";
    include 'php/Admin.php';
    $user = getUserById($_SESSION['user_id'], $conn);

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
        <title>CraftConnect</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:500,700&display=swap&subset=latin-ext" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600&display=swap&subset=latin-ext" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/fontawesome-all.css" rel="stylesheet">
        <link href="css/swiper.css" rel="stylesheet">
        <link href="css/magnific-popup.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">

        <!-- Favicon  -->
        <link rel="icon" href="images/favicon2.png">
    </head>
    <?php if ($user) { ?>

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
                <a class="navbar-brand logo-image" href="adminhome.php"><img src="images/favicon2.png" alt="alternative">islandhopper</a>

                <!-- Mobile Menu Toggle Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-awesome fas fa-bars"></span>
                    <span class="navbar-toggler-awesome fas fa-times"></span>
                </button>
                <!-- end of mobile menu toggle button -->

                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="adminhome.php">HOME <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link page-scroll" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                SELLERS
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="approval_seller.php">Approval</a>
                                <a class="dropdown-item" href="sellers.php">List of Sellers</a>
                                <a class="dropdown-item" href="registereddti.php">List of DIT Numbers</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="upload/<?= $user['pp'] ?>" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Hello, <?= $user['username'] ?>!</a>
                                <a class="dropdown-item" href="accountsettings.php">Account Settings</a>
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
                            <h1>Pending Approval for Sellers</h1>
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
                                <a href="adminhome.php">Home</a><i class="fa fa-angle-double-right"></i><span>Approval</span>
                            </div> <!-- end of breadcrumbs -->
                        </div> <!-- end of col -->
                    </div> <!-- end of row -->
                </div> <!-- end of container -->
            </div> <!-- end of ex-basic-1 -->
            <!-- end of breadcrumbs -->


            <!-- Privacy Content -->
            <div class="ex-basic-2">
                <div class="container">
                    <div class="main-content">
                        <header>
                            <form action="" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" id="searchartisans" placeholder="Search artisans..." oninput="filterartisan()">
                                </div>
                            </form>
                        </header>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-container">
                                <div class="userdetails">
                                    <table class="table">
                                        <thead class="thead">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Mobile</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Business Name</th>
                                                <th scope="col">Business No.</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Type of Craft</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="users">
                                            <?php
                                            $counter = 1;
                                            if (isset($_GET['search'])) {
                                                $filtervalues = $_GET['search'];
                                                $query = "SELECT * FROM sellers WHERE status = 'pending' AND CONCAT(fname, mobile, username, businessname, location, typeofcraft) LIKE '%$filtervalues%'";
                                            } else {
                                                $query = "SELECT * FROM sellers WHERE status = 'pending'";
                                            }

                                            $stmt = $conn->prepare($query);
                                            $stmt->execute();

                                            if ($stmt->rowCount() > 0) {
                                                while ($items = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                    <tr>
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= $items['fname']; ?></td>
                                                        <td><?= $items['mobile']; ?></td>
                                                        <td><?= $items['username']; ?></td>
                                                        <td><?= $items['businessname']; ?></td>
                                                        <td><?= $items['businessnumber']; ?></td>
                                                        <td><?= $items['location']; ?></td>
                                                        <td><?= $items['typeofcraft']; ?></td>
                                                        <td><button class="btn btn-warning  "><?= ucfirst($items['status']); ?></button></td>
                                                        <td>
                                                            <?php if ($items['status'] == 'pending') { ?>
                                                                <a href="#" class="btn btn-success approveBtn" data-seller-id="<?= $items['seller_id'] ?>">Approve</a>
                                                            <?php } else { ?>
                                                                Approved
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            } else {
                                                echo '<tr><td colspan="10">No Pending Approval Found</td></tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end of text container -->

                        </div> <!-- end of col-->
                    </div> <!-- end of row -->
                </div> <!-- end of container -->
            </div> <!-- end of ex-basic-2 -->
            <!-- end of privacy content -->

            <!-- Confirmation Modal -->
            <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmModalLabel">Confirm Approval</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to approve this seller <span id="sellerName"></span>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="confirmApproveBtn">Yes, Approve</button>
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
                                <a href="adminhome.php">Home</a><i class="fa fa-angle-double-right"></i><span>Approval</span>
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
            <script src="js/FAQ.js"></script>
        <?php } else {
        header("Location: login.php");
        exit;
    } ?>
        </body>

    </html>

<?php } else {
    header("Location: login.php");
    exit;
} ?>

<script>
    $(document).ready(function() {
        // Show modal when approve button is clicked
        $('.approveBtn').click(function() {
            var sellerId = $(this).data('seller-id');
            $('#confirmApproveBtn').data('seller-id', sellerId); // Set seller ID in confirm button data attribute
            $('#confirmModal').modal('show');
        });

        // Handle approve confirmation
        $('#confirmApproveBtn').click(function() {
            var sellerId = $(this).data('seller-id');
            // Redirect to approve seller script with seller ID
            window.location.href = 'php/approve_seller.php?id=' + sellerId;
        });
    });
</script>
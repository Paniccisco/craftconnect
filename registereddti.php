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
                            <h1>Registered DTI Sellers</h1>
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
                                <a href="adminhome.php">Home</a><i class="fa fa-angle-double-right"></i><span>Registered</span>
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
                                    <input type="text" id="searchartisans" placeholder="Search artisans..." oninput="filterregistered()">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSellerModal">
                                        Add Seller
                                    </button>
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
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Business Name</th>
                                                <th>Business No.</th>
                                                <th>Address</th>
                                                <th>Date Registered</th>
                                            </tr>
                                        </thead>
                                        <tbody id="users">
                                            <?php
                                            $counter = 1;
                                            $con = mysqli_connect("localhost", "root", "", "testing_approve");

                                            if (isset($_GET['search'])) {
                                                $filtervalues = $_GET['search'];
                                                $query = "SELECT * FROM registereddti WHERE CONCAT(fname, businessname, businessnumber, location, date_registered) LIKE '%$filtervalues%'";
                                                $query_run = mysqli_query($con, $query);

                                                if (mysqli_num_rows($query_run) > 0) {
                                                    while ($items = mysqli_fetch_assoc($query_run)) {
                                            ?>
                                                        <tr>
                                                            <td><?= $items['id']; ?></td>
                                                            <td><?= $items['fname']; ?></td>
                                                            <td><?= $items['businessname']; ?></td>
                                                            <td><?= $items['businessnumber']; ?></td>
                                                            <td><?= $items['location']; ?></td>
                                                            <td><?= $items['date_registered']; ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    echo '<tr><td colspan="8" class="no-record">No Record Found</td></tr>';
                                                }
                                            } else {
                                                $query = "SELECT * FROM registereddti";
                                                $query_run = mysqli_query($con, $query);

                                                while ($items = mysqli_fetch_assoc($query_run)) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= $items['fname']; ?></td>
                                                        <td><?= $items['businessname']; ?></td>
                                                        <td><?= $items['businessnumber']; ?></td>
                                                        <td><?= $items['location']; ?></td>
                                                        <td><?= $items['date_registered']; ?></td>
                                                    </tr>
                                            <?php
                                                }
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

            <div class="modal fade" id="addSellerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Seller</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="addSellerForm">
                                <div class="form-group">
                                    <label for="fullname">Full Name:</label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                                </div>
                                <div class="form-group">
                                    <label for="businessname">Business Name:</label>
                                    <input type="text" class="form-control" id="businessname" name="businessname" required>
                                </div>
                                <div class="form-group">
                                    <label for="businessnumber">Business Number:</label>
                                    <input type="text" class="form-control" id="businessnumber" name="businessnumber" required>
                                </div>
                                <div class="form-group">
                                    <label for="location">Address:</label>
                                    <input type="text" class="form-control" id="location" name="location" required>
                                </div>
                                <div class="form-group">
                                    <label for="date_registered">Date Registered:</label>
                                    <input type="date" class="form-control" id="date_registered" name="date_registered" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Seller</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered custom-modal-size" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="successModalLabel">Success</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Seller added successfully.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                                <a href="adminhome.php">Home</a><i class="fa fa-angle-double-right"></i><span>Registered</span>
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
        $('#addSellerForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'add_seller.php',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.trim() === 'success') {
                        // Trigger the success modal
                        $('#successModal').modal('show');
                        // Optionally, you can reload the page after the modal is closed
                        $('#successModal').on('hidden.bs.modal', function(e) {
                            location.reload();
                        });
                    } else {
                        alert('Failed to add seller. Please try again.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred while processing your request. Please try again.');
                }
            });
        });
    });

    function filterregistered() {
        var input = document.getElementById('searchartisans').value.toUpperCase();
        var table = document.querySelector('.userdetails table');
        var rows = table.getElementsByTagName('tr');

        for (var i = 0; i < rows.length; i++) {
            var name = rows[i].getElementsByTagName('td')[1];
            var businessName = rows[i].getElementsByTagName('td')[2];
            var address = rows[i].getElementsByTagName('td')[4];
            var dateRegistered = rows[i].getElementsByTagName('td')[5];

            if (name && businessName && address && dateRegistered) {
                var nameValue = name.textContent || name.innerText;
                var businessNameValue = businessName.textContent || businessName.innerText;
                var addressValue = address.textContent || address.innerText;
                var dateRegisteredValue = dateRegistered.textContent || dateRegistered.innerText;

                var rowText = nameValue + businessNameValue + addressValue + dateRegisteredValue;

                if (rowText.toUpperCase().indexOf(input) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    }
</script>
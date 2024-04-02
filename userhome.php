<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['fname'])) {

    include "db_conn.php";
    include 'php/User.php';
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
                <a class="navbar-brand logo-image" href="userhome.php"><img src="images/favicon2.png" alt="alternative">islandhopper</a>

                <!-- Mobile Menu Toggle Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-awesome fas fa-bars"></span>
                    <span class="navbar-toggler-awesome fas fa-times"></span>
                </button>
                <!-- end of mobile menu toggle button -->

                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="userhome.php">HOME <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#">ORDERS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="edit.php">PROFILE</a>
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
            <header id="header" class="header">
                <div class="header-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-container">
                                    <h1>UNVEILING <span id="js-rotating">LOCAL, SYMBIOTIC, HANDMADE</span></h1>
                                    <p class="p-heading p-large">
                                        CraftConnect facilitates the exchange of one-of-a-kind handmade items between consumers and artisans via a dynamic marketplace. Support local artisans in Cavite while appreciating exquisite craftsmanship.
                                    </p>
                                    <a class="btn-solid-lg page-scroll" href="#features">DISCOVER</a>
                                </div>
                            </div> <!-- end of col -->
                        </div> <!-- end of row -->
                    </div> <!-- end of container -->
                </div> <!-- end of header-content -->
            </header> <!-- end of header -->
            <!-- end of header -->


        <?php } else {
        header("Location: login.php");
        exit;
    } ?>
        <!-- Intro -->
        <section id="features">
            <div id="map"></div>

            <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
            <script>
                var map = L.map('map').setView([14.2822, 120.9999], 10);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
                }).addTo(map);

                fetch('get_seller_locations.php')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(seller => {
                            var popupContent = `
                    <img src="upload/${seller.pp}" class="profile-picture"><br>
                    <b>Business Name:</b> ${seller.businessname}<br>
                    <b>Type of Craft:</b> ${seller.typeofcraft}<br>
                    <b>Mobile Number:</b> ${seller.mobile}<br>
                    <b>Address:</b> ${seller.location}<br>
                    <a href="sellerpage.php?seller_id=${seller.seller_id}">Visit Seller's Profile</a>
                `;
                            L.marker([seller.latitude, seller.longitude])
                                .addTo(map)
                                .bindPopup(popupContent);
                        });
                    })
                    .catch(error => console.error('Error fetching seller locations:', error));
            </script>

            <?php
            include 'db_conn.php';

            $stmt = $conn->prepare("SELECT * FROM sellers WHERE latitude IS NOT NULL AND longitude IS NOT NULL");
            $stmt->execute();
            $sellers = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo '<script>';
            echo 'var sellers = ' . json_encode($sellers) . ';';
            echo '</script>';
            ?>
        </section>
        <!-- end of intro -->


        <!-- Project Lightboxes -->
        <!-- Lightbox -->
        <div id="project-1" class="lightbox-basic zoom-anim-dialog mfp-hide">
            <div class="row">
                <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
                <div class="col-lg-8">
                    <img class="img-fluid" src="images/project-1.jpg" alt="alternative">
                </div> <!-- end of col -->
                <div class="col-lg-4">
                    <h3>Online Banking</h3>
                    <hr class="line-heading">
                    <h6>Strategy Development</h6>
                    <p>Need a solid foundation for your business growth plans? Aria will help you manage sales and meet your
                        current needs</p>
                    <p>By offering the best professional services and quality products in the market. Don't hesitate and get
                        in touch with us.</p>
                    <div class="testimonial-container">
                        <p class="testimonial-text">Need a solid foundation for your business growth plans? Aria will help
                            you manage sales and meet your current requirements.</p>
                        <p class="testimonial-author">General Manager</p>
                    </div>
                    <a class="btn-solid-reg" href="#your-link">DETAILS</a> <a class="btn-outline-reg mfp-close as-button" href="#projects">BACK</a>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of lightbox-basic -->
        <!-- end of lightbox -->

        <!-- Lightbox -->
        <div id="project-2" class="lightbox-basic zoom-anim-dialog mfp-hide">
            <div class="row">
                <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
                <div class="col-lg-8">
                    <img class="img-fluid" src="images/project-2.jpg" alt="alternative">
                </div> <!-- end of col -->
                <div class="col-lg-4">
                    <h3>Classic Industry</h3>
                    <hr class="line-heading">
                    <h6>Strategy Development</h6>
                    <p>Need a solid foundation for your business growth plans? Aria will help you manage sales and meet your
                        current needs</p>
                    <p>By offering the best professional services and quality products in the market. Don't hesitate and get
                        in touch with us.</p>
                    <div class="testimonial-container">
                        <p class="testimonial-text">Need a solid foundation for your business growth plans? Aria will help
                            you manage sales and meet your current requirements.</p>
                        <p class="testimonial-author">General Manager</p>
                    </div>
                    <a class="btn-solid-reg" href="#your-link">DETAILS</a> <a class="btn-outline-reg mfp-close as-button" href="#projects">BACK</a>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of lightbox-basic -->
        <!-- end of lightbox -->

        <!-- Lightbox -->
        <div id="project-3" class="lightbox-basic zoom-anim-dialog mfp-hide">
            <div class="row">
                <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
                <div class="col-lg-8">
                    <img class="img-fluid" src="images/project-3.jpg" alt="alternative">
                </div> <!-- end of col -->
                <div class="col-lg-4">
                    <h3>BoomBap Audio</h3>
                    <hr class="line-heading">
                    <h6>Strategy Development</h6>
                    <p>Need a solid foundation for your business growth plans? Aria will help you manage sales and meet your
                        current needs</p>
                    <p>By offering the best professional services and quality products in the market. Don't hesitate and get
                        in touch with us.</p>
                    <div class="testimonial-container">
                        <p class="testimonial-text">Need a solid foundation for your business growth plans? Aria will help
                            you manage sales and meet your current requirements.</p>
                        <p class="testimonial-author">General Manager</p>
                    </div>
                    <a class="btn-solid-reg" href="#your-link">DETAILS</a> <a class="btn-outline-reg mfp-close as-button" href="#projects">BACK</a>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of lightbox-basic -->
        <!-- end of lightbox -->

        <!-- Lightbox -->
        <div id="project-4" class="lightbox-basic zoom-anim-dialog mfp-hide">
            <div class="row">
                <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
                <div class="col-lg-8">
                    <img class="img-fluid" src="images/project-4.jpg" alt="alternative">
                </div> <!-- end of col -->
                <div class="col-lg-4">
                    <h3>Van Moose</h3>
                    <hr class="line-heading">
                    <h6>Strategy Development</h6>
                    <p>Need a solid foundation for your business growth plans? Aria will help you manage sales and meet your
                        current needs</p>
                    <p>By offering the best professional services and quality products in the market. Don't hesitate and get
                        in touch with us.</p>
                    <div class="testimonial-container">
                        <p class="testimonial-text">Need a solid foundation for your business growth plans? Aria will help
                            you manage sales and meet your current requirements.</p>
                        <p class="testimonial-author">General Manager</p>
                    </div>
                    <a class="btn-solid-reg" href="#your-link">DETAILS</a> <a class="btn-outline-reg mfp-close as-button" href="#projects">BACK</a>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of lightbox-basic -->
        <!-- end of lightbox -->

        <!-- Lightbox -->
        <div id="project-5" class="lightbox-basic zoom-anim-dialog mfp-hide">
            <div class="row">
                <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
                <div class="col-lg-8">
                    <img class="img-fluid" src="images/project-5.jpg" alt="alternative">
                </div> <!-- end of col -->
                <div class="col-lg-4">
                    <h3>Joy Moments</h3>
                    <hr class="line-heading">
                    <h6>Strategy Development</h6>
                    <p>Need a solid foundation for your business growth plans? Aria will help you manage sales and meet your
                        current needs</p>
                    <p>By offering the best professional services and quality products in the market. Don't hesitate and get
                        in touch with us.</p>
                    <div class="testimonial-container">
                        <p class="testimonial-text">Need a solid foundation for your business growth plans? Aria will help
                            you manage sales and meet your current requirements.</p>
                        <p class="testimonial-author">General Manager</p>
                    </div>
                    <a class="btn-solid-reg" href="#your-link">DETAILS</a> <a class="btn-outline-reg mfp-close as-button" href="#projects">BACK</a>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of lightbox-basic -->
        <!-- end of lightbox -->

        <!-- Lightbox -->
        <div id="project-6" class="lightbox-basic zoom-anim-dialog mfp-hide">
            <div class="row">
                <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
                <div class="col-lg-8">
                    <img class="img-fluid" src="images/project-6.jpg" alt="alternative">
                </div> <!-- end of col -->
                <div class="col-lg-4">
                    <h3>Spark Events</h3>
                    <hr class="line-heading">
                    <h6>Strategy Development</h6>
                    <p>Need a solid foundation for your business growth plans? Aria will help you manage sales and meet your
                        current needs</p>
                    <p>By offering the best professional services and quality products in the market. Don't hesitate and get
                        in touch with us.</p>
                    <div class="testimonial-container">
                        <p class="testimonial-text">Need a solid foundation for your business growth plans? Aria will help
                            you manage sales and meet your current requirements.</p>
                        <p class="testimonial-author">General Manager</p>
                    </div>
                    <a class="btn-solid-reg" href="#your-link">DETAILS</a> <a class="btn-outline-reg mfp-close as-button" href="#projects">BACK</a>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of lightbox-basic -->
        <!-- end of lightbox -->

        <!-- Lightbox -->
        <div id="project-7" class="lightbox-basic zoom-anim-dialog mfp-hide">
            <div class="row">
                <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
                <div class="col-lg-8">
                    <img class="img-fluid" src="images/project-7.jpg" alt="alternative">
                </div> <!-- end of col -->
                <div class="col-lg-4">
                    <h3>Casual Wear</h3>
                    <hr class="line-heading">
                    <h6>Strategy Development</h6>
                    <p>Need a solid foundation for your business growth plans? Aria will help you manage sales and meet your
                        current needs</p>
                    <p>By offering the best professional services and quality products in the market. Don't hesitate and get
                        in touch with us.</p>
                    <div class="testimonial-container">
                        <p class="testimonial-text">Need a solid foundation for your business growth plans? Aria will help
                            you manage sales and meet your current requirements.</p>
                        <p class="testimonial-author">General Manager</p>
                    </div>
                    <a class="btn-solid-reg" href="#your-link">DETAILS</a> <a class="btn-outline-reg mfp-close as-button" href="#projects">BACK</a>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of lightbox-basic -->
        <!-- end of lightbox -->

        <!-- Lightbox -->
        <div id="project-8" class="lightbox-basic zoom-anim-dialog mfp-hide">
            <div class="row">
                <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
                <div class="col-lg-8">
                    <img class="img-fluid" src="images/project-8.jpg" alt="alternative">
                </div> <!-- end of col -->
                <div class="col-lg-4">
                    <h3>Zazoo Apps</h3>
                    <hr class="line-heading">
                    <h6>Strategy Development</h6>
                    <p>Need a solid foundation for your business growth plans? Aria will help you manage sales and meet your
                        current needs</p>
                    <p>By offering the best professional services and quality products in the market. Don't hesitate and get
                        in touch with us.</p>
                    <div class="testimonial-container">
                        <p class="testimonial-text">Need a solid foundation for your business growth plans? Aria will help
                            you manage sales and meet your current requirements.</p>
                        <p class="testimonial-author">General Manager</p>
                    </div>
                    <a class="btn-solid-reg" href="#your-link">DETAILS</a> <a class="btn-outline-reg mfp-close as-button" href="#projects">BACK</a>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of lightbox-basic -->

        <!-- Footer -->
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-container about">
                            <h4>Few Words About CraftConnect</h4>
                            <p class="white">CraftConnect is a platform that empowers Cavitean artisans by unveiling their local, handmade treasures to the world. It fosters a symbiotic relationship, where artisans gain exposure and support, while customers discover unique and authentic crafts.</p>
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
        <script src="js/scripts.js"></script>
        <script src="js/index.js"></script>

        </body>

    </html>
<?php } else {
    header("Location: login.php");
    exit;
} ?>
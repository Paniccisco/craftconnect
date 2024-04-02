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
    <title>Register as Seller</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
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
        <a class="navbar-brand logo-image" href="guest.php"><img src="images/favicon2.png" alt="alternative">islandhopper</a>

        <!-- Mobile Menu Toggle Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-awesome fas fa-bars"></span>
            <span class="navbar-toggler-awesome fas fa-times"></span>
        </button>
        <!-- end of mobile menu toggle button -->

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="guest.php">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#" data-toggle="modal" data-target="#ordersModal">ORDERS</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="images/defaultpic.jpg" class="img-fluid rounded-circle">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="login.php">LOGIN</a>
                        <a class="dropdown-item" href="login.php">SIGN UP</a>
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
                    <h1>REGISTER</h1>
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
                        <a href="guest.php">Home</a><i class="fa fa-angle-double-right"></i><span>Become a Seller</span>
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
                        <form class="shadow w-450 p-3" action="php/seller_signup.php" method="post" enctype="multipart/form-data">
                            <?php if (isset($_GET['error'])) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $_GET['error']; ?>
                                </div>
                            <?php } ?>

                            <?php if (isset($_GET['success'])) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $_GET['success']; ?>
                                </div>
                            <?php } ?>
                            <div class="elem-group">
                                <label class="form-label" for="fname">Full Name</label>
                                <input type="text" class="form-control" name="fname" id="fname" value="<?php echo (isset($_GET['fname'])) ? $_GET['fname'] : "" ?>" placeholder="Enter your full name" required>
                            </div>

                            <div class="elem-group">
                                <label class="form-label" for="mobile">Mobile</label>
                                <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo (isset($_GET['mobile'])) ? $_GET['mobile'] : "" ?>" placeholder="Enter your mobile number" required>
                            </div>

                            <div class="elem-group">
                                <label class="form-label" for="mobile">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo (isset($_GET['email'])) ? $_GET['email'] : "" ?>" placeholder="Enter your email address" required>
                            </div>

                            <div class="elem-group">
                                <label class="form-label" for="uname">Username</label>
                                <input type="text" class="form-control" name="uname" id="username" value="<?php echo (isset($_GET['uname'])) ? $_GET['uname'] : "" ?>" placeholder="Enter a username" required>
                                <div class="username-feedback"></div>
                            </div>

                            <div class="elem-group">
                                <label class="form-label" for="pass">Password</label>
                                <input type="password" class="form-control" name="pass" id="password" minlength="8" required placeholder="Enter a password">
                            </div>

                            <div class="elem-group">
                                <label class="form-label" for="businessname">Business Name</label>
                                <input type="text" class="form-control" name="businessname" id="businessNameInput" value="<?php echo (isset($_GET['businessname'])) ? $_GET['businessname'] : "" ?>" placeholder="Enter your business name" required>
                            </div>

                            <div class="elem-group">
                                <label class="form-label">Business No.</label>
                                <input type="text" class="form-control" name="businessnumber" value="<?php echo (isset($_GET['businessnumber'])) ? $_GET['businessnumber'] : "" ?>" placeholder="Enter your business number" required>
                            </div>

                            <div class="elem-group">
                                <label class="form-label" for="location">Complete Address</label>
                                <input type="text" class="form-control" name="location" id="location" value="<?php echo (isset($_GET['location'])) ? $_GET['location'] : "" ?>" placeholder="Enter your location" required>
                            </div>

                            <div class="elem-group">
                                <label for="typeofcraft" class="form-label">Type of Handicraft</label>
                                <select class="custom-select" id="craftTypeInput" name="typeofcraft" autocomplete="off" required>
                                    <option value="">Select Your Type of Handicraft</option>
                                    <option value="Agimats amulets" <?php echo (isset($_GET['typeofcraft']) && $_GET['typeofcraft'] === 'Agimats amulets') ? 'selected' : ''; ?>>Agimats amulets</option>
                                    <option value="Lapida" <?php echo (isset($_GET['typeofcraft']) && $_GET['typeofcraft'] === 'Lapida') ? 'selected' : ''; ?>>Lapida</option>
                                    <option value="Palayok" <?php echo (isset($_GET['typeofcraft']) && $_GET['typeofcraft'] === 'Palayok') ? 'selected' : ''; ?>>Palayok</option>
                                    <option value="Wood Carving" <?php echo (isset($_GET['typeofcraft']) && $_GET['typeofcraft'] === 'Wood Carving') ? 'selected' : ''; ?>>Wood Carving</option>
                                    <option value="Weaving" <?php echo (isset($_GET['typeofcraft']) && $_GET['typeofcraft'] === 'Weaving') ? 'selected' : ''; ?>>Weaving</option>
                                </select>

                            </div>

                            <div class="elem-group">
                                <input type="hidden" id="latitude" name="latitude" placeholder="Latitude">
                                <input type="hidden" id="longitude" name="longitude" placeholder="Longitude">
                            </div>

                            <div class="elem-group">
                                <label class="form-label" for="pp">Profile Picture</label>
                                <input type="file" class="form-control" name="pp" id="pp" required>
                            </div>

                            <div id="address-search-container">
                                <label for="addressSearchInput">Enter Address:</label>
                                <input type="text" id="addressSearchInput" placeholder="e.g., 1032 Dra. SalamancaSan Antonio, Cavite City, Cavite" oninput="getAddressSuggestions()" required>
                                <div id="addressSuggestions"></div>
                                <button type="button" id="searchAddressButton" onclick="searchAddress()">Search Address</button>
                            </div>

                            <div id="map-container">
                                <div id="map"></div>
                            </div>

                            <button type="button" class="btn btn-primary" onclick="submitForm()">Sign Up</button>
                            <a href="login.php" class="link-secondary">Login</a>
                        </form>

                    </section>
                </div> <!-- end of col-->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of ex-basic-2 -->
    <!-- end of privacy content -->

    <!-- Breadcrumbs -->
    <div class="ex-basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs">
                        <a href="guest.php">Home</a><i class="fa fa-angle-double-right"></i><span>Become a Seller</span>
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
    <script src="js/sellerusername_checker.js"></script>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>

</body>
<script src="sellerusername_checker.js"></script>
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
<script>
    var map;
    var marker;

    function getAddressSuggestions() {
        const addressInput = document.getElementById('addressSearchInput');
        const suggestionsContainer = document.getElementById('addressSuggestions');

        const address = addressInput.value;

        if (address.trim() !== '') {
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        const suggestions = data.map(item => item.display_name);
                        suggestionsContainer.innerHTML = suggestions.map(suggestion =>
                            `<div class="suggestion-item" onclick="selectSuggestion('${suggestion}')">${suggestion}</div>`
                        ).join('');
                        suggestionsContainer.style.display = 'block';
                    } else {
                        suggestionsContainer.innerHTML = '';
                        suggestionsContainer.style.display = 'none';
                    }
                })
                .catch(error => console.error('Error fetching address suggestions:', error));
        } else {
            suggestionsContainer.innerHTML = '';
            suggestionsContainer.style.display = 'none';
        }
    }

    function selectSuggestion(suggestion) {
        document.getElementById('addressSearchInput').value = suggestion;
        document.getElementById('addressSuggestions').style.display = 'none';
    }

    function searchAddress() {
        const address = document.getElementById('addressSearchInput').value;
        if (address.trim() !== '') {

            if (map) {
                map.remove();
            }

            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        const {
                            lat,
                            lon
                        } = data[0];

                        map = L.map('map').setView([lat, lon], 15);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 50,
                            minZoom: 10,
                            attribution: '© OpenStreetMap'
                        }).addTo(map);

                        marker = L.marker([lat, lon], {
                            draggable: true
                        }).addTo(map);

                        document.getElementById('notification').innerHTML = 'Address found! Move the marker and click "Save Your Location".';
                        document.getElementById('notification').style.backgroundColor = '#2ecc71';
                        document.getElementById('notification').style.display = 'block';
                    } else {
                        console.error('Address not found');
                    }
                })
                .catch(error => console.error('Error fetching address:', error));
        } else {
            console.error('Please enter an address');
        }
    }

    function submitForm() {

        const latLng = marker.getLatLng();
        const latitude = latLng.lat;
        const longitude = latLng.lng;

        console.log(latitude);
        console.log(latitude);

        document.getElementById('latitude').value = latitude;
        document.getElementById('longitude').value = longitude;


        document.querySelector('form').submit();
    }
</script>

</html>
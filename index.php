<!DOCTYPE html>
<html>
<head>
    <!-- jQuery -->
    <script src="assets/javascript/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">
    <script src="assets/javascript/bootstrap.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/stylesheet.css"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed" rel="stylesheet">
    <!-- PHP -->
    <?php
        include("assets/database.php");
        include("assets/functions.php");
    ?>
    <!-- Metadata -->
    <title>WSC - Seefeld 2019</title>
    <meta charset="UTF-8">
    <meta name="author" content="Sindre Beba, Sander Sandøy">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <img src="assets/images/logo.png" />
        <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="index.php">FRONT PAGE</a></li>
            <?php getNavbar(); ?>
        </ul>
    </nav>
    <!-- Container -->
    <div class="row" id="frontpage-container">
        <!-- Carousel -->
        <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <div class="row"><img src="assets/images/carousel1.png"></div>
                    <div class="row red-row"><h4>FEBRUARY 19TH - MARCH 3RD 2019</h4></div>
                </div>
                <div class="item">
                    <div class="row"><img src="assets/images/carousel2.png"></div>
                    <div class="row red-row"><h4>FIS NORDIC WORLD SKI CHAMPIONSHIPS - SEEFELD 2019</h4></div>
                </div>
                <div class="item">
                    <div class="row"><img src="assets/images/carousel3.png"></div>
                    <div class="row red-row"><h4>FEBRUARY 19TH - MARCH 3RD 2019</h4></div>
                </div>
                <div class="item">
                    <div class="row"><img src="assets/images/carousel4.png"></div>
                    <div class="row red-row"><h4>FIS NORDIC WORLD SKI CHAMPIONSHIPS - SEEFELD 2019</h4></div>
                </div>
            </div>
        </div>
        <!-- Third row -->
        <div class="row">
            <div class="col-sm-5 text-center">
                <h2>NEXT EVENT</h2>
                <?php getNextEvent(); ?>
            </div>
            <div class="col-sm-7 text-center">
                <h2>SEEFELD</h2>
                <p>Seefeld has played host to the Olympic Nordic disciplines no fewer than three times – in 1964, 1976 and
                    2012. It was the venue of the FIS Nordic World Ski Championships in 1985, and organises the Nordic
                    World Cup on an annual basis. Following the success of 1985, the Olympiaregion Seefeld has been
                    selected as the venue for the Nordic World Ski Championships in 2019, and the region is incredibly
                    proud to be able to host the prestigious Nordic sporting event once more.</p>
            </div>
        </div>
        <footer>
            <p>(C) 2017 Sindre Beba and Sander Fagerland Sandøy</p>
        </footer>
    </div>
</body>
</html>
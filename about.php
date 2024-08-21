<?php
session_start(); // Start the session

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;

require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About - World Time</title>

    <script>
        document.documentElement.classList.remove('no-js');
        document.documentElement.classList.add('js');
    </script>

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/styles.css">

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">

</head>

<body id="top">



    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader" class="dots-fade">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- page wrap
    ================================================== -->
    <div id="page" class="s-pagewrap">

        <!-- # site header 
        ================================================== -->
        <header class="s-header">

            <div class="row s-header__inner width-sixteen-col">

                <div class="s-header__block">
                    <div class="s-header__logo">
                        <a class="logo" href="index.php">
                        </a>
                    </div>

                    <a class="s-header__menu-toggle" href="#0"><span>Menu</span></a>
                </div>
                <!-- end s-header__block -->

                <nav class="s-header__nav">

                    <ul class="s-header__menu-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="clock_design1.php">Clock 1</a></li>
                        <li><a href="clock_design2.php">Clock 2</a></li>
                        <li><a href="clock_design3.php">Clock 3</a></li>
                    </ul> <!-- s-header__menu-links -->
                    <!-- s-header__menu-links -->

                    <div class="s-header__contact">
                        <?php if ($isLoggedIn) { ?>
                            <a href="logout.php" class="btn btn--primary s-header__contact-btn">Logout</a>
                        <?php } else { ?>
                            <a href="login.php" class="btn btn--primary s-header__contact-btn">Login</a>
                        <?php } ?>
                    </div>
                    <!-- s-header__contact -->

                </nav>
                <!-- end s-header__nav -->

            </div>
            <!-- end s-header__inner -->

        </header>
        <!-- end s-header -->

        <!-- # site main content
                                ================================================== -->
        <section id="content" class="s-content">

            <section class="s-pageheader pageheader">
                <div class="row">
                    <div class="column xl-12">
                        <h1 class="page-title">
                            <span class="page-title__small-type text-pretitle">About</span> Discover World Time
                        </h1>
                        <br>
                        <br>

                        <div class="m-intro__content-text">
                            <h2 class="s-intro__content-pretitle text-pretitle">Hello,

                                <?php if (isset($_SESSION['username']))
                                    echo ($_SESSION['username']);
                                ?></h2>

                        </div>
                    </div>
                </div>
            </section>
            <!-- end pageheader -->

            <section class="s-pagecontent pagecontent">

                <div class="row pageintro">
                    <div class="column xl-6 lg-12">
                        <h2 class="text-display-title">Understanding Time Across the Globe</h2>
                    </div>
                    <div class="column xl-6 lg-12 u-flexitem-x-right">
                        <p class="lead">
                            Time is a universal constant that connects us all. It shapes our lives, governs our schedules, and bridges distances. At World Time, we strive to provide you with accurate, real-time updates on the time in every corner of the world.
                        </p>
                    </div>
                </div>
                <!-- end pageintro -->


                <!-- end pag                        emedia -->

                <div class="row width-narrower pagemain">
                    <di class="column xl-12">

                        <h2>Our Mission</h2>
                        <p>
                            At World Time, we aim to be your trusted companion in the journey through time. We believe that understanding time zones and their impact on our daily lives is crucial in today's globalized world. Whether you're scheduling a meeting with colleagues overseas or simply curious about the time in another country, we're here to help.
                        </p>

                        <h2 class="u-add-bottom">Our Values & Beliefs</h2>

                        <div class="grid-list-items list-items">
                            <div class="grid-list-items__item list-items__item u-remove-bottom">
                                <div class="list-items__item-header">
                                    <h6 class="list-items__item-small-title">Accuracy</h6>
                                </div>
                                <p>
                                    We strive to provide the most accurate and up-to-date information on global time zones. Our data is sourced from reliable sources to ensure you have the information you need when you need it.
                                </p>
                            </div>
                            <div class="grid-list-items__item list-items__item u-remove-bottom">
                                <div class="list-items__item-header">
                                    <h6 class="list-items__item-small-title">Accessibility</h6>
                                </div>
                                <p>
                                    Time is for everyone. We believe in making time-related information accessible to all, regardless of their location or technical expertise. Our platform is designed to be user-friendly and inclusive.
                                </p>
                            </div>
                            <div class="grid-list-items__item list-items__item u-remove-bottom">
                                <div class="list-items__item-header">
                                    <h6 class="list-items__item-small-title">Innovation</h6>
                                </div>
                                <p>
                                    We constantly seek new ways to improve our services and deliver innovative features. Our goal is to stay ahead of the curve in an ever-changing digital landscape.
                                </p>
                            </div>
                            <div class="grid-list-items__item list-items__item u-remove-bottom">
                                <div class="list-items__item-header">
                                    <h6 class="list-items__item-small-title">Community</h6>
                                </div>
                                <p>
                                    We value our community of users and strive to create a space where people can learn, share, and connect. Time is a shared experience, and we are committed to fostering a sense of unity and understanding.
                                </p>
                            </div>
                        </div>
                        <!--grid-list-items -->

                        <h2>Why Choose Us</h2>
                        <p>
                            We understand that time management is essential in today's fast-paced world. That's why we offer a comprehensive and easy-to-use platform that caters to your needs. Whether you're a business professional, a traveler, or simply curious, World Time is your go-to source for all things related to time.
                        </p>

                        <h2>Our Story</h2>
                        <p>
                            World Time was founded with a simple goal: to make time more accessible and understandable. Since our inception, we've grown into a trusted platform that millions of users rely on daily. Our commitment to accuracy, accessibility, and innovation continues to drive us forward as we explore new horizons.
                        </p>

                    </di v>
                    <!-- end grid-block-->
                </div>
                <!-- end pagemain -->

            </section>
            <!-- pagecontent -->

            <section class="s-testimonials">

                <div class="s-testimonials__header row row-x-center text-center">
                    <div class="column xl-8 lg-12">

                        <p class="text-pretitle">
                            Testimonials
                        </p>
                        <h3>
                            What Our Users Say
                        </h3>

                    </div>
                </div>
                <!--end s-testimonials__header -->

                <div class="row s-testimonials__content">
                    <div class="column xl-12 testimonials">

                        <div class="swiper-container testimonials__slider page-slider">

                            <di class="swiper-wrapper">
                                <div class="testimonials__slide swiper-slide">
                                    <p>
                                        "World Time has been a lifesaver for me. As someone who frequently travels for work, having access to accurate time zone information is crucial. I can't recommend it enough!"
                                    </p>
                                    <h6 class="testimonials__author">John Doe</h6>
                                </div>

                                <div class="testimonials__slide swiper-slide">
                                    <p>
                                        "I love how easy it is to use World Time. The interface is simple, and the information is always up-to-date. It's the best time-related app I've used."
                                    </p>
                                    <h6 class="testimonials__author">Jane Smith</h6>
                                </div>

                                <div class="testimonials__slide swiper-slide">
                                    <p>
                                        "World Time has helped me stay connected with friends and family around the world. It's great to know the time difference at a glance. Thank you for creating such a fantastic service!"
                                    </p>
                                    <h6 class="testimonials__author">Sarah Lee</h6>
                                </div>

                            </di v>
                            <!-- swiper-wrapper -->

                            <div class="swiper-pagination"></div>

                        </div>
                        <!-- swi                        per-container -->

                    </div>
                </div>
                <!--end                         s-testimonials__content-->

            </section>
            <!-- end s-t                        estimonials -->

        </section>
        <!-- end s-content -->

        <!-- # site foot                        er
                                ================================================== -->
        <footer class="s-footer">

            <div class="row s-footer__main">
                <div class="column xl-12">
                    <div class="s-footer__block">

                    </div>
                    <div class="s-footer__block">
                        <div class="s-footer__social">
                            <h3 class="s-footer__title">Follow Us</h3>
                            <ul class="s-footer__social-links">
                                <a href="mailto:ramdevops2005@gmail.com">Email</a>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- s-footer__main -->

            <div class="s-footer__bottom">
                <div class="row">
                    <div class="column xl-12">
                        <div class="s-footer__copyright">
                            <p>&copy; 2024 World Time. All rights reserved.</p>
                        </div>
                        <div class="s-footer__credits">
                            <p>Website b y <a href="https://worldtime.com">World Time</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- s-footer__botto                        m -->

        </footer>
        <!-- end s-footer -->

    </div>
    <!-- end s-pagewrap -->

    <!-- Java Script
    ====================================                        ============== -->
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/modernizr                        .js"></script>
    <script src="js/vendor/pace.min.js"></script>

    <script src="js/plugins.                        js"></script>
    <script src="js/main.js"></script>

</body>

</html>
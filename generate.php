<?php
//
// template with Bootstrap:
// https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
//
require_once("data/data.php");
require_once("data/commentHandler.php");

function ordinalNumber( $num ){
    $n = $num % 10;
    $t = floor($num / 10) % 10;

    if($t === 1){
        return $num . "th";
    } else {
        switch($n) {
            case 1:
                return $num . "st";
            case 2:
                return $num . "nd";
            case 3:
                return $num . "rd";
            default:
                return $num . "th";
        }
    }
}

$background=[
    "portfolio-1.jpg",
    "portfolio-2.jpg",
    "portfolio-3.jpg",
    "portfolio-4.jpg",
    "portfolio-5.jpg",
    "portfolio-6.jpg",
    "portfolio-7.jpg",
];

$ch=new CommentHandler();
$ch->registerComment(date: $argv[1], userId: $argv[2], comment:$argv[3]);
$results=$ch->mergeComment($results,$members);
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>
            どんぐり会
        </title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="assets/css/style.css" rel="stylesheet">

        <!-- =======================================================
             * Template Name: Arsha
             * Updated: Sep 18 2023 with Bootstrap v5.3.2
             * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
             * Author: BootstrapMade.com
             * License: https://bootstrapmade.com/license/
             ======================================================== -->
        <!-- 絵文字対応 -->
        <style>
         .portfolio-info table td{
             font-family: apple color emoji,segoe ui emoji,noto color emoji,android emoji,emojisymbols,emojione mozilla,twemoji mozilla,segoe ui symbol;
         }
        </style>
    </head>

    <body>

        <!-- ======= Header ======= -->
        <header id="header" class="fixed-top ">
            <div class="container d-flex align-items-center">

                <h1 class="logo me-auto"><a href="index.html">Donguries</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                        <li><a class="nav-link scrollto" href="#about">About</a></li>
                        <li><a class="nav-link   scrollto" href="#portfolio">Results</a></li>
                        <li><a class="nav-link scrollto" href="#team">Members</a></li>
                        <!--
                             <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                             <ul>
                             <li><a href="#">Drop Down 1</a></li>
                             <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                             <ul>
                             <li><a href="#">Deep Drop Down 1</a></li>
                             <li><a href="#">Deep Drop Down 2</a></li>
                             <li><a href="#">Deep Drop Down 3</a></li>
                             <li><a href="#">Deep Drop Down 4</a></li>
                             <li><a href="#">Deep Drop Down 5</a></li>
                             </ul>
                             </li>
                             <li><a href="#">Drop Down 2</a></li>
                             <li><a href="#">Drop Down 3</a></li>
                             <li><a href="#">Drop Down 4</a></li>
                             </ul>
                             </li>
                        -->
                        <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                        <li><a class="getstarted scrollto" href="#about">Get Started</a></li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->
            </div>
        </header><!-- End Header -->

        <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex align-items-center">

            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                        <h1>どんぐり会</h1>
                        <h2>100を切らない。切ったら破門。</h2>
                        <div class="d-flex justify-content-center justify-content-lg-start">
                            <a href="#about" class="btn-get-started scrollto">Get Started</a>
                            <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                        <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>

        </section><!-- End Hero -->

        <main id="main">

            <!-- ======= Clients Section ======= -->
            <section id="clients" class="clients section-bg">
                <div class="container">

                    <div class="row" data-aos="zoom-in">

                        <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                            <a href="http://honmokutei.jp/"><img src="assets/img/logo-red.png" class="img-fluid" alt=""></a>
                        </div>

                        <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                            <a href="https://golaku-plus.jp/">
                                <img src="https://golaku-plus.jp/img/sp_title_footer_fluid.png" class="img-fluid" alt="">
                            </a>
                        </div>

                        <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                            <a href="https://jpn.mizuno.com/golf">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeTWfEav9Okz3Ph9psqZQLaY0bKM5tHtnBmZhbnjPj&s" class="img-fluid" alt="">
                            </a>
                        </div>

                        <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                            <img src="assets/img/clients/client-4.png" class="img-fluid" alt="">
                        </div>

                        <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                            <img src="assets/img/clients/client-5.png" class="img-fluid" alt="">
                        </div>

                        <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                            <img src="assets/img/clients/client-6.png" class="img-fluid" alt="">
                        </div>

                    </div>

                </div>
            </section><!-- End Cliens Section -->

            <!-- ======= About Us Section ======= -->
            <section id="about" class="about">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>What is どんぐり会</h2>
                    </div>

                    <div class="row content">
                        <div class="col-lg-6">
                            <p>
                                底辺の底辺による底辺のためのダブルボギー
                            </p>
                            <ul>
                                <?php foreach($whatis as $w):?>
                                    <li><i class="ri-check-double-line"></i><?=$w?></li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>

                </div>
            </section><!-- End Why Us Section -->

            <!-- ======= Cta Section ======= -->
            <section id="cta" class="cta">
                <div class="container" data-aos="zoom-in">

                    <div class="row">
                        <div class="col-lg-9 text-center text-lg-start">
                            <h3>Call To Action</h3>
                            <p> 入会費無料キャンペーン(2050年まで)</p>
                        </div>
                        <div class="col-lg-3 cta-btn-container text-center">
                            <a class="cta-btn align-middle" href="https://golaku-plus.jp/">Go To G-Plus</a>
                        </div>
                    </div>
                </div>
            </section><!-- End Cta Section -->

            <!-- ======= Portfolio Section ======= -->
            <section id="portfolio" class="portfolio">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Results</h2>
                        <p>
                            昼飯だ！人の金で！<br>
                            順位はネットで決定<br>
                            レディースハンデは廃止されました(2023/11/23)<br>
                            誕生月はハンデが1もらえます<br>
                        </p>
                    </div>

                    <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-app">App</li>
                        <li data-filter=".filter-card">Card</li>
                        <li data-filter=".filter-web">Web</li>
                    </ul>

                    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                        <?php foreach($results as $i=>$result):?>
                            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                <div class="portfolio-img">
                                    <img src="assets/img/portfolio/<?=$background[mt_rand(0,count($background)-1)]?>" class="img-fluid" alt=""/>
                                    <div class="portfolio-info">
                                        <h4><?=$result["date"]?></h4>
                                        <p><?=ordinalNumber($i+1)?></p>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Gross</th>
                                                    <th scope="col">Excuse</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($result["score"] as $rank=>$s):?>
                                                    <tr>
                                                        <th scope="row"><?=(int)$rank+1?></th>
                                                        <td><?=$s["name"]?></td>
                                                        <td><?=$s["gross"]?></td>
                                                        <td><?=$s["excuse"] ?? ''?></td>
                                                    </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </section><!-- End Portfolio Section -->

            <!-- ======= Team Section ======= -->
            <section id="team" class="team section-bg">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Members</h2>
                        <p>若者は........全然......いない............................</p>
                    </div>

                    <div class="row">

                        <?php foreach($members as $m):?>
                            <div class="col-lg-6 mt-4" data-aos="zoom-in" data-aos-delay="<?=mt_rand(1,count($members))*100?>">
                                <div class="member d-flex align-items-start">
                                    <div class="pic"><img src="assets/img/team/<?=$m['img']?>" class="img-fluid" alt=""></div>
                                    <div class="member-info">
                                        <h4><?=$m["name"]?></h4>
                                        <span><?=$m["summary"]?></span>
                                        <p><?=$m["description"]?></p>
                                        <div class="social">
                                            <a href=""><i class="ri-twitter-fill"></i></a>
                                            <a href=""><i class="ri-facebook-fill"></i></a>
                                            <a href=""><i class="ri-instagram-fill"></i></a>
                                            <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>

                </div>
            </section><!-- End Team Section -->

            <!-- ======= Contact Section ======= -->
            <section id="contact" class="contact">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Contact</h2>
                        <p>火曜定休</p>
                    </div>

                    <div class="row">

                        <div class="col-lg-5 d-flex align-items-stretch">
                            <div class="info">
                                <div class="address">
                                    <i class="bi bi-geo-alt"></i>
                                    <h4>Location:</h4>
                                    <p>A108 Adam Street, New York, NY 535022</p>
                                </div>

                                <div class="email">
                                    <i class="bi bi-envelope"></i>
                                    <h4>Email:</h4>
                                    <p>info@example.com</p>
                                </div>

                                <div class="phone">
                                    <i class="bi bi-phone"></i>
                                    <h4>Call:</h4>
                                    <p>+1 5589 55488 55s</p>
                                </div>

                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d405.50853123153956!2d139.69823869879102!3d35.601383001619766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188ab659feda85%3A0x61a917c1e89bbb8!2z44CSMTQ1LTAwNjQg5p2x5Lqs6YO95aSn55Sw5Yy65LiK5rGg5Y-w77yR5LiB55uu77yT77yS4oiS77yVIOWil-eUsOODk-ODqw!5e0!3m2!1sja!2sjp!4v1664244006365!5m2!1sja!2sjp" width="100%" height="360" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                            </div>
                        </div>
                        <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                            <div class="info">
                                <div class="address">
                                    <i class="bi bi-geo-alt"></i>
                                    <h4>Location:</h4>
                                    <p>A108 Adam Street, New York, NY 535022</p>
                                </div>

                                <div class="email">
                                    <i class="bi bi-envelope"></i>
                                    <h4>Email:</h4>
                                    <p>info@example.com</p>
                                </div>

                                <div class="phone">
                                    <i class="bi bi-phone"></i>
                                    <h4>Call:</h4>
                                    <p>+1 5589 55488 55s</p>
                                </div>

                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3244.0404010381344!2d139.6957473149481!3d35.60206998021287!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188ab644119c65%3A0x747440df2d30412c!2z5pys54mn5Lqt!5e0!3m2!1sja!2sjp!4v1489218025507" width="100%" height="360" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- End Contact Section -->

        </main><!-- End #main -->

        <!-- ======= Footer ======= -->
        <footer id="footer">

            <div class="footer-newsletter">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <h4>Join Our Newsletter</h4>
                            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                            <form action="" method="post">
                                <input type="email" name="email"><input type="submit" value="Subscribe">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-top">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 col-md-6 footer-contact">
                            <h3>Dongries</h3>
                            <p>
                                A108 Adam Street <br>
                                New York, NY 535022<br>
                                United States <br><br>
                                <strong>Phone:</strong> +1 5589 55488 55<br>
                                <strong>Email:</strong> info@example.com<br>
                            </p>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Useful Links</h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Our Services</h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Our Social Networks</h4>
                            <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                            <div class="social-links mt-3">
                                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container footer-bottom clearfix">
                <div class="copyright">
                    &copy; Copyright <strong><span>Arsha</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>
        </footer><!-- End Footer -->

        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="assets/vendor/aos/aos.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>

    </body>

</html>

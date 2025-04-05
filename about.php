<?php
    session_start();
    if(!empty($_SESSION["username"])){
        $username = $_SESSION['username'];
    }else{
        $username = '';
    }
    $_SESSION["url"] = $_SERVER["REQUEST_URI"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <!-- Font Awesome 4.7 Library -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- My CSS File -->
    <link rel="stylesheet" href="css/style.css">
    <title>M&H |About Us</title>
</head>
<body>
    <!-- Start Header -->
    <header class="header">
        <div class="container">
            <!-- Start Navbar -->
            <nav class="navbar">
                <i class="fa fa-bars list"></i>
                <a href="index.php" class="logo"><img src="images/logo.png" alt=""></a>
                <ul class="list1">
                    <li class="fBold"><a href="index.php">home</a></li>
                    <li class="fBold"><a href="flower.php">flower</a></li>
                    <li class="fBold"><a href="plant.php">plant</a></li>
                    <li class="fBold"><a href="about.php">about us</a></li>
                    <li class="fBold"><a href="contact.php">contact us</a></li>
                </ul>
                <ul class="list2">
                    <li>
                        <?php
                            if ($username == '') {
                        ?>
                            <a href="signIn.php">
                                <i class="fa fa-user"></i>
                                <span class="userName">
                                    <?php echo 'Sign In'; ?>
                                </span>
                            </a>
                    </li>
                    <!-- <li><a href="signIn.php"><i class="fa fa-shopping-cart"></i></a></li>         -->
                            <?php }else{ ?>
                    <li>
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span class="userName">
                                    <?php echo $username; ?>
                                </span>
                            </a>
                                
                    </li>
                    <!-- <li><a href="cart.php"><i class="fa fa-shopping-cart"></i></a></li> -->
                    <?php } ?>
                    <?php
                    if ($username != '') {
                        ?>
                    <li>
                        <form class="logOutForm" method="post" >
                            <button type="submit" class="logOut" name="logOut" style="
                                border: none;
                                background-color: transparent;
                                font-size: 20px;
                                cursor: pointer;
                            "
                            onMouseOver="this.style.color='#a55277'"
                            onMouseOut="this.style.color='#000000'" >
                                <i class="fa fa-sign-out"></i>
                            </button>
                        </form>
                    </li>
                    <?php }
                    if (isset($_POST['logOut'])) {
                        session_unset(); 
                        header("Location:index.php");
                    }
                    ?>
                </ul>
            </nav>
            <!-- End Navbar -->
        </div>
    </header>
    <!-- End Header -->


    <!-- Start About Main  -->
    <main class="about">
        <section class="sec1">
            <video src="images/video.mp4"  muted autoplay loop playsinline></video>
        </section>
        <section class="sec2">
            <p class="title fBold">about us</p>
            <p class="pra">
            The M&H Flower Shop caters to the thoughtful shopper who appreciates unique roses and high-quality plantings you can't find anywhere else. We are constantly curating new collections and looking for the next big thing that our customers will love. Established in Gaza in 2023, we are proud to be your online flower shop that you can rely on for our expert service and care.
            </p>
        </section>
        <section class="sec3">
            <p class="leftPra">
            <span class="title fBold">Our mission</span> is to deliver the most compelling shopping experience for our customers and giving them what they want.
            </p>
            <p class="rightPra">
                <span class="title fBold">Our vision</span> is to change the way our society relates to flowers and plant cultivation by providing our customers with great products.
            </p>
        </section>
        <section class="sec4">
            <img src="images/favicon.png" alt="">
            <p class="pra">
                M & H Store is here to serve you and make sure you find the perfect gift for every occasion. Our passion for flowers is the reason we are here. We absolutely love what we do, and our goal is to help our customers by providing them with unique flowers and plants that make them stand out from the crowd.
            </p>
        </section>
            
    </main>
    <!-- End About Main -->


    <!-- Start arrow button -->
    <button type="button" class="arrow" >
        <i class="fa fa-angle-double-up"></i>
    </button>
    <!-- End arrow button -->


    <!-- Start Footer -->
    <footer class="footer">
        <div>
            <ul class="list">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                <li><a href="#"><i class="fa fa-telegram"></i></a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
            </ul>
        </div>
        <p>
         © 2023 M&H. ALL RIGHTS RESRVED.
        </p>
    </footer>
    <!-- End Footer -->


    <!-- Start Navbar Responsive Div -->
    <div class="navbarR">
        <i class="fa fa-times close"></i>
        <a href="index.php" class="logo"><img src="images/logo.png" alt=""></a>
        <ul class="list1">
            <li class="fBold border"><a href="index.php">home</a></li>
            <li class="fBold border"><a href="flower.php">flower</a></li>
            <li class="fBold border"><a href="planet.php">planet</a></li>
            <li class="fBold border"><a href="about.php">about us</a></li>
            <li class="fBold"><a href="contact.php">contact</a></li>
        </ul>
    </div>
    <!-- End Navbar Responsive Div -->


    <script src="js/js.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
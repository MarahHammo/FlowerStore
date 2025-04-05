<?php
    session_start();
    if(!empty($_SESSION['trueCode'] )){
        $trueCode = $_SESSION['trueCode'] ;
    }else{
        $trueCode = '';
    }
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
    <title>M&H |Forget Password</title>
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
                        <a href="signIn.php">
                            <i class="fa fa-user"></i>
                            <span class="userName">Sign In</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- End Navbar -->
        </div>
    </header>
    <!-- End Header -->


    <!-- Start php -->
    <?php
        $server = "localhost";
		$username = "root";
		$password = "";

		$conn = mysqli_connect($server, $username, $password);
		$db = mysqli_select_db($conn,"MH");
				
        function cleanData($data)
        {
            $data = htmlspecialchars($data);
            $data = trim($data);
            $data = strip_tags($data);
            $data = stripslashes($data);
            return $data;
        }

		$errors = array(
		    'vCode' => '',
		    'message' => '',
		);
        
        if (isset($_POST['check'])) {
            

            $vCode = cleanData($_POST['vCode']);

            if (empty($vCode)) {
                $errors['vCode'] = "write your verifaction code <br>";
            }elseif ($vCode != $trueCode) {
                $errors['vCode'] = "Wrong <br>";
            }else{
                header('Location:resetPassword.php');
            }
            
        }
    ?>
    
    <!-- Start vCode Main  -->
    <main class="forgetPassword">
        <section class="forgetPasswordSec" style="background:url(images/forms.jpg) 50% 20% no-repeat scroll;">
            <p class="title fBold">Forget your password?</p>
            <form action="vCode.php" method="post" class="forgetPasswordForm">
                <label>Verification Code</label>
                <input type="text" placeholder="Verification Code" name="vCode">
                <span class="errorStyle">
                    <?php echo $errors['message'] ?>
                    <?php echo $errors['vCode'] ?>
                </span>
                <button class="button fBold" name="check">Check</button>
            </form>  
        </section>
    </main>
    <!-- End vCode Main -->


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
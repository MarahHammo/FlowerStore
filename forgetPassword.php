<?php
    session_start();
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

        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[random_int(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        
        $trueCode = generateRandomString(10);

		$errors = array(
		    'email' => '',
		    'message' => '',
		);
        
        $email1 = '';
        
        if (isset($_POST['sendCode'])) {
            $_SESSION['trueCode'] = $trueCode ;
			$email = cleanData($_POST['email']);
            

			if (empty($email)) {
                $errors['email'] = "Add email <br>";
            } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
                $errors['email'] = "Please enter a valid email address Like example@example.com";
            } else {
                $email1 = $email;
                $_SESSION['email'] = $email;
            }
            
            if(!empty($email1)){
                $select_users = mysqli_query($conn, "SELECT * FROM USERS WHERE EMAIL = '$email1'") or die('query failed');
                if(mysqli_num_rows($select_users) == 0){
                    $errors['message'] = 'user not found!';
                }else{
                    header('Location:vCode.php?vCode=' . $trueCode);
                }
            }
        }
    ?>
    
    <!-- Start Forget Password Main  -->
    <main class="forgetPassword">
        <section class="forgetPasswordSec" style="background:url(images/forms.jpg) 50% 20% no-repeat scroll;">
            <p class="title fBold">Forget your password?</p>
            <form action="forgetPassword.php" method="post" class="forgetPasswordForm">
                <label>Email</label>
                <input type="text" placeholder="Enter Your Email" name="email">
                <span class="errorStyle">
           		    <?php echo $errors['email'] ?>
           		    <?php echo $errors['message'] ?>
        		</span>
                <button type="submit" class="button sendCode fBold" name="sendCode">Send Code</button>
            </form>  
     </section>
    </main>
    <!-- End Forget Password Main -->


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
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
    <title>M&H |Reset Password</title>
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
            'password' => '',
            'confirmPassword' => '',
		);

		$password1 =" ";
		$confirmPassword1 =" ";

		if (isset($_POST['reset'])) {
			$password = cleanData($_POST['password']);
			$confirmPassword = cleanData($_POST['confirmPassword']);

            $email = $_SESSION['email'];

			if (empty($password)) {
				$errors['password'] = "Add password";
			} elseif(!preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-9]@', $password) || !preg_match('@[^\w]@', $password) || strlen($password) < 8) {
				$errors['password'] = "Please enter a valid password <br> Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
			} else {
			    $password1 = $password;
			}

            if (empty($confirmPassword)) {
				$errors['confirmPassword'] = "Add confirm password";
            } else {
			    $confirmPassword1 = $confirmPassword;
			}

            if($password1 != $confirmPassword1){
                $errors['confirmPassword'] = 'confirm password not matched!';
            }else{
                if(!empty($password)){
                    $sql = "UPDATE USERS SET PASSWORD = '$password1' WHERE EMAIL ='$email' ";
                    $result = mysqli_query($conn , $sql);
                    if (!$result) {
                        echo "Query failed " . mysqli_error($conn);
                        exit;
                    } else {
                        header('location:signIn.php');
                    }
                }   
		    }
        }
	?>
	<!-- End php -->


    <!-- Start Reset Password Main  -->
    <main class="resetPassword" >
        <section class="resetSec" style="background:url(images/forms.jpg) 50% 20% no-repeat scroll;">
            <p class="title fBold">Reset your password?</p>
            <form action="resetPassword.php" method="post" class="resetPasswordForm">
                    <label>New Password</label>
                    <input type="password" placeholder="********" name="********">
                    <span class="errorStyle">
                        <?php echo $errors['password'] ?>
                    </span>
                    <label>Confirm Password</label>
                    <input type="password" placeholder="********" name="********">  
                    <span class="errorStyle">
                        <?php echo $errors['confirmPassword'] ?>
                    </span>  
                    <button type="submit" class="button fBold" name="reset">Reset</button>
            </form>
        </section>
    </main>
    <!-- End Reset Password Main -->


    <!-- Start arrow button -->
    <button type="button" class="arrow" >
        <i class="fa fa-angle-double-up"></i>
    </button>
    <!-- End arrow button -->

    
    <!-- Start Footer -->
    <footer class="footer">
        <!-- <a href="signIn.php" class="signIn fBold" >Sign In</a> -->
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
        <!-- <a href="signIn.php" class="signInButton fBold" >Sign In</a> -->
    </div>
    <!-- End Navbar Responsive Div -->


    <script src="js/js.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
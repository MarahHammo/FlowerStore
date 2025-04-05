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
    <title>M&H |Sign Up</title>
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
			'email' => '',
            'username' => '',
            'password' => '',
            'confirmPassword' => '',
            'message1' => '',
            'message2' => '',
		);

		$email1 = "";
		$username1 = "";
		$password1 =" ";
		$confirmPassword1 =" ";

		if (isset($_POST['signUp'])) {
			$email = cleanData($_POST['email']);
			$username = cleanData($_POST['username']);
			$password = cleanData($_POST['password']);
			$confirmPassword = cleanData($_POST['confirmPassword']);

            if (empty($email)) {
                $errors['email'] = "Add email <br>";
            } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
                $errors['email'] = "Please enter a valid email address Like example@example.com";
            } else {
                $email1 = $email;
            }

			if (empty($username)) {
				$errors['username'] = "Add username";
			} elseif(preg_match('/^[a-z\d_]{1,15}$/i', $username) == FALSE) {
				$errors['username'] = "please enter characters or digits between 0 and 15";
			} else {
				$username1 = $username;
			}

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

            $select_users1 = mysqli_query($conn, "SELECT * FROM USERS WHERE EMAIL = '$email1'") or die('query failed');

            $select_users2 = mysqli_query($conn, "SELECT * FROM USERS WHERE USERNAME = '$username1'") or die('query failed');

            if(mysqli_num_rows($select_users1) != 0){
                $errors['message1'] = 'user already exist!';
            }elseif(mysqli_num_rows($select_users2) != 0){
                $errors['message2'] = 'user already exist!';
            }else{
                if($password1 != $confirmPassword1){
                    $errors['confirmPassword'] = 'confirm password not matched!';
                }else{
                    if($email1 != "" && $username1 != "" && $password1 != "" ){
                        $sql = "INSERT INTO USERS(EMAIL ,USERNAME , PASSWORD) VALUES('$email1',  '$username1', '$password1')";
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
        }
	?>
	<!-- End php -->


    <!-- Start signUp Main  -->
    <main class="signUp">
        <section class="upSec" style="background:url(images/forms.jpg) 50% 20% no-repeat scroll;">
            <p class="title fBold">sign up</p>
            <form action="signUp.php" method="post" class="signUpForm">
                <label>Email</label>
                <input type="text" placeholder="example@example.com" name="email">
                <span class="errorStyle">
           		    <?php echo $errors['email'] ?>
                    <?php echo $errors['message1'] ?>
        		</span>
                <label>Username</label>
                <input type="text" placeholder="username" name="username">
                <span class="errorStyle">
           			<?php echo $errors['username'] ?>
                    <?php echo $errors['message2'] ?>
        		</span>
                <label>Password</label>
                <input type="password" placeholder="********" name="password">
                <span class="errorStyle">
           		    <?php echo $errors['password'] ?>
        		</span>
                <label>Confirm Password</label>
                <input type="password"  placeholder="********" name="confirmPassword">
                <span class="errorStyle">
           			<?php echo $errors['confirmPassword'] ?>
        		</span>
                <button type="submit" class="button signUp fBold" name="signUp">Sign Up</button>
            </form>
        </section>
    </main>
    <!-- End signUp Main -->


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
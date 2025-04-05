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
    <title>M&H |Contact Us</title>
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
			'fName' => '',
            'lName' => '',
            'email' => '',
            'description' => '',
		);

		$fName1 = "";
		$lName1 = "";
		$email1 = "";
		$description1 = "";

        if (isset($_POST['contact'])) {
			$fName = cleanData($_POST['fName']);
			$lName = cleanData($_POST['lName']);
			$email = cleanData($_POST['email']);
			$description = cleanData($_POST['description']);

            if (empty($fName)) {
				$errors['fName'] = "Add first name";
			} elseif(preg_match('/^[a-zA-z]*$/', $fName) == FALSE) {
				$errors['fName'] = "Only alphabets and whitespace are allowed.";
			} else {
				$fName1 = $fName;
			}

            if (empty($lName)) {
				$errors['lName'] = "Add last name";
			} elseif(preg_match('/^[a-zA-z]*$/', $lName) == FALSE) {
				$errors['fName'] = "Only alphabets and whitespace are allowed.";
			} else {
				$lName1 = $lName;
			}

            if (empty($email)) {
                $errors['email'] = "Add email <br>";
            } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
                $errors['email'] = "Please enter a valid email address Like example@example.com";
            } else {
                $email1 = $email;
            }

            if (empty($description)) {
                $errors['description'] = "Please write your message <br>";
            } else {
                $description1 = $description;
            }

            if($fName1 != "" && $lName1 != "" && $email1 != "" && $description1 != "" ){
                $sql = "INSERT INTO CONTACT(FIRST_NAME ,LAST_NAME ,EMAIL , DESCRIPTION) VALUES('$fName1', '$lName1','$email1', '$description1')";
                $result = mysqli_query($conn , $sql);
                if (!$result) {
                    echo "Query failed " . mysqli_error($conn);
                    exit;
                }else{
                    echo '
                        <script> alert("WELCOME")</script>
                    ';
                }
            }
        }     
    ?>
    <!-- End php -->


    <!-- Start Contact Main  -->
    <main class="contact" style="background:url(images/forms.jpg) 50% 20% no-repeat scroll;">
        <p class="title fBold">get in touch</p>
        <form action="contact.php" method="post" class="contactForm">
            <div class="name">
                <div class="first">
                    <label>First Name</label>
                    <input type="text" placeholder="First Name" name="fName">
                    <span class="errorStyle">
           		    <?php echo $errors['fName'] ?>
        		    </span>
                </div>
                <div class="last">
                    <label>Last Name</label>
                    <input type="text" placeholder="Last Name" name="lName">
                    <span class="errorStyle">
           		    <?php echo $errors['lName'] ?>
        		    </span>
                </div>
            </div>
            <label>Email Address</label>
            <input type="text" placeholder= "Email Address" name="email">
            <span class="errorStyle">
           		<?php echo $errors['email'] ?>
        	</span>
            <label>Description</label>
            <textarea placeholder="Description" name="description"></textarea>
            <span class="errorStyle">
           		<?php echo $errors['description'] ?>
        	</span>
            <button type="submit" class="button fBold submit" name="contact">Submit</button>
        </form>

    </main>
    <!-- End Contact Main -->


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
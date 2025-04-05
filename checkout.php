<?php
    session_start();
    if(!empty($_SESSION["qty"])){
        $qty = $_SESSION['qty'];
    }else{
        $qty = '';
    }

    if(!empty($_SESSION["pName"])){
        $pName = $_SESSION['pName'];
    }else{
        $pName = '';
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
    <title>M&H |Checkout</title>
</head>
<body>


    <!-- Start PHP -->
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
		    'phoneNo' => '',
		    'city' => '',
		    'address' => '',
		    'cardNo' => '',
		    'cvc' => '',
		    'zip' => '',
		);

        $fName1='';
        $lName1='';
        $email1='';
        $phoneNo1='';
        $city1='';
        $address1='';
        $cardNo1='';
        $cvc1='';
        $zip1='';


        if (isset($_POST['buy'])) {

			$fName = cleanData($_POST['fName']);
			$lName = cleanData($_POST['lName']);
			$email = cleanData($_POST['email']);
			$phoneNo = cleanData($_POST['phoneNo']);
			$country = $_POST['country'];
			$city = cleanData($_POST['city']);
			$address = cleanData($_POST['address']);
			$cardNo = cleanData($_POST['cardNo']);
			$cvc = cleanData($_POST['cvc']);
			$zip = cleanData($_POST['zip']);

			if (empty($fName)) {
				$errors['fName'] = "Add First Name<br>";
			} elseif(preg_match('/^[a-z]{1,10}$/i', $fName) == FALSE) {
				$errors['fName'] = "please enter just characters , maximum lenght 10";
			} else {
				$fName1 = $fName;
			}

            if (empty($lName)) {
				$errors['lName'] = "Add last Name <br>";
			} elseif(preg_match('/^[a-z]{1,10}$/i', $lName) == FALSE) {
				$errors['lName'] = "please enter just characters , maximum lenght 10";
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

            if (empty($phoneNo)) {
                $errors['phoneNo'] = "Add phone number <br>";
            }elseif(!preg_match('/^[0-9]{10}+$/', $phoneNo)) {
                $errors['phoneNo'] = "Add a valid phone number <br>";
            } else {
                $phoneNo1 = $phoneNo;
            }
			
            if (empty($city)) {
				$errors['city'] = "Add Your City<br>";
			} elseif(preg_match('/^[a-z]{1,10}$/i', $city) == FALSE) {
				$errors['city'] = "please enter just characters , maximum lenght 10";
			} else {
				$city1 = $city;
			}

            if (empty($address)) {
				$errors['address'] = "Add Your address<br>";
			}else {
				$address1 = $address;
			}

            if (empty($cardNo)) {
				$errors['cardNo'] = "Add Your Card Number<br>";
            } elseif(!(preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/', $cardNo) || preg_match('/^5[1-5][0-9]{14}$/', $cardNo) || preg_match('/^3[47][0-9]{13}$/', $cardNo)|| preg_match('/^6(?:011|5[0-9]{2})[0-9]{12}$/', $cardNo))) {
				$errors['cardNo'] = "please enter a valid card number";
			} else {
				$cardNo1 = $cardNo;
			}


            if (empty($cvc)) {
				$errors['cvc'] = "Add CVC number<br>";
			} elseif(strlen($cvc) != 3) {
				$errors['cvc'] = "please enter a valid CVC (3 digits)<br>";
			} else {
				$cvc1 = $cvc;
			}

            if (empty($zip)) {
				$errors['zip'] = "Add ZIP number<br>";
			}else {
				$zip1 = $zip;
			}

            if($fName1 != "" && $lName1 != "" && $email1 != "" && $phoneNo1 != "" && $city1 != "" && $address1 != "" && $cardNo1 != "" && $cvc1 != "" && $zip1 != "" ){
                    

                    $sql = "INSERT INTO ORDERS(FIRST_NAME, LAST_NAME  ,EMAIL ,PHONE_NUMBER ,COUNTRY ,CITY ,ADDRESS ,CARD_NUMBER  ,CVC ,ZIP , PRODUCT_NAME , QUANTITY ) VALUES('$fName1', '$lName1' ,'$email1' ,'$phoneNo1' ,'$country' ,'$city1' ,'$address1' ,'$cardNo1'  ,'$cvc1' ,'$zip1' ,'$pName','$qty')";
                    $result = mysqli_query($conn , $sql);
                    if (!$result) {
                        echo "Query failed " . mysqli_error($conn);
                        exit;
                    } else {
                        echo "<script>alert('Your Order is Ready')</script>";  
                    }
            }
        }
        

        $select_country = mysqli_query($conn, "SELECT * FROM COUNTRY") or die('query failed');
        $country = mysqli_fetch_array($select_country);
    ?>
    <!-- End PHP -->


    <!-- Srart Checkout Main -->
    <main class="checkout" style="background:url(images/forms.jpg) 50% 20% no-repeat scroll;">
        <p class="title fBold">shipping information</p>
        <form action="checkout.php" method="post" class="orderForm">
            <input type="text" placeholder="First Name" name="fName" class="input">
            <span class="errorStyle">
           		    <?php echo $errors['fName'] ?>
        	</span>
            <input type="text" placeholder="Last Name" name="lName" class="input">
            <span class="errorStyle">
           		    <?php echo $errors['lName'] ?>
        	</span>
            <input type="text" placeholder="Email Address" name="email" class="input">
            <span class="errorStyle">
           		    <?php echo $errors['email'] ?>
        	</span>
            <input type="text" placeholder="Phone Number" name="phoneNo" class="input">
            <span class="errorStyle">
           		    <?php echo $errors['phoneNo'] ?>
        	</span>
            <select name="country" class="input">
                <?php 
                    do{
                        echo '<option>';
                        echo $country["NAME"];
                        echo '</option>';
                    }while ($country = mysqli_fetch_array($select_country))
                ?>
            </select>
            <input type="text" placeholder="City" name="city" class="input">
            <span class="errorStyle">
           		    <?php echo $errors['city'] ?>
        	</span>
            <input type="text" placeholder="Your Address" name="address" class="input">
            <span class="errorStyle">
           		    <?php echo $errors['address'] ?>
        	</span>
            <input type="text" placeholder="Card Number" name="cardNo" class="input">
            <span class="errorStyle">
           		    <?php echo $errors['cardNo'] ?>
        	</span>
            <input type="text" placeholder="CVC" name="cvc" class="input">
            <span class="errorStyle">
           		    <?php echo $errors['cvc'] ?>
        		</span>
            <input type="text" placeholder="ZIP" name="zip" class="input">
            <span class="errorStyle">
           		    <?php echo $errors['zip'] ?>
        	</span>
            <button type="submit" name="buy" class="button">BUY</button>
        </form>
    </main>
    <!-- End Checkout Main -->


    <!-- Start arrow button -->
    <button type="button" class="arrow" >
        <i class="fa fa-angle-double-up"></i>
    </button>
    <!-- End arrow button -->

    
    <script src="js/js.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
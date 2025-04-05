<?php
    $server = "localhost";
	$username = "root";
	$password = "";

	$conn = mysqli_connect($server, $username, $password);
	$db = mysqli_select_db($conn,"MH");
    
    function cleanData($data){
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = strip_tags($data);
        $data = stripslashes($data);
        return $data;
    }

    if(isset($_POST['submit'])){
        
        // Data field in databade
        $name = mysqli_real_escape_string($conn, cleanData($_POST['namr']));
        $email = mysqli_real_escape_string($conn, cleanData($_POST['email']));
        $password = cleanData($_POST['password']);
        $cpassword = cleanData($_POST['cpassword']);


        //Insert Data into database but at first Verify that the email is not used already
        $select = "SELECT * FROM ADMINS WHERE EMAIL ='$email' ";
        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result)>0){
            $error[] = 'user already exist!';
        
        }else{
            if( $password != $cpassword){
                $error[] = 'password not matched!';
            }else{
                $insert =" INSERT INTO ADMINS (NAME, EMAIL, PASSWORD) VALUES ('$name', '$email', '$password')";
                mysqli_query($conn, $insert);
                header('location:index.php');
            }
        }

    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page title -->
    <title>Register</title>
    <!-- Style CSS link -->
    <link rel="stylesheet" href="adminStyle.css">
</head>
<body>

    <div class="form-container">
        <form action="" method="post">
            <h3>register now</h3>
            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    }
                };
            
            ?>

            <input type="text" name="name" required placeholder="enter your name">
            <input type="email" name="email" required placeholder="enter your email">
            <input type="password" name="password" required placeholder="******">
            <input type="password" name="cpassword" required placeholder="******">
            
            <input type="submit" name="submit" value="register now" class="form-btn">
        </form>
    </div>
    
</body>
</html>
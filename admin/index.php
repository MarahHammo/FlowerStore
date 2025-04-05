<?php
    session_start();
    $server = "localhost";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($server, $username, $password);
    $db = mysqli_select_db($conn,"MH");

    /*Clean Data */
    function cleanData($data){
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = strip_tags($data);
        $data = stripslashes($data);
        return $data;
    }

    if(isset($_POST['submit'])){
        
        //Check validation
        $email = cleanData($_POST['email']);
        $password = cleanData($_POST['password']);

        // Data field in databade
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = $_POST['password'];

        //Insert Data into database but at first Verify that the email is not used already
        $select = "SELECT * FROM ADMINS WHERE email ='$email'";
        $result = mysqli_query($conn, $select);


        if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_array($result);
            if($password == $row['PASSWORD']){
            $adminName = $row['NAME'];

            $_SESSION['name'] = $adminName;
            
            header('location:homeA.php');
            }else{
                $error[] = 'incorrect password';
            }
        }else{
            $error[] = 'incorrect email';
        }
    };

    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page title -->
    <title>Login</title>
    <!-- Style CSS link -->
    <link rel="stylesheet" href="adminStyle.css">
</head>
<body >

    <div class="form-container">
        <form action="" method="post">
            <h3>Login now</h3>
            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    }
                };
            
            ?>
            
            <input type="email" name="email" required placeholder="enter your email" >
            <input type="password" name="password" required placeholder="enter your password" >     
            <input type="submit" name="submit" value="login now" class="form-btn">
            <p>don't have an account? <a href="register.php">register now</a></p>

        </form>
    </div>
    
</body>
</html>
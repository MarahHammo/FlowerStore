<?php
session_start();
if(!empty($_SESSION["name"])){
    $adminName = $_SESSION['name'];
}else{
    $adminName = '';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Page Title  -->
        <title>Admin Panel</title>
        <!-- Bootstrap 5 css -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- Bootstrap 5 js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!-- Favicon -->
        <link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon">
        <!-- Font Awesome 4.7 Library -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- Admin CSS File -->
        <link rel="stylesheet" href="adminStyle.css">
    </head>


    <body>

    <div class="contanier home">
        <div class="content">
            <h3>Hi, 
                <span>
                    <?php
                        if ($adminName != '') { 
                            echo "$adminName";
                        }
                            ?>
                </span>
            </h3>
            <h1>Welcome</h1>
            <p>This is an admin page</p>

            <a href="plantA.php" class="btn" style="width:150px;">PLANTS</a>
            <a href="flowerA.php" class="btn" style="width:150px;">FLOWERS</a>
            <a href="orderA.php" class="btn" style="width:150px;">ORDERS</a>
            <a href="contactA.php" class="btn" style="width:150px;">MESSEGES</a>
            <a href="logOut.php" class="btn btn_log" style="width:150px;">Logout</a>
        </div>
    </div>
    
    </body>
</html>
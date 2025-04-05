<?php
    session_start();
    if(!empty($_SESSION["username"])){
        $username = $_SESSION["username"];
    }else{
        $username = "";
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- My CSS File -->
    <link rel="stylesheet" href="css/style.css">
    <title>M&H |Plant</title>
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


    <!-- Start PHP -->
    <?php
        $server = "localhost";
		$username = "root";
		$password = "";

		$conn = mysqli_connect($server, $username, $password);
		$db = mysqli_select_db($conn,"MH");
        
        if (isset($_POST['buy'])){
            if(empty($_SESSION["username"])){
                header('location: signIn.php');
            }else{
                $_SESSION['qty'] = $_POST['qty'];
                $_SESSION['pName'] = $_POST['pName'];
                header('location:checkout.php');
            }
        }
        
    ?>
    <!-- End PHP -->


    <!-- Start Plant Main -->
    <main class="plantSec">
        

        <!-- Title -->
        <div class="title">
            <a href="plant.php">
                <h1 class="fRegular">Plants</h1>
            </a>
        </div>


        <!-- Plant images -->
        <div class="container plantUser">
            <?php
            $sql = "SELECT * FROM PLANTS";
            $result =  mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)){
            ?>
                    <div class="box">

                        <ul>

                            <li>
                                <img src="admin/uploaded_image/<?php echo $row['IMAGE']; ?> "/>
                            </li>
                            
                            <li>
                                <p class="fBold fname"> <?php echo $row['NAME']; ?> </p>
                            </li>

                            <li>
                                <table style="margin:10px auto;">
                                    <tr>
                                        <td> <h3 class="fRegular price" style="font-size:20px; margin-right:10px; margin-top:5px; color:rgba(165, 82, 119,0.6);"><?php echo $row['PRICE'];?> $</h3> </td>
                                        <td> <span class="decrementButton qty_ctr fBold" style="cursor:pointer; width:20px; padding:2px 4px; color:rgb(200, 106, 148); margin : 1px ; background-color: rgb(237, 233, 240);" onMouseOver="this.style.color='#203141'" onMouseOut="this.style.color='rgb(200, 106, 148)'" >-</span> </td>
                                        <td> <form action="plant.php" method="post"> <input type="text" class="qty fBold" value="1" name="qty" style="width:55px; text-align:center;"> </td>
                                        <td> <span class="incrementButton qty_ctr fBold" disabled style="cursor:pointer; width:20px; padding:2px 4px; color:rgb(200, 106, 148); margin : 1px ; background-color: rgb(237, 233, 240);"   onMouseOver="this.style.color='#203141'" onMouseOut="this.style.color='rgb(200, 106, 148)'">+</span> </td>
                                    </tr>
                                </table>
                            </li>
                            
                            <li>
                                    <input type="text" name="pName" value="<?php echo $row['NAME']; ?>" hidden>
                                    <input type="submit" value="buy now" name="buy" class="btn fRegular">
                                </form>
                                
                            </li>
                        </ul>

                    </div>
                <?php } ?>        
        </div>

    
    </main>
    <!-- End Plant Main -->


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
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>
</body>
</html>
<?php

    session_start();
    $server = "localhost";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($server, $username, $password);
    $db = mysqli_select_db($conn,"MH");

    $smg []="";

    function cleanData($data){
            $data = htmlspecialchars($data);
            $data = trim($data);
            $data = strip_tags($data);
            $data = stripslashes($data);
            return $data;
    }

    /*_______________Insret Into database________________*/

    // if upload button is pressed
    if(isset($_POST['upload'])) {
        
        // Posted Values
        $imgtitle=$_POST['Plant_name'];
        $imgfile=$_FILES["Plant_image"]["name"];

        // get the image extension
        $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
        
        // allowed extensions
        $allowed_extensions = array(".jpg","jpeg",".png",".gif");      
        
        // Validation for allowed extensions .in_array() function searches an array for a specific value.
        if(!in_array($extension,$allowed_extensions)){
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        }else{


        $target = "uploaded_image/" .basename($_FILES['Plant_image']['name']);

        // Get all the submitted data from the form
        $name= cleanData($_POST['Plant_name']);
        $price = cleanData($_POST['Plant_price']);
        $image = $_FILES['Plant_image']['name'];

        if(!preg_match("/[0-9]$/", $price)){
            echo "<script> alert('Price Must Be Integer'); </script>"; 
        }else{
            
            $sql = "INSERT INTO PLANTS (NAME, PRICE, IMAGE) VALUES('$name', '$price', '$image' )";
            mysqli_query($conn, $sql); //stores the submitted data into the database table: plants
            
            // Now let's move the uploaded image into the folder:images
            if (move_uploaded_file($_FILES['Plant_image']['tmp_name'], $target)) {
                $msg[] = "Image uploaded successfully";
            }else{
                $msg[] = "There was a problem uploading image ";
            }
            echo "<script> alert('Done'); </script>"; 
        }
        

        
    } 

}

    /*____________DELETE DATA FROM MYSQL___________*/

    if(isset($_GET['delId'])){
        $delid = $_GET['delId'];
       
        $query = "DELETE FROM plants WHERE ID ='".$delid."'";
        $res = mysqli_query($conn, $query);

        if(!$res) {
            $msg[] = "error! no data to deleted";
        }
        else {
            $msg[] = "Deleted successfully";
        }     
        echo "<script> alert('Done'); </script>"; 

    }

    
    if(isset($_POST['edit'])){
        $_SESSION['pId'] = $_POST['pId'];
        header("Location:editPlants.php");
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
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <!-- Admin CSS File -->
    <link rel="stylesheet" href="adminStyle.css">
</head>
<body>
    
    <!-- Start Main -->
    <main class="main mainPlant">

    
        <header class="header">
                <a href="homeA.php" class="back fBold"> HOME </a>
        </header>

        <!-- Start section one -->
        <section class="container Asec1">


            <!-- Page title -->
            <div class="title">
                <a href="A_plants.php">
                    <h1 class="fRegular">Plants</h1>
                </a>
            </div>

            <!-- Page contents -->
            <div id="contentP" class="contentP">

                <form action="plantA.php" method="post" enctype="multipart/form-data" class="addPlants">

                    <input type="hidden" name="size" value="1000000">
                    
                    <div>
                        <label for="" class="fBold"><h4> Plant Name: </h4></label>
                        <input type="text" name="Plant_name" cols="40" rows="4" required placeholder="Name">
                    </div>

                    <div>
                        <label for="" class="fBold"><h4> Plant Price: </h4></label>
                        <input type="text" name="Plant_price" cols="40" rows="4" required placeholder="Price"><span>
                    </div>

                    <div>
                        <label for="" class="fBold"><p> Select Image: </p></label>
                        <input type="file" name="Plant_image" required>
                    </div>

                    <div>
                        <input type="submit" name="upload" value="ADD" style="color:#203141;" class="fBold">
                    </div>

                </form>
            </div>

        </section>
        <!-- End section one -->



        <!-- Start section two -->
        <section class="sec2">
            <div class="container plantAdmin">
                <?php
                $sql = "SELECT * FROM PLANTS";
                $result =  mysqli_query($conn, $sql);

                while($row = mysqli_fetch_array($result)){?>
                    <div class="box">
                        <ul>

                            <li>
                                <img src="uploaded_image/<?php echo $row['IMAGE'];?>"/>
                            </li>
                            
                            <li>
                                <h3 class="fRegular"> <?php echo $row['NAME'];?></h3>
                            </li>
                        
                            <li>
                                <h3 class="fRegular price"> <?php echo$row['PRICE'];?> $ </h3>

                            </li>

                            <li>
                                    <ul class="btn_box" style="
                                        display: flex;
                                        gap:10px;
                                        justify-content: center;">
                                        <form method="GET" class="delete">
                                            <a href="plantA.php?delId=<?php echo $row['ID'];?>"> 
                                                <input value="Delete" name="delete" class="btn fBold btnD" style="
                                                width:75%;
                                                padding:2px 25px; 
                                                border: 1px solid;
                                                color:#fff;">
                                            </a>
                                        </form>
                                        <form method="post" class="edit">
                                            <input type="hidden" name="pId" value="<?php echo $row['ID'];?>">
                                            <input type="submit" value="Edit" name="edit" class="btn fBold btnE" style="
                                                width:75%;
                                                padding:2px 25px; 
                                                border: 1px solid;
                                                color:#fff;
                                                background-color:rgb(52, 90, 125);
                                                transition: all .3s ease; ">
                                        </form>     
                                    </ul>
                                </li>

                        </ul>

                </div>
             <?php } ?>   
            
        </div>
    </section>
    <!-- End section two -->

    
    <!-- Start arrow button -->
    <button type="button" class="arrow" >
        <i class="fa fa-angle-double-up"></i>
    </button>
    <!-- End arrow button -->

    <script src="../js/js.js"></script>
    <script src="../js/custom.js"></script>

</body>
</html>
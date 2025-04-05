<?php 
    session_start();
    if(!empty($_SESSION["pId"])){
        $pId = $_SESSION['pId'];
    }else{
        $pId = 0;
    }
    // connect to the database
    $conn = mysqli_connect("localhost", "root", "", "MH"); 
    
    
        $edit = "SELECT * FROM PLANTS WHERE ID = '".$pId."'";
        $rsl = mysqli_query($conn, $edit);
        $editData = mysqli_fetch_array($rsl);
        
    



    /*_______________Update Into database________________*/

    if(isset($_POST['upload'])) {

        $name= $_POST['Plant_name'];
        $price = $_POST['Plant_price'];            
        $image = $_FILES['Plant_image']['name'];

        // get the image extension
        $extension = substr($image,strlen($image)-4,strlen($image));
        
        // allowed extensions
        $allowed_extensions = array(".jpg","jpeg",".png",".gif");  

         // Validation for allowed extensions .in_array() function searches an array for a specific value.
         if(!in_array($extension,$allowed_extensions)){
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        }else{
            $target = "uploaded_image/" .basename($_FILES['Plant_image']['name']);
         
            if(!preg_match("/[0-9]$/", $price)){
                echo "<script> alert('Price Must Be Integer'); </script>"; 
            }else{
                $sql = "UPDATE PLANTS SET NAME = '$name' , PRICE = '$price' , IMAGE = '$image' WHERE ID = '$pId' ";
                $result = mysqli_query($conn, $sql); //stores the submitted data into the database table: plants
                
                echo "<script> alert('Done'); </script>"; 
                
                // Now let's move the uploaded image into the folder:images
                if (move_uploaded_file($_FILES['Flower_image']['tmp_name'], $target)) {
                    $msg[] = "Image uploaded successfully";
                }else{
                    $msg[] = "There was a problem uploading image ";
                }
                header('location: plantA.php');
            }    
    }


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
    <!-- Font Awesome 6.4.0 Library -->
    <link rel="stylesheet" href="fontawesome.css">
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
            <!-- page title -->
            <div class="title">
                <a href="plants.php">
                    <h1> Plants </h1>
                </a>
            </div>

            <!-- Page contents -->
            <div id="contentP" class="contentP">
                <form action="editPlants.php" method="post" enctype="multipart/form-data" class="addPlants">

                    <input type="hidden" name="size" value="1000000" />

                    <div>
                        <label for="" class="fBold"><p> Plant Name: </p></label>
                        <input type="text" name="Plant_name" cols="40" rows="4" value="<?php echo $editData['NAME'];?>">
                    </div>

                    <div>
                        <label for="" class="fBold"><p> Plant Price: </p></label>
                        <input type="text" name="Plant_price" cols="40" rows="4"value="<?php echo $editData['PRICE'];?>">
                    </div>


                    <div>
                        <label for="" class="fBold"><p> Image Name: </p></label>
                        <input type="text" cols="40" rows="4" value="<?php echo $editData['IMAGE'];?>">
                        <input type="file" name="Plant_image" value="uploaded_image/<?php echo $editData['IMAGE'];?>" required>
                    </div>


                    <div>
                        <input type="submit" name="upload" value="Update" style="color:#203141;" class="fBold">
                    </div>


                </form>
            </div>

        </section>
        <!-- End section one -->
    </main>
    <!-- End Main  -->
    
</body>
</html>
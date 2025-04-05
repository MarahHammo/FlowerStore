<?php 
    session_start();
    if(!empty($_SESSION["pId"])){
        $pId = $_SESSION['pId'];
    }else{
        $pId = 0;
    }
    // connect to the database
    $conn = mysqli_connect("localhost", "root", "", "MH"); 


    
    
        $edit = "SELECT * FROM FLOWERS WHERE ID = '".$pId."'";
        $rsl = mysqli_query($conn, $edit);
        $editData = mysqli_fetch_array($rsl);
        
    



    /*_______________Update Into database________________*/

    if(isset($_POST['upload'])) {

        $name= $_POST['Flower_name'];
        $price = $_POST['Flower_price'];            
        $image = $_FILES['Flower_image']['name'];

        // get the image extension
        $extension = substr($image,strlen($image)-4,strlen($image));
        
        // allowed extensions
        $allowed_extensions = array(".jpg","jpeg",".png",".gif");      
        
         // Validation for allowed extensions .in_array() function searches an array for a specific value.
        if(!in_array($extension,$allowed_extensions)){
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        }else{
            $target = "uploaded_image/" .basename($_FILES['Flower_image']['name']);

            if(!preg_match("/[0-9]$/", $price)){
                echo "<script> alert('Price Must Be Integer'); </script>"; 
            }else{
                $sql = "UPDATE FLOWERS SET NAME = '$name' , PRICE = '$price' , IMAGE = '$image' WHERE ID = '$pId' ";
                $result = mysqli_query($conn, $sql); //stores the submitted data into the database table: flowers

                // Now let's move the uploaded image into the folder:images
                if (move_uploaded_file($_FILES['Flower_image']['tmp_name'], $target)) {
                    $msg[] = "Image uploaded successfully";
                }else{
                    $msg[] = "There was a problem uploading image ";
                }
                echo "<script> alert('Done'); </script>"; 
                header('location: flowerA.php');

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

   <main class="main mainFlowers">

        <header class="header">
            <a href="homeA.php" class="back fBold"> HOME </a>
        </header>

        <section class="container Asec1">
                <!-- Page title -->
                <div class="title">
                    <a href="editFlowers.php">
                        <h1 class="fRegular">Update Flowers</h1>
                    </a>
                </div>
                <!-- Page contents -->
                <div id="contentF" class="contentF">

                    <form action="editFlowers.php" method="post" enctype="multipart/form-data" class="addFlowers">

                        <input type="hidden" name="size" value="1000000">
                    
                        <div>
                            <label for="" class="fBold"><p> New Flower Name: </p></label>
                            <input type="text" name="Flower_name" cols="40" rows="4" value="<?php echo $editData['NAME'];?>">
                        </div>

                        <div>
                            <label for="" class="fBold"><p> New Flower Price: </p></label>
                            <input type="text" name="Flower_price" cols="40" rows="4" value="<?php echo $editData['PRICE'];?>">
                        </div>


                        <div>
                            <label for="" class="fBold"><p> Image name </p></label>
                            <input type="text" cols="40" rows="4" value="<?php echo $editData['IMAGE'];?>">
                            <input type="file" name="Flower_image" value="uploaded_image/<?php echo $editData['IMAGE'];?>" required>
                        </div>

                        <div>
                            <input type="submit" name="upload" value="Update" style="color:#a55277;" class="fBold">
                        </div>

                    </form>
                </div>
        </section>
    </main>
</body>
</html>
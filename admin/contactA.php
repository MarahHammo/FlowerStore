<?php 
    // connect to the database
    $conn = mysqli_connect("localhost", "root", "", "MH");
    /*____________DELETE DATA FROM MYSQL___________*/

    if(isset($_GET['delid'])){
        $delid = $_GET['delid'];
    
        $query = "DELETE FROM CONTACT WHERE ID ='".$delid."'";
        $res = mysqli_query($conn, $query);

        if(!$res) {
            $msg[] = "error! no data to deleted";
        }
        else {
            $msg[] = "Deleted successfully";
        }          
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstarb 5 CSS-->
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font awesome css -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <!-- Admin CSS File -->
    <link rel="stylesheet" href="style.css">


</head>
<body>
    <nav class="navbar navbar-light bg-light" style="margin-bottom:25px;">
        <div class="container-fluid container">
            <a class="navbar-brand fBold" style="color:#c32f56;font-size:35px;">Messages</span></a>
            <form class="d-flex">
            <button class="btn btn-light" type="submit" style="background-color:#f0f8ff;"> <a href="homeA.php" class="fBold" style="color:#c32f56;"> Home </a></button>
            <button class="btn btn-light" type="submit" style="background-color:#f0f8ff;"> <a href="logout.php" class="fBold" style="color:#203141;"> Logout </a></button>
            </form>
        </div>
    </nav>




    <table class="table table-bordered table-striped table-hover table-responsive container">
        <tr class="head">
            <th class="fBold">Id</th>
            <th class="fBold">User Name</th>
            <th class="fBold">Email</th>
            <th class="fBold">Discription</th>
            <th class="fBold">#</th>
        </tr>

        <?php 
            // connect to the database
            $conn = mysqli_connect("localhost", "root", "", "MH");

            $sql = "SELECT * FROM CONTACT ";

            $result = mysqli_query($conn, $sql);

            if ($result){
                while ($row = mysqli_fetch_array($result)){?>
                    <tr class="body">
                        <td> <?php echo $row['ID'];?> </td>
                        <td> <?php echo $row['FIRST_NAME']." ".$row['LAST_NAME'];?> </td>
                        <td> <?php echo $row['EMAIL'];?> </td>
                        <td> <?php echo $row['DESCRIPTION'];?> </td>
                        <td class="del fBold"><a href="contactA.php?delid=<?php echo $row['ID'];?>"><i class="btn btn-light" >Delete</i> </a></td>

                    </tr>
                <?php }?>
            <?php }?>
    </table>




    
    <!-- Start arrow button -->
    <button type="button" class="arrow" >
        <i class="fa fa-angle-double-up"></i>
    </button>
    <!-- End arrow button -->

    <script src="../js/js.js"></script>
    <!-- Bootstarb 5 JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../js/custom.js"></script>

</body>
</html>
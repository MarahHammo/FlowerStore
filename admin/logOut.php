<?php
    session_start();
    
    // connect to the database
    $conn = mysqli_connect("localhost", "root", "", "MH"); 

    session_unset();

    header('location:index.php');

?>
<?php
    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $database = "agasthi";

    $servername = "mysql8003.site4now.net";
    $username = "a9810e_agasthi";
    $password = "admin@123";
    $database = "db_a9810e_agasthi";

    try {
        $conn = mysqli_connect($servername, $username, $password, $database);
        if (!$conn) {
            throw new Exception("Failed to connect to MySQL: " . mysqli_connect_error());
        }
        
    } catch(Exception $e) {
        $errorMessage = $e->getMessage();
        echo "<script>alert('$errorMessage');</script>";
    }
?>

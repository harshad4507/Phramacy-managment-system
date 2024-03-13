<?php
include("../dbconnection.php");

try {
    if(isset($_REQUEST['name']))
    {
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $mobileno = $_REQUEST['contactNo'];
        $password = $_REQUEST['password'];
        $address = $_REQUEST['address'];
        $ctype = "Retail";

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO customers(name, email, mobileno, password, address,ctype) VALUES ('$name','$email','$mobileno','$hashedPassword','$address','$ctype')";
        $result = mysqli_query($conn, $query);

        if($result)
        {
            $tarray = array("result" => "success");
        }
        else
        {
            $tarray = array("result" => "Failed to insert customer data");
        }

        header('Content-Type: application/json');
        echo json_encode($tarray);
    }
} catch (Exception $e) {
    // Handle the exception
    $tarray = array("result" => "An error occurred: " . $e->getMessage());
    header('Content-Type: application/json');
    echo json_encode($tarray);
}
?>

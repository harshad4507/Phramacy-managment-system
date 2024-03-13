<?php
include("../dbconnection.php");

if(isset($_REQUEST['email']) && isset($_REQUEST['newpassword']))
{
    try {
        $email = $_REQUEST['email'];
        $newpassword = $_REQUEST['newpassword'];

        $data = array();

        $query = "SELECT * FROM customers WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) == 1)
        {
            $hashedPassword = password_hash($newpassword, PASSWORD_DEFAULT);

            $query = "UPDATE customers SET password = '$hashedPassword' WHERE email = '$email'";
            $result = mysqli_query($conn, $query);
    
            if($result)
            {
                $data = array("result" => "success");
            }
            else
            {
                $data = array("result" => "Failed to update the data");
            }
        }
        else
        {
            $data = array("result" => "Email not Found!!!");
        }

        $dataArray = array();
        array_push($dataArray, $data);
        header('Content-Type: application/json');
        echo json_encode(array("data" => $dataArray));
    } catch (Exception $e) {
        // Handle the exception
        $data = array("result" => "An error occurred: " . $e->getMessage());
        $dataArray = array();
        array_push($dataArray, $data);
        header('Content-Type: application/json');
        echo json_encode(array("data" => $dataArray));
    }
}
?>

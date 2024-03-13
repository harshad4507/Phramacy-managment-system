<?php
include("../dbconnection.php");

if(isset($_REQUEST['email']))
{
    try {
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        $data = array();

        $query = "SELECT * FROM customers WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row["password"];

            if(password_verify($password, $hashedPassword))
            {
                $data['result'] = "success";
                $data['cid'] = $row['cid'];
                $data['name'] = $row['name'];
                $data['email'] = $row['email'];
                $data['mobileno'] = $row['mobileno'];
                $data['address'] = $row['address'];
            }
            else
            {
                $data = array("result" => "Invalid password!!!");
            }
        }
        else
        {
            $data = array("result" => "Invalid Username or password!!!");
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

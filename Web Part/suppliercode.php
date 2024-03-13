<?php
session_start();
include('dbconnection.php');

try {
    if (isset($_POST['addsupplier'])) {
        $suppliercode = $_POST['suppliercode'];
        $name = $_POST['suppliername'];
        $email = $_POST['emailaddress'];
        $address = $_POST['PAddress'];
        $mobileno = $_POST['supmob'];

        if (empty($suppliercode) || empty($name) || empty($email) || empty($address) || empty($mobileno)) {
            throw new Exception("Please fill in all the required fields");
        }

        // Check if the mobile number or email already exists
        $checkQuery = "SELECT * FROM suppliers WHERE mobileno = '$mobileno' OR email = '$email'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $existingData = mysqli_fetch_assoc($checkResult);
            if ($existingData['mobileno'] === $mobileno) {
                throw new Exception("Mobile number already exists");
            } elseif ($existingData['email'] === $email) {
                throw new Exception("Email already exists");
            }
        }

        $query = "INSERT INTO suppliers(suppliercode, name, email, address, mobileno) VALUES ('$suppliercode','$name','$email','$address','$mobileno')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['msg'] = "Supplier data inserted successfully";
            header("Location: suppliers.php");
            exit(0);
        } else {
            throw new Exception("Supplier data not inserted successfully");
        }
    }

    if (isset($_POST['updatesupplier'])) {
        $sid = $_POST['sid'];
        $suppliercode = $_POST['suppliercode'];
        $name = $_POST['suppliername'];
        $email = $_POST['emailaddress'];
        $address = $_POST['PAddress'];
        $mobileno = $_POST['supmob'];

        if (empty($suppliercode) || empty($name) || empty($email) || empty($address) || empty($mobileno)) {
            throw new Exception("Please fill in all the required fields");
        }

        // Check if the mobile number or email already exists
        $checkQuery = "SELECT * FROM suppliers WHERE mobileno = '$mobileno' OR email = '$email'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $existingData = mysqli_fetch_assoc($checkResult);
            if ($existingData['mobileno'] === $mobileno) {
                throw new Exception("Mobile number already exists");
            } elseif ($existingData['email'] === $email) {
                throw new Exception("Email already exists");
            }
        }


        $query = "UPDATE suppliers set suppliercode='$suppliercode',name='$name',email='$email',address='$address',mobileno='$mobileno' where sid=$sid";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['msg'] = "Supplier data updated successfully";
            header("Location: suppliers.php");
            exit(0);
        } else {
            throw new Exception("Supplier data not updated successfully");
        }
    }
} catch (Exception $e) {
    $_SESSION['msg'] = $e->getMessage();
    header("Location: supplier.php");
    exit(0);
}

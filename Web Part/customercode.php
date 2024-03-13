<?php
session_start();
include('dbconnection.php');

try {

    if (isset($_POST['addcustomer'])) {
        $name = $_POST['CName'];
        $email = $_POST['CEmail'];
        $mobile = $_POST['CMobile'];
        $first_four_digits = strval(substr($mobile, 0, 4));
        $pass = strtoupper(str_replace(" ", '', $name)) . '@' . $first_four_digits;
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        $address = $_POST['CAddress'];
        if (isset($_POST['ctype'])) {
            $ctype = $_POST['ctype'];
        }

        // Check if the mobile number or email already exists
        $checkQuery = "SELECT * FROM  customers WHERE mobileno = '$mobileno' OR email = '$email'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $existingData = mysqli_fetch_assoc($checkResult);
            if ($existingData['mobileno'] === $mobileno) {
                throw new Exception("Mobile number already exists");
            } elseif ($existingData['email'] === $email) {
                throw new Exception("Email already exists");
            }
        }

        $query = "INSERT INTO customers(name, email, mobileno, password, address, ctype) VALUES ('$name','$email','$mobile','$hashedPassword','$address','$ctype')";

        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['msg'] = "Customer data added successfully";
            header("Location: suppliers.php");
            exit(0);
        } else {
            throw new Exception("Not Added successfully");
        }
    }

    if (isset($_POST['updatecustomer'])) {
        $cid = $_POST['cid'];
        $name = $_POST['CName'];
        $email = $_POST['CEmail'];
        $mobile = $_POST['CMobile'];
        $address = $_POST['CAddress'];
        if (isset($_POST['ctype'])) {
            $ctype = $_POST['ctype'];
        }

        // Check if the mobile number or email already exists
        $checkQuery = "SELECT * FROM  customers WHERE mobileno = '$mobileno' OR email = '$email'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $existingData = mysqli_fetch_assoc($checkResult);
            if ($existingData['mobileno'] === $mobileno) {
                throw new Exception("Mobile number already exists");
            } elseif ($existingData['email'] === $email) {
                throw new Exception("Email already exists");
            }
        }

        $query = "UPDATE customers SET name='$name',email='$email',mobileno='$mobile',address='$address',ctype='$ctype' WHERE cid='$cid'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['msg'] = "Customer data updated successfully";
            header("Location: suppliers.php");
            exit(0);
        } else {
            throw new Exception("Not updated successfully");
        }
    }
} catch (Exception $e) {
    $_SESSION['msg'] = $e->getMessage();
    header("Location: supplier.php");
    exit(0);
}

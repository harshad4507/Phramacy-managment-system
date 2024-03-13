<?php
session_start();
include("dbconnection.php");

try {
    if(isset($_POST['retrunProduct']))
    {
        $srdate = $_POST['date'];
        $cid = $_POST['customername'];
        $total_amount = $_POST['total_amount'];

        if(empty($srdate) || empty($cid) || empty($total_amount))
        {
            throw new Exception("Please fill in all the required fields");
        }

        $q1 = "INSERT INTO `salereturns`(`srdate`, `customer_id`, `total_amount`) VALUES ('$srdate','$cid','$total_amount')";
        mysqli_query($conn,$q1);
        $srid = mysqli_insert_id($conn);
        $count = $_POST['count'];

        for($i=1; $i<=$count; $i++)
        {
            $product_id = $_POST['product'.$i];
            $sd_id = $_POST['sd_id'.$i];
            $pd_id = $_POST['pd_id'.$i];
            $quantity = $_POST['quantity'.$i];
            $rate = $_POST['rate'.$i];
            $total = $_POST['total'.$i];

            $q2 = "INSERT INTO `salereturns_details`(`srid`, `product_id`, `sd_id`, `pd_id`, `quantity`, `rate`, `total_amount`) 
            VALUES ('$srid','$product_id','$sd_id','$pd_id','$quantity','$rate','$total')";
            $result = mysqli_query($conn,$q2);

            $q3 = "UPDATE purchase_details SET stock = stock + $quantity WHERE pd_id = $pd_id";
            mysqli_query($conn,$q3);
        }

        if($result)
        {
            $_SESSION['msg'] = "Product returned successfully";
            header("Location: saleretruntable.php");
            exit(0);
        }
        else
        {
            throw new Exception("Something went wrong");
        }
    }
} catch (Exception $e) {
    $_SESSION['msg'] = $e->getMessage();
    header("Location: saleretrun.php");
    exit(0);
}
?>

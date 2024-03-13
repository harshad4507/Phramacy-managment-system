<?php
include("../dbconnection.php");

if(isset($_REQUEST['cid']))
{
    try {
        $flag = 0;
        $cid = $_REQUEST['cid'];
        $query1 = "INSERT INTO online_orders(customer_id, order_date, status) VALUES ($cid, CURDATE(), 'pending')";
        $result = mysqli_query($conn, $query1);

        $count = $_REQUEST['count'];

        if($result)
        {
            $ooid = mysqli_insert_id($conn);
            for($i = 1; $i <= $count; $i++)
            {
                $product_id = $_REQUEST['product_id'.$i];
                $quantity = $_REQUEST['quantity'.$i];

                $query2 = "INSERT INTO online_orderdetails(oo_id, product_id, quantity) VALUES ($ooid, $product_id, $quantity)";
                $result1 = mysqli_query($conn, $query2);
                if($result1)
                {
                    $flag = 1;
                }
            }
        }

        if($flag == 1)
        {
            $tarray = array();	
            $tarray["result"] = "success";

            header('Content-Type: application/json');
            echo json_encode($tarray);
        }
    } catch (Exception $e) {
        // Handle the exception
        $tarray = array("result" => "An error occurred: " . $e->getMessage());
        header('Content-Type: application/json');
        echo json_encode($tarray);
    }
}
?>

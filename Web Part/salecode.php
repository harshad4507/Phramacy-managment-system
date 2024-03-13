<?php 
session_start();
include("dbconnection.php");

try {
    if(isset($_POST['addsale']))
    {
        $date = $_POST['date'];
        $cid = $_POST['customername'];
        $subtotal = $_POST['subtotal'];
        $discount = $_POST['Discountamount'];
        $total = $_POST['total'];

        $sql1 = "INSERT INTO sale(sale_date,cid,subtotal,discount,total,status) VALUES('$date','$cid','$subtotal','$discount','$total','Closed');";
        $reult = mysqli_query($conn,$sql1);
        if(!$reult) {
            throw new Exception("Failed to insert sale data");
        }
        $sale_id = mysqli_insert_id($conn);

        $count = $_POST['count'];

        for($i=1; $i<=$count; $i++)
        {
            $product_id = $_POST['product'.$i];
            $pd_id = $_POST['batch'.$i]; 
            $subquantity = $_POST['quantity'.$i];
            $rate = $_POST['rate'.$i];
            $sdsubtotal = $_POST['sdsubtotal'.$i];
            $sddiscount = $_POST['sddiscount'.$i];
            $sdtotal = $_POST['sdtotal'.$i];

            $sql2 = "INSERT INTO sale_details(sale_id,product_id,pd_id,subquantity,rate,subtotal,discount,total) 
                     VALUES('$sale_id','$product_id','$pd_id','$subquantity','$rate','$sdsubtotal','$sddiscount','$sdtotal')";
            $result1 = mysqli_query($conn,$sql2);
            if(!$result1) {
                throw new Exception("Failed to insert sale details");
            }

            $sql3 = "UPDATE purchase_details SET stock = stock - $subquantity WHERE pd_id = $pd_id";
            $result2 = mysqli_query($conn,$sql3);
            if(!$result2) {
                throw new Exception("Failed to update purchase details");
            }
        }

        if($reult)
        {
            if($_POST['order_id']>0)
            {
                $id = $_POST['order_id'];
                $query1 = "UPDATE  online_orders SET status = 'Billed' WHERE id = $id";
                mysqli_query($conn,$query1);
            }
        }
        else
        {
            throw new Exception("Failed to update online orders");
        }

        $_SESSION['msg'] = "Sales data inserted successfully";
        header("Location: sales.php");
        exit(0);
    }
    else
    {
        throw new Exception("Invalid request");
    }
} catch (Exception $e) {
    $_SESSION['msg'] = "An error occurred: " . $e->getMessage();
    header("Location: sale.php");
    exit(0);
}

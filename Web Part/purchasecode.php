<?php
session_start();
include("dbconnection.php");

if(isset($_POST['addpurchase']))
{
    try {
        $date = $_POST['date'];
        $sid = $_POST['suppliername'];
        $total_amount = $_POST['tamount'];
        $query1 = "INSERT INTO purchases(purchase_date,sid,total_amount) VALUES ('$date','$sid','$total_amount')";
        mysqli_query($conn,$query1);
        $last_id = mysqli_insert_id($conn);

        $count = $_POST['count'];
        for($i=1; $i<=$count; $i++)
        {
            $pid = $_POST['product'.$i];
            $quntity = $_POST['quantity'.$i];
            $purchase_rate = $_POST['rate'.$i];
            $purchase_total = $_POST['amount'.$i];
            $batch = $_POST['batch'.$i];
            $retailrate = $_POST['retailrate'.$i];
            $wholesalerate = $_POST['wholesalerate'.$i];
            $mfg_date = $_POST['mfgdate'.$i];
            $expiry_date = $_POST['expdate'.$i];

            $query2 = "INSERT INTO purchase_details(purchase_id,pid,batch_no,quantity,purchase_rate,purchase_total,retailrate, wholesale_rate,mfg_date,expiry_date,stock) 
                        VALUES ($last_id,$pid,'$batch',$quntity,$purchase_rate,$purchase_total,$retailrate,$wholesalerate,'$mfg_date','$expiry_date',$quntity)";
            $result = mysqli_query($conn,$query2);
            if(!$result) {
                throw new Exception("Failed to insert purchase details");
            }
        }

        $_SESSION['msg'] = "Purchase data inserted successfully";
        header("Location: purchases.php");
        exit(0);
    } catch (Exception $e) {
        $_SESSION['msg'] = "An error occurred: " . $e->getMessage();
        header("Location: purchase.php");
        exit(0);
    }
}

if(isset($_POST['Deletetpurchase']))
{
    try {
        $purchase_id = $_POST['Deletetpurchase'];
        $query = "DELETE FROM purchases WHERE purchase_id=$purchase_id";
        $result = mysqli_query($conn,$query);
        if($result)
        {
            $_SESSION['msg'] = "purchases data deleted successfully";
            header("Location: purchases.php");
            exit(0);
        }
        else
        {
            throw new Exception("Failed to delete purchase data");
        }
    } catch (Exception $e) {
        $_SESSION['msg'] = "An error occurred: " . $e->getMessage();
        header("Location: purchases.php");
        exit(0);
    }
}

if(isset($_POST['editpurchase']))
{
    try {
        $date = $_POST['date'];
        $sid = $_POST['suppliername'];
        $total_amount = $_POST['tamount'];
        $purchase_id = $_POST['purchaseid'];
        $query1 = "UPDATE purchases SET purchase_date='$date',sid=$sid,total_amount=$total_amount WHERE purchase_id=$purchase_id";
        mysqli_query($conn,$query1);

        $count = $_POST['count'];
        for($i=1; $i<=$count; $i++)
        {
            $pd_id = $_POST['pd_id'.$i];
            $pid = $_POST['product'.$i];
           
            $quntity = $_POST['quantity'.$i];
            $purchase_rate = $_POST['rate'.$i];
            $purchase_total = $_POST['amount'.$i];
            $batch = $_POST['batch'.$i];
            $retailrate = $_POST['retailrate'.$i];
            $wholesalerate = $_POST['wholesalerate'.$i];
            $mfg_date = $_POST['mfgdate'.$i];
            $expiry_date = $_POST['expdate'.$i];
    
            $query2 = "UPDATE purchase_details SET pid=$pid, batch_no=$batch ,quantity=$quntity,purchase_rate=$purchase_rate,purchase_total=$purchase_total,
                        retailrate=$retailrate,wholesale_rate=$wholesalerate,mfg_date='$mfg_date',expiry_date='$expiry_date',stock=$quntity WHERE pd_id = $pd_id";
            $result = mysqli_query($conn,$query2);
            if(!$result) {
                throw new Exception("Failed to update purchase details");
            }
        }
    
        $_SESSION['msg'] = "purchase data updated successfully";
        header("Location: purchases.php");
        exit(0);
    } catch (Exception $e) {
        $_SESSION['msg'] = "An error occurred: " . $e->getMessage();
        header("Location: purchase.php");
        exit(0);
    }
}
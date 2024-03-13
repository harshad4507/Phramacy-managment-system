<?php
include("../dbconnection.php");

if(isset($_REQUEST['cid']))
{
    try {
        $cid = $_REQUEST['cid'];

        $sql = "SELECT sale.sale_id, sale.sale_date, sale.subtotal, sale.discount, sale.total, customers.name FROM sale 
        LEFT OUTER JOIN customers ON sale.cid = customers.cid WHERE sale.cid=$cid";
        $result = mysqli_query($conn, $sql);

        $dataArray = array();
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $tArray = array();
                $tArray['name'] = $row['name'];
                $tArray['sale_id'] = $row['sale_id'];
                $tArray['sale_date'] = $row['sale_date'];
                $tArray['subtotal'] = $row['subtotal'];
                $tArray['discount'] = $row['discount'];
                $tArray['total'] = $row['total'];
                array_push($dataArray, $tArray);
            }
        }
        else
        {
            $dataArray = array("result" => "No Order");
        }
        header('Content-Type: application/json');
        echo json_encode(array("Data" => $dataArray));
    } catch (Exception $e) {
        // Handle the exception
        $dataArray = array("result" => "An error occurred: " . $e->getMessage());
        header('Content-Type: application/json');
        echo json_encode(array("Data" => $dataArray));
    }
}
?>

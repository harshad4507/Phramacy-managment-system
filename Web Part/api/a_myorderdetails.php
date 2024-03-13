<?php
include("../dbconnection.php");

if(isset($_REQUEST['sale_id']))
{
    try {
        $sale_id = $_REQUEST['sale_id'];

        $sql = "SELECT product_id, pd_id, sale_details.subquantity, rate, subtotal, discount, total, product.pname FROM sale_details
        LEFT OUTER JOIN product ON sale_details.product_id = product.id WHERE sale_id = $sale_id";
        $result = mysqli_query($conn, $sql);

        $dataArray = array();
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $tArray = array();
                $tArray['product_id'] = $row['product_id'];
                $tArray['pname'] = $row['pname'];
                $tArray['pd_id'] = $row['pd_id'];
                $tArray['subquantity'] = $row['subquantity'];
                $tArray['rate'] = $row['rate'];
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

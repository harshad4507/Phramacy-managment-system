<?php
include("../dbconnection.php");

try {
    $query = "SELECT purchase_details.pd_id, purchase_details.pid, purchase_details.batch_no, purchase_details.mfg_date, purchase_details.expiry_date, purchase_details.retailrate, purchase_details.stock,
    purchase_details.stock, product.pname, product.ptype, product.description FROM purchase_details JOIN product ON purchase_details.pid = product.id 
    WHERE purchase_details.stock > 0 AND purchase_details.expiry_date > CURDATE()";
    $result = mysqli_query($conn, $query);

    $dataarray = array();
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $tarray = array();
            $tarray['product_id'] = $row['pid'];
            $tarray['pd_id'] = $row['pd_id'];
            $tarray['pname'] = $row['pname'];
            $tarray['description'] = $row['description'];
            $tarray['batch_no'] = $row['batch_no'];
            $tarray['mfg_date'] = $row['mfg_date'];
            $tarray['expiry_date'] = $row['expiry_date'];
            $tarray['ptype'] = $row['ptype'];
            $tarray['expiry_date'] = $row['expiry_date'];
            $tarray['retailrate'] = $row['retailrate'];
            $tarray['stock'] = $row['stock'];
            array_push($dataarray, $tarray);
        }
    }
    else{
        $dataarray = array("result" => "No Order");
    }
    header('Content-Type: application/json');
    echo json_encode(array("Data" => $dataarray));
} catch (Exception $e) {
    // Handle the exception
    $dataarray = array("result" => "An error occurred: " . $e->getMessage());
    header('Content-Type: application/json');
    echo json_encode(array("Data" => $dataarray));
}
?>

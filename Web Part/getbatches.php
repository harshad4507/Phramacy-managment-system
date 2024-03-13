<?php
include("dbconnection.php");

$ctype = $_POST["ctype"];
$productid = $_POST["productid"];

try {
    if (!is_numeric($productid)) {
        throw new Exception("Invalid product ID.");
    }

    $sql = "SELECT * FROM product WHERE id = " . $productid;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        $discount = $product['a_discount'];
    }

    $sql1 = "SELECT * FROM purchase_details WHERE stock > 0 AND pid = " . $productid;
    $result1 = mysqli_query($conn, $sql1);

    $option1 = "<option selected disabled value=''>Select Batch</option>";
    if (mysqli_num_rows($result1) > 0) {
        foreach ($result1 as $data1) {
            $option1 .= "<option value='" . $data1["pd_id"] . "' stock='" . $data1["stock"] . "' rate='" . ($ctype == 'Wholesale' ? $data1["wholesale_rate"] : $data1["retailrate"]) . "'>" . $data1["batch_no"] . " - " . $data1['stock'] . "</option>";
        }
    } else {
        $option1 = "<option selected disabled value=''>No Batch Found</option>";
    }

    echo json_encode(array("options" => $option1, "discount" => $discount));
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    echo json_encode(array("error" => $errorMessage));
}
?>

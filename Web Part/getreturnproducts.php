<?php
include("dbconnection.php");

$cid = $_POST['customerid'];

try {
    if (!is_numeric($cid)) {
        throw new Exception("Invalid customer ID.");
    }

    $sql = "SELECT P.id, P.pname, PD.pd_id, SD.sd_id, PD.batch_no, S.sale_date, SD.subquantity, ROUND((SD.total - SD.discount) / SD.subquantity, 2) AS rate,
        (SELECT IFNULL(SUM(quantity), 0) FROM salereturns_details AS SRD WHERE SRD.sd_id = SD.sd_id) AS returnquantity 
        FROM sale AS S, sale_details AS SD, product AS P, purchase_details AS PD 
        WHERE S.sale_id = SD.sale_id AND SD.product_id = P.id AND PD.pd_id = SD.pd_id AND S.cid = $cid ORDER BY P.pname";
    $result = mysqli_query($conn, $sql);

    $option = "<option selected disabled value=''>Select Product</option>";
    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $data) {
            $availableQuantity = $data['subquantity'] - $data['returnquantity'];
            if ($availableQuantity > 0) {
                $option .= "<option value='" . $data["id"] . "' pd_id='" . $data['pd_id'] . "' sd_id='" . $data['sd_id'] . "' rate='" . $data['rate'] . "' subquantity='" . $availableQuantity . "'>" . $data["pname"] . " - " . $data['sale_date'] . " - " . $availableQuantity . "</option>";
            }
        }
    } else {
        $option = "<option selected disabled value=''>No Batch Found</option>";
    }

    echo $option;
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    echo $errorMessage;
}
?>

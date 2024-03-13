<?php
include("dbconnection.php");
$Date = $_POST['Date'];
// $Date = "This Year";

try {
    if($Date == "Today")
    {
        $sql = "SELECT COUNT(*) AS count FROM sale WHERE sale_date = CURDATE()";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            throw new Exception(mysqli_error($conn));
        }
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
        echo $count;
    }
    elseif($Date == "This Month" )
    {
        $sql = "SELECT COUNT(*) AS count FROM sale WHERE MONTH(sale_date) = MONTH(CURDATE()) AND YEAR(sale_date) = YEAR(CURDATE())";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            throw new Exception(mysqli_error($conn));
        }
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
        echo $count;
    }
    elseif($Date == "This Year")
    {
        $sql = "SELECT COUNT(*) AS count FROM sale WHERE YEAR(sale_date) = YEAR(CURDATE())";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            throw new Exception(mysqli_error($conn));
        }
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
        echo $count;
    }
} catch (Exception $e) {
    // Handle the exception gracefully
    echo "An error occurred: " . $e->getMessage();
}
?>

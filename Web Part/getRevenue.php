<?php
    include("dbconnection.php");
    $Date = $_POST['Date'];
    // $Date = "This Year";

    try {
        if($Date == "Today")
        {
            $sql ="SELECT SUM(total) AS amount FROM sale WHERE sale_date = CURDATE()";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                throw new Exception(mysqli_error($conn));
            }
            $row = mysqli_fetch_assoc($result);
            $amount = 0;
            if($row["amount"] > 0)
            {
                $amount = $row["amount"];
            }
            echo $amount;
        }
        elseif($Date == "This Month" )
        {
            $sql = "SELECT SUM(total) As amount FROM sale WHERE MONTH(sale_date) = MONTH(CURDATE()) AND YEAR(sale_date) = YEAR(CURDATE())";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                throw new Exception(mysqli_error($conn));
            }
            $row = mysqli_fetch_assoc($result);
            $amount = 0;
            if($row["amount"] > 0)
            {
                $amount = $row["amount"];
            } 
            echo $amount;
        }
        elseif($Date == "This Year")
        {
            $sql = "SELECT SUM(total) As amount FROM sale WHERE YEAR(sale_date) = YEAR(CURDATE())";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                throw new Exception(mysqli_error($conn));
            }
            $row = mysqli_fetch_assoc($result);
            $amount = 0;
            if($row["amount"] > 0)
            {
                $amount = $row["amount"];
            } 
            echo $amount;
        }
    } catch (Exception $e) {
        // Handle the exception gracefully
        echo "An error occurred: " . $e->getMessage();
    }
?>

<?php
session_start();
include("dbconnection.php");

try {
    if(isset($_POST['Addproduct']))
    {
        $pname = $_POST['pname'];
        if(isset($_POST['ptype']))
        {
            $ptype = $_POST['ptype'];
        }
        $description = $_POST['desc'];
        if(isset($_POST['rb1']))
        {
            $discount = $_POST['rb1'];
        }
        $subquntity = $_POST['subquntity'];
        echo "$pname $ptype $description $discount";
        $query = "INSERT INTO `product`(`pname`, `ptype`, `description`, `subquantity`, `a_discount`) VALUES ('$pname','$ptype','$description','$subquntity','$discount')";

        $result = mysqli_query($conn,$query);

        if($result)
        {
            $_SESSION['msg'] = "Product data inserted successfully";
            header("Location: products.php");
            exit(0);
        }
        else
        {
            throw new Exception("Failed to insert product data");
        }
    }

    if(isset($_POST['updateproduct']))
    {
        $product_id = $_POST['product_id'];
        $pname = $_POST['pname'];
        if(isset($_POST['ptype']))
        {
            $ptype = $_POST['ptype'];
        }
        $description = $_POST['desc'];
        if(isset($_POST['rb1']))
        {
            $discount = $_POST['rb1'];
        }
        $subquntity = $_POST['subquntity'];
        echo "$pname $ptype $description $discount";
        $query = "UPDATE product SET pname='$pname',ptype='$ptype',description='$description',subquantity='$subquntity',a_discount='$discount' WHERE id = $product_id";

        $result = mysqli_query($conn,$query);

        if($result)
        {
            $_SESSION['msg'] = "Product data updated successfully";
            header("Location: products.php");
            exit(0);
        }
        else
        {
            throw new Exception("Failed to update product data");
        }
    }

    if(isset($_POST['Deleteproduct']))
    {
        $product_id = $_POST['Deleteproduct'];
        $query = "DELETE FROM product where id = $product_id";
        $result = mysqli_query($conn,$query);

        if($result)
        {
            $_SESSION['msg'] = "Product data deleted successfully";
            header("Location: products.php");
            exit(0);
        }
        else
        {
            throw new Exception("Failed to delete product data");
        }
    }
} catch (Exception $e) {
    $_SESSION['msg'] = "An error occurred: " . $e->getMessage();
    header("Location: product.php");
    exit(0);
}
?>

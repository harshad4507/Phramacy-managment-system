<?php
include("header.php");
include("dbconnection.php");
?>

<main id="main" class="main">
<div class="pagetitle">
        <h1>Product Return</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item ">Dashboard</li>
                <li class="breadcrumb-item active">Product Returns</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row-lg-6">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sales Details
                            <div class="position-relative">
                                <a href="saleretruntable.php" class="btn btn-info position-absolute top-0 end-0 translate-middle">Back</a>
                            </div>
                        </h5>
                        <hr>
                        <?php
                        $salereturn_id = $_GET['id'];
                        $query = "SELECT salereturns.srdate,salereturns.total_amount,customers.name FROM salereturns JOIN customers ON 
                        salereturns.customer_id = customers.cid  where salereturns.id = $salereturn_id";
                            $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            $sale = mysqli_fetch_array($result);
                        ?>
                            <section class="section">
                                <div class="row-lg-6">
                                    <div class="col-lg-10">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                </h5>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="validationTooltip01" class="form-label">Purchases Date</label>
                                                        <input type="text" class="form-control" value="<?= $sale['srdate'] ?>" disabled>
                                                    </div>

                                                    <div class="col">
                                                        <label for="validationTooltip02" class="form-label">Supplier
                                                            name</label>
                                                        <input type="text" class="form-control" value="<?= $sale['name'] ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section class="section">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table class="table table-hover table-striped" id="purchasesTable">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th class="text-center">Product Name</th>
                                                            <th class="text-center">Quantity</th>
                                                            <th class="text-center">Rate</th>
                                                            <th class="text-center">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <br>
                                                    <tbody>
                                                        <?php
                                                        $query = "SELECT salereturns_details.quantity,salereturns_details.rate,salereturns_details.total_amount,product.pname FROM salereturns_details
                                                         JOIN product ON salereturns_details.product_id = product.id where salereturns_details.srid = $salereturn_id";
                                                        $result = mysqli_query($conn, $query);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            $data = mysqli_fetch_array($result);
                                                            $i = 1;
                                                        ?>
                                                                <tr>
                                                                    <th class="text-center"><?= $i ?></th>
                                                                    <td class="text-center"><?= $data['pname'] ?></td>
                                                                    <td class="text-center"><?= $data['quantity'] ?></td>
                                                                    <td class="text-center"><?= $data['rate'] ?></td>
                                                                    <td class="text-center"><?= $data['total_amount'] ?></td>
                                                                </tr>
                                                        <?php
                                                                $i++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row d-flex justify-content-around">
                                                <div class="col-6"></div>
                                                <div class="col-lg-1">
                                                </div>
                                                Total Amount :
                                                <div class="col-2">
                                                    <input type="text" class="form-control" value="<?= $sale['total_amount']?>" name="subtotal" id="subtotal" readonly>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <hr>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


</main>

<?php include("footer.php"); ?>
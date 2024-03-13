<?php
include("header.php");
include("dbconnection.php");
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Sale</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item ">Dashboard</li>
                <li class="breadcrumb-item active">Sales</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row-lg-6">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sales Details
                            <div class="position-relative">
                                <a href="sales.php" class="btn btn-info position-absolute top-0 end-0 translate-middle">Back</a>
                            </div>
                        </h5>
                        <hr>
                        <?php
                        $sale_id = $_GET['id'];
                        // $query = "SELECT purchases.purchase_date,purchases.total_amount,suppliers.name FROM purchases 
                        //                 LEFT OUTER JOIN suppliers ON purchases.sid = suppliers.sid where purchases.purchase_id =$purchase_id";
                        $query = "SELECT sale.sale_id,sale.sale_date,sale.subtotal,sale.discount,sale.total,customers.name FROM sale 
                                         LEFT OUTER JOIN customers ON sale.cid = customers.cid where sale.sale_id = $sale_id";
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
                                                        <input type="text" class="form-control" value="<?= $sale['sale_date'] ?>" disabled>
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
                                                <table class="table table-hover" id="purchasesTable">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th class="text-center">Product Name</th>
                                                            <th class="text-center">Batch No</th>
                                                            <th class="text-center">Quantity</th>
                                                            <th class="text-center">Rate</th>
                                                            <th class="text-center">Amount</th>
                                                            <th class="text-center">Discount</th>
                                                            <th class="text-center">Payable Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <br>
                                                    <tbody>
                                                        <?php
                                                        $query = "SELECT product_id,pd_id,sale_details.subquantity,rate,subtotal,discount,total,product.pname FROM sale_details
                                                         LEFT OUTER JOIN product ON sale_details.product_id = product.id where sale_id = $sale_id";
                                                        $result = mysqli_query($conn, $query);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            $i = 1;
                                                            foreach ($result as $data) {
                                                                $pd_id = $data['pd_id'];
                                                                $query2 = "SELECT purchase_details.batch_no from purchase_details LEFT OUTER JOIN sale_details ON purchase_details.pd_id = sale_details.pd_id where sale_details.pd_id = $pd_id";
                                                                $result1 = mysqli_query($conn,$query2);
                                                                $sale_details = mysqli_fetch_array($result1)
                                                        ?>
                                                                <tr>
                                                                    <th class="text-center"><?= $i ?></th>
                                                                    <td class="text-center"><?= $data['pname'] ?></td>
                                                                    <td class="text-center"><?= $sale_details['batch_no'] ?></td>
                                                                    <td class="text-center"><?= $data['subquantity'] ?></td>
                                                                    <td class="text-center"><?= $data['rate'] ?></td>
                                                                    <td class="text-center"><?= $data['subtotal'] ?></td>
                                                                    <td class="text-center"><?= $data['discount'] ?></td>
                                                                    <td class="text-center"><?= $data['total'] ?></td>
                                                                </tr>
                                                        <?php
                                                                $i++;
                                                            }
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
                                                    <input type="text" class="form-control" value="<?= $sale['subtotal']?>" name="subtotal" id="subtotal" readonly>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row d-flex justify-content-around">
                                                <div class="col-6"></div>
                                                <div class="col-lg-1"></div>
                                                Discount Amount :
                                                <div class="col-2">
                                                    <input type="text" class="form-control" value="<?= $sale['discount']?>" name="Discountamount" id="Discountamount" readonly>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row d-flex justify-content-around">
                                                <div class="col-6"></div>
                                                <div class="col-lg-1">
                                                </div>
                                                Payable Amount :
                                                <div class="col-2">
                                                    <input type="text" class="form-control" value="<?= $sale['total']?>" name="total" id="total" readonly>
                                                </div>
                                            </div>
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
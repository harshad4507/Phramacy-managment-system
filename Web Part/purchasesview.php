<?php
include("header.php");
include("dbconnection.php");
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Purchases</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item ">Dashboard</li>
                <li class="breadcrumb-item active">Purchases</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row-lg-6">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Purchase Details
                            <div class="position-relative">
                                <a href="purchases.php" class="btn btn-info position-absolute top-0 end-0 translate-middle">Back</a>
                            </div>
                        </h5>
                        <hr>
                        <?php
                        $purchase_id = $_GET['id'];
                        $query = "SELECT purchases.purchase_date,purchases.total_amount,suppliers.name FROM purchases 
                                        LEFT OUTER JOIN suppliers ON purchases.sid = suppliers.sid where purchases.purchase_id =$purchase_id";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            $purchase = mysqli_fetch_array($result);
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
                                                        <input type="text" class="form-control" value="<?= $purchase['purchase_date'] ?>" disabled>
                                                    </div>

                                                    <div class="col">
                                                        <label for="validationTooltip02" class="form-label">Supplier
                                                            name</label>
                                                        <input type="text" class="form-control" value="<?= $purchase['name'] ?>" disabled>
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
                                                            <th class="text-center">Quantity</th>
                                                            <th class="text-center">Rate</th>
                                                            <th class="text-center">Amount</th>
                                                            <th class="text-center">Batch No</th>
                                                            <th class="text-center">Retail Rate</th>
                                                            <th class="text-center">Wholesale Rate</th>
                                                            <th class="text-center">MFG Date</th>
                                                            <th class="text-center">EXP Date</th>
                                                        </tr>
                                                    </thead>
                                                    <br>
                                                    <tbody>
                                                        <?php
                                                        $query = "SELECT batch_no,quantity,purchase_rate,purchase_total,retailrate,wholesale_rate,mfg_date,expiry_date,stock,product.pname FROM purchase_details LEFT OUTER JOIN product ON purchase_details.pid = product.id where purchase_id = $purchase_id";
                                                        $result = mysqli_query($conn, $query);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            $i = 1;
                                                            foreach ($result as $data) {
                                                        ?>
                                                                <tr>
                                                                    <th class="text-center"><?= $i ?></th>
                                                                    <td class="text-center"><?= $data['pname'] ?></td>
                                                                    <td class="text-center"><?= $data['quantity'] ?></td>
                                                                    <td class="text-center"><?= $data['purchase_rate'] ?></td>
                                                                    <td class="text-center"><?= $data['purchase_total'] ?></td>
                                                                    <td class="text-center"><?= $data['batch_no'] ?></td>
                                                                    <td class="text-center"><?= $data['retailrate'] ?></td>
                                                                    <td class="text-center"><?= $data['wholesale_rate'] ?></td>
                                                                    <td class="text-center"><?= $data['mfg_date'] ?></td>
                                                                    <td class="text-center"><?= $data['expiry_date'] ?></td>
                                                                </tr>
                                                        <?php
                                                                $i++;
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row">
                                                <div class="col-6"></div>
                                                <div class="col-lg-2">
                                                </div>
                                                Total Amount :
                                                <div class="col-2">
                                                    <input type="text" class="form-control" value="<?= $purchase['total_amount'] ?>" name="tamount" id="tamount" readonly>
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
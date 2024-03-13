<?php
include('header.php');
include('dbconnection.php');
?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Sales</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item ">Dashboard</li>
        <li class="breadcrumb-item active">Sales</li>
      </ol>
    </nav>
  </div>
  <section class="section">
    <div class="card d-print-block" id="printable-section">
      <div class="card-body">
        <div class="container mb-5 mt-4">
          <div class="row d-flex align-items-baseline">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <a href="" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span style="color: #7e8d9f;font-size: 30px;">Agasti pharmacy</span>
              </a>
            </div>
          </div>
          <hr>

          <div class="container">
            <div style="display: flex; align-items: center; justify-content: space-between;">
              <div>
                <?php
                $sale_id = $_GET['id'];
                $query = "SELECT sale.sale_id,sale.sale_date,sale.subtotal,sale.discount,sale.total,sale.status,customers.name ,customers.address,customers.mobileno FROM sale 
                        LEFT OUTER JOIN customers ON sale.cid = customers.cid where sale.sale_id = $sale_id";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                  $sale = mysqli_fetch_array($result);
                  $status = $sale['status'];
                ?>
                  <ul class="list-unstyled">
                    <li class="text-muted">To: <span style="color:#5d9fc5 ;"><?= $sale['name'] ?></span></li>
                    <?php 
                    if($sale['name'] != "WalkIn")
                    {
                    ?>
                    <li class="text-muted"><?= $sale['address'] ?></li>
                    <li class="text-muted"><i class="fas fa-phone"></i>Mobile No :<?= $sale['mobileno'] ?></li>
                    <?php }?>
                  </ul>
              </div>

              <div style="float:right">
                <p class="text-muted">Invoice : </p>
                <ul class="list-unstyled">
                  <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Creation Date: </span><?= $sale['sale_date'] ?></li>
                  <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="me-1 fw-bold">Status:</span>
                    <?php
                    if ($status == "Closed") {
                    ?>
                      <span class="badge bg-warning text-black fw-bold">paid</span>
                    <?php
                    } else {
                    ?>
                      <span class="badge bg-warning text-black fw-bold">Unpaid</span>
                    <?php
                    }
                    ?>

                  </li>
                </ul>
              </div>

            </div>

            <div class="row my-2 mx-1 justify-content-center">
              <table class="table table-striped table-borderless">
                <thead style="background-color:#84B0CA ;" class="text-white">
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Product </th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Unit Price</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Discount Amount</th>
                    <th class="text-center">Payable Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT product_id,pd_id,sale_details.subquantity,rate,subtotal,discount,total,product.pname FROM sale_details
                            LEFT OUTER JOIN product ON sale_details.product_id = product.id where sale_id = $sale_id";
                  $result = mysqli_query($conn, $query);
                  if (mysqli_num_rows($result) > 0) {
                    $i = 1;
                    foreach ($result as $data) {
                  ?>
                      <tr>
                        <th class="text-center"><?= $i ?></th>
                        <td class="text-center"><?= $data['pname'] ?></td>
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
            <hr>

            <div class="container">
              <div style="position: relative;">
                <ul class="list-unstyled">
                  <li><span>Total Amount :</span>&#8377; <?= $sale['subtotal'] ?></li>
                  <li><span>Discount Amount :</span>&#8377; <?= $sale['discount'] ?></li>
                  <li><span> Payable Amount :</span><span style="font-size: 25px;"></span>&#8377; <?= $sale['total'] ?></li>
                </ul>
              </div>

            </div>
            <hr>
            <div class="row">
              <div class="col-xl-10">
                <p>Thank you for your purchase</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="row">
      <div class="text-right">
        <button type="button" class="btn btn-primary text-capitalize" onclick="printDiv('printable-section')" >Print</button>
        <button type="button" class="btn btn-primary text-capitalize" onclick="Downloadpdf('printable-section')">Download PDF</button>
        <a class="btn btn-primary text-capitalize" href="sales.php">Back</a>
      </div>
    </div>
  </section>
<?php
                }
?>
</main>
<script>
  function printDiv(divName) {

    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
  }

  function Downloadpdf(divName) {

    var element = document.getElementById(divName);
    html2pdf().from(element).save();
  }
</script>
<?php include('footer.php'); ?>
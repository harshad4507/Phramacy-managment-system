<?php
include('header.php');
include('dbconnection.php');

// Get the search query if it exists
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare the query to fetch sales with the search query
$query = "SELECT sale.sale_id, sale.sale_date, sale.subtotal, sale.discount, sale.total, customers.name 
          FROM sale 
          LEFT OUTER JOIN customers ON sale.cid = customers.cid
          WHERE (sale.sale_date LIKE '%$search%' OR customers.name LIKE '%$search%') AND customers.cid <> 5";
$result = mysqli_query($conn, $query);
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Sales</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Sales</li>
      </ol>
    </nav>
  </div>
  <section class="section">
    <?php include('message.php') ?>
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Sales Details
            <div class="position-relative">
              <a href="sale.php" class="btn btn-warning position-absolute top-0 end-0 translate-middle">Add Sales</a>
            </div>
          </h5>
          <form action="" method="GET" class="mb-3">
            <div class="form-row align-items-center">
              <div class="col-lg-4">
                <input type="text" name="search" class="form-control" placeholder="Search by Date or Customer Name" value="<?php echo $search; ?>">
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-primary">Search</button>
              </div>
            </div>
            <br>
          </form>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Sales Date</th>
                <th class="text-center">Customer Name</th>
                <th class="text-center">Total Amount</th>
                <th class="text-center">Discount Amount</th>
                <th class="text-center">Payable Amount</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (mysqli_num_rows($result) > 0) {
                $i = 1;
                foreach ($result as $data) {
              ?>
                  <tr>
                    <th class="text-center"><?= $i ?></th>
                    <td class="text-center"><?= $data['sale_date'] ?></td>
                    <td class="text-center"><?= $data['name'] ?></td>
                    <td class="text-center"><?= $data['subtotal'] ?></td>
                    <td class="text-center"><?= $data['discount'] ?></td>
                    <td class="text-center"><?= $data['total'] ?></td>
                    <td class="text-center">
                      <a href="salebill.php?id=<?= $data['sale_id'] ?>" class="btn btn-secondary btn-sm">Bill</a>
                      <a href="saleview.php?id=<?= $data['sale_id'] ?>" class="btn btn-success btn-sm">View</a>
                      <!-- <form action="purchasecode.php" method="post" class="d-inline">
                        <button type="submit" name="Deletetpurchase" value="<?= $data['purchase_id'] ?>" class="btn btn-danger btn-sm">Delete</button>
                      </form> -->
                    </td>
                  </tr>
              <?php
                  $i++;
                }
              } else {
                // Display a message when no matching sales are found
                echo '<tr><td colspan="7">No matching sales found.</td></tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </section>
</main>
<?php include('footer.php'); ?>


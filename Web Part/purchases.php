<?php
include('header.php');
include('dbconnection.php');

// Get the search query if it exists
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare the query to fetch purchases with the search query
$query = "SELECT purchases.purchase_id, purchases.purchase_date, purchases.total_amount, suppliers.name 
          FROM purchases 
          LEFT OUTER JOIN suppliers ON purchases.sid = suppliers.sid
          WHERE purchases.purchase_date LIKE '%$search%' OR suppliers.name LIKE '%$search%'";
$result = mysqli_query($conn, $query);
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Purchases</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Purchases</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <?php include('message.php') ?>
        <div class="col-lg-11">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Purchase Details
                        <div class="position-relative">
                            <a href="purchase.php" class="btn btn-warning position-absolute top-0 end-0 translate-middle">Add Purchase</a>
                        </div>
                    </h5>
                    <form action="" method="GET" class="mb-3">
                        <div class="form-row align-items-center">
                            <div class="col-lg-4">
                                <input type="text" name="search" class="form-control" placeholder="Search by Date or Supplier Name" value="<?php echo $search; ?>">
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
                                <th class="text-center">Purchase Date</th>
                                <th class="text-center">Supplier Name</th>
                                <th class="text-center">Amount</th>
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
                                        <td class="text-center"><?= $data['purchase_date'] ?></td>
                                        <td class="text-center"><?= $data['name'] ?></td>
                                        <td class="text-center"><?= $data['total_amount'] ?></td>
                                        <td class="text-center">
                                            <a href="purchasesedit.php?id=<?= $data['purchase_id'] ?>" class="btn btn-secondary btn-sm">Edit</a>
                                            <a href="purchasesview.php?id=<?= $data['purchase_id'] ?>" class="btn btn-success btn-sm">View</a>
                                            <!-- <form action="purchasecode.php" method="post" class="d-inline">
                                                <button type="submit" name="Deletetpurchase" value="<//?= $data['purchase_id'] ?>" class="btn btn-danger btn-sm">Delete</button>
                                            </form> -->
                                        </td>
                                    </tr>
                                    <?php
                                $i++;
                                }
                            } else {
                                echo '<tr><td colspan="5" class="text-center">No purchases found.</td></tr>';
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

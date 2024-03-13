<?php
include('header.php');
include('dbconnection.php');

// Get the search query if it exists
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare the query to fetch product returns with the search query
$query = "SELECT salereturns.id, salereturns.srdate, salereturns.total_amount, customers.name 
          FROM salereturns 
          JOIN customers ON salereturns.customer_id = customers.cid
          WHERE (salereturns.srdate LIKE '%$search%' OR customers.name LIKE '%$search%') AND customers.cid <> 5";
$result = mysqli_query($conn, $query);
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Product Return</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Product Returns</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <?php include('message.php') ?>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Product Returned Details
                        <div class="position-relative">
                            <a href="salereturn.php" class="btn btn-warning position-absolute top-0 end-0 translate-middle">Return Product</a>
                        </div>
                        <br>
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
                                <th class="text-center">Return Date</th>
                                <th class="text-center">Customer Name</th>
                                <th class="text-center">Total Amount</th>
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
                                        <td class="text-center"><?= $data['srdate'] ?></td>
                                        <td class="text-center"><?= $data['name'] ?></td>
                                        <td class="text-center"><?= $data['total_amount'] ?></td>
                                        <td class="text-center">
                                            <a href="salereturnview.php?id=<?= $data['id'] ?>" class="btn btn-success btn-sm">View</a>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } else {
                                // Display a message when no matching product returns are found
                                echo '<tr><td colspan="5">No matching product returns found.</td></tr>';
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
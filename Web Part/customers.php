<?php
include("header.php");
include("dbconnection.php");

// Get the search query if it exists
$search = isset($_GET['search']) ? $_GET['search'] : '';

try {
    // Prepare the query to fetch customers with the search query
    $query = "SELECT * FROM customers WHERE (name LIKE '%$search%' OR email LIKE '%$search%') AND cid <> 5 ORDER BY name";
    $result = mysqli_query($conn, $query);

    if ($result === false) {
        throw new Exception("Error executing the database query.");
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
}

?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Customer</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item ">Dashboard</li>
                <li class="breadcrumb-item active">Customer</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-11">
                <?php include('message.php'); ?>
                <div class="card overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Customer Details
                            <div class="position-relative">
                                <a href="customer.php"
                                    class="btn btn-warning position-absolute top-0 end-0 translate-middle">Add
                                    Customer</a>
                            </div>
                        </h5>

                        <?php
                        // Display error message if an exception occurred
                        if (isset($errorMessage)) {
                            echo '<script>alert("' . $errorMessage . '");</script>';
                        }
                        ?>

                        <form action="" method="GET" class="mb-3">
                            <div class="form-row align-items-center">
                                <div class="col-lg-4">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Search by Name or Email">
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
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Contact No</th>
                                    <th class="text-center">Customer Type</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($result) && mysqli_num_rows($result)) {
                                    $i = 1;
                                    foreach ($result as $data) {
                                ?>
                                        <tr>
                                            <th scope="row">
                                                <?php echo $i; ?>
                                            </th>
                                            <td>
                                                <?php echo $data['name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $data['email']; ?>
                                            </td>
                                            <td>
                                                <?php echo $data['mobileno']; ?>
                                            </td>
                                            <td>
                                                <?php echo $data['ctype']; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="customeredit.php?id=<?= $data['cid']; ?>"
                                                    class="btn btn btn-secondary btn-sm">Edit</a>
                                            </td>
                                        </tr>
                                <?php
                                    $i++;
                                }
                                } else {
                                    // Display a message when no matching customers are found
                                    echo '<tr><td colspan="6">No matching customers found.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<?php include("footer.php"); ?>

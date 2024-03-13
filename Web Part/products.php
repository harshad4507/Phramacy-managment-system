<?php
include("header.php");
include("dbconnection.php");

// Get the search query if it exists
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare the query to fetch products with the search query
$query = "SELECT * FROM product WHERE pname LIKE '%$search%' OR ptype LIKE '%$search%' ORDER BY pname ASC";
$result = mysqli_query($conn, $query);
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Product</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item ">Dashboard</li>
        <li class="breadcrumb-item active">Product</li>
      </ol>
    </nav>
  </div>
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <?php include('message.php') ?>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Product Details
              <div class="position-relative">
                <a href="product.php" class="btn btn-warning position-absolute top-0 end-0 translate-middle">Add Product</a>
              </div>
            </h5>
            <form action="" method="GET" class="mb-3">
              <div class="form-row align-items-center">
                <div class="col-lg-4">
                  <input type="text" name="search" class="form-control" placeholder="Search by Product Name or Type">
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
                  <th scope="col">#</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Product Type</th>
                  <th scope="col">Sub Quantity</th>
                  <th scope="col">Description</th>
                  <th scope="col">Apply Discount</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (mysqli_num_rows($result)) {
                  $i = 1;
                  while ($data = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                      <th>
                        <?php echo $i; ?>
                      </th>
                      <td>
                        <?php echo $data["pname"]; ?>
                      </td>
                      <td>
                        <?php echo $data["ptype"]; ?>
                      </td>
                      <td>
                        <?php echo $data["subquantity"]; ?>
                      </td>
                      <td>
                        <?php echo $data["description"]; ?>
                      </td>
                      <td>
                        <?php echo $data["a_discount"]; ?>
                      </td>
                      <td class="text-center">
                        <a href="productedit.php?id=<?= $data["id"]; ?>" class="btn btn-secondary btn-sm">Edit</a>
                      </td>
                    </tr>
                <?php
                    $i++;
                  }
                } else {
                  // Display a message when no matching customers are found
                  echo '<tr><td colspan="6">No matching product found.</td></tr>';
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
               

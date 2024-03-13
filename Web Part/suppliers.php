<?php
include('dbconnection.php');
include("header.php");

// Get the search query if it exists
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare the query to fetch suppliers with the search query
$query = "SELECT * FROM suppliers WHERE name LIKE '%$search%' OR email LIKE '%$search%' ORDER BY name";
$result = mysqli_query($conn, $query);
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Supplier</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item ">Dashboard</li>
        <li class="breadcrumb-item active">Supplier</li>
      </ol>
    </nav>
  </div>
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <?php include('message.php'); ?>
          <div class="card-body">
            <h5 class="card-title">Supplier Details
              <div class="position-relative">
                <a href="supplier.php" class="btn btn-warning position-absolute top-0 end-0 translate-middle">Add
                  Supplier</a>
              </div>
            </h5>
            <form action="" method="GET" class="mb-3">
              <div class="form-row align-items-center">
                <div class="col-lg-4">
                  <input type="text" name="search" class="form-control" placeholder="Search by Name or Email" value="<?php echo $search; ?>">
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
                  <th scope="col">Supplier code</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Mobile No</th>
                  <th scope="col">Address</th>
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
                        <?php echo $data['suppliercode']; ?>
                      </td>
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
                        <?php echo $data['address']; ?>
                      </td>
                      <td class="text-center">
                        <a href="supplieredit.php?sid=<?= $data['sid']; ?>" class="btn btn-secondary btn-sm">Edit</a>
                        <!-- <form action="suppliercode.php" method="post" class="d-inline">
                          <button type="submit" name="Deletesupplier" value="<//?= $data['sid']; ?>" class="btn btn-danger btn-sm">Delete</button>
                        </form> -->
                      </td>
                    </tr>
                    <?php
                    $i++;
                  }
                } else {
                  // Display a message when no matching customers are found
                  echo '<tr><td colspan="6">No matching supplier found.</td></tr>';
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
               

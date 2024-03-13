<?php
include("header.php");
include('dbconnection.php');

if (isset($_GET['sid'])) {
  $sid = $_GET['sid'];
  $query = "SELECT * from suppliers where sid='$sid'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_array($result);

    $sid = $data['sid'];
    $suppliercode = $data['suppliercode'];
    $name = $data['name'];
    $email = $data['email'];
    $number = $data['mobileno'];
    $address = $data['address'];
  }
}
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
    <div class="row-lg-6">
      <div class="col-lg-10">
        <div class="card">
          <?php include('message.php'); ?>
          <div class="card-body">
            <h5 class="card-title">Supplier Information
              <div class="position-relative">
                <a href="suppliers.php" class="btn btn-info position-absolute top-0 end-0 translate-middle">Back</a>
              </div>
            </h5>
            <!-- <p>Enter the supplier details here: </p> -->

            <form class="row g-3 needs-validation" method="POST" action="suppliercode.php" novalidate>
              <input type="hidden" name="sid" value="<?php echo $sid; ?>">
              <div class="col-md-6 position-relative">
                <label for="validationTooltip02" class="form-label">Supplier code</label>
                <input type="numbers" class="form-control" value="<?= $suppliercode ?>" id="validationTooltipSupplierId" name="suppliercode">
                <span id="supcoderror" class="text-danger"></span>
              </div>

              <div class="col-md-6 position-relative">
                <label for="validationTooltipUsername" class="form-label">Supplier Name</label>
                <div class="input-group has-validation">
                  <input type="text" class="form-control" value="<?= $name ?>" id="validationTooltipSupplierName" aria-describedby="validationTooltipUsernamePrepend" name="suppliername">
                </div>
                <span id="supnamerror" class="text-danger"></span>
              </div>

              <div class="col-md-6 position-relative">
                <label for="validationTooltipUsername" class="form-label">E-mail Address</label>
                <div class="input-group has-validation">
                  <input type="text" class="form-control" value="<?= $email ?>" id="validationTooltipEMail" aria-describedby="validationTooltipUsernamePrepend" name="emailaddress">
                  <!-- <span class="input-group-text" id="inputGroupPrepend2">@gmail.com</span> -->
                </div>
                <span id="emailerror" class="text-danger"></span>
              </div>


              <div class="col-md-6 position-relative">
                <label for="validationTooltipUsername" class="form-label">Supplier Contact
                  Number</label>
                <div class="input-group has-validation">
                  <input type="text" class="form-control" value="<?= $number ?>" id="validationTooltipContactNumber" aria-describedby="validationTooltipUsernamePrepend" name="supmob">
                </div>
                <span id="contacterror" class="text-danger"></span>
              </div>

              <div class="col-md-6 position-relative">
                <label for="validationTooltip02" class="form-label">Supplier Address</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name='PAddress' rows="2"><?= $address ?></textarea>
                <span id="supaddresserror" class="text-danger"></span>
              </div>

              <div>
                <button id="button" class="btn btn-primary" width="100" type="submit" onclick="return validate()" name="updatesupplier">Update Supplier Data</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    function validateField(fieldId, errorId, errorMessage, isValid) {
      const field = document.getElementById(fieldId);
      const error = document.getElementById(errorId);

      if (!isValid) {
        error.innerHTML = errorMessage;
        error.classList.add("text-danger");
        field.classList.add("border-danger");
        return false;
      } else {
        error.innerHTML = "";
        error.classList.remove("text-danger");
        field.classList.remove("border-danger");
        return true;
      }
    }

    function validate() {
      let flag = true;

      // Validate Supplier Code
      const supCode = document.getElementById('validationTooltipSupplierId').value;
      const supCodeRegex = /^[A-Za-z0-9]+$/;;
      flag = validateField('validationTooltipSupplierId', 'supcoderror', "Please Enter valid Supplier Code", supCodeRegex.test(supCode)) && flag;

      // Validate Supplier Name
      const supName = document.getElementById('validationTooltipSupplierName').value;
      const supNameRegex = /^[A-Za-z]+(?:\s[A-Za-z]+)*$/;
      flag = validateField('validationTooltipSupplierName', 'supnamerror', "Please Enter valid Supplier Name", !(
        supName === "" || supName === null || !(supNameRegex.test(supName)))) && flag;

      // Validate  Supplier Email
      const supEmail = document.getElementById('validationTooltipEMail').value;
      const supEmailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      flag = validateField('validationTooltipEMail', 'emailerror', "Please Enter Valid email", !(supEmail === "" ||
        supEmail === null || !(supEmailRegex.test(supEmail)))) && flag;

      // Validate Supplier Contact Number
      const supContact = document.getElementById('validationTooltipContactNumber').value;
      const supContactRegex = /^[6-9]\d{9}$/;
      flag = validateField('validationTooltipContactNumber', 'contacterror', "Please Enter valid Contact Number", !(
        supContact === "" || supContact === null || !(supContactRegex.test(supContact)))) && flag;

      // Validate Address
      flag = validateField('exampleFormControlTextarea1', 'supaddresserror', "Please Enter Address", !(document
        .getElementById('exampleFormControlTextarea1').value === "" || document.getElementById(
          'exampleFormControlTextarea1').value === null)) && flag;

      return flag;
    }
  </script>
</main><!-- End #main -->

<?php include("footer.php"); ?>
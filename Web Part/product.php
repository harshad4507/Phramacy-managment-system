<?php
include("header.php");
include("dbconnection.php");
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
    <?php include('message.php') ?>
    <div class="row-lg-6">
      <div class="col-lg-10">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Product Information
              <div class="position-relative">
                <a href="products.php" class="btn btn-info position-absolute top-0 end-0 translate-middle">Back</a>
              </div>
            </h5>
            <form class="row g-3 needs-validation" method="POST" action="productcode.php" name="productForm" novalidate>
              <div class="col-md-6 position-relative">
                <label for="validationTooltip01" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="validationTooltip01" value="" name="pname" required>
                <span id="prnamerror" class="text-danger"></span>
              </div>

              <div class="col-md-6 position-relative">
                <label for="validationTooltip02" class="form-label">Product Type</label>
                <select class="form-select" id="validationTooltip04" name="ptype" required>
                  <option selected disabled value="">Select Product Type</option>
                  <option value="Tablets">Tablets</option>
                  <option value="Capsules">Capsules</option>
                  <option value="Syrups">Syrups</option>
                </select>
                <span id="ptyperror" class="text-danger"></span>
              </div>

              <div class="col-md-6 position-relative">
                <label for="validationTooltipUsername" class="form-label">Sub-quantity</label>
                <div class="input-group has-validation">
                  <input type="number" class="form-control" name="subquntity" min="1" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" required>
                </div>
                <span id="quantityerror" class="text-danger"></span>
              </div>

              <div class="col-md-6 position-relative">
                <label for="validationTooltip03" class="form-label">Discount</label>
                <div>
                  <input type="radio" name="rb1" value="Yes" id="RadioDefault1" required> Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="rb1" value="No" id="RadioDefault2" required> No
                </div>
                <span id="radioerror" class="text-danger"></span>
              </div>

              <div class="col-md-10 position-relative">
                <label for="validationTooltipDescription" class="form-label">Description</label>
                <div class="input-group has-validation">
                  <input type="text" class="form-control" name="desc" id="validationTooltipDescription" aria-describedby="validationTooltipUsernamePrepend" required>
                </div>
                <span id="descrerror" class="text-danger"></span>
              </div>

              <div class="col-12">
                <br>
                <button class="btn btn-primary" type="submit" name="Addproduct" onclick="return validate()">Add Product</button>
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

      // Validate product name
      const productName = document.getElementById('validationTooltip01').value;
      const productNameRegex = /^[a-zA-Z0-9 ]+$/;
      flag = validateField('validationTooltip01', 'prnamerror', "Please Enter valid Product Name", !(productName === "" || productName === null || !(productNameRegex.test(productName)))) && flag;

      // Validate product type
      flag = validateField('validationTooltip04', 'ptyperror', "Please select product type", !(document.getElementById('validationTooltip04').value === "" || document.getElementById('validationTooltip04').value === null)) && flag;

      // Validate quantity
      const quantity = document.getElementById('validationTooltipUsername').value;
      const quantityRegex = /^[0-9]+$/;
      flag = validateField('validationTooltipUsername', 'quantityerror', "Please Enter Sub-quantity", !(quantity === "" || quantity === null || !(quantityRegex.test(quantity)))) && flag;

      // Validate description
      flag = validateField('validationTooltipDescription', 'descrerror', "Please Enter Description", !(document.getElementById('validationTooltipDescription').value === "" || document.getElementById('validationTooltipDescription').value === null)) && flag;

      // Validate radio buttons
      const radios = document.querySelectorAll('input[type="radio"]');
      let isChecked = false;
      radios.forEach(radio => {
        if (radio.checked) {
          isChecked = true;
        }
      });
      flag = validateField('radioerror', 'radioerror', "Please Check Option", isChecked) && flag;

      return flag;
    }
  </script>
</main>

<?php include("footer.php"); ?>
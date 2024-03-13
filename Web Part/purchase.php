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
    <?php include('message.php') ?>
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
            <form class="row g-3 needs-validation" method="POST" action="purchasecode.php" novalidate onsubmit="return validateForm()">
              <section class="section">
                <div class="row-lg-6">
                  <div class="col-lg-10">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">
                        </h5>
                        <div class="row">
                          <div class="col">
                            <label for="validationTooltip01" class="form-label">Date</label>
                            <input type="Date" class="form-control" id="date" value="" name="date" min="<?= date('Y-m-d') ?>" required>
                            <span id="daterror" class="text-danger"></span>
                          </div>

                          <?php
                          $query = "SELECT * FROM suppliers ORDER BY name";
                          $result = mysqli_query($conn, $query);
                          $option = "<option selected disabled value='0'>Select Supplier</option>";
                          if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $data) {
                              $option .= "<option value='" . $data["sid"] . "'>" . $data["name"] . "</option>";
                            }
                          }
                          ?>

                          <div class="col">
                            <label for="validationTooltip02" class="form-label">Supplier
                              name</label>
                            <select class="form-select" id="suppliername" name="suppliername" required>
                              <?= $option ?>
                            </select>
                            <span id="purchasesuppliererror" class="text-danger"></span>
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
                        <table class="table table-striped" id="purchasesTable">
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
                          <tbody id="tablebody">
                          </tbody>
                        </table>
                      </div>

                      <div class="row">
                        <div class="col-6"></div>
                        <div class="col-lg-2">
                        </div>
                        Total Amount :
                        <div class="col-2">
                          <input type="text" class="form-control" value="0.00" name="tamount" id="tamount" readonly>
                        </div>
                      </div>
                      <br>
                      <hr>

                      <div class="row">
                        <div class="col-2">
                          <input type="number" class="form-control" id="numrow" min="1" max="10" value="1" placeholder="Enter number rows" required>
                        </div>
                        <div class="col-4">
                          <input type="hidden" id="count" name="count" value="0">
                          <button class="btn btn-primary" type="button" id="addrow" onclick="insRow()" name="addrow">ADD</button>
                          <button class="btn btn-danger" type="button" id="delrow" onclick="delRow()" name="delrow">Delete</button>
                        </div>
                      </div>
                      <br>

                      <div class="col-12">
                        <br>
                        <button class="btn btn-success" type="submit" name="addpurchase">Submit</button>
                      </div>
                      <br>
                    </div>
                  </div>
                </div>
              </section>

            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php
  $sql = "SELECT * from product ORDER BY pname";
  $result = mysqli_query($conn, $sql);
  $options = "<option selected disabled value='0'>Select Product</option>";
  if (mysqli_num_rows($result) > 0) {
    foreach ($result as $data) {
      $options .= "<option value='" . $data["id"] . "'>" . $data["pname"] . "</option>";
    }
  }
  ?>

  <script>
    let products = "<?= $options ?>";
    // var count = 0;
    function singleRow() {
      let count = parseInt(document.getElementById("count").value) + 1;
      document.getElementById("count").value = count;

      // count +=1;
      var td1 = document.createElement("th");
      td1.setAttribute("class", "text-center");
      td1.innerHTML = count;

      //select filed
      var td2 = document.createElement("td");
      var select = document.createElement("select");
      select.innerHTML = products;
      select.setAttribute("class", "form-select");
      select.addEventListener("change", productselect);
      select.id = "product" + count;
      select.name = "product" + count;
      td2.setAttribute("class", "col-md-2");
      td2.appendChild(select);

      // Quantity field
      var td3 = document.createElement("td");
      var input1 = document.createElement("input");
      input1.setAttribute("type", "text");
      input1.setAttribute("class", "form-control");
      input1.id = "quantity" + count;
      input1.name = "quantity" + count;
      input1.disabled = true;
      input1.addEventListener('input', calculateResult);
      input1.required = true;
      td3.setAttribute("class", "col-md-1");
      td3.appendChild(input1);

      //rate field
      var td4 = document.createElement("td");
      var input2 = document.createElement("input");
      input2.setAttribute("type", "text");
      input2.setAttribute("class", "form-control");
      input2.id = "rate" + count;
      input2.name = "rate" + count;
      input2.disabled = true;
      input2.addEventListener('input', calculateResult);
      input2.required = true;
      td4.setAttribute("class", "col-md-1");
      td4.appendChild(input2);

      // amount field
      var td5 = document.createElement("td");
      var input3 = document.createElement("input");
      input3.setAttribute("type", "text");
      input3.setAttribute("class", "form-control");
      input3.id = "amount" + count;
      input3.name = "amount" + count;
      input3.setAttribute("readonly", "");
      input3.value = "0.00";
      td5.setAttribute("class", "col-md-1");
      td5.appendChild(input3);

      //batch no field
      var td6 = document.createElement("td");
      var input4 = document.createElement("input");
      input4.setAttribute("type", "text");
      input4.setAttribute("class", "form-control");
      input4.required = true;
      input4.id = "batch" + count;
      input4.name = "batch" + count;
      td6.setAttribute("class", "col-md-1");
      td6.appendChild(input4);

      //retail rate field
      var td7 = document.createElement("td");
      var input5 = document.createElement("input");
      input5.setAttribute("type", "text");
      input5.setAttribute("class", "form-control");
      input5.required = true;
      input5.id = "retailrate" + count;
      input5.name = "retailrate" + count;
      td7.setAttribute("class", "col-md-1");
      td7.appendChild(input5);

      //wholesale rate
      var td8 = document.createElement("td");
      var input6 = document.createElement("input");
      input6.setAttribute("type", "text");
      input6.setAttribute("class", "form-control");
      input6.required = true;
      input6.id = "wholesalerate" + count;
      input6.name = "wholesalerate" + count;
      td8.setAttribute("class", "col-md-1");
      td8.appendChild(input6);

      //mfg date field
      var td9 = document.createElement("td");
      var date1 = document.createElement("input");
      date1.setAttribute("type", "Date");
      date1.setAttribute("class", "form-control");
      date1.required = true;
      date1.id = "mfgdate" + count;
      date1.name = "mfgdate" + count;
      td9.setAttribute("class", "col-md-1");
      td9.appendChild(date1);

      //exp date field
      var td10 = document.createElement("td");
      var date2 = document.createElement("input");
      date2.setAttribute("type", "Date");
      date2.setAttribute("class", "form-control");
      date2.required = true;
      date2.id = "expdate" + count;
      date2.name = "expdate" + count;
      td10.setAttribute("class", "col-md-1");
      td10.appendChild(date2);

      var tr = document.createElement("tr");
      tr.appendChild(td1);
      tr.appendChild(td2);
      tr.appendChild(td3);
      tr.appendChild(td4);
      tr.appendChild(td5);
      tr.appendChild(td6);
      tr.appendChild(td7);
      tr.appendChild(td8);
      tr.appendChild(td9);
      tr.appendChild(td10);

      var tablebody = document.getElementById("tablebody");
      tablebody.appendChild(tr);
    }


    function insRow() {
      var no = document.getElementById("numrow").value;
      for (let i = 0; i < no; i++) {
        singleRow();
      }
    }

    function delRow() {
      let count = parseInt(document.getElementById("count").value);
      // console.log(count);
      var x = document.getElementById("purchasesTable");
      if (count > 1) {
        x.deleteRow(count);
        document.getElementById("count").value = count - 1;
      }
    }

    function productselect() {
      let count = parseInt(document.getElementById("count").value);
      for (let i = 1; i <= count; i++) {
        const product = document.getElementById('product' + i);
        const quantityInput = document.getElementById('quantity' + i);
        const rateInput = document.getElementById('rate' + i);

        if (product.selectedIndex > 0) {
          quantityInput.disabled = false;
          rateInput.disabled = false;
        } else {
          quantityInput.disabled = true;
          rateInput.disabled = true;
        }
      }
    }

    function calculateResult() {
      let count = parseInt(document.getElementById("count").value);
      totalamount = 0;
      for (let i = 1; i <= count; i++) {
        const quantityInput = document.getElementById('quantity' + i);
        const rateInput = document.getElementById('rate' + i);
        const amount = document.getElementById('amount' + i);
        if (quantityInput.value !== '' && rateInput.value !== '') {
          const result = parseFloat(quantityInput.value) * parseFloat(rateInput.value);
          amount.value = result;
          totalamount += result;
          document.getElementById("tamount").value = totalamount;
        } else {
          amount.value = '0.00';
        }
      }
    }



    for (let i = 0; i < 5; i++) {
      singleRow();
    }

    function validateForm() {
      // Validate date field
      var dateInput = document.getElementById("date");
      if (dateInput.value === "") {
        alert("Please enter a valid date");
        dateInput.focus();
        return false;
      }

      // Validate supplier name field
      var supplierNameInput = document.getElementById("suppliername");
      if (supplierNameInput.value === "0") {
        alert("Please select a supplier");
        supplierNameInput.focus();
        return false;
      }

      // Validate product and quantity fields
      var count = parseInt(document.getElementById("count").value);
      for (var i = 1; i <= count; i++) {
        var productInput = document.getElementById("product" + i);
        var quantityInput = document.getElementById("quantity" + i);
        var rateInput = document.getElementById("rate" + i);
        var batchNoInput = document.getElementById("batch" + i);
        var retailRateInput = document.getElementById("retailrate" + i);
        var wholesaleRateInput = document.getElementById("wholesalerate" + i);
        var mfgDateInput = document.getElementById("mfgdate" + i);
        var expDateInput = document.getElementById("expdate" + i);

        if (productInput.value === "0") {
          alert("Please select a product for Product " + i);
          productInput.focus();
          return false;
        }

        if (quantityInput.value === "" || quantityInput.value <= 0 || isNaN(quantityInput.value)) {
          alert("Please enter a valid quantity for Product " + i);
          quantityInput.focus();
          return false;
        }

        if (rateInput.value === "" || rateInput.value <= 0 || isNaN(rateInput.value)) {
          alert("Please enter a valid rate for Product " + i);
          rateInput.focus();
          return false;
        }

        if (batchNoInput.value === "") {
          alert("Please enter a batch number for Product " + i);
          batchNoInput.focus();
          return false;
        }

        if (retailRateInput.value === "" || retailRateInput.value <= 0 || isNaN(retailRateInput.value)) {
          alert("Please enter a valid retail rate for Product " + i);
          retailRateInput.focus();
          return false;
        }

        if (wholesaleRateInput.value === "" || wholesaleRateInput.value <= 0 || isNaN(wholesaleRateInput.value)) {
          alert("Please enter a valid wholesale rate for Product " + i);
          wholesaleRateInput.focus();
          return false;
        }

        if (mfgDateInput.value === "") {
          alert("Please enter a manufacturing date for Product " + i);
          mfgDateInput.focus();
          return false;
        }

        if (expDateInput.value === "") {
          alert("Please enter an expiration date for Product " + i);
          expDateInput.focus();
          return false;
        }
      }

      return true;
    }
  </script>
</main>

<?php include("footer.php"); ?>
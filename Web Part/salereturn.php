<?php
include("header.php");
include("dbconnection.php");
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Product Return</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item ">Dashboard</li>
        <li class="breadcrumb-item active">Product Returns</li>
      </ol>
    </nav>
  </div>
  <section class="section">
    <?php include('message.php') ?>
    <div class="row-lg-6">
      <div class="col-lg-10">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Product Return Details
              <div class="position-relative">
                <a href="saleretruntable.php" class="btn btn-info position-absolute top-0 end-0 translate-middle">Back</a>
              </div>
            </h5>
            <hr>
            <form class="row g-3 needs-validation" method="POST" action="salereturncode.php" novalidate onsubmit="return validateForm()">
              <section class="section">
                <div class="row-lg-6">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">
                        </h5>
                        <div class="row">
                          <div class="col">
                            <label for="validationTooltip01" class="form-label">Date</label>
                            <input type="Date" class="form-control" id="date" name="date" required>
                            <span id="saledate" class="text-danger"></span>
                          </div>

                          <?php
                          $query = "SELECT * FROM customers ORDER BY CASE WHEN name='WalkIn' THEN 0 ELSE 1 END, name";
                          $result = mysqli_query($conn, $query);
                          $option = "<option selected ctype='Retail' disabled value='0'>Select Customer</option>";
                          if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $data) {
                              $option .= "<option ctype='" . $data["ctype"] . "' value='" . $data["cid"] . "'>" . $data["name"] . "</option>";
                            }
                          }
                          ?>

                          <div class="col">
                            <label for="validationTooltip02" class="form-label">Customer
                              name</label>
                            <select class="form-select" id="customername" name="customername" onchange="customerchanged(this)" required>
                              <?= $option ?>
                            </select>
                            <span id="salecustomer" class="text-danger"></span>
                            <span id="spnCustomerType" class="text-success"></span>
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
                              <th class="text-center">Avalable Quantity</th>
                              <th class="text-center">Rate</th>
                              <th class="text-center">Amount</th>
                            </tr>
                          </thead>
                          <br>
                          <tbody id="tablebody">
                          </tbody>
                        </table>
                      </div>

                      <div class="row d-flex justify-content-around">
                        <div class="col-6"></div>
                        <div class="col-lg-1">
                        </div>
                        Total Amount :
                        <div class="col-2">
                          <input type="text" class="form-control" value="0.00" name="total_amount" id="total_amount" readonly>
                        </div>
                      </div>
                      <br>

                      <div class="row">
                        &nbsp;&nbsp;&nbsp;
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
                        <button class="btn btn-success" type="submit" name="retrunProduct">Save</button>
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

  <script>
    // var count = 0;
    function singleRow() {
      let count = parseInt(document.getElementById("count").value) + 1;
      document.getElementById("count").value = count;

      var td1 = document.createElement("th");
      td1.setAttribute("class", "text-center");
      td1.innerHTML = count;

      //product select filed
      var td2 = document.createElement("td");
      var select1 = document.createElement("select");
      select1.setAttribute("class", "form-select");
      select1.id = "product" + count;
      select1.name = "product" + count;
      select1.innerHTML = "<option selected disabled>Select Product</option>";
      td2.setAttribute("class", "col-md-4");
      select1.setAttribute("onchange", "productselect(" + count + ")");
      td2.appendChild(select1);


      // Quantity field
      var td3 = document.createElement("td");
      var input1 = document.createElement("input");
      input1.setAttribute("type", "text");
      input1.setAttribute("class", "form-control");
      input1.addEventListener('input', calculateResult);
      input1.disabled = true;
      input1.id = "quantity" + count;
      input1.name = "quantity" + count;
      input1.required = true;
      td3.appendChild(input1);

      // Avalable Quntity 
      var td8 = document.createElement("td");
      var inout6 = document.createElement("input");
      inout6.setAttribute("type", "text");
      inout6.setAttribute("class", "form-control");
      inout6.addEventListener('input', calculateResult);
      inout6.disabled = true;
      inout6.id = "subquantity" + count;
      inout6.name = "subquantity" + count;
      inout6.required = true;
      td8.appendChild(inout6);

      //rate field
      var td4 = document.createElement("td");
      var input2 = document.createElement("input");
      input2.setAttribute("type", "text");
      input2.setAttribute("class", "form-control");
      input2.readOnly = true;
      input2.id = "rate" + count;
      input2.name = "rate" + count;
      td4.appendChild(input2);

      // amount field
      var td5 = document.createElement("td");
      var input3 = document.createElement("input");
      input3.setAttribute("type", "text");
      input3.setAttribute("class", "form-control");
      input3.id = "total" + count;
      input3.name = "total" + count;
      input3.setAttribute("readonly", "");
      input3.value = "0.00";
      td5.appendChild(input3);

      // sd_id field
      var td6 = document.createElement("td");
      var input4 = document.createElement("input");
      input4.setAttribute("type", "hidden");
      input4.id = "sd_id" + count;
      input4.name = "sd_id" + count;
      td6.appendChild(input4);

      // pd_id filed
      var td7 = document.createElement("td");
      var input5 = document.createElement("input");
      input5.setAttribute("type", "hidden");
      input5.id = "pd_id" + count;
      input5.name = "pd_id" + count;
      td7.appendChild(input5);

      var tr = document.createElement("tr");
      tr.appendChild(td1);
      tr.appendChild(td2);
      tr.appendChild(td3);
      tr.appendChild(td8);
      tr.appendChild(td4);
      tr.appendChild(td5);
      tr.appendChild(td6);
      tr.appendChild(td7);

      var tablebody = document.getElementById("tablebody");
      tablebody.appendChild(tr);
    }

    function productselect(i) {
      let count = parseInt(document.getElementById("count").value);
      const product = document.getElementById('product' + i);
      const quantity = document.getElementById('quantity' + i);
      const rate = document.getElementById('rate' + i);
      const pd_id = document.getElementById('pd_id' + i);
      const sd_id = document.getElementById('sd_id' + i);
      if (product != undefined) {
        if (product.selectedIndex > 0) {
          quantity.disabled = false;
          const selectedtype = product.options[product.selectedIndex];
          const r = selectedtype.getAttribute("rate");
          const pd = selectedtype.getAttribute("pd_id");
          const sd = selectedtype.getAttribute("sd_id");
          const defaultQuantity = selectedtype.getAttribute("subquantity");
          document.getElementById('subquantity' + i).value = defaultQuantity;
          document.getElementById('rate' + i).value = r;
          pd_id.value = pd;
          sd_id.value = sd;
        } else {
          quantity.disabled = true;
        }
      }
    }

    function calculateResult() {
      let count = parseInt(document.getElementById("count").value);
      totalamount = 0;
      for (let i = 1; i <= count; i++) {
        const rate = document.getElementById('rate' + i).value;
        const quantity = document.getElementById('quantity' + i).value;
        const total = document.getElementById('total' + i);
        result = rate * quantity;
        total.value = result;
        totalamount = result;
      }
      document.getElementById('total_amount').value = totalamount;
    }

    function insRow() {
      var no = document.getElementById("numrow").value;
      for (let i = 0; i < no; i++) {
        singleRow();
      }
    }

    function delRow() {
      let count = parseInt(document.getElementById("count").value);
      var x = document.getElementById("purchasesTable");
      if (count > 1) {
        x.deleteRow(count);
        document.getElementById("count").value = count - 1;
      }
    }

    function customerchanged(ctrl) {
      let count = parseInt(document.getElementById("count").value);
      const selectedtype = ctrl.options[ctrl.selectedIndex];
      const ctype = selectedtype.getAttribute("ctype");
      const cid = selectedtype.getAttribute("value");
      document.getElementById("spnCustomerType").innerText = ctype;
      $.post("getreturnproducts.php", {
          customerid: cid,
        },
        function(data, status) {
          for (let i = 1; i <= count; i++) {
            document.getElementById('product' + i).innerHTML = data;
          }
        });
    }

    singleRow();

    function validateForm() {
  // Validate date field
  var dateInput = document.getElementById("date");
  if (dateInput.value === "") {
    alert("Please enter a valid date");
    dateInput.focus();
    return false;
  }

  // Validate customer name field
  var customerNameInput = document.getElementById("customername");
  if (customerNameInput.value === "0") {
    alert("Please select a customer");
    customerNameInput.focus();
    return false;
  }

  // Validate product and quantity fields
  var count = parseInt(document.getElementById("count").value);
  for (var i = 1; i <= count; i++) {
    var productInput = document.getElementById("product" + i);
    var quantityInput = document.getElementById("quantity" + i);
    var availableQuantityInput = document.getElementById("subquantity" + i);
    var maxQuantity = parseInt(availableQuantityInput.value);

    if (productInput.value === '') {
      alert("Please select a product for row " + i);
      productInput.focus();
      return false;
    }

    if (quantityInput.value === "" || quantityInput.value <= 0 || quantityInput.value > maxQuantity || isNaN(quantityInput.value)) {
      alert("Please enter a valid quantity for row " + i + " (between 1 and " + maxQuantity + ")");
      quantityInput.focus();
      return false;
    }
  }

  return true;
}

  </script>
</main>
<?php
include("footer.php");
?>
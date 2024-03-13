<?php
include("header.php");
include("dbconnection.php");

$orderid = 0;
$customerid = 0;

if (isset($_GET["orderid"])) {
  $orderid = $_GET["orderid"];
  $query = "SELECT * FROM online_orders WHERE id = " . $orderid;
  $orders = mysqli_query($conn, $query);
  foreach ($orders as $data) {
    $order = $data;
    $customerid = $order["customer_id"];
  }
  $query = "SELECT * FROM online_orderdetails WHERE oo_id = " . $orderid;
  $order_details = mysqli_query($conn, $query);
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Sales</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item ">Dashboard</li>
        <li class="breadcrumb-item active">Sales</li>
      </ol>
    </nav>
  </div>
  <section class="section">
    <?php include('message.php') ?>
    <div class="row-lg-6">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Sales Details
              <div class="position-relative">
                <a href="sales.php" class="btn btn-info position-absolute top-0 end-0 translate-middle">Back</a>
              </div>
            </h5>
            <hr>
            <form class="row g-3 needs-validation" method="POST" action="salecode.php" novalidate onsubmit="return validateForm()">
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
                          </div>

                          <?php
                          $query = "SELECT * FROM customers ORDER BY CASE WHEN name = 'WalkIn' THEN 0 ELSE 1 END, name";
                          $result = mysqli_query($conn, $query);
                          $option = "<option selected ctype='Retail' disabled value='0'>Select Customer</option>";
                          if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $data) {
                              $option .= "<option ctype='" . $data["ctype"] . "' value='" . $data["cid"] . "' " . ($customerid == $data["cid"] ? "selected" : "") . ">" . $data["name"] . "</option>";
                            }
                          }
                          ?>

                          <div class="col">
                            <label for="validationTooltip02" class="form-label">Customer
                              name</label>
                            <select class="form-select" id="customername" name="customername" onchange="customerchanged(this)" required>
                              <?= $option ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" class="form-control" id="order_id" value="<?= $orderid ?>" name="order_id">
                  <span id="Producterror" class="text-danger"></span>
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
                              <th class="text-center">Batch</th>
                              <th class="text-center">Quantity</th>
                              <th class="text-center">Rate</th>
                              <th class="text-center">Amount</th>
                              <th class="text-center">Status</th>
                              <th class="text-center">Discount</th>
                              <th class="text-center">Payable Amount</th>
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
                          <input type="text" class="form-control" value="0.00" name="subtotal" id="subtotal" readonly>
                        </div>
                      </div>
                      <br>

                      <div class="row d-flex justify-content-around">
                        <div class="col-2"></div>
                        <div class="col-lg-1"></div>
                        Discount (%) :
                        <div class="col-2">
                          <input type="text" class="form-control" value="" oninput="discountCalculate()" name="Discountper" id="Discountper">
                        </div>
                        Discount Amount :
                        <div class="col-2">
                          <input type="text" class="form-control" value="0.00" name="Discountamount" id="Discountamount" readonly>
                        </div>
                      </div>
                      <br>

                      <div class="row d-flex justify-content-around">
                        <div class="col-6"></div>
                        <div class="col-lg-1">
                        </div>
                        Payable Amount :
                        <div class="col-2">
                          <input type="text" class="form-control" value="0.00" name="total" id="total" readonly>
                        </div>
                      </div>
                      <br>
                      <hr>
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
                        <button class="btn btn-success" type="submit" name="addsale">Submit</button>
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
  $options = "<option selected disabled value=''>Select Product</option>";
  if (mysqli_num_rows($result) > 0) {
    foreach ($result as $data) {
      $options .= "<option value='" . $data["id"] . "'>" . $data["pname"] . "</option>";
    }
  }
  $option1 = "<option selected disabled value=''>Select batch</option>";
  ?>

  <script>
    let products = "<?= $options ?>";
    let batch = "<?= $option1 ?>";

    function singleRow(productid, quantity) {
      let count = parseInt(document.getElementById("count").value) + 1;
      document.getElementById("count").value = count;

      // count +=1;
      var td1 = document.createElement("th");
      td1.setAttribute("class", "text-center");
      td1.innerHTML = count;

      //product select filed
      var td2 = document.createElement("td");
      var select1 = document.createElement("select");
      select1.innerHTML = products;
      select1.setAttribute("class", "form-select");
      select1.id = "product" + count;
      select1.name = "product" + count;
      td2.setAttribute("class", "col-md-2");
      select1.setAttribute("onchange", "productselect(" + count + ")");
      select1.value = productid;
      td2.appendChild(select1);

      //batch select filed
      var td3 = document.createElement("td");
      var select2 = document.createElement("select");
      select2.innerHTML = batch;
      select2.setAttribute("class", "form-select");
      select2.id = "batch" + count;
      select2.name = "batch" + count;
      select2.setAttribute("onchange", "batchSelect(" + count + ")");
      td3.setAttribute("class", "col-md-2");
      td3.appendChild(select2);

      // Quantity field
      var td4 = document.createElement("td");
      var input1 = document.createElement("input");
      input1.setAttribute("type", "text");
      input1.setAttribute("class", "form-control");
      input1.addEventListener('input', calculateResult);
      input1.id = "quantity" + count;
      input1.name = "quantity" + count;
      input1.required = true;
      input1.value = quantity;
      td4.appendChild(input1);

      //rate field
      var td5 = document.createElement("td");
      var input2 = document.createElement("input");
      input2.setAttribute("type", "text");
      input2.setAttribute("class", "form-control");
      input2.addEventListener('input', calculateResult);
      input2.disabled = true;
      input2.readOnly = true;
      input2.id = "rate" + count;
      input2.name = "rate" + count;
      input2.required = true;
      td5.appendChild(input2);

      // amount field
      var td6 = document.createElement("td");
      var input3 = document.createElement("input");
      input3.setAttribute("type", "text");
      input3.setAttribute("class", "form-control");
      input3.id = "sdsubtotal" + count;
      input3.name = "sdsubtotal" + count;
      input3.setAttribute("readonly", "");
      input3.value = "0.00";
      td6.appendChild(input3);

      //status filed
      var td7 = document.createElement("td");
      var input4 = document.createElement("input");
      input4.setAttribute("type", "text");
      input4.setAttribute("class", "form-control");
      input4.id = "status" + count;
      input4.name = "status" + count;
      input4.setAttribute("readonly", "");
      td7.appendChild(input4);

      var td8 = document.createElement("td");
      var input4 = document.createElement("input");
      input4.setAttribute("type", "text");
      input4.setAttribute("class", "form-control");
      input4.id = "sddiscount" + count;
      input4.name = "sddiscount" + count;
      input4.setAttribute("readonly", "");
      input4.value = "0.00";
      td8.appendChild(input4);

      var td9 = document.createElement("td");
      var input5 = document.createElement("input");
      input5.setAttribute("type", "text");
      input5.setAttribute("class", "form-control");
      input5.id = "sdtotal" + count;
      input5.name = "sdtotal" + count;
      input5.setAttribute("readonly", "");
      input5.value = "0.00";
      td9.appendChild(input5);

      var td10 = document.createElement("td");
      var input6 = document.createElement("input");
      input6.setAttribute("type", "hidden");
      input6.setAttribute("class", "form-control");
      input6.id = "availableQ" + count;
      input6.name = "availableQ" + count;
      input6.setAttribute("readonly", "");
      td10.appendChild(input6);

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

      if (productid != "") {
        productselect(count);
      }
    }

    function productselect(i) {
      let count = parseInt(document.getElementById("count").value);
      let ctype = document.getElementById("customername").innerText;
      const product = document.getElementById('product' + i);
      const batchno = document.getElementById('batch' + i);
      const statusfiled = document.getElementById('status' + i);
      if (product != undefined) {
        if (product.selectedIndex > 0) {
          pid = product.value;

          $.post("getbatches.php", {
              productid: pid,
              ctype: ctype
            },
            function(data, status) {
              var obj = JSON.parse(data);
              batchno.innerHTML = obj.options;
              statusfiled.value = obj.discount;
            });
        } else {
          batchno.disabled = true;
        }
      }
    }

    function batchSelect(i) {
      let count = parseInt(document.getElementById("count").value);
      const batchno = document.getElementById('batch' + i);
      const quantityInput = document.getElementById('quantity' + i);
      const rateInput = document.getElementById('rate' + i);
      const availableQ = document.getElementById('availableQ'+i);
      if (batchno != undefined) {
        if (batchno.selectedIndex > 0) {
          quantityInput.disabled = false;
          rateInput.disabled = false;
          const selectedb = batchno.options[batchno.selectedIndex];
          const rate = selectedb.getAttribute("rate");
          const available = selectedb.getAttribute("stock");
          rateInput.value = rate;
          availableQ.value = available;
        } else {
          quantityInput.disabled = true;
          rateInput.disabled = true;
        }
      }
      calculateResult();
      discountCalculate();
    }

    function calculateResult() {
      let count = parseInt(document.getElementById("count").value);
      totalamount = 0;
      for (let i = 1; i <= count; i++) {
        const quantityInput = document.getElementById('quantity' + i);
        const rateInput = document.getElementById('rate' + i);
        const amount = document.getElementById('sdsubtotal' + i);
        if (quantityInput.value !== '' && rateInput.value !== '') {
          const result = parseFloat(quantityInput.value) * parseFloat(rateInput.value);
          amount.value = result;
          totalamount += result;
          document.getElementById("subtotal").value = totalamount;
        } else {
          amount.value = '0.00';
        }
        document.getElementById('sdtotal' + i).value = document.getElementById("sdsubtotal" + i).value;
      }
      document.getElementById('total').value = parseFloat(document.getElementById('subtotal').value) - parseFloat(document.getElementById('Discountamount').value);
    }

    function discountCalculate() {
      let count = parseInt(document.getElementById("count").value);
      const dicountperecentage = document.getElementById('Discountper');
      var totaldiscount = 0;

      dicountper = dicountperecentage.value;
      if (dicountperecentage.value == '') {
        dicountper = 0;
      }

      for (let i = 1; i <= count; i++) {
        const amount = document.getElementById('sdsubtotal' + i);
        const statusfield = document.getElementById('status' + i);
        const damount = document.getElementById('sddiscount' + i);
        const subtotal = document.getElementById('sdtotal' + i);

        if (statusfield.value == "Yes") {
          var total = 0;
          var result = (parseFloat(amount.value) * parseFloat(dicountper)) / 100;
          damount.value = result;
          totaldiscount += result;
          document.getElementById('Discountamount').value = totaldiscount;

          var subtotalamount = 0;
          var result2 = (parseFloat(amount.value) - (parseFloat(damount.value)));
          subtotal.value = result2;
        } else {
          subtotal.value = document.getElementById('sdsubtotal' + i).value;
        }
      }
      document.getElementById('total').value = parseFloat(document.getElementById('subtotal').value) - parseFloat(document.getElementById('Discountamount').value);
    }

    function insRow() {
      var no = document.getElementById("numrow").value;
      for (let i = 0; i < no; i++) {
        singleRow("", "");
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

    function customerchanged(ctrl) {

      let count = parseInt(document.getElementById("count").value);
      const selectedtype = ctrl.options[ctrl.selectedIndex];
      const ctype = selectedtype.getAttribute("ctype");
      document.getElementById("spnCustomerType").innerText = ctype;
    }
 
    <?php
    if (isset($_GET["orderid"])) {
      foreach ($order_details as $data) {
        echo "singleRow(" . $data["product_id"] .  ", " . $data["quantity"] . ");";
      }
    } else {
      echo "singleRow('', '');";
    }
    ?>

function  validateForm()
{
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
  var count = parseInt(document.getElementById("count").value);
  for (var i = 1; i <= count; i++) {
    var productInput = document.getElementById("product" + i);
    var batchInput = document.getElementById("batch" + i);
    var quantityInput = document.getElementById("quantity" + i);
    var availableQuantityInput = document.getElementById("availableQ" + i);
    var maxQuantity = parseInt(availableQuantityInput.value);

    if (productInput.value === '') {
      alert("Please select a product for row " + i);
      productInput.focus();
      return false;
    }

    if (batchInput.value === '') {
      alert("Please select a batch for row " + i);
      batchInput.focus();
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

<?php include("footer.php"); ?>
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
            <form class="row g-3 needs-validation" method="POST" action="purchasecode.php" novalidate>
              <section class="section">
                <div class="row-lg-6">
                  <div class="col-lg-10">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">
                        </h5>
                        <?php
                        $purchase_id = $_GET['id'];
                        $query = "SELECT purchases.sid,purchases.purchase_date,purchases.total_amount,suppliers.name FROM purchases 
                                LEFT OUTER JOIN suppliers ON purchases.sid = suppliers.sid where purchases.purchase_id =$purchase_id";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                          $purchase = mysqli_fetch_array($result);
                        }
                        ?>
                        <div class="row">
                          <div class="col">
                            <label for="validationTooltip01" class="form-label">Date</label>
                            <input type="hidden" name="purchaseid" value="<?= $purchase_id ?>">
                            <input type="Date" class="form-control" name="date" id="validationTooltip01" value="<?= $purchase['purchase_date'] ?>" required>
                            <div class="valid-tooltip">
                              valid!
                            </div>
                          </div>

                          <?php
                          $query = "SELECT * FROM suppliers";
                          $result = mysqli_query($conn, $query);
                          $option = "<option selected disabled value='0'>Select Supplier</option>";
                          if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $data) {
                              $option .= "<option value='" . $data["sid"] . "'" . (($purchase["sid"] == $data["sid"]) ? "selected" : "") . ">" . $data["name"] . "</option>";
                            }
                          }
                          ?>

                          <div class="col">
                            <label for="validationTooltip02" class="form-label">Supplier
                              name</label>
                            <select class="form-select" id="suppliername" name="suppliername" required>
                              <?= $option ?>
                            </select>
                            <div class="valid-tooltip">
                              valid!
                            </div>
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
                          <input type="text" class="form-control" value="<?= $purchase['total_amount'] ?>" name="tamount" id="tamount" readonly>
                        </div>
                      </div>
                      <br>
                      <hr>
                      <div class="row">
                        <div class="col-4">
                          <input type="hidden" id="count" name="count" value="0">
                        </div>
                      </div>

                      <br>
                      <div class="col-12">
                        <br>
                        <button class="btn btn-success" onclick="submit()" type="submit" name="editpurchase">Submit</button>
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
  $sql = "SELECT * from product";
  $result = mysqli_query($conn, $sql);
  $options = "<option selected disabled value='0'>Select Product</option>";
  if (mysqli_num_rows($result) > 0) {
    foreach ($result as $data) {
      $options .= "<option value='" . $data["id"] . "'>" . $data["pname"] . "</option>";
    }
  }
  ?>
  <script>
    // var count = 0;
    function Calculateamount() {
      let count = parseInt(document.getElementById("count").value);
      var totalamount = 0;
      for (var i = 1; i <= count; i++) {
        var index = document.getElementById("product" + i).selectedIndex;
        if (index > 0) {
          var quantity = parseFloat(document.getElementById('quantity' + i).value);
          var rate = parseFloat(document.getElementById('rate' + i).value);

          if (isNaN(quantity) || isNaN(rate)) {
            document.getElementById("amount" + i).value = "0.00";
          } else {
            var result = (quantity * rate);
            document.getElementById("amount" + i).value = String(result);
            totalamount += result;
            document.getElementById("tamount").value = String(totalamount);
          }
        }
      }
    }

    let products = "<?= $options ?>";

    function singleRow(json_data) {

      // console.log(json_data);

      var pd_id = json_data['pd_id'];
      var pid = json_data['pid'];
      var quantity = json_data['quantity'];
      var rate = json_data['rate'];
      var amount = json_data['amount'];
      var batch = json_data['batch'];
      var retailrate = json_data['retailrate'];
      var wholesale_rate = json_data['wholesale_rate'];
      var mfg_date = json_data['mfg_date'];
      var expiry_date = json_data['expiry_date'];
      var stock = json_data['stock'];

      // console.log(pd_id);
      // console.log(pid);
      // console.log(quantity);
      // console.log(rate);
      // console.log(amount);
      // console.log(batch);
      // console.log(retailrate);
      // console.log(wholesale_rate);
      // console.log(mfg_date);
      // console.log(expiry_date);
      // console.log(stock);
      // console.log(productName);

      let count = parseInt(document.getElementById("count").value) + 1;
      document.getElementById("count").value = count;

      //hidden 
      var hidden = document.createElement("input");
      hidden.setAttribute("type", "hidden");
      hidden.id = "pd_id" + count;
      hidden.name = "pd_id" + count;
      hidden.value = pd_id;

      // count +=1;
      var td1 = document.createElement("th");
      td1.setAttribute("class","text-center");
      td1.innerHTML = count;

      //select filed
      var td2 = document.createElement("td");
      var select = document.createElement("select");
      select.innerHTML = products;
      select.setAttribute("class", "form-select");
      select.addEventListener("change", Calculateamount);
      select.id = "product" + count;
      select.name = "product" + count;
      select.selectedIndex = pid;
      td2.setAttribute("class", "col-md-2");
      td2.appendChild(select);

      // Quantity field
      var td3 = document.createElement("td");
      var input1 = document.createElement("input");
      input1.setAttribute("type", "text");
      input1.setAttribute("class", "form-control");
      input1.id = "quantity" + count;
      input1.name = "quantity" + count;
      input1.addEventListener('input', Calculateamount);
      input1.required = true;
      input1.value = quantity;
      td3.setAttribute("class", "col-md-1");
      td3.appendChild(input1);

      //rate field
      var td4 = document.createElement("td");
      var input2 = document.createElement("input");
      input2.setAttribute("type", "text");
      input2.setAttribute("class", "form-control");
      input2.id = "rate" + count;
      input2.name = "rate" + count;
      input2.value = rate;
      input2.addEventListener('input', Calculateamount);
      input2.required = true;
      td4.setAttribute("class", "col-md-1");
      td4.appendChild(input2);

      // amount field
      var td5 = document.createElement("td");
      var input3 = document.createElement("input");
      input3.setAttribute("type", "text");
      input3.setAttribute("class", "form-control");
      // input3.addEventListener('input',totalamount);
      input3.id = "amount" + count;
      input3.name = "amount" + count;
      input3.setAttribute("readonly", "");
      input3.value = "0.00";
      input3.value = amount;
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
      input4.value = batch;
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
      input5.value = retailrate;
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
      input6.value = wholesale_rate;
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
      date1.value = mfg_date;
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
      date2.value = expiry_date;
      td10.setAttribute("class", "col-md-1");
      td10.appendChild(date2);

      //stock field
      var td11 = document.createElement("td");
      var input7 = document.createElement("input");
      input7.setAttribute("type", "text");
      input7.setAttribute("class", "form-control");
      input7.required = true;
      input7.id = "stock" + count;
      input7.name = "stock" + count;
      input7.value = stock;
      td11.setAttribute("class", "col-md-1");
      td11.appendChild(input7);

      var tr = document.createElement("tr");
      tr.appendChild(hidden);
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
  </script>

  <?php

  $query = "SELECT pd_id,pid,batch_no,quantity,purchase_rate,purchase_total,retailrate,wholesale_rate,mfg_date,expiry_date,stock FROM purchase_details LEFT OUTER JOIN product ON purchase_details.pid = product.id where purchase_id = $purchase_id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    foreach ($result as $data) {
      $pd_id = $data['pd_id'];
      $pid = $data['pid'];
      $quantity = $data['quantity'];
      $rate = $data['purchase_rate'];
      $amount = $data['purchase_total'];
      $batch = $data['batch_no'];
      $retailrate = $data['retailrate'];
      $wholesale_rate = $data['wholesale_rate'];
      $mfg_date = $data['mfg_date'];
      $expiry_date = $data['expiry_date'];
      $stock = $data['stock'];

      $data = [
        "pd_id" => $pd_id,
        "pid" => $pid,
        "quantity" => $quantity,
        "rate" => $rate,
        "amount" => $amount,
        "batch" => $batch,
        "retailrate" => $retailrate,
        "wholesale_rate" => $wholesale_rate,
        "mfg_date" => $mfg_date,
        "expiry_date" => $expiry_date,
        "stock" => $stock,
      ];

      $json_data = json_encode($data);
      echo "<script>singleRow($json_data);</script>";
    }
  }
  ?>

</main>

<?php include("footer.php"); ?>
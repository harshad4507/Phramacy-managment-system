<?php
include("header.php");
include("dbconnection.php");
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>

  <?php
  try {
    $sql = "SELECT COUNT(*) AS count, SUM(total) AS amount FROM sale WHERE sale_date = CURDATE()";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      throw new Exception(mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($result);
    $total_amount = $row['amount'];
    $amount = ($total_amount > 0) ? $total_amount : 0;
    $count = $row['count'];

    $sql1 = "SELECT COUNT(*) AS count from customers";
    $result = mysqli_query($conn, $sql1);
    if (!$result) {
      throw new Exception(mysqli_error($conn));
    }
    $row1 = mysqli_fetch_assoc($result);
    $customer_count = $row1['count'];

    $current_month = date('m');
    $current_year = date('Y');

    // Query the database to get the sales for the current month
    $sql = "SELECT COUNT(*) as sales ,sale_date, SUM(total) AS total_amount FROM sale WHERE MONTH(sale_date) = $current_month AND YEAR(sale_date) = $current_year GROUP BY sale_date";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      throw new Exception(mysqli_error($conn));
    }

    // Initialize the arrays
    $sale_dates = array();
    $total_amounts = array();
    $sales = array();

    // Loop through the result set and add the values to the arrays
    while ($row = mysqli_fetch_assoc($result)) {
      $sale_dates[] = $row['sale_date'];
      $total_amounts[] = $row['total_amount'];
      $sales[] = $row['sales'];
    }

    // Using array_map to wrap each element of $sale_dates in quotes
    $sale_dates_quoted = array_map(function ($date) {
      return "'" . $date . "'";
    }, $sale_dates);

    // Rest of your code...
  } catch (Exception $e) {
    echo "<script>alert('An error occurred: " . $e->getMessage() . "');</script>";
  }
  ?>
  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-9">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" id="myList">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                  <li><a class="dropdown-item" id="Today" onclick="changeSale(event)">Today</a></li>
                  <li><a class="dropdown-item" id="Month" onclick="changeSale(event)">This Month</a></li>
                  <li><a class="dropdown-item" id="Year" onclick="changeSale(event)">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Sales <span id="Changesale">| Today</span></h5>
                <script>
                  const selectedItem = document.querySelector('#Changesale');

                  function changeSale(event) {
                    const selectedItemText = `| ${event.target.textContent}`;
                    selectedItem.textContent = selectedItemText;
                    time = `${event.target.textContent}`;

                    $.post("getSales.php", {
                      Date: time
                    }, function(data, status) {
                      document.getElementById('salecount').innerText = data;
                    });
                  }
                </script>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                  </div>
                  <div class="ps-3">
                    <h6 id="salecount"><?= $count ?></h6>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" onclick="ChangeRevenue(event)">Today</a></li>
                  <!-- get The target Element -->
                  <li><a class="dropdown-item" onclick="ChangeRevenue(event)">This Month</a></li>
                  <li><a class="dropdown-item" onclick="ChangeRevenue(event)">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Revenue <span id="changerevenue">| Today</span></h5>

                <script>
                  const selectedItem1 = document.querySelector('#changerevenue');

                  function ChangeRevenue(event) {
                    const selectedItemText1 = `| ${event.target.textContent}`;
                    selectedItem1.textContent = selectedItemText1;
                    time1 = `${event.target.textContent}`;

                    $.post("getRevenue.php", {
                      Date: time1
                    }, function(data, status) {
                      document.getElementById('TotalRevenue').innerText = data;
                    });
                  }
                </script>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-rupee"></i>
                  </div>
                  <div class="ps-3">
                    <h6>&#8377; <span id="TotalRevenue"><?= $amount ?></span></h6>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Customers <span>| Till Today</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $customer_count ?></h6>
                  </div>

                </div>

              </div>
            </div>

          </div><!-- End Customers Card -->

          <!-- Reports -->
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Sales Reports <span id="graphpsale">/This Month</span></h5>

                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#reportsChart"), {
                      series: [{
                        name: 'sales',
                        data: [<?php echo implode(", ", $sales); ?>]
                      }, ],
                      chart: {
                        height: 350,
                        type: 'area',
                        toolbar: {
                          show: false
                        },
                      },
                      markers: {
                        size: 4
                      },
                      colors: ['#4154f1'],
                      fill: {
                        type: "gradient",
                        gradient: {
                          shadeIntensity: 1,
                          opacityFrom: 0.3,
                          opacityTo: 0.4,
                          stops: [0, 90, 100]
                        }
                      },
                      dataLabels: {
                        enabled: false
                      },
                      stroke: {
                        curve: 'smooth',
                        width: 2
                      },
                      xaxis: {
                        type: 'date',
                        categories: [<?php echo implode(", ", $sale_dates_quoted); ?>]
                      },
                      tooltip: {
                        x: {
                          format: 'dd/MM/yy'
                        },
                      }
                    }).render();
                  });
                </script>
                <div id="reportsChart"></div>
                <!-- End Line Chart -->
              </div>
            </div>
          </div><!-- End Reports -->

          <!-- Reports -->
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Revenue Reports <span>/This Month</span></h5>
                <!-- Line Chart -->

                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#reportsChart1"), {
                      series: [{
                        name: 'Revenue',
                        data: [<?php echo implode(", ", $total_amounts); ?>]
                      }, ],
                      chart: {
                        height: 350,
                        type: 'area',
                        toolbar: {
                          show: false
                        },
                      },
                      markers: {
                        size: 4
                      },
                      colors: ['#2eca6a'],
                      fill: {
                        type: "gradient",
                        gradient: {
                          shadeIntensity: 1,
                          opacityFrom: 0.3,
                          opacityTo: 0.4,
                          stops: [0, 90, 100]
                        }
                      },
                      dataLabels: {
                        enabled: false
                      },
                      stroke: {
                        curve: 'smooth',
                        width: 2
                      },
                      xaxis: {
                        type: 'date',
                        categories: [<?php echo implode(", ", $sale_dates_quoted); ?>]
                      },
                      tooltip: {
                        x: {
                          format: 'dd/MM/yy'
                        },
                      }
                    }).render();
                  });
                </script>
                <!-- End Line Chart -->
                <div id="reportsChart1"></div>
                <!-- End Line Chart -->
              </div>
            </div>
          </div><!-- End Reports -->


        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-3">

        <!-- Recent Activity -->
        

        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Reports <span>| Today</span></h5>
              <hr>

              <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                  <ul id="" class="nav-content">
                    <li>
                      <a href="StockLeft.php">
                        <i class="bi bi-circle"></i><span>Stock Left</span>
                      </a>
                    </li>
                    <li>
                      <a href="StockFinished.php">
                        <i class="bi bi-circle"></i><span>Stcok Finished</span>
                      </a>
                    </li>
                    <li>
                      <a href="StocknearExpiry.php">
                        <i class="bi bi-circle"></i><span>Stock Near Expiry</span>
                      </a>
                    </li>
                    <li>
                      <a href="StockExpired.php">
                        <i class="bi bi-circle"></i><span>Stock Expired</span>
                      </a>
                    </li>
                    <li>
                      <a href="purchasereport.php">
                        <i class="bi bi-circle"></i><span>Purchases</span>
                      </a>
                    </li>
                    <li>
                      <a href="salesreport.php">
                        <i class="bi bi-circle"></i><span>Sales</span>
                      </a>
                    </li>
                    <li>
                      <a href="productreport.php">
                        <i class="bi bi-circle"></i><span>Product</span>
                      </a>
                    </li>
                    <li>
                      <a href="Customerreport.php">
                        <i class="bi bi-circle"></i><span>Customers</span>
                      </a>
                    </li>
                    <li>
                      <a href="customerbusiness.php">
                        <i class="bi bi-circle"></i><span>Customers business</span>
                      </a>
                    </li>
                    <li>
                      <a href="onlineordersreport.php">
                        <i class="bi bi-circle"></i><span>Online Orders</span>
                      </a>
                    </li>

                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
  </section>

</main><!-- End #main -->

<?php include("footer.php"); ?>
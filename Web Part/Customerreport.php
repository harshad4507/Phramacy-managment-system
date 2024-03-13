<?php
include("header.php");
include("dbconnection.php");
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Customers</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item ">Dashboard</li>
                <li class="breadcrumb-item ">Reports</li>
                <li class="breadcrumb-item active">Customers</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row-lg-6">
            <div class="col-lg-11">
                <div class="card">
                    <div class="card-body">
                        <div class="row" style="margin-top: 20px; margin-bottom: 20px">
                            <div class="text-right">
                                <button type="button" class="btn btn-dark text-capitalize" onclick="printDiv('CustomerReport')">Print</button>
                                <button type="button" class="btn btn-dark text-capitalize" onclick="Downloadpdf('CustomerReport')">Download PDF</button>
                                <button type="button" class="btn btn-dark text-capitalize" onclick="Export('CustomerReport')">Export</button>
                            </div>
                        </div>
                        <div class="card" id="CustomerReport">
                            <div class="card-body">
                                <h5 class="card-title">Customers
                                </h5>
                                <hr>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Customer Name</th>
                                            <th>Customer Email</th>
                                            <th>Mobile No</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        try {
                                            $query = "SELECT * from customers where cid <> 5";
                                            $result = mysqli_query($conn, $query);

                                            if ($result === false) {
                                                throw new Exception("Query execution failed.");
                                            }

                                            if (mysqli_num_rows($result) > 0) {
                                                $i = 1;
                                                foreach ($result as $data) {
                                        ?>
                                                    <tr>
                                                        <th class="text-center">
                                                            <?php echo $i; ?>
                                                        </th>
                                                        <td>
                                                            <?= $data['name']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $data['email'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $data['mobileno'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $data['address'] ?>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    $i++;
                                                }
                                            }
                                        } catch (Exception $e) {
                                            ?>
                                            <script>
                                                alert("<?php echo $e->getMessage(); ?>");
                                            </script>
                                        <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

</main>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }

    function Downloadpdf(divName) {
        var element = document.getElementById(divName);
        html2pdf().from(element).save('Customer-report.pdf');
    }

    function Export(divName) {

        let data = document.getElementById(divName);
        var file = XLSX.utils.table_to_book(data, {
            sheet: 'Cutsomer'
        });
        XLSX.write(file, {
            bookType: 'xlsx',
            type: 'base64'
        });
        XLSX.writeFile(file, 'Customer-report.xlsx');
    }
</script>

<?php include("footer.php"); ?>
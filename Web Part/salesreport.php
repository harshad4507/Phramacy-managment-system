<?php
include("header.php");
include("dbconnection.php");
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Sales</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item ">Dashboard</li>
                <li class="breadcrumb-item ">Reports</li>
                <li class="breadcrumb-item active">Sales</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row-lg-6">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row" style="margin-top: 20px; margin-bottom: 20px">
                            <div class="text-right">
                                <button type="button" class="btn btn-dark text-capitalize" onclick="printDiv('SaleTable')">Print</button>
                                <button type="button" class="btn btn-dark text-capitalize" onclick="Downloadpdf('SaleTable')">Download PDF</button>
                                <button type="button" class="btn btn-dark text-capitalize" onclick="Export('SaleTable')">Export</button>
                            </div>
                        </div>
                        <div class="card" id="SaleTable">
                            <div class="card-body ">
                                <h5 class="card-title">Sales
                                </h5>
                                <hr>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Date</th>
                                            <th>Customer Name</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT sale.sale_id,sale.sale_date,sale.total,customers.name FROM sale 
                                                  LEFT OUTER JOIN customers ON sale.cid = customers.cid ";

                                        $result = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($result) > 0) {
                                            $i = 1;
                                            foreach ($result as $data) {

                                        ?>
                                                <tr>
                                                    <th class="text-center">
                                                        <?php echo $i; ?>
                                                    </th>
                                                    <td>
                                                        <?= $data['sale_date'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $data['name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $data['total'] ?>
                                                    </td>
                                                </tr>
                                        <?php
                                                $i++;
                                            }
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
        html2pdf().from(element).save("Sale-report.pdf");
    }

    function Export(divName) {

        let data = document.getElementById(divName);
        var file = XLSX.utils.table_to_book(data, {
            sheet: 'Salr'
        });
        XLSX.write(file, {
            bookType: 'xlsx',
            type: 'base64'
        });
        XLSX.writeFile(file, 'Sale-report.xlsx');
    }
</script>

<?php include("footer.php"); ?>
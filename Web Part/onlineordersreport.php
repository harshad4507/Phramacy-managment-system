<?php
include("header.php");
include("dbconnection.php");
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Online Orders</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item">Reports</li>
                <li class="breadcrumb-item active">Online Orders</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row-lg-6">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row" style="margin-top: 20px; margin-bottom: 20px">
                            <div class="text-right">
                                <button type="button" class="btn btn-dark text-capitalize" onclick="printDiv('PurchaseTable')">Print</button>
                                <button type="button" class="btn btn-dark text-capitalize" onclick="Downloadpdf('PurchaseTable')">Download PDF</button>
                                <button type="button" class="btn btn-dark text-capitalize" onclick="Export('PurchaseTable')">Export</button>
                            </div>
                        </div>
                        <div class="card" id="PurchaseTable">
                            <div class="card-body ">
                                <h5 class="card-title">Online Orders</h5>
                                <hr>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Customer</th>
                                            <th>Sale Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT c.cid, c.name, COUNT(o.customer_id) AS sale_count 
                                        FROM online_orders o 
                                        JOIN customers c ON o.customer_id = c.cid 
                                        WHERE o.status = 'Billed' 
                                        GROUP BY c.cid";

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
                                                        <?= $data['name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $data['sale_count'] ?>
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
        html2pdf().from(element).save();
    }

    function Export(divName) {

        let data = document.getElementById(divName);
        var file = XLSX.utils.table_to_book(data, {
            sheet: 'Purchase'
        });
        XLSX.write(file, {
            bookType: 'xlsx',
            type: 'base64'
        });
        XLSX.writeFile(file, 'Purchase-report.xlsx');
    }
</script>

<?php include("footer.php"); ?>
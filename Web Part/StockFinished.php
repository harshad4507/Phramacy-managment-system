<?php
include("header.php");
include("dbconnection.php");
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Stock Finished</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item ">Dashboard</li>
                <li class="breadcrumb-item ">Reports</li>
                <li class="breadcrumb-item active">Stock Finished</li>
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
                                <button type="button" class="btn btn-dark text-capitalize" onclick="printDiv('stock-finished')">Print</button>
                                <button type="button" class="btn btn-dark text-capitalize" onclick="Downloadpdf('stock-finished')">Download PDF</button>
                                <button type="button" class="btn btn-dark text-capitalize" onclick="Export('stock-finished')">Export</button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body" id="stock-finished">
                                <h5 class="card-title">Stock Finished
                                </h5>
                                <hr>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Category</th>
                                            <th>Product Name</th>
                                            <th>Batch No</th>
                                            <th>MFG Date</th>
                                            <th>Exp Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT purchase_details.pid,purchase_details.batch_no,purchase_details.mfg_date,purchase_details.expiry_date,purchase_details.stock,
                                                    product.pname,product.ptype from purchase_details LEFT OUTER JOIN product ON purchase_details.pid = product.id 
                                                    where purchase_details.stock = 0";
                                        $result = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($result)) {
                                            $i = 1;
                                            foreach ($result as $data) {

                                        ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $i; ?>
                                                    </td>
                                                    <td>
                                                        <?= $data['ptype'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $data['pname'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $data['batch_no'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $data['mfg_date'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $data['expiry_date'] ?>
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
            sheet: 'Stock-finised'
        });
        XLSX.write(file, {
            bookType: 'xlsx',
            type: 'base64'
        });
        XLSX.writeFile(file, 'Stock-finised-report.xlsx');
    }
</script>
<script src="export.js"></script>
<?php include("footer.php"); ?>
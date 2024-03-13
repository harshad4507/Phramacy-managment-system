<?php
include("header.php");
include("dbconnection.php");
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Customer business</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item ">Dashboard</li>
                <li class="breadcrumb-item ">Reports</li>
                <li class="breadcrumb-item active">Customer business</li>
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
                                <button type="button" class="btn btn-dark text-capitalize" onclick="printDiv('CustomerBusiness')">Print</button>
                                <button type="button" class="btn btn-dark text-capitalize" onclick="Downloadpdf('CustomerBusiness')">Download PDF</button>
                                <button type="button" class="btn btn-dark text-capitalize" onclick="Export('CustomerBusiness')">Export</button>
                            </div>
                        </div>
                        <div class="card" id="CustomerBusiness">
                            <div class="card-body ">
                                <h5 class="card-title">Customer business
                                </h5>
                                <hr>
                                <table class="table table-striped table-bordered" id="excel-data">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Sale Count</th>
                                            <th>Sale Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        try {
                                            $query = "SELECT c.cid, c.name, COUNT(*) as count, SUM(s.total) as total_amount
    FROM sale s
    INNER JOIN customers c ON s.cid = c.cid
    WHERE c.cid <> 5
    GROUP BY c.cid";
                                            $result = mysqli_query($conn, $query);

                                            if ($result === false) {
                                                throw new Exception("Query execution failed.");
                                            }

                                            if (mysqli_num_rows($result)) {
                                                $i = 1;
                                                foreach ($result as $data) {
                                        ?>
                                                    <tr>
                                                        <th class="text-center">
                                                            <?php echo $i; ?>
                                                        </th>
                                                        <td>
                                                            <?php echo $data['name']; ?>
                                                        </td>
                                                        <td>
                                                            <?= $data['count'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $data['total_amount'] ?>
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
        html2pdf().from(element).save('Customer-business-report.pdf');
    }

    function Export(divName) {

        let data = document.getElementById(divName);
        var file = XLSX.utils.table_to_book(data, {
            sheet: 'Customer-bisuness'
        });
        XLSX.write(file, {
            bookType: 'xlsx',
            type: 'base64'
        });
        XLSX.writeFile(file, 'Customer-business-reports.xlsx');

    }
</script>

<?php include("footer.php"); ?>
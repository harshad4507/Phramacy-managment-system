<?php
include("header.php");
include('dbconnection.php');

if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];

    try {
        // Validate customer ID (Example: ensuring it is a positive integer)
        if (!ctype_digit($customer_id) || $customer_id <= 0) {
            throw new Exception("Invalid customer ID.");
        }

        $query = "SELECT * FROM customers WHERE cid='$customer_id'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_array($result);

            $cid = $data['cid'];
            $name = $data['name'];
            $email = $data['email'];
            $mobile = $data['mobileno'];
            $ctype = $data['ctype'];
            $address = $data['address'];
        } else {
            throw new Exception("Customer not found.");
        }
    } catch (Exception $e) {
        ?>
        <script>
            alert("<?php echo $e->getMessage(); ?>");
        </script>
        <?php
        // You may choose to redirect or display an error message as needed
        exit;
    }
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Customer</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item ">Dashboard</li>
                <li class="breadcrumb-item active">Customer</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row-lg-6">
            <div class="col-lg-10">
                <div class="card">
                    <?php include('message.php') ?>
                    <div class="card-body">
                        <h5 class="card-title">Customer Information
                            <div class="position-relative">
                                <a href="customers.php" class="btn btn-info position-absolute top-0 end-0 translate-middle">Back</a>
                            </div>
                        </h5>
                        <form class="row g-3 needs-validation" method='POST' action='customercode.php' novalidate>
                            <input type="hidden" name="cid" value="<?php echo $cid; ?>">
                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Name</label>
                                <input type="text" class="form-control" id="validationTooltip01" name='CName' value="<?= $name?>" required>
                                <span id="cnamerror" class="text-danger"></span>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip02" class="form-label">Customer Type</label>
                                <select class="form-select" id="validationTooltip04" name="ctype" required>
                                    <option selected disabled value="">Select Customer Type</option>
                                    <option value="Retail"<?php if($ctype == "Retail"){?>selected = "selected"<?php }?>>Retail</option>
                                    <option value="Wholesale"<?php if($ctype == "Wholesale"){?>selected= "selected"<?php }?>>Wholesale</option>
                                </select>
                                <span id="cutomertypeerror" class="text-danger"></span>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip02" class="form-label">Email</label>
                                <input type="text" class="form-control" id="validationTooltip03" name='CEmail' value="<?= $email?>" required>
                                <span id="mailerror" class="text-danger"></span>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltipUsername" class="form-label">Mobile No.</label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" id="validationTooltipmobile" value= "<?= $mobile?>"name='CMobile' aria-describedby="validationTooltipUsernamePrepend" required>
                                </div>
                                <span id="mobileerror" class="text-danger"></span>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip02" class="form-label">Address</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name='CAddress' rows="2" required><?= $address?></textarea>
                                <span id="adderror" class="text-danger"></span>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit" onclick="return validate()" name="updatecustomer">Update Customer
                                    Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        function validateField(fieldId, errorId, errorMessage, isValid) {
            const field = document.getElementById(fieldId);
            const error = document.getElementById(errorId);

            if (!isValid) {
                error.innerHTML = errorMessage;
                error.classList.add("text-danger");
                field.classList.add("border-danger");
                return false;
            } else {
                error.innerHTML = "";
                error.classList.remove("text-danger");
                field.classList.remove("border-danger");
                return true;
            }
        }

        function validate() {
            let flag = true;

            // Validate Customer name
            const cname = document.getElementById('validationTooltip01').value;
            flag = validateField('validationTooltip01', 'cnamerror', "Please Enter valid Customer Name", !(cname === "" || cname === null || !(isNaN(cname)))) && flag;

            // Validate product type
            flag = validateField('validationTooltip04', 'cutomertypeerror', "Please select Customer type", !(document.getElementById('validationTooltip04').value === "" || document.getElementById('validationTooltip04').value === null)) && flag;
            
            // Validate Email
            const cmail = document.getElementById('validationTooltip03').value;
            const epattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            flag = validateField('validationTooltip03', 'mailerror', "Please Enter valid Email Address", !(cmail === "" || cmail === null || !(epattern.test(cmail)))) && flag;

            // Validate mobile
            const cmob = document.getElementById('validationTooltipmobile').value;
            const mpattern = $pattern = /^[6-9]\d{9}$/;
            flag = validateField('validationTooltipmobile', 'mobileerror', "Please Enter valid Mobile No.", !(cmob === "" || cmob === null || !(mpattern.test(cmob)))) && flag;

            //validation address
            const cadd = document.getElementById('exampleFormControlTextarea1').value
            flag = validateField('exampleFormControlTextarea1', 'adderror', "Please Enter valid Address", !(cadd === "" || cadd === null )) && flag;


            return flag;
        }
    </script>
</main>

<?php include("footer.php"); ?>
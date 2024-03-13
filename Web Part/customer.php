<?php
include("header.php");
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
                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip01" class="form-label">Name</label>
                                <input type="text" class="form-control" id="validationTooltip01" name='CName' value="" required>
                                <span id="cnamerror" class="text-danger"></span>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip02" class="form-label">Customer Type</label>
                                <select class="form-select" id="validationTooltip04" name="ctype" required>
                                    <option selected disabled value="">Select Customer Type</option>
                                    <option value="Retail">Retail</option>
                                    <option value="Wholesale">Wholesale</option>
                                </select>
                                <span id="cutomertypeerror" class="text-danger"></span>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip02" class="form-label">Email</label>
                                <input type="text" class="form-control" id="validationTooltip03" name='CEmail' value="" required>
                                <span id="mailerror" class="text-danger"></span>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltipUsername" class="form-label">Mobile No.</label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" id="validationTooltipmobile" name='CMobile' aria-describedby="validationTooltipUsernamePrepend" required>
                                </div>
                                <span id="mobileerror" class="text-danger"></span>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip02" class="form-label">Address</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name='CAddress' rows="2" required></textarea>
                                <span id="adderror" class="text-danger"></span>
                            </div>

                            <div class="col-12">
                                <br>
                                <button class="btn btn-primary" type="submit" name="addcustomer" onclick="return validate()">Add Customer</button>
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
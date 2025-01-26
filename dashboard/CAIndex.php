<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];

$select_admin = "select * from `user` where `lid`='".$lid."'";
$run_admin = mysqli_query($con,$select_admin);
$row_admin = mysqli_fetch_assoc($run_admin);

$fname = $row_admin['fname'];
$wa = $row_admin['wa'];
$ut = $row_admin['user_type'];
$branchCode = $row_admin['branchCode'];

$sel_branch = "select * from branches where branchCode='".$branchCode."'";
$run_branch = mysqli_query($con,$sel_branch);
$row_branch = mysqli_fetch_assoc($run_branch);
$btanch = $row_branch['branchName'];
$BranchAddress = $row_branch['BranchAddress'];
$BranchTel = $row_branch['BranchTel'];

if($ut == 0){
    $ut = "Administrater";
} else if($ut == 1){
    $ut = "Manager";
} else if($ut == 2){
    $ut = "Cashier";
} else if($ut == 3){
    $ut = "Purchasing Officer";
}

$alert = isset($_REQUEST['alert']) ? $_REQUEST['alert'] : null;
$count = 0;

if ($alert == 1 && $count == 0) {
    $message = "Bill Issued.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $count = 1;
}
if ($alert == 2 && $count == 0) {
    $message = "Empty Bill.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $count = 1;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>InfoWorld Computer Solution</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/logo.jpg" />
    <!-- Link AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <!-- Custom CSS -->
    <style>
    body {
        zoom: 105%;
    }
    </style>
</head>

<body class="with-welcome-text">

    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <div class="me-3">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
            </div>
            <div>
                <a class="navbar-brand brand-logo"
                    href="<?php echo $home; ?>?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                    <h5><b><?php echo $btanch ?></b></h5>
                </a>
                <a class="navbar-brand brand-logo-mini"
                    href="<?php echo $home; ?>?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                    <img src="assets/images/logo.jpg" alt="logo" />
                </a>
            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
            <ul class="navbar-nav">
                <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                    <?php
                            // Set the time zone to Sri Lanka
                            date_default_timezone_set('Asia/Colombo');
                            // Get the current hour in 24-hour format
                            $currentHour = date('H');

                            // Check if the current hour is between 6 AM (6) and 12 PM (12) inclusive
                            if ($currentHour >= 6 && $currentHour < 12) {
                                $greeting = "Good Morning";
                            } elseif ($currentHour >= 12 && $currentHour < 18) { // Check if the current hour is between 12 PM (12) and 6 PM (18) inclusive
                                $greeting = "Good Afternoon";
                            } else { // For all other hours (6 PM to 5:59 AM)
                                $greeting = "Good Evening";
                            }
                        ?>
                    <h1 class="welcome-text"><?php echo $greeting; ?>, <span
                            class="text-black fw-bold"><?php echo $ut; ?></span>
                    </h1>
                    <h3 class="welcome-sub-text"></h3>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">

                <li class="nav-item d-none d-lg-block">
                    <div id="datetimepicker-popup" class="input-group date datetimepicker navbar-datetime-picker">
                        <!-- Date input field -->
                        <div class="input-group-prepend">
                            <span class="icon-calendar input-group-text "> Today</span>
                        </div>
                        <?php
                                // Get the current date in a format suitable for date input
                                $currentDate = date('Y-m-d');
                            ?>
                        <input type="date" class="form-control" value="<?php echo $currentDate; ?>">

                        <!-- Time input field -->
                        <div class="input-group-prepend">
                            <span class="icon-clock input-group-text "> Time</span>
                        </div>
                        <?php
                                // Get the current time in a format suitable for time input
                                $currentTime = date('H:i:s');
                            ?>
                        <input type="time" class="form-control" value="<?php echo $currentTime; ?>" id="timeInput">
                    </div>
                </li>

                <!-- JavaScript to add clock functionality -->
                <script>
                // Function to update the time input with the current time
                function updateTimeInput() {
                    var currentTime = new Date().toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: false
                    });
                    document.getElementById('timeInput').value = currentTime;
                }

                // Update the time input initially
                updateTimeInput();

                // Update the time input every second (for the clock effect)
                setInterval(updateTimeInput, 1000);
                </script>

                <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                    <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <p class="mb-1 mt-3 fw-semibold"><?php echo $fname; ?></p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header text-center">
                            <p class="mb-1 mt-3 fw-semibold"><?php echo $fname; ?></p>
                            <p class="fw-light text-muted mb-0"><?php echo $lid; ?></p>
                        </div>
                        <a class="dropdown-item" href="CAIndex.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="fa fa-desktop dropdown-item-icon text-primary me-2"></i>
                            <span class="menu-title">Billing</span>
                        </a>
                        <a class="dropdown-item"
                            href="CACancelBill.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="fa fa-file-excel-o dropdown-item-icon text-primary me-2"></i>
                            <span class="menu-title">Cancel Bill</span>
                        </a>
                        <a class="dropdown-item"
                            href="CACreditBill.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="fa fa-credit-card dropdown-item-icon text-primary me-2"></i>
                            <span class="menu-title">Credit Bill</span>
                        </a>
                        <a class="dropdown-item" href="CARecieve.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="dropdown-item-icon text-primary me-2 fa fa-external-link"></i>
                            <span class="menu-title">Recieve</span>
                        </a>
                        <a href="CAProfile.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>"
                            class="dropdown-item"><i
                                class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My
                            Profile</a>
                        <a class="dropdown-item" href="../index.html"><i
                                class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-bs-toggle="offcanvas"><?php echo $fname; ?>
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->

    <br><br><br><br>
    <div class="row">
        <div class="col-sm-12">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"
                            style="color:white; background-color: darkblue; padding:5px; border-radius:5px;">
                            Billing</h4>
                        <p class="card-description" style="float:left;"> Please Fill All Fields
                            &nbsp;&nbsp;&nbsp;</p>
                        <?php
                            $select_purches = "SELECT billNo FROM branches where branchCode='".$branchCode."'";
                            $run_purches = mysqli_query($con,$select_purches);
                            $row_purches = mysqli_fetch_assoc($run_purches);
                            $purches = $row_purches['billNo']+1;
                        ?>
                        <p class="card-description" style="float:right;"><b> Bill No.
                                <?php echo $purches; ?></b></p>
                        <p class="card-description"><b>( Discount Type : 0 - No Discount, 1 -
                                Percentage, 2
                                - Price )</b></p>

                        <script type="text/javascript">
                        function confirmSubmission(event) {
                            event.preventDefault(); // Prevent form from submitting
                            let confirmation = confirm("Are you sure? Do you want to Bill Now?");
                            if (confirmation) {
                                document.getElementById("billForm").submit(); // Submit the form if confirmed
                            }
                        }
                        </script>

                        <form
                            action="CABilling.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>&billNo=<?php echo $purches; ?>&BillingBranch=<?php echo $branchCode; ?>"
                            method="POST" class="forms-sample" onsubmit="confirmSubmission(event)" id="billForm">

                            <div class="row" style="clear:both;">
                            <div class="col-md-2 form-group">
                                <label for="PurchesNo">Item Code</label>
                                <input type="text" name="ItemCode" id="ItemCode" class="form-control"
                                    style="color:black; background-color: #EBEDEF;" list="exampleList">
                                <datalist id="exampleList">
                                    <?php
                                            $select_catCode1 = "select stock.qty,stock.itemCode,items.itemName,items.costPrice,items.sellingPrice from stock,items where stock.itemCode=items.itemCode and branchCode='".$branchCode."' ORDER BY itemCode ASC";
                                            $run_catCode1 = mysqli_query($con,$select_catCode1);
                                            while($row1 = mysqli_fetch_assoc($run_catCode1)){ 
                                        ?>
                                    <option value="<?php echo $row1['itemCode'];?>"
                                        data-name="<?php echo $row1['itemName'];?>"
                                        data-cost="<?php echo $row1['costPrice'] ?>"
                                        data-qty="<?php echo $row1['qty'] ?>"
                                        data-selling="<?php echo $row1['sellingPrice'] ?>">
                                        <?php echo $row1['itemName'];?>
                                    </option>
                                    <?php } ?>
                                </datalist>
                            </div>
                            <script>
                            document.getElementById('ItemCode').addEventListener('input',
                                function() {
                                    var selectedItem = this.value;
                                    var options = document.getElementById('exampleList')
                                        .childNodes;
                                    var optionsList = document.getElementById('exampleList')
                                        .options;
                                    var isSelected = false;

                                    // Check if the entered value matches any option in the datalist
                                    for (var i = 0; i < optionsList.length; i++) {
                                        if (optionsList[i].value === selectedItem) {
                                            isSelected = true;
                                            break;
                                        }
                                    }

                                    // If an option is selected, do something
                                    if (isSelected) {
                                        for (var i = 0; i < options.length; i++) {
                                            if (options[i].value === selectedItem) {
                                                document.getElementById('ItemName').value =
                                                    options[
                                                        i].getAttribute('data-name');
                                                document.getElementById('CostPrice').value =
                                                    options[i].getAttribute('data-cost');
                                                document.getElementById('SellingPrice').value =
                                                    options[i].getAttribute('data-selling');
                                                document.getElementById('RealSellingPrice').value =
                                                    options[i].getAttribute('data-selling');
                                                document.getElementById('availableQTY').value =
                                                    options[i].getAttribute('data-qty');

                                                break;
                                            }
                                        }
                                    }
                                });
                            </script>
                            <!-- // Focus on the QTY input field after selecting an item code
                                                    document.getElementById('QTY').focus(); -->
                            <div class="col-md-2 form-group">
                                <label for="ItemName">Item name</label>
                                <input type="text" name="ItemName" class="form-control" id="ItemName"
                                    placeholder="Item name" style="color:black; background-color: #FDEBD0;">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="serialNo">Serial No.</label>
                                <input type="text" id="serialNo" name="serialNo" class="form-control"
                                    list="serialNoList">
                                <datalist id="serialNoList">
                                </datalist>
                                <!-- Link AJAX -->
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
                                </script>

                                <script>
                                $(document).ready(function() {
                                    $('#ItemCode').on('input', function() {
                                        var ItemCode = $(this).val();
                                        var branchCode = '<?php echo $branchCode; ?>';
                                        console.log("ItemCode:", ItemCode); // Debugging
                                        console.log("branchCode:", branchCode); // Debugging

                                        $.ajax({
                                            url: 'select_serial_to_item.php',
                                            method: 'POST',
                                            data: {
                                                ItemCode: ItemCode,
                                                BranchCode: branchCode
                                            },
                                            success: function(data) {
                                                console.log("AJAX response:",
                                                    data); // Debugging
                                                data = data.replace(/'/g, '');
                                                $('#serialNoList').html(
                                                    '<option value=""></option>' +
                                                    data);
                                            },
                                            error: function(xhr, status, error) {
                                                console.error("AJAX error:", status,
                                                    error); // Debugging
                                            }
                                        });
                                    });
                                });
                                </script>
                            </div>
                            <div class="col-md-2 form-group" style="display:none">
                                <label for="availableQTY">Available QTY</label>
                                <input type="text" id="availableQTY" class="form-control">
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="Warranty">Warranty</label>
                                <select id="Warranty" class="form-control">
                                    <option value="">Select Warranty Period</option>
                                    <option value="1m">One Month</option>
                                    <option value="2m">Two Month</option>
                                    <option value="3m">Three Month</option>
                                    <option value="4m">Fore Month</option>
                                    <option value="5m">Five Month</option>
                                    <option value="6m">Six Month</option>
                                    <option value="1y">One Year</option>
                                    <option value="2y">Two Year</option>
                                    <option value="3y">Three Year</option>
                                    <option value="4y">Fore Year</option>
                                    <option value="5y">Five Year</option>
                                    <option value="6y">Six Year</option>
                                    <option value="1mt">One Month Test</option>
                                    <option value="1bt">One Year Battery</option>
                                    <option value="1mb">Two Year Mother Board</option>
                                </select>
                            </div>
                            <div class="col-md-1 form-group" style="display:none">
                                <label for="QTY">QTY</label>
                                <input type="text" name="QTY" class="form-control" id="QTY" placeholder="QTY"
                                    style="color:black; background-color: #D4E6F1;" value="1">
                            </div>
                            <script>
                            function checkAvailable() {
                                var available = document.getElementById('availableQTY')
                                    .value;
                                var transferQTY = document.getElementById('QTY')
                                    .value; // 'this' refers to the input that triggered the event
                                // alert(available);
                                // alert(transferQTY);

                                if (transferQTY == 0) {
                                    alert("QTY can't be 0");
                                    $('#QTY').focus();
                                    $('#QTY').select();
                                } else {
                                    $('#Warranty').focus();
                                    $('#Warranty').select();
                                }
                            };
                            </script>
                            <script>
                            // Function to calculate total price with discount
                            function calculateTotalBill() {
                                var qty = parseFloat(document.getElementById('QTY').value);
                                var sellingPrice = parseFloat(document.getElementById(
                                    'RealSellingPrice').value);
                                var discountType = parseInt(document.getElementById('DiscountType')
                                    .value);
                                var discount = parseFloat(document.getElementById('Discount')
                                    .value);
                                var totalPriceElement = document.getElementById('TotalPrice');
                                var totalPriceBi = document.getElementById('Price');

                                var total = qty * sellingPrice;

                                if (discountType === 1) {
                                    // Percentage discount
                                    total -= (total * (discount / 100));
                                } else if (discountType === 2) {
                                    // Price discount
                                    total -= (qty * discount);
                                }
                                totalPriceElement.value = total.toFixed(
                                    2); // Assuming 2 decimal places for currency
                            }

                            // Call calculateTotal when any relevant input changes
                            // var inputs = document.querySelectorAll('input[type="text"], select');
                            // inputs.forEach(function(input) {
                            //     input.addEventListener('input', calculateTotalBill);
                            // });

                            // Initial calculation
                            calculateTotalBill();
                            </script>
                            <div class="col-md-1 form-group" style="display:none;">
                                <label for="CostPrice">Cost price (Rs.)</label>
                                <input type="text" name="CostPrice" class="form-control" id="CostPrice"
                                    placeholder="Cost price" style="color:black; background-color: #D4E6F1;">
                            </div>
                            <script>
                            // Function to calculate total price
                            function calculateTotal() {
                                // Get the values of quantity and cost price
                                var quantity = parseFloat(document.getElementById('QTY').value);
                                var costPrice = parseFloat(document.getElementById('SellingPrice')
                                    .value);

                                // Calculate total price
                                var totalPrice = quantity * costPrice;
                                document.getElementById('Price').value = totalPrice.toFixed(
                                    2); // Display only if totalPrice is a valid number

                                // Display total price
                                document.getElementById('TotalPrice').value = totalPrice.toFixed(
                                    2); // Display only if totalPrice is a valid number

                                var realSelling = parseFloat(document.getElementById('SellingPrice').value);
                                var nowSelling = parseFloat(document.getElementById('RealSellingPrice').value);
                                if (realSelling != nowSelling) {
                                    document.getElementById('DiscountType').value = 2
                                    document.getElementById('Discount').value = nowSelling - realSelling;

                                    document.getElementById('Price').value = (nowSelling * quantity).toFixed(2);
                                }
                            }

                            // Call the calculateTotal function whenever quantity or cost price changes
                            document.getElementById('QTY').addEventListener('input',
                                calculateTotal);
                            document.getElementById('SellingPrice').addEventListener('input',
                                calculateTotal);

                            // Event listener for "keypress" event on the QTY input field
                            document.getElementById('QTY').addEventListener('keypress', function(
                                event) {
                                // Check if the pressed key is Enter (key code 13)
                                if (event.keyCode === 13) {
                                    // Do something here, like focusing on another input field
                                    // document.getElementById('ItemCode').focus();
                                    // Trigger a click event on the Add button
                                    // document.getElementById('addPurch').click();

                                }
                            });
                            </script>

                            <div class="col-md-2 form-group">
                                <label for="SellingPrice">Selling Price</label>
                                <input type="text" name="SellingPrice" class="form-control" id="SellingPrice"
                                    placeholder="Selling Price" style="color:black; background-color: #FADBD8;">
                                <input type="text" name="RealSellingPrice" class="form-control" id="RealSellingPrice"
                                    placeholder="Selling Price" style="display:none">
                                <!--style="display:none" -->
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="DiscountType">Discount Type</label>
                                <input type="text" name="DiscountType" class="form-control" id="DiscountType"
                                    placeholder="Discount Type" value="0"
                                    style="color:black; background-color: #FADBD8;">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="Discount">Discount</label>
                                <input type="text" name="Discount" class="form-control" id="Discount"
                                    placeholder="Discount" value="0" style="color:black; background-color: #FADBD8;">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="TotalPrice">Total price (Rs.)</label>
                                <input type="text" name="TotalPrice" class="form-control" id="TotalPrice"
                                    placeholder="Total price" style="color:black; background-color: #D1F2EB;">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="Price">Price (Rs.)</label>
                                <input type="text" name="Price" class="form-control" id="Price" placeholder="Price"
                                    style="color:black; background-color: #D1F2EB;">
                            </div>
                    </div>
                    <script>
                    document.getElementById('CatagoryCode').addEventListener('change',
                        function() {
                            var selectedOption = this.options[this.selectedIndex];
                            document.getElementById('CatagoryName').value =
                                selectedOption
                                .dataset
                                .name;
                        });
                    </script>
                    <button type="button" id="addPurch" class="btn btn-primary me-2">Add to
                        Bill</button>

                    <input type='button' id='Printbtn' value='Print' onclick='printDiv();' style="display:none">
                    <!-- Hidden input fields to store values for PHP arrays -->
                    <input type="text" name="rowData" id="rowData" required style="display:none"><br>
                    <!--style="display:none" -->
                    <div class="table-responsive">
                        <style>
                        .hide-column {
                            display: none;
                        }
                        </style>
                        <div id="billContent" style="overflow-y: auto; max-height: 500px;">
                            <div style="text-align: center;">
                                <img class="hide-column" style="width:100px; margin:0 auto;"
                                    src="assets/images/logo1.png" alt="Shanthi Lanka Holdings (PVT) Ltd">
                                <p class="hide-column" style="margin:0">
                                    <?php echo $BranchAddress; ?></p>
                                <p class="hide-column" style="margin:0">
                                    <?php echo $BranchTel; ?></p>
                            </div>
                            <p class="hide-column">Bill No: <?php echo $purches; ?></p>
                            <?php $date = date("Y-m-d  |  H:m:s");?>
                            <p class="hide-column">Bill Officer: <?php echo $fname; ?></p>
                            <hr class="hide-column">
                            <p class="hide-column">Date: <?php echo $date; ?></p>
                            <hr class="hide-column">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Item name </th>
                                        <th> Serial No. </th>
                                        <th> Selling Price </th>
                                        <th> Price </th>
                                        <th> Discount </th>
                                        <th> Total price (Rs.) </th> <!-- New Column -->
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody id="purchTableBody">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="8">
                                            <hr class="hide-column">
                                        </td> <!-- Horizontal line -->
                                    </tr>
                                    <tr>
                                        <td colspan="4">Total Discount: <span id="TotalDiscount1"></span></td>
                                        <td colspan="4">Total Price: <span id="PaybleBillAmount1"></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8">
                                            <hr class="hide-column">
                                        </td> <!-- Horizontal line -->
                                    </tr>
                                </tfoot>
                            </table>
                            <div style="text-align: center;">
                                <h3 class="hide-column">Thank You..Come Again..</h3>
                            </div>
                            <div style="text-align: center;">
                                <hr class="hide-column">
                                <h5 class="hide-column" style="margin:0">Focus Solution (PVT)
                                    LTD</h5>
                                <h5 class="hide-column" style="margin:0">Contact: 074 043 0551
                                </h5>
                            </div>
                            <br><br>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group"><br>
                            <h2 style="float:left;">Total Amount Rs. <span id="purchTot"></span>
                            </h2>
                            <h2 style="float:right;">Total Item Count: <span id="itemTot">0</span></h2>
                            <h2 style="clear:both; float:left;">Payable Bill Amount Rs. <span
                                    id="PaybleBillAmount">0</span>
                            </h2>
                            <h2 style="float:right;">Total Discount Rs. <span id="TotalDiscount">0</span>
                            </h2>
                            <input type="text" name="purchTotal" id="purchTotal" style="display:none;" required>
                            <input type="text" name="PaybleBillAmountSend" id="PaybleBillAmountSend"
                                style="display:none;" required>
                            <input type="text" name="TotalDiscountSend" id="TotalDiscountSend" style="display:none;"
                                required>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="paidAmount">Paid Amount:</label>
                                    <input type="text" id="paidAmount" name="paidAmount" class="form-control" required>
                                </div>
                                <script>
                                document.getElementById('paidAmount').addEventListener('input',
                                    function() {
                                        var costomerPayable = document.getElementById(
                                            'PaybleBillAmountSend').value;
                                        var costomerGiven = this.value;
                                        if (costomerGiven < 0) {
                                            alert("Not Valid Amount.");
                                        } else {
                                            var ballence = costomerGiven - costomerPayable;
                                            document.getElementById('ballenceAmount').value = ballence;
                                        }
                                    });
                                </script>
                                <div class="col-md-6 form-group">
                                    <label for="ballenceAmount">Ballence Amount:</label>
                                    <input type="text" id="ballenceAmount" name="ballenceAmount" class="form-control"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 form-group">
                        <button type="submit" id="submitBTN" class="btn btn-success">Bill</button>
                    </div>
                    </form>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                    $(document).ready(function() {

                        $(window).keydown(function(event) {
                            if (event.keyCode == 13) {
                                event.preventDefault();
                                // $('#addPurch').click();
                                $('#ItemCode').focus();
                                return false;
                            }
                        });
                        $('#BranchCode').keydown(function(event) {
                            if (event.keyCode == 13) {
                                event.preventDefault();
                                // $('#addPurch').click();
                                $('#ItemCode').focus();
                                return false;
                            }
                        });
                        $('#ItemCode').keydown(function(event) {
                            if (event.keyCode == 13) {
                                event.preventDefault();
                                // $('#addPurch').click();
                                $('#serialNo').focus();
                                return false;
                            }
                            if (event.keyCode === 27) {
                                event.preventDefault();
                                // $('#submitBTN').click();
                                $('#paidAmount').focus();
                                return false;
                            }
                        });
                        $('#serialNo').keydown(function(event) {
                            if (event.keyCode === 13) {
                                event.preventDefault();
                                // $('#addPurch').click();
                                // $('#SellingPrice').focus();
                                checkAvailable();
                                // $('#SellingPrice').select();
                                return false;
                            }
                        });
                        $('#Warranty').keydown(function(event) {
                            if (event.keyCode === 13) {
                                event.preventDefault();
                                // $('#addPurch').click();
                                $('#SellingPrice').focus();
                                // checkAvailable();
                                $('#SellingPrice').select();
                                return false;
                            }
                        });
                        $('#SellingPrice').keydown(function(event) {
                            if (event.keyCode === 13) {
                                event.preventDefault();
                                // $('#addPurch').click();
                                $('#DiscountType').focus();
                                calculateTotal();
                                checkAvailable();
                                $('#DiscountType').select();
                                return false;
                            }
                        });
                        $('#DiscountType').keydown(function(event) {
                            if (event.keyCode === 13) {
                                if (this.value === '0') {
                                    event.preventDefault();
                                    $('#addPurch').click();
                                    $('#ItemCode').focus();
                                    return false;
                                }
                                if (this.value === '1') {
                                    event.preventDefault();
                                    // $('#addPurch').click();
                                    $('#Discount').focus();
                                    $('#Discount').select();
                                    return false;
                                }
                                if (this.value === '2') {
                                    event.preventDefault();
                                    // $('#addPurch').click();
                                    $('#Discount').focus();
                                    $('#Discount').select();
                                    return false;
                                }
                            }
                        });
                        $('#Discount').keydown(function(event) {
                            if (event.keyCode == 13) {
                                event.preventDefault();
                                calculateTotalBill();
                                $('#addPurch').click();
                                $('#ItemCode').focus();
                                return false;
                            }
                        });
                        $('#paidAmount').keydown(function(event) {
                            if (event.keyCode == 13) {
                                event.preventDefault();
                                $('#submitBTN').click();
                                // $('#chequeAmount').focus();
                                return false;
                            }
                        });
                        // $('#chequeAmount').keydown(function(event) {
                        //     if (event.keyCode == 13) {
                        //         event.preventDefault();
                        //         $('#submitBTN').click();
                        //         // $('#ItemCode').focus();
                        //         return false;
                        //     }
                        // });
                    });
                    </script>

                    <script>
                    // Counter for row number
                    let rowNum = 1;

                    // Array to store row data
                    let rowDataArray = [];

                    // Function to add a new row to the table
                    function addRow() {
                        // Get form field values
                        const itemCode = document.getElementById('ItemCode').value;
                        const itemName = document.getElementById('ItemName').value;
                        const serialNo = document.getElementById('serialNo').value;
                        const Warranty = document.getElementById('Warranty').value;
                        const costPrice = document.getElementById('CostPrice').value;
                        const totalPrice = document.getElementById('TotalPrice').value;
                        const sellingPrice = document.getElementById('RealSellingPrice').value;
                        const discountType = document.getElementById('DiscountType').value;
                        const discount = document.getElementById('Discount')
                            .value; // New Discount value
                        const price = document.getElementById('Price').value; // New Discount value
                        //alert("price" + price);
                        const CalDiscount = price - totalPrice; // New Discount value

                        // Create a new row
                        const newRow = `
                                                <tr>
                                                    <td class="text-center">${rowNum}</td>
                                                    <td class="text-center">${itemName}</td>
                                                    <td class="text-center">${serialNo}</td>
                                                    <td class="text-center">${sellingPrice}</td>
                                                    <td class="text-center">${price}</td>
                                                    <td class="text-center">${CalDiscount}</td> <!-- New Discount value -->
                                                    <td class="text-center">${totalPrice}</td> <!-- New Discount value -->
                                                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, ${rowNum - 1})">x</button></td>
                                                    <td colspan="8">
                                                        <hr class="hide-column">
                                                    </td> <!-- Horizontal line -->
                                                </tr>
                                            `;

                        // Append the new row to the table body
                        document.getElementById('purchTableBody').insertAdjacentHTML('beforeend',
                            newRow);

                        // Construct JSON object for row data
                        const rowData = {
                            itemCode: itemCode,
                            itemName: itemName,
                            serialNo: serialNo,
                            Warranty: Warranty,
                            costPrice: costPrice,
                            totalPrice: price,
                            sellingPrice: sellingPrice,
                            discountType: discountType,
                            discount: discount, // New Discount data
                            CalDiscount: CalDiscount, // New Discount data
                            price: totalPrice
                        };

                        // Push JSON object to array
                        rowDataArray.push(rowData);

                        // Update hidden input field with JSON array
                        document.getElementById('rowData').value = JSON.stringify(rowDataArray);

                        // Increment row number
                        document.getElementById('itemTot').innerText = rowNum;
                        rowNum++;

                        // Clear input fields
                        document.getElementById('ItemCode').value = '';
                        document.getElementById('ItemName').value = '';
                        document.getElementById('serialNo').value = '';
                        document.getElementById('CostPrice').value = '';
                        document.getElementById('TotalPrice').value = '';
                        document.getElementById('SellingPrice').value = '';
                        document.getElementById('DiscountType').value = '0';
                        document.getElementById('Discount').value = '0';
                        document.getElementById('Price').value = '0';
                    }

                    // Function to calculate total purchase amount
                    function calculatePurchaseTotal() {
                        let total = 0;
                        // Iterate through each row in the table
                        document.querySelectorAll('#purchTableBody tr').forEach(row => {
                            // Get the total price from the row and add it to the total
                            const totalPrice = parseFloat(row.cells[4].textContent);
                            if (!isNaN(totalPrice)) {
                                total += totalPrice;
                            }
                        });
                        let totalPayablePrice = 0;
                        document.querySelectorAll('#purchTableBody tr').forEach(row => {
                            // Get the total price from the row and add it to the total
                            const PayablePrice = parseFloat(row.cells[6].textContent);
                            if (!isNaN(PayablePrice)) {
                                totalPayablePrice += PayablePrice;
                            }
                        });
                        let totalDiscountPriceBill = total - totalPayablePrice;
                        // Update the purchTot label with the total amount
                        document.getElementById('purchTot').textContent = total.toFixed(2);
                        document.getElementById('purchTotal').value = total.toFixed(2);

                        document.getElementById('PaybleBillAmount').textContent = totalPayablePrice
                            .toFixed(2);
                        document.getElementById('PaybleBillAmount1').textContent = totalPayablePrice
                            .toFixed(2);
                        document.getElementById('PaybleBillAmountSend').value = totalPayablePrice
                            .toFixed(2);

                        document.getElementById('TotalDiscount').textContent =
                            totalDiscountPriceBill
                            .toFixed(2);
                        document.getElementById('TotalDiscount1').textContent =
                            totalDiscountPriceBill
                            .toFixed(2);
                        document.getElementById('TotalDiscountSend').value = totalDiscountPriceBill
                            .toFixed(2);

                    }

                    // Call calculatePurchaseTotal initially to calculate the initial total
                    calculatePurchaseTotal();

                    // Function to remove a row from the table
                    function removeRow(button, rowIndex) {
                        // Traverse up to the row and remove it
                        const row = button.closest('tr');
                        row.remove();

                        // Remove the corresponding row from the rowDataArray
                        rowDataArray.splice(rowIndex, 1);

                        // Update hidden input field with updated JSON array
                        document.getElementById('rowData').value = JSON.stringify(rowDataArray);
                        calculatePurchaseTotal();

                        // Decrement row number and update the itemTot span
                        rowNum--;
                        document.getElementById('itemTot').innerText = rowDataArray.length;
                    }

                    // Event listener for the "Add" button
                    document.getElementById('addPurch').addEventListener('click', function() {
                        addRow();
                        calculatePurchaseTotal();
                    });
                    </script>
                    <script>
                    // Event listener for keydown event on the document
                    document.addEventListener('keydown', function(event) {
                        // Check if the key combination is CTRL+ENTER (keyCode for Enter is 13)
                        if (event.ctrlKey && event.keyCode === 13) {
                            // Submit the form
                            document.querySelector('form').submit();
                        }
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div> <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"></span>
            <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2024. All
                rights reserved.</span>
        </div>
    </footer>
    <!-- partial -->

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/dashboard.js"></script>
    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
</body>

</html>
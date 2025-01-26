<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$billNo = $_REQUEST['billNo'];

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
    $message = "Successfully Transfered Item(s).";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $count = 1;
}
if ($alert == 2 && $count == 0) {
    $message = "No item(s) selected to transfer.";
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

    <!-- Custom CSS -->
    <style>
    #myInput {
        background-image: url('/css/searchicon.png');
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;

    }

    th,
    td {
        padding: 1px 8px;
        text-align: left;
    }

    .noBorder {
        text-align: center;
        border-top: 1px solid white;
        border-left: 1px solid white;
    }

    .our-info {
        display: none;
    }
    </style>
</head>

<body class="with-welcome-text">
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
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
                            <a href="MAProfile.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>"
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
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="MAIndex.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="mdi mdi-truck menu-icon"></i>
                            <span class="menu-title">Transfer Items</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="MAReceiveItems.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="mdi mdi-archive menu-icon"></i>
                            <span class="menu-title">Receive Items</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="MAStock.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="menu-icon mdi mdi-chart-line"></i>
                            <span class="menu-title">Stock</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="MABills.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="menu-icon fa fa-folder-o"></i>
                            <span class="menu-title">Bills</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="MAPurchaseHistory.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="fa fa-book menu-icon"></i>
                            <span class="menu-title">Purchase History</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="MACancelBill.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="fa fa-file-excel-o menu-icon"></i>
                            <span class="menu-title">Cancel Bill</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="MACancelPurchase.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="fa fa-cubes menu-icon"></i>
                            <span class="menu-title">Cancel Purchase</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="MAReorder.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="menu-icon fa fa-retweet"></i>
                            <span class="menu-title">Re-Order Level</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="MARecieve.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="menu-icon fa fa-external-link"></i>
                            <span class="menu-title">Recieve</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="MAProfile.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i>
                            <span class="menu-title">My Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.html">
                            <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>
                            <span class="menu-title">Sign Out</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">

                        <div class="col-lg-12 grid-margin stretch-card" id="billContent">
                            <div class="card">
                                <div class="card-body">
                                    <div style="text-align: center;">
                                        <img style="width:100%; margin:0; padding:0;" src="assets/images/bill_head.jpg"
                                            alt="InfoWorld Computer Solution">
                                    </div>
                                    <div class="table-responsive pt-3">
                                        <table cellspacing="0">
                                            <?php
                                                $sel_customer = "SELECT Cashier,DATE(timespam),customerID from bill_head where billNo='".$billNo."' and BillingBranch='".$branchCode."' ";
                                                $run_customer = mysqli_query($con,$sel_customer);
                                                $row_customer = mysqli_fetch_assoc($run_customer);
                                                $invoiceCashier = $row_customer['Cashier'];
                                                $invoiceDate = $row_customer['DATE(timespam)'];
                                                $invoicecustomerID = $row_customer['customerID'];

                                                $sel_customerD = "SELECT * from customer where id='".$invoicecustomerID."'";
                                                $run_customerD = mysqli_query($con,$sel_customerD);
                                                $row_customerD = mysqli_fetch_assoc($run_customerD);

                                                $invoicename = $row_customerD['name'];
                                                $invoicemobile = $row_customerD['mobile'];
                                                $invoiceaddress = $row_customerD['address'];
                                            ?>
                                            <tr>
                                                <td class="noBorder" colspan="4" rowspan="2"><b>INVOICE</b></td>
                                                <td colspan="2">INVOICE NO</td>
                                                <td><?php echo $billNo; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">INVOICE DATE</td>
                                                <td><?php echo $invoiceDate; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">CONTACT NO</td>
                                                <td colspan="2"><?php echo $invoicemobile; ?></td>

                                                <td colspan="2">DUE DATE</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">CUSTOMER NAME</td>
                                                <td colspan="2"><?php echo $invoicename; ?></td>
                                                <td colspan="2">P.O. NO</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">CUSTOMER ADDRESS</td>
                                                <td colspan="2"><?php echo $invoiceaddress; ?></td>
                                                <td colspan="2">SALES PERSON</td>
                                                <td><?php echo $invoiceCashier; ?></td>
                                            </tr>
                                        </table>
                                        <table class="table table-hover" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th> NO </th>
                                                    <th colspan="2"> DESCRIPTION </th>
                                                    <th> SERIAL NO </th>
                                                    <th> QTY </th>
                                                    <th> RATE </th>
                                                    <th> AMOUNT (Rs.) </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $count = 1;
                                                    $sel_query12 = "SELECT bill_data.BillingBranch,bill_data.billNo,bill_data.ItemCode,bill_data.serialNo,bill_data.TotalPrice,bill_data.SellingPrice,bill_data.Discount,bill_data.Price,items.itemName FROM bill_data,items where  items.itemCode=bill_data.ItemCode and BillingBranch='".$branchCode."' and billNo='".$billNo."'";
                                                    $result12 = mysqli_query($con, $sel_query12);
                                                    while ($row = mysqli_fetch_assoc($result12)) {
                                                        $seriao_no = $row["serialNo"]; 
                                                        $Warranty = '';
                                                        if ($seriao_no != ''){
                                                            $sel_warrenty = "select * from serial_no where serialNo='".$seriao_no."'";
                                                            $run_sel_warrenty = mysqli_query($con, $sel_warrenty);
                                                            $rowsel_warrenty = mysqli_fetch_assoc($run_sel_warrenty);
                                                            $Warranty = $rowsel_warrenty["Warranty"];
                                                            if ($Warranty == '1m') {
                                                                $Warranty = "(1 Month Warranty)";
                                                            } else if ($Warranty == '2m') {
                                                                $Warranty = "(2 Month Warranty)";
                                                            } else if ($Warranty == '3m') {
                                                                $Warranty = "(3 Month Warranty)"; 
                                                            } else if ($Warranty == '4m') {
                                                                $Warranty = "(4 Month Warranty)";
                                                            } else if ($Warranty == '5m') {
                                                                $Warranty = "(5 Month Warranty)";
                                                            } else if ($Warranty == '6m') {
                                                                $Warranty = "(6 Month Warranty)";
                                                            } else if ($Warranty == '1y') {
                                                                $Warranty = "(1 Year Warranty)";
                                                            } else if ($Warranty == '2y') {
                                                                $Warranty = "(2 Year Warranty)";
                                                            } else if ($Warranty == '3y') {
                                                                $Warranty = "(3 Year Warranty)";
                                                            } else if ($Warranty == '4y') {
                                                                $Warranty = "(4 Year Warranty)";
                                                            } else if ($Warranty == '5y') {
                                                                $Warranty = "(5 Year Warranty)";
                                                            } else if ($Warranty == '1mt') {
                                                                $Warranty = "(1 Month Test Warranty)";
                                                            } else if ($Warranty == '1bt') {
                                                                $Warranty = "(1 Year Warranty for Battery)";
                                                            } else if ($Warranty == '1mb') {
                                                                $Warranty = "(2 Year Warranty for Mother Board)";
                                                            }
                                                        } else {
                                                            $seriao_no = '(No Serial)';
                                                        }
                                                ?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td colspan="2">
                                                        <?php echo $row["itemName"]; ?><br><?php echo $Warranty; ?></td>
                                                    <td><?php echo $seriao_no; ?></td>
                                                    <td>1</td>
                                                    <td><?php echo $row["TotalPrice"]; ?></td>
                                                    <td><?php echo $row["Price"]; ?></td>
                                                </tr>
                                                <?php $count++; } ?>

                                                <?php
                                                    $sel_query122 = "SELECT * FROM bill_head where  BillingBranch='".$branchCode."' and billNo='".$billNo."'";
                                                    $result122 = mysqli_query($con, $sel_query122);
                                                    $row2 = mysqli_fetch_assoc($result122);
                                                    $cusBallence = $row2['cusBallence'];
                                                    if ($cusBallence >= 0) {
                                                        $cusBallence = "Cash";
                                                    } else {
                                                        $cusBallence = "Credit: Paid - Rs.".$row2['custPaid'];
                                                    }
                                                ?>
                                                <tr>
                                                    <td style="text-align:center;" colspan=6><b>GRAND TOTAL
                                                            (<?php echo $cusBallence; ?>)</b></td>
                                                    <td style="text-align:center;"> <b>Rs.
                                                            <?php echo number_format($row2['billTotal'],2); ?></b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table cellspacing="0">
                                            <tr>
                                                <td>TERMS & CONDITIONS</td>
                                                <td>
                                                    <ul style="list-style-type: '🔹 '; font-size:10px;">
                                                        <li>Please submit the <b> Original Invoice</b> for warranty
                                                            claims.</li>
                                                        <li>Warranty period is one year less than 14 working days</li>
                                                        <li>Good once sold are not refundable</li>
                                                        <li>No warranty Keyboard, Mouse, Speakers, Cartridges, Toners,
                                                            Ribbons, Printer
                                                            Heads & all other consumable items.</li>
                                                        <li>Warranty covers <b> only Manufacture Defects</b>: Software &
                                                            Virus issues,
                                                            Damages or defects or due to other causes such as corrosion,
                                                            insects,
                                                            negligence, misuse, improper operations, power fluctuation,
                                                            lightening or other
                                                            natural disaster. Sabotage or accidents etc are <b>NOT</b>
                                                            included under this
                                                            warranty.</li>
                                                        <li>The customer bound to protect all the <b> serial & warranty
                                                                stickers</b> for any
                                                            warranty claims. If not, <b> no </b>warranty claims will be
                                                            issued for such
                                                            items, even if the original invoice were produced or even
                                                            the item is within the
                                                            warranty period</li>
                                                        <li>Repair or replacements necessitated by such causes not
                                                            covered by the warranty
                                                            are subject to changes for labor, time & material. Warranty
                                                            replacement would be
                                                            provided with available technology, if identical replacement
                                                            is not available.
                                                        </li>
                                                        <li>InfoWorld Computer Solution is <b>not liable</b> or bounds
                                                            to provide any <b> On
                                                                Site Services</b> unless specified in the Quotation /
                                                            Maintenance Agreement
                                                            or in the Original Invoice. The customer bound to carry in
                                                            any items at his /
                                                            hers own expenses for such warranty claims / repairs or
                                                            services.</li>
                                                        <li>The customer bound with iWorld to pay above balance within
                                                            one week.</li>
                                                        <li>All payments can be made through cash or cheque & cheque to
                                                            be drawn in favor of
                                                            <b>InfoWorld Computer Solution. “A/C Payee Only”</b>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2></td>
                                            </tr>
                                        </table>
                                        <div class="our-info"
                                            style="text-align: center; position:absolute;bottom:0px; width:100%;">
                                            <hr>
                                            <h5 style="margin:0">Focus Solution (PVT) LTD</h5>
                                            <h5 style="margin:0">Contact: 074 043 0551</h5>
                                        </div>

                                        <script type="text/javascript">
                                        function printAndRedirect() {

                                            var divToPrint = document.getElementById('billContent');
                                            var inputs = divToPrint.querySelectorAll('input[type="text"]');
                                            inputs.forEach(function(input) {
                                                var span = document.createElement('span');
                                                span.innerText = input.value;
                                                input.parentNode.replaceChild(span, input);
                                            });
                                            var newWin = window.open('', 'Print-Window');
                                            newWin.document.open();
                                            newWin.document.write(
                                                '<html><head><style>@media print { table, th, td {padding:1px 8px; border: 1px solid black; border-collapse: collapse;} table{width:100%;} .noBorder { text-align:center; border-top:1px solid white; border-left:1px solid white; }  }</style></head><body onload="window.print();">' +
                                                divToPrint.innerHTML + '</body></html>');
                                            newWin.document.close();
                                            setTimeout(function() {
                                                newWin.close();

                                            }, 1000); // Adjust the delay as needed
                                        }
                                        </script>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <button style="text-align:center; width:100%;" class="btn btn-primary"
                            onclick="printAndRedirect()">Print The
                            Bill</button>

                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"></span>
                        <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2024. All
                            rights reserved.</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
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
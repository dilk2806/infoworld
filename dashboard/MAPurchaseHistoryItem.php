<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$PurchesNo = $_REQUEST['PurchesNo'];

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

    .our-info{
        display:none;
    }

    .tableOverflow{
        overflow-y: auto; 
        max-height: 500px;
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
                        <a class="nav-link" href="MAPurchaseHistory.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
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
                                    <div style="display:flex; align-item:center; justify-content: center;">
                                        <h4 class="card-title" >Purchase Registry</h4>
                                    </div>

                                    <div class="table-responsive pt-3">
                                        <div class="row">
                                            <div class="col-lg-6" style="float:left;">
                                                <?php
                                                    $sel_purch_head = "SELECT * from purch_head where PurchesNo='".$PurchesNo."' and branchCode='".$branchCode."'";
                                                    $run_purch_head = mysqli_query($con, $sel_purch_head);
                                                    $row_purch_head = mysqli_fetch_assoc($run_purch_head);

                                                    $SuplierCode = $row_purch_head['SuplierCode'];
                                                    $sel_supplier = "SELECT * from suplier where SuplierCode='".$SuplierCode."'";
                                                    $run_supplier = mysqli_query($con, $sel_supplier);
                                                    $run_supplier = mysqli_fetch_assoc($run_supplier);
                                                ?>
                                                <h5>Purchase No: <?php echo $PurchesNo; ?></h5>
                                                <h5>Purchase Officer: <?php echo $row_purch_head['purchOfficer']; ?>
                                                </h5>
                                                <h5>Supplier Name: <?php echo $run_supplier['SuplierName']; ?></h5>
                                            </div>
                                            <div class="col-lg-6 text-lg-right" style="float:right;">
                                                <h5>Invoice No.:
                                                    <?php echo $row_purch_head['InvoiceNo'];?></h5>
                                                <h5>Total Amount:
                                                    <?php echo $row_purch_head['purchTot']; ?></h5>
                                                <h5>Date & Time:
                                                    <?php echo $row_purch_head['timeSpan']; ?></h5>
                                            </div>
                                        </div>
                                        <div class="tableOverflow" style="clear:both;">
                                            <table class="table table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Item Code</th>
                                                        <th>Item Name</th>
                                                        <th>QTY</th>
                                                        <th>Cost Price</th>
                                                        <th>Total Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    $sel_query12 = "SELECT * FROM purch_data,items WHERE purch_data.PurchesNo='".$PurchesNo."' and purch_data.branchCode='".$branchCode."' and purch_data.itemCode=items.itemCode";
                                                    $result12 = mysqli_query($con, $sel_query12);
                                                    while ($row = mysqli_fetch_assoc($result12)) {
                                                        $sel_serialNo = "SELECT serialNo,Warranty from serial_no where PurchesNo='".$PurchesNo."' and branchCode='".$branchCode."' and itemCode='".$row["itemCode"]."'";
                                                        $run_serialNo = mysqli_query($con, $sel_serialNo);
                                                        
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $count; ?></th>
                                                        <td><?php echo $row["itemCode"]; ?></td>
                                                        <td><?php echo $row["itemName"]; ?></td>
                                                        <td><?php echo $row["qty"]; ?></td>
                                                        <td><?php echo $row["costPrice"]; ?></td>
                                                        <td><?php echo $row["totalPrice"]; ?></td>
                                                    </tr>
                                                    <?php
                                                        while ($row_serialNo = mysqli_fetch_assoc($run_serialNo)) {
                                                            $Warranty = $row_serialNo["Warranty"];
                                                            if ($Warranty == '1m') {
                                                                $Warranty = "One Month Warranty";
                                                            } else if ($Warranty == '2m') {
                                                                $Warranty = "Two Month Warranty";
                                                            } else if ($Warranty == '3m') {
                                                                $Warranty = "Three Month Warranty"; 
                                                            } else if ($Warranty == '4m') {
                                                                $Warranty = "Fore Month Warranty";
                                                            } else if ($Warranty == '5m') {
                                                                $Warranty = "Five Month Warranty";
                                                            } else if ($Warranty == '6m') {
                                                                $Warranty = "Six Month Warranty";
                                                            } else if ($Warranty == '1y') {
                                                                $Warranty = "One Year Warranty";
                                                            } else if ($Warranty == '2y') {
                                                                $Warranty = "Two Year Warranty";
                                                            } else if ($Warranty == '3y') {
                                                                $Warranty = "Three Year Warranty";
                                                            } else if ($Warranty == '4y') {
                                                                $Warranty = "Fore Year Warranty";
                                                            } else if ($Warranty == '5y') {
                                                                $Warranty = "Five Year Warranty";
                                                            } else if ($Warranty == '1mt') {
                                                                $Warranty = "One Month Test Warranty";
                                                            } else if ($Warranty == '1bt') {
                                                                $Warranty = "One Year Warranty for Battery";
                                                            } else if ($Warranty == '1mb') {
                                                                $Warranty = "Two Year Warranty for Mother Board";
                                                            }
                                                    ?>
                                                    <tr>
                                                        <th scope="row"></th>
                                                        <th scope="row"></th>
                                                        <td colspan="4">◼ Serial No:
                                                            <?php echo $row_serialNo["serialNo"]; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $Warranty; ?></td>
                                                    </tr>
                                                    <?php } $count++; } ?>
                                                </tbody>
                                            </table>
                                            <div class="our-info"
                                                style="text-align: center; position:absolute;bottom:0px; width:100%;">
                                                <hr>
                                                <h5 style="margin:0">Focus Solution (PVT) LTD</h5>
                                                <h5 style="margin:0">Contact: 074 043 0551</h5>
                                            </div>
                                        </div>
                                        <script>
                                        function myFunction() {
                                            var input, filter, table, tr, td, i, j, txtValue;
                                            input = document.getElementById("myInput");
                                            filter = input.value.toUpperCase();
                                            table = document.getElementById("myTable");
                                            tr = table.getElementsByTagName("tr");
                                            for (i = 0; i < tr.length; i++) {
                                                // Loop through all cells in the current row
                                                for (j = 0; j < tr[i].cells.length; j++) {
                                                    td = tr[i].cells[j];
                                                    if (td) {
                                                        txtValue = td.textContent || td.innerText;
                                                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                                            tr[i].style.display = "";
                                                            break; // Break out of the inner loop, no need to check other cells in this row
                                                        } else {
                                                            tr[i].style.display = "none";
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button style="text-align:center; width:50%;" class="btn btn-primary"
                                onclick="printAndRedirect()">Print The
                                Purchase Registry</button>
                            <script>
                            function printAndRedirect() {

                                var divToPrint = document.getElementById('billContent');

                                var newWin = window.open('', 'Print-Window');
                                newWin.document.open();
                                newWin.document.write(
                                    '<html><head><style> table{width:100%;} </style></head><body onload="window.print();">' +
                                    divToPrint.innerHTML + '</body></html>');
                                newWin.document.close();
                                setTimeout(function() {
                                    newWin.close();
                                    window.location.reload(); // Refresh the page to restore the inputs

                                }, 1000); // Adjust the delay as needed
                            }

                            document.getElementById('addRowBtn').addEventListener('click', function() {
                                // Get the table body element
                                var tableBody = document.getElementById('myTable').getElementsByTagName(
                                    'tbody')[0];

                                // Create a new row
                                var newRow = tableBody.insertRow();

                                // Create and insert cells into the new row
                                for (var i = 0; i < 6; i++) {
                                    var newCell = newRow.insertCell(i);
                                    // Create an input element
                                    var input = document.createElement('input');
                                    input.type = 'text';
                                    // Optionally set a default value
                                    newCell.appendChild(input);
                                }
                            });
                            </script>
                        </div>

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
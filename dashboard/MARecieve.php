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
if ($alert == 3 && $count == 0) {
    $message = "RMA Note Added Successful.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $count = 1;
}
if ($alert == 4 && $count == 0) {
    $message = "Status Changed Successful.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $count = 1;
}
if ($alert == 5 && $count == 0) {
    $message = "Tried to Add Empty Data.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $count = 1;
}
if ($alert == 6 && $count == 0) {
    $message = "RMA Note Issued Successful.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $count = 1;
}

$fromDate = isset($_REQUEST['fromDate']) ? $_REQUEST['fromDate'] : null;
$toDate = isset($_REQUEST['toDate']) ? $_REQUEST['toDate'] : null;

$today = date("Y-m-d");
if ($fromDate == "" && $toDate == ""){
    $fromDate = $today;
    $toDate = $today;
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

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Recieved Item Status</h4>
                                    <form id="filterForm" action="MARecieve.php" method="POST">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="FromDate">From:</label>
                                                <input type="date" name="FromDate" class="form-control" id="FromDate"
                                                    placeholder="From" required value="<?php echo $fromDate; ?>">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="ToDate">To:</label>
                                                <input type="date" name="ToDate" class="form-control" id="ToDate"
                                                    placeholder="To" required value="<?php echo $toDate; ?>">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                                        <button type="reset" class="btn btn-light">Cancel</button>
                                    </form>
                                    <script>
                                    // JavaScript to update form action with input values
                                    document.getElementById('filterForm').addEventListener('submit', function(e) {
                                        e.preventDefault(); // Prevent form submission
                                        var fromDate = document.getElementById('FromDate').value;
                                        var toDate = document.getElementById('ToDate').value;
                                        var lid =
                                            '<?php echo $lid; ?>'; // Assuming $lid and $home are PHP variables
                                        var home = '<?php echo $home; ?>';
                                        var actionUrl = 'MARecieve.php?lid=' + encodeURIComponent(lid) +
                                            '&home=' + encodeURIComponent(home) + '&fromDate=' +
                                            encodeURIComponent(fromDate) + '&toDate=' + encodeURIComponent(
                                                toDate);
                                        this.action = actionUrl; // Update form action
                                        this.submit(); // Submit the form
                                    });
                                    </script>

                                    <div class="table-responsive pt-3">
                                        <input type="text" id="myInput" onkeyup="myFunction()"
                                            placeholder="Search for names.." title="Type in a name">
                                        <div style="overflow-y: auto; max-height: 500px;">
                                            <table class="table table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Customer Name</th>
                                                        <th>Customer Mobile</th>
                                                        <th>Job No</th>
                                                        <th>Item Code</th>
                                                        <th>Serial No.</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    $sel_query12 = "SELECT * FROM retun_items_data WHERE status!=0 and branchCode='".$branchCode."' and comeDate>='".$fromDate."' AND comeDate<='".$toDate."' or sendDate>='".$fromDate."' AND sendDate<='".$toDate."' or recieveDate>='".$fromDate."' AND recieveDate<='".$toDate."' or issueDate>='".$fromDate."' AND issueDate<='".$toDate."' order by status ASC ";
                                                    $result12 = mysqli_query($con, $sel_query12);
                                                    while ($row = mysqli_fetch_assoc($result12)) {
                                                        $customerId = $row["custId"];

                                                        $sel_cust = "SELECT * from customer where id='".$customerId."'";
                                                        $run_cust = mysqli_query($con, $sel_cust);
                                                        $row_cust = mysqli_fetch_assoc($run_cust);
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $count; ?></th>
                                                        <td><?php echo $row_cust["name"]; ?></td>
                                                        <td><?php echo $row_cust["mobile"]; ?></td>
                                                        <td><?php echo $row["returnNo"]; ?></td>
                                                        <td><?php echo $row["itemCode"]; ?></td>
                                                        <td><?php echo $row["serialNo"]; ?></td>
                                                        <td>
                                                            <?php 
                                                        $serialST = $row["status"]; 
                                                        if ($serialST == 1){
                                                            echo "<label class='badge badge-danger'>Recieve from Customer</label>";
                                                        } else if ($serialST == 2){
                                                            echo "<label class='badge badge-info'>Send</label>";
                                                        } else if ($serialST == 3){
                                                            echo "<label class='badge badge-warning'>Recieve To Branch</label>";
                                                        }else if ($serialST == 4){
                                                            echo "<label class='badge badge-success'>Issued</label>";
                                                        }
                                                        ?>
                                                        </td>
                                                        <?php 
                                                        if($serialST == 1){
                                                            $serailDate = $row["comeDate"];
                                                            $class = "btn-danger";
                                                        } else if ($serialST == 2){
                                                            $serailDate = $row["sendDate"];
                                                            $class = "btn-info";
                                                        } else if ($serialST == 3){
                                                            $serailDate = $row["recieveDate"];
                                                            $class = "btn-primary";
                                                        } else if ($serialST == 4){
                                                            $serailDate = $row["issueDate"];
                                                            $class = "btn-success";
                                                        } ?>
                                                        <td><?php echo $serailDate; ?></td>
                                                    </tr>
                                                    <?php $count++; } ?>
                                                </tbody>
                                            </table>
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

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Change Recieved Item Status</h4>

                                    <div class="table-responsive pt-3">
                                        <div style="overflow-y: auto; max-height: 500px;">
                                            <table class="table table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Customer Name</th>
                                                        <th>Customer Mobile</th>
                                                        <th>Job No</th>
                                                        <th>Item Code</th>
                                                        <th>Serial No.</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    $sel_query12 = "SELECT * FROM retun_items_data WHERE status!=4 and status!=0 and branchCode='".$branchCode."' order by status ASC ";
                                                    $result12 = mysqli_query($con, $sel_query12);
                                                    while ($row = mysqli_fetch_assoc($result12)) {
                                                        $customerId = $row["custId"];

                                                        $sel_cust = "SELECT * from customer where id='".$customerId."'";
                                                        $run_cust = mysqli_query($con, $sel_cust);
                                                        $row_cust = mysqli_fetch_assoc($run_cust);
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $count; ?></th>
                                                        <td><?php echo $row_cust["name"]; ?></td>
                                                        <td><?php echo $row_cust["mobile"]; ?></td>
                                                        <td><?php echo $row["returnNo"]; ?></td>
                                                        <td><?php echo $row["itemCode"]; ?></td>
                                                        <td><?php echo $row["serialNo"]; ?></td>
                                                        <td>
                                                            <?php $serialST = $row["status"]; if($serialST == 1){ ?>
                                                            <a class="btn btn-info btn-sm"
                                                                href="MAchangeSTSend.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>&returnNo=<?php echo $row["returnNo"]; ?>&itemCode=<?php echo $row["itemCode"]; ?>">Send</a>
                                                            <?php } else if ($serialST == 2){ ?>
                                                            <a class="btn btn-warning btn-sm"
                                                                href="MAchangeSTRecieve.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>&returnNo=<?php echo $row["returnNo"]; ?>&itemCode=<?php echo $row["itemCode"]; ?>&done=0">Recieve</a>
                                                            <?php } else if ($serialST == 3){ ?>
                                                            <a class="btn btn-success btn-sm"
                                                                href="MAchangeSTIssue.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>&returnNo=<?php echo $row["returnNo"]; ?>&itemCode=<?php echo $row["itemCode"]; ?>">Issue</a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <?php $count++; } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 grid-margin stretch-card" style="display:none;">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add Recieved Item</h4>
                                    <form
                                        action="MAAddRecievedItem.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>"
                                        method="POST" class="forms-sample">
                                        <div class="row">

                                            <div class="form-group col-4">
                                                <?php
                                                $sel_jobNo = "SELECT returnNo from branches where branchCode='".$branchCode."'";
                                                $run_jobNo = mysqli_query($con,$sel_jobNo);
                                                $row_jobNo = mysqli_fetch_assoc($run_jobNo);
                                                $jobNo = $row_jobNo['returnNo']+1;
                                                ?>
                                                <label for="jobNo">Job No.</label>
                                                <input type="text" name="jobNo" class="form-control" id="jobNo"
                                                    placeholder="Job No" value="<?php echo $jobNo; ?>" required
                                                    readonly>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="technicalOfficer">Technical Officer</label>
                                                <input type="text" name="technicalOfficer" class="form-control"
                                                    id="technicalOfficer" placeholder="Technical Officer"
                                                    value="<?php echo $lid; ?>" required readonly>
                                            </div>

                                            <div class="form-group col-4">
                                                <?php $today = date("Y-m-d"); ?>
                                                <label for="recievedDate">Recived Date</label>
                                                <input type="date" name="recievedDate" class="form-control"
                                                    id="recievedDate" value="<?php echo $today; ?>" required>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="customerMobile">Customer Mobile</label>
                                                <input type="text" name="customerMobile" class="form-control"
                                                    id="customerMobile" placeholder="Customer Mobile"
                                                    list="customerList" required>
                                                <input type="hidden" name="customerId" id="customerId"
                                                    style="display:none;">
                                                <datalist id="customerList">
                                                    <?php
                                                        $select_catCode1 = "SELECT * from customer";
                                                        $run_catCode1 = mysqli_query($con,$select_catCode1);
                                                        while($row1 = mysqli_fetch_assoc($run_catCode1)){ 
                                                    ?>
                                                    <option value="<?php echo $row1['mobile'];?>"
                                                        data-name="<?php echo $row1['name'];?>"
                                                        data-id="<?php echo $row1['id'];?>"
                                                        data-address="<?php echo $row1['address'] ?>">
                                                        <?php echo $row1['name'];?>
                                                    </option>
                                                    <?php } ?>
                                                </datalist>
                                            </div>
                                            <script>
                                            document.getElementById('customerMobile').addEventListener('input',
                                                function() {
                                                    var customerMobile = this.value;
                                                    var options = document.getElementById('customerList')
                                                        .childNodes;
                                                    var optionsList = document.getElementById('customerList')
                                                        .options;
                                                    var isSelected = false;

                                                    // Check if the entered value matches any option in the datalist
                                                    for (var i = 0; i < optionsList.length; i++) {
                                                        if (optionsList[i].value === customerMobile) {
                                                            isSelected = true;
                                                            break;
                                                        }
                                                    }

                                                    // If an option is selected, do something
                                                    if (isSelected) {
                                                        for (var i = 0; i < options.length; i++) {
                                                            if (options[i].value === customerMobile) {
                                                                document.getElementById('customerName').value =
                                                                    options[
                                                                        i].getAttribute('data-name');
                                                                document.getElementById('customerAddress').value =
                                                                    options[i].getAttribute('data-address');
                                                                document.getElementById('customerId').value =
                                                                    options[i].getAttribute('data-id');

                                                                break;
                                                            }
                                                        }
                                                    }
                                                });
                                            </script>

                                            <div class="form-group col-4">
                                                <label for="customerName">Customer Name</label>
                                                <input type="text" name="customerName" class="form-control"
                                                    id="customerName" placeholder="Customer Name"
                                                    list="customerListName" required>
                                                <datalist id="customerListName">
                                                    <?php
                                                        $select_catCode1 = "SELECT * from customer";
                                                        $run_catCode1 = mysqli_query($con,$select_catCode1);
                                                        while($row1 = mysqli_fetch_assoc($run_catCode1)){ 
                                                    ?>
                                                    <option value="<?php echo $row1['name'];?>"
                                                        data-mobile="<?php echo $row1['mobile'];?>"
                                                        data-id="<?php echo $row1['id'];?>"
                                                        data-address="<?php echo $row1['address'] ?>">
                                                        <?php echo $row1['mobile'];?>
                                                    </option>
                                                    <?php } ?>
                                                </datalist>
                                            </div>
                                            <script>
                                            document.getElementById('customerName').addEventListener('input',
                                                function() {
                                                    var customerName = this
                                                        .value; // Changed variable name for clarity
                                                    var options = document.getElementById('customerListName')
                                                        .childNodes;
                                                    var optionsList = document.getElementById('customerListName')
                                                        .options;
                                                    var isSelected = false;

                                                    // Check if the entered value matches any option in the datalist
                                                    for (var i = 0; i < optionsList.length; i++) {
                                                        if (optionsList[i].value === customerName) {
                                                            isSelected = true;
                                                            break;
                                                        }
                                                    }

                                                    // If an option is selected, update the fields
                                                    if (isSelected) {
                                                        for (var i = 0; i < options.length; i++) {
                                                            if (options[i].value === customerName) {
                                                                document.getElementById('customerAddress').value =
                                                                    options[i].getAttribute('data-address');
                                                                document.getElementById('customerId').value =
                                                                    options[i].getAttribute('data-id');
                                                                document.getElementById('customerMobile').value =
                                                                    options[i].getAttribute('data-mobile');
                                                                break;
                                                            }
                                                        }
                                                    }
                                                });
                                            </script>

                                            <div class="form-group col-4">
                                                <label for="customerAddress">Customer Address</label>
                                                <input type="text" name="customerAddress" class="form-control"
                                                    id="customerAddress" placeholder="Customer Address" required>
                                            </div>

                                            <div class="col-md-4 form-group">
                                                <label for="PurchesNo">Item Code</label>
                                                <input type="text" name="ItemCode" id="ItemCode" class="form-control"
                                                    list="exampleList">
                                                <datalist id="exampleList">
                                                    <?php
                                                        $select_catCode1 = "SELECT stock.qty,stock.itemCode,items.itemName,items.costPrice,items.sellingPrice from stock,items where stock.itemCode=items.itemCode and branchCode='".$branchCode."' ORDER BY itemCode ASC";
                                                        $run_catCode1 = mysqli_query($con,$select_catCode1);
                                                        while($row1 = mysqli_fetch_assoc($run_catCode1)){ 
                                                    ?>
                                                    <option value="<?php echo $row1['itemCode'];?>"
                                                        data-name="<?php echo $row1['itemName'];?>">
                                                        <?php echo $row1['itemName'];?>
                                                    </option>
                                                    <!-- 
                                                        data-cost="<?php echo $row1['costPrice'] ?>"
                                                        data-qty="<?php echo $row1['qty'] ?>"
                                                        data-selling="<?php echo $row1['sellingPrice'] ?>"-->
                                                    <?php } ?>
                                                </datalist>
                                            </div>
                                            <script>
                                            document.getElementById('ItemCode').addEventListener('input',
                                                function() {
                                                    var selectedItemi = this.value;
                                                    var optionsi = document.getElementById('exampleList')
                                                        .childNodes;
                                                    var optionsListi = document.getElementById('exampleList')
                                                        .options;
                                                    var isSelectedi = false;

                                                    // Check if the entered value matches any option in the datalist
                                                    for (var i = 0; i < optionsListi.length; i++) {
                                                        if (optionsListi[i].value === selectedItemi) {
                                                            isSelectedi = true;
                                                            break;
                                                        }
                                                    }

                                                    // If an option is selected, do something
                                                    if (isSelectedi) {
                                                        for (var i = 0; i < optionsi.length; i++) {
                                                            if (optionsi[i].value === selectedItemi) {
                                                                document.getElementById('ItemName').value =
                                                                    optionsi[
                                                                        i].getAttribute('data-name');
                                                                // document.getElementById('CostPrice').value =
                                                                //     options[i].getAttribute('data-cost');
                                                                // document.getElementById('SellingPrice').value =
                                                                //     options[i].getAttribute('data-selling');
                                                                // document.getElementById('RealSellingPrice').value =
                                                                //     options[i].getAttribute('data-selling');
                                                                // document.getElementById('availableQTY').value =
                                                                //     options[i].getAttribute('data-qty');

                                                                break;
                                                            }
                                                        }
                                                    }
                                                });
                                            </script>

                                            <div class="col-md-4 form-group">
                                                <label for="ItemName">Item name</label>
                                                <input type="text" name="ItemName" class="form-control" id="ItemName"
                                                    placeholder="Item name">
                                            </div>

                                            <div class="col-md-4 form-group">
                                                <label for="serialNo">Serial No.</label>
                                                <input type="text" id="serialNo" name="serialNo" class="form-control"
                                                    list="serialNoList">
                                                <datalist id="serialNoList">
                                                </datalist>
                                                <!-- Link AJAX -->
                                                <script
                                                    src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
                                                </script>

                                                <script>
                                                $(document).ready(function() {
                                                    $('#ItemCode').on('input', function() {
                                                        var ItemCode = $(this).val();
                                                        var branchCode = '<?php echo $branchCode; ?>';
                                                        console.log("ItemCode:", ItemCode); // Debugging
                                                        console.log("branchCode:",
                                                            branchCode); // Debugging

                                                        $.ajax({
                                                            url: 'select_serial_to_itemR.php',
                                                            method: 'POST',
                                                            data: {
                                                                ItemCode: ItemCode,
                                                                BranchCode: branchCode
                                                            },
                                                            success: function(data) {
                                                                console.log(
                                                                    "AJAX response:",
                                                                    data); // Debugging
                                                                data = data.replace(/'/g,
                                                                    '');
                                                                $('#serialNoList').html(
                                                                    '<option value=""></option>' +
                                                                    data);
                                                            },
                                                            error: function(xhr, status,
                                                                error) {
                                                                console.error("AJAX error:",
                                                                    status,
                                                                    error); // Debugging
                                                            }
                                                        });
                                                    });
                                                });
                                                </script>
                                            </div>

                                            <div class="col-md-12 form-group">
                                                <label for="description">REPAIR / REPLACEMENT & WARRANTY</label>
                                                <input type="text" name="description" class="form-control"
                                                    id="description" placeholder="REPAIR / REPLACEMENT & WARRANTY">
                                            </div>

                                        </div>

                                        <button type="button" id="addPurch" class="btn btn-primary me-2">Add to
                                            RMA NOTE</button>

                                        <input type='button' id='Printbtn' value='Print' onclick='printDiv();'
                                            style="display:none">
                                        <!-- Hidden input fields to store values for PHP arrays -->
                                        <input type="text" name="rowData" style="display:none" id="rowData" required><br>
                                        <!--style="display:none" -->
                                        <div class="table-responsive">

                                            <div id="billContent" style="overflow-y: auto; max-height: 500px;">

                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th> # </th>
                                                            <th> Item name </th>
                                                            <th> Serial No. </th>
                                                            <th> Discription </th>
                                                            <th> </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="purchTableBody">

                                                    </tbody>
                                                </table>

                                                <br><br>
                                                <h2 style="float:right;">Total Item Count: <span id="itemTot">0</span>
                                                </h2>

                                            </div>
                                        </div>

                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <script>
                                        document.getElementById('addPurch').addEventListener('click', function() {
                                            addRow();
                                        });

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
                                            const description = document.getElementById('description').value;

                                            // Create a new row
                                            const newRow = `
                                                <tr>
                                                    <td class="text-center">${rowNum}</td>
                                                    <td class="text-center">${itemName}</td>
                                                    <td class="text-center">${serialNo}</td>
                                                    <td class="text-center">${description}</td>
                                                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, ${rowNum - 1})">x</button></td>
                                                    <td colspan="5">
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
                                                description: description
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
                                            document.getElementById('description').value = '';
                                        }

                                        // Function to remove a row from the table
                                        function removeRow(button, rowIndex) {
                                            // Traverse up to the row and remove it
                                            const row = button.closest('tr');
                                            row.remove();

                                            // Remove the corresponding row from the rowDataArray
                                            rowDataArray.splice(rowIndex, 1);

                                            // Update hidden input field with updated JSON array
                                            document.getElementById('rowData').value = JSON.stringify(rowDataArray);

                                            // Decrement row number and update the itemTot span
                                            rowNum--;
                                            document.getElementById('itemTot').innerText = rowDataArray.length;
                                        }

                                        $(document).ready(function() {

                                            $(window).keydown(function(event) {
                                                if (event.keyCode == 13) {
                                                    event.preventDefault();
                                                    // $('#addPurch').click();
                                                    $('#customerMobile').focus();
                                                    $('#customerMobile').select();
                                                    return false;
                                                }
                                            });
                                            $('#customerMobile').keydown(function(event) {
                                                if (event.keyCode == 13) {
                                                    event.preventDefault();
                                                    // $('#addPurch').click();
                                                    $('#customerName').focus();
                                                    $('#customerName').select();
                                                    return false;
                                                }
                                            });
                                            $('#customerName').keydown(function(event) {
                                                if (event.keyCode == 13) {
                                                    event.preventDefault();
                                                    // $('#addPurch').click();
                                                    $('#customerAddress').focus();
                                                    $('#customerAddress').select();
                                                    return false;
                                                }
                                            });
                                            $('#customerAddress').keydown(function(event) {
                                                if (event.keyCode == 13) {
                                                    event.preventDefault();
                                                    // $('#addPurch').click();
                                                    $('#ItemCode').focus();
                                                    // $('#customerAddress').select();
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
                                                    $('#submitBTN').click();
                                                    // $('#paidAmount').focus();
                                                    return false;
                                                }
                                            });
                                            $('#serialNo').keydown(function(event) {
                                                if (event.keyCode == 13) {
                                                    event.preventDefault();
                                                    // $('#addPurch').click();
                                                    $('#description').focus();
                                                    // $('#customerAddress').select();
                                                    return false;
                                                }
                                            });
                                            $('#description').keydown(function(event) {
                                                if (event.keyCode == 13) {
                                                    event.preventDefault();
                                                    $('#addPurch').click();
                                                    $('#ItemCode').focus();
                                                    // $('#customerAddress').select();
                                                    return false;
                                                }
                                            });
                                        });
                                        </script>
                                        <button type="submit" id="submitBTN" class="btn btn-primary me-2">Add</button>
                                        <button type="reset" class="btn btn-light" onclick="deleteTableBody()">Cancel</button>
                                        <script>
                                            function deleteTableBody(){
                                                document.getElementById('purchTableBody').remove();
                                                document.getElementById('itemTot').innerText = 0;
                                            }
                                        </script>
                                    </form>
                                </div>
                            </div>
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
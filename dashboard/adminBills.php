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
    $message = "Successfully Registered Item.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $count = 1;
}
if ($alert == 2 && $count == 0) {
    $message = "Successfully Registered Catagory.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $count = 1;
}
if ($alert == 3 && $count == 0) {
    $message = "Successfully Registered Brand.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $count = 1;
}
if ($alert == 4 && $count == 0) {
    $itemC = $_REQUEST['itemC'];
    $sel_itemC = "select * from items where itemCode='".$itemC."'";
    $run_itemC = mysqli_query($con,$sel_itemC);
    $row_itemC = mysqli_fetch_assoc($run_itemC);
    $itemCode = $row_itemC['itemCode'];
    $itemName = $row_itemC['itemName'];
    $itemCost = $row_itemC['costPrice'];
    $itemSelling = $row_itemC['sellingPrice'];
    $itemReorder = $row_itemC['reorderLevel'];
    $message = "Item Already Registered.";
    echo "<script type='text/javascript'>alert('$message \\n\\nItem Code: $itemCode \\nItem Name: $itemName \\nCost Price (Rs.): $itemCost \\nSelling Proce (Rs.): $itemSelling \\nRe order Level: $itemReorder');</script>";
    $count = 1;
}
if ($alert == 5 && $count == 0) {
    $message = "Catagory Already Registered.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $count = 1;
}
if ($alert == 6 && $count == 0) {
    $message = "Brand Already Registered.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $count = 1;
}

$fromDate = isset($_REQUEST['fromDate']) ? $_REQUEST['fromDate'] : null;
$toDate = isset($_REQUEST['toDate']) ? $_REQUEST['toDate'] : null;
$selBranch = isset($_REQUEST['selBranch']) ? $_REQUEST['selBranch'] : null;
$Category = isset($_REQUEST['Category']) ? $_REQUEST['Category'] : null;
$Brand = isset($_REQUEST['Brand']) ? $_REQUEST['Brand'] : null;

$today = date("Y-m-d");
if ($fromDate == "" && $toDate == "" ){
    $fromDate = $today;
    $toDate = $today;
}
if($selBranch == ""){
    $selBranch = "All";
}
if($Category == ""){
    $Category = "All";
}
if($Brand == ""){
    $Brand = "All";
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
                        <h5><b><?php echo $ut; ?></b></h5>
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
                                <span class="icon-clock input-group-text ">Time</span>
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
                            <a href="adminProfile.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>"
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
                        <a class="nav-link" href="adminIndex.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Item Registation</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminBranchReg.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="mdi mdi-plus-circle menu-icon"></i>
                            <span class="menu-title">Branch Registation</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="adminSupplierReg.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="mdi mdi-account-group menu-icon"></i>
                            <span class="menu-title">Supplier <br> Registation</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="adminUpdateItem.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="mdi mdi-update menu-icon"></i>
                            <span class="menu-title">Update Items</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminStock.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="menu-icon mdi mdi-chart-line"></i>
                            <span class="menu-title">Stock</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminBills.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="menu-icon fa fa-folder-o"></i>
                            <span class="menu-title">Sales Report</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminReorder.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="menu-icon fa fa-retweet"></i>
                            <span class="menu-title">Re-Order Level</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminRecieve.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="menu-icon fa fa-external-link"></i>
                            <span class="menu-title">Recieve</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminChequeReg.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="menu-icon fa fa-bank"></i>
                            <span class="menu-title">Cheque Registry</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="adminPendingTransfer.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                            <i class="menu-icon fa fa-tags"></i>
                            <span class="menu-title">Pending Transfer <br>Note</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminProfile.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
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
                                    <h4 class="card-title">Branch wise Sales Report</h4><br>
                                    <form id="filterForm" action="adminBills.php" method="POST">
                                        <div class="row">
                                            <div class="col-md-4 form-group">
                                                <label for="FromDate">From:</label>
                                                <input type="date" name="FromDate" class="form-control" id="FromDate"
                                                    placeholder="From" required value="<?php echo $fromDate; ?>">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="ToDate">To:</label>
                                                <input type="date" name="ToDate" class="form-control" id="ToDate"
                                                    placeholder="To" required value="<?php echo $toDate; ?>">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="selBranch">Branch:</label>
                                                <input type="text" name="selBranch" class="form-control" id="selBranch"
                                                    placeholder="Select Branch" value="<?php echo $selBranch; ?>"
                                                    list="BranchList">
                                                <datalist id="BranchList">
                                                    <?php
                                                        $select_catCode1 = "select * from branches  ORDER BY branchCode ASC";
                                                        $run_catCode1 = mysqli_query($con,$select_catCode1);
                                                        while($row1 = mysqli_fetch_assoc($run_catCode1)){ 
                                                    ?>
                                                    <option value="<?php echo $row1['branchCode'];?>">
                                                        <?php echo $row1['branchName'];?>
                                                    </option>
                                                    <?php } ?>
                                                </datalist>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="Category">Category:</label>
                                                <input type="text" name="Category" class="form-control" id="Category"
                                                    placeholder="Select Category" value="<?php echo $Category; ?>"
                                                    list="CategoryList">
                                                <datalist id="CategoryList">
                                                    <?php
                                                        $select_catCode1 = "select * from categories  ORDER BY catCode ASC";
                                                        $run_catCode1 = mysqli_query($con,$select_catCode1);
                                                        while($row1 = mysqli_fetch_assoc($run_catCode1)){ 
                                                    ?>
                                                    <option value="<?php echo $row1['catCode'];?>">
                                                        <?php echo $row1['catName'];?>
                                                    </option>
                                                    <?php } ?>
                                                </datalist>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="Brand">Brand:</label>
                                                <input type="text" name="Brand" class="form-control" id="Brand"
                                                    placeholder="Select Brand" value="<?php echo $Brand; ?>"
                                                    list="BrandList">
                                                <datalist id="BrandList">
                                                    <option value="">All</option>
                                                </datalist>
                                                <script>
                                                $(document).ready(function() {
                                                    $('#Category').on('change', function() {
                                                        var CatagoryCode = $(this).val();
                                                        $.ajax({
                                                            url: 'searchBrandCode.php',
                                                            method: 'POST',
                                                            data: {
                                                                CatagoryCode: CatagoryCode
                                                            },
                                                            success: function(data) {
                                                                data = data.replace(/'/g,
                                                                    '');
                                                                $('#BrandList').html(
                                                                    '<option value="" data-brand=""></option>' +
                                                                    data);
                                                                console.log(data);
                                                            },
                                                            error: function(jqXHR, textStatus,
                                                                errorThrown) {
                                                                console.error('AJAX error:',
                                                                    textStatus,
                                                                    errorThrown
                                                                ); // Debugging statement
                                                            }
                                                        });
                                                    });

                                                });
                                                </script>
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
                                        var selBranch = document.getElementById('selBranch').value;
                                        var Category = document.getElementById('Category').value;
                                        var Brand = document.getElementById('Brand').value;
                                        var lid =
                                            '<?php echo $lid; ?>'; // Assuming $lid and $home are PHP variables
                                        var home = '<?php echo $home; ?>';
                                        var actionUrl = 'adminBills.php?lid=' + encodeURIComponent(lid) +
                                            '&home=' + encodeURIComponent(home) +
                                            '&fromDate=' + encodeURIComponent(fromDate) +
                                            '&toDate=' + encodeURIComponent(toDate) +
                                            '&selBranch=' + encodeURIComponent(selBranch) +
                                            '&Category=' + encodeURIComponent(Category) +
                                            '&Brand=' + encodeURIComponent(Brand);
                                        this.action = actionUrl; // Update form action
                                        this.submit(); // Submit the form
                                    });
                                    </script>
                                </div>
                            </div>
                        </div>

                        <?php
                         if ($selBranch != "All") { 

                                if ($Category != "All"){
                                    if ($Brand != "All"){
                                        $get_branchName = "SELECT branchName from branches where branchCode='".$selBranch."'";
                                        $run_get_branchName = mysqli_query($con,$get_branchName);
                                        $row_get_branchName = mysqli_fetch_assoc($run_get_branchName);
                                        $sel_branchName = $row_get_branchName['branchName'];
                                        // echo $sel_branchName."<br>";

                                        $sel_CategoryName = "SELECT catName from categories where catCode='".$Category."'";
                                        $run_CategoryName = mysqli_query($con,$sel_CategoryName);
                                        $row_CategoryName = mysqli_fetch_assoc($run_CategoryName);
                                        $CategoryName = $row_CategoryName['catName'];
                                        // echo $CategoryName."<br>";

                                        $sel_BrandyName = "SELECT brandName from brand_names where brandCode='".$Brand."'";
                                        $run_BrandName = mysqli_query($con,$sel_BrandyName);
                                        $row_BrandName = mysqli_fetch_assoc($run_BrandName);
                                        $BrandName = $row_BrandName['brandName'];
                                        // echo $BrandName."<br>"; ?>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Sales (Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                        echo "<br>Category: ".$Category;
                                        echo "<br>Brand: ".$Brand;

                                        $sel_totSale = "SELECT SUM(bd.Price) AS totSale 
                                        FROM bill_data bd
                                        JOIN bill_head bh
                                            ON bh.billNo = bd.billNo 
                                            AND bh.BillingBranch = bd.BillingBranch
                                        JOIN items i 
                                            ON bd.ItemCode = i.itemCode
                                        WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                        AND DATE(bh.timespam) <= '" . $toDate . "' 
                                        AND bh.BillingBranch = '" . $selBranch . "' 
                                        AND bh.cansel = 0
                                        AND i.catCode = '" . $Category . "' 
                                        AND i.brandCode = '" . $Brand . "'; ";

                                        $run_totSale = mysqli_query($con, $sel_totSale);
                                        $row_totSale = mysqli_fetch_assoc($run_totSale);
                                        $totSale = $row_totSale['totSale'];
                                        if (is_null($totSale)){
                                            $totSale = 0.00;
                                        } else {
                                            $totSale = number_format($totSale,2, '.', ',');
                                        }

                                    ?></code>
                                    </h4>

                                    <h2 class="text-center"><?php echo $totSale; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Profit (Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                        echo "<br>Category: ".$Category;
                                        echo "<br>Brand: ".$Brand;

                                        $sel_totProfit = "SELECT SUM(bd.profit) AS totProfit
                                        FROM bill_data bd
                                        JOIN bill_head bh
                                            ON bh.billNo = bd.billNo 
                                            AND bh.BillingBranch = bd.BillingBranch
                                        JOIN items i 
                                            ON bd.ItemCode = i.itemCode
                                        WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                        AND DATE(bh.timespam) <= '" . $toDate . "' 
                                        AND bh.BillingBranch = '" . $selBranch . "' 
                                        AND bh.cansel = 0
                                        AND i.catCode = '" . $Category . "' 
                                        AND i.brandCode = '" . $Brand . "'; ";

                                        $run_totProfit = mysqli_query($con, $sel_totProfit);
                                        $row_totProfit = mysqli_fetch_assoc($run_totProfit);
                                        $totProfit = $row_totProfit['totProfit'];
                                        if (is_null($totProfit)){
                                            $totProfit = 0.00;
                                        } else {
                                            $totProfit = number_format($totProfit,2, '.', ',');
                                        }
                                    ?></code>
                                    </h4>

                                    <h2 class="text-center"><?php echo $totProfit; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bill Count <code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                        echo "<br>Category: ".$Category;
                                        echo "<br>Brand: ".$Brand;
                                    ?></code>
                                    </h4>
                                    <?php
                                        // Execute query for bill count
                                        $sel_today_bill = "SELECT COUNT(bh.billNo) AS Bill_count 
                                            FROM bill_head bh
                                            JOIN bill_data bd 
                                                ON bh.billNo = bd.billNo 
                                                AND bh.BillingBranch = bd.BillingBranch
                                            JOIN items i 
                                                ON bd.ItemCode = i.itemCode
                                            WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                            AND DATE(bh.timespam) <= '" . $toDate . "' 
                                            AND bh.BillingBranch = '" . $selBranch . "' 
                                            AND bh.cansel = 0
                                            AND i.catCode = '" . $Category . "' 
                                            AND i.brandCode = '" . $Brand . "';";

                                        $run_today_bill = mysqli_query($con, $sel_today_bill);
                                        $row_today_bill = mysqli_fetch_assoc($run_today_bill);
                                        $Bill_count = $row_today_bill['Bill_count'];
                                    ?>
                                    <h2 class="text-center"><?php echo number_format($Bill_count); ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Cancel Bill Total(Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                        echo "<br>Category: ".$Category;
                                        echo "<br>Brand: ".$Brand;
                                    ?></code>
                                    </h4>
                                    <?php
                                        // Execute query for total canceled bill
                                        $sel_today_bill = "SELECT SUM(bd.Price) AS TotalPrice
                                            FROM bill_head bh
                                            JOIN bill_data bd 
                                                ON bh.billNo = bd.billNo 
                                                AND bh.BillingBranch = bd.BillingBranch
                                            JOIN items i 
                                                ON bd.ItemCode = i.itemCode
                                            WHERE bh.cansel = 2
                                            AND DATE(bh.timespam) >= '" . $fromDate . "'
                                            AND DATE(bh.timespam) <= '" . $toDate . "'
                                            AND i.catCode = '" . $Category . "'
                                            AND i.brandCode = '" . $Brand . "'
                                            AND bd.BillingBranch = '" . $selBranch . "'; ";

                                        $run_today_bill = mysqli_query($con, $sel_today_bill);
                                        $row_today_bill = mysqli_fetch_assoc($run_today_bill);
                                        $todayCBillTotal = $row_today_bill['TotalPrice'];

                                        if($todayCBillTotal == ""){
                                            $todayCBillTotal=0;
                                        }
                                    ?>
                                    <h2 class="text-center"><?php echo number_format($todayCBillTotal, 2, '.', ','); ?>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bills<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                    ?></code></h4>

                                    <div class="table-responsive pt-3">
                                        <input type="text" id="myInput" onkeyup="myFunction()"
                                            placeholder="Search for names.." title="Type in a name">
                                        <div style="overflow-y: auto; max-height: 500px;">
                                            <table class="table table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Branch No.</th>
                                                        <th>Bill No.</th>
                                                        <th>Cashier</th>
                                                        <th>Total Price</th>
                                                        <th>Total Discount</th>
                                                        <th>Total Payable Amount</th>
                                                        <th>Total Profit</th>
                                                        <th>Bill Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    $sel_query12 = "SELECT * FROM bill_head WHERE DATE(timespam)>='".$fromDate."' AND DATE(timespam)<='".$toDate."' AND BillingBranch='".$selBranch."' and cansel=0";
                                                    $result12 = mysqli_query($con, $sel_query12);
                                                    while ($row = mysqli_fetch_assoc($result12)) {

                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $count; ?></th>
                                                        <td><?php echo $row["BillingBranch"]; ?></td>
                                                        <td><?php echo $row["billNo"]; ?></td>
                                                        <td><?php echo $row["Cashier"]; ?></td>
                                                        <td><?php echo $row["billTotal"]; ?></td>
                                                        <td><?php echo $row["TotalDiscountSend"]; ?></td>
                                                        <td><?php echo $row["PaybleBillAmountSend"]; ?></td>
                                                        <td><?php echo $row["totalProfit"]; ?></td>
                                                        <td><?php echo date('Y-m-d', strtotime($row['timespam'])); ?>
                                                        </td>
                                                        <td><a class="btn btn-primary btn-sm"
                                                                href="adminBillItem.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>&billNo=<?php echo $row["billNo"]; ?>&BillingBranch=<?php echo $row["BillingBranch"]; ?>">View
                                                                Bill</a></td>
                                                    </tr>
                                                    <?php $count++; } ?>
                                                </tbody>
                                            </table>
                                            <script>
                                            // let totalPayablePrice = 0.00;
                                            // let totalProfit = 0.00;
                                            // document.querySelectorAll('#myTable tr').forEach(row => {
                                            //     // Get the total price from the row and add it to the total
                                            //     const PayablePrice = parseFloat(row.cells[6].textContent);
                                            //     if (!isNaN(PayablePrice)) {
                                            //         totalPayablePrice += PayablePrice;
                                            //     }
                                            // });
                                            // document.querySelectorAll('#myTable tr').forEach(row => {
                                            //     // Get the total price from the row and add it to the total
                                            //     const PayablePrice1 = parseFloat(row.cells[7].textContent);
                                            //     if (!isNaN(PayablePrice1)) {
                                            //         totalProfit += PayablePrice1;
                                            //     }
                                            // });
                                            // // totalPayablePrice = new Intl.NumberFormat("de-DE").format(
                                            // // totalPayablePrice);
                                            // // alert(totalPayablePrice);
                                            // totalProfit = totalProfit.toFixed(2);
                                            // document.getElementById('sales').innerHTML = totalPayablePrice;
                                            // document.getElementById('profit').innerHTML = totalProfit;
                                            </script>
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

                        <?php
                                    } else {  
                                        $get_branchName = "SELECT branchName from branches where branchCode='".$selBranch."'";
                                        $run_get_branchName = mysqli_query($con,$get_branchName);
                                        $row_get_branchName = mysqli_fetch_assoc($run_get_branchName);
                                        $sel_branchName = $row_get_branchName['branchName'];
                                        // echo $sel_branchName."<br>";

                                        $sel_CategoryName = "SELECT catName from categories where catCode='".$Category."'";
                                        $run_CategoryName = mysqli_query($con,$sel_CategoryName);
                                        $row_CategoryName = mysqli_fetch_assoc($run_CategoryName);
                                        $CategoryName = $row_CategoryName['catName'];
                                        // echo $CategoryName."<br>";
                                    ?>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Sales (Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                        echo "<br>Category: ".$Category;

                                        $sel_totSale = "SELECT SUM(bd.Price) AS totSale 
                                        FROM bill_data bd
                                        JOIN bill_head bh
                                            ON bh.billNo = bd.billNo 
                                            AND bh.BillingBranch = bd.BillingBranch
                                        JOIN items i 
                                            ON bd.ItemCode = i.itemCode
                                        WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                        AND DATE(bh.timespam) <= '" . $toDate . "' 
                                        AND bh.BillingBranch = '" . $selBranch . "' 
                                        AND bh.cansel = 0
                                        AND i.catCode = '" . $Category . "'  ";

                                        $run_totSale = mysqli_query($con, $sel_totSale);
                                        $row_totSale = mysqli_fetch_assoc($run_totSale);
                                        $totSale = $row_totSale['totSale'];
                                        if (is_null($totSale)){
                                            $totSale = 0.00;
                                        } else {
                                            $totSale = number_format($totSale,2, '.', ',');
                                        }

                                    ?></code>
                                    </h4>

                                    <h2 class="text-center"><?php echo $totSale; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Profit (Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                        echo "<br>Category: ".$Category;

                                        $sel_totProfit = "SELECT SUM(bd.profit) AS totProfit
                                        FROM bill_data bd
                                        JOIN bill_head bh
                                            ON bh.billNo = bd.billNo 
                                            AND bh.BillingBranch = bd.BillingBranch
                                        JOIN items i 
                                            ON bd.ItemCode = i.itemCode
                                        WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                        AND DATE(bh.timespam) <= '" . $toDate . "' 
                                        AND bh.BillingBranch = '" . $selBranch . "' 
                                        AND bh.cansel = 0
                                        AND i.catCode = '" . $Category . "'  ";

                                        $run_totProfit = mysqli_query($con, $sel_totProfit);
                                        $row_totProfit = mysqli_fetch_assoc($run_totProfit);
                                        $totProfit = $row_totProfit['totProfit'];
                                        if (is_null($totProfit)){
                                            $totProfit = 0.00;
                                        } else {
                                            $totProfit = number_format($totProfit,2, '.', ',');
                                        }
                                    ?></code>
                                    </h4>

                                    <h2 class="text-center"><?php echo $totProfit; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bill Count <code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                        echo "<br>Category: ".$Category;
                                    ?></code>
                                    </h4>
                                    <?php
                                        // Execute query for bill count
                                        $sel_today_bill = "SELECT COUNT(bh.billNo) AS Bill_count 
                                            FROM bill_head bh
                                            JOIN bill_data bd 
                                                ON bh.billNo = bd.billNo 
                                                AND bh.BillingBranch = bd.BillingBranch
                                            JOIN items i 
                                                ON bd.ItemCode = i.itemCode
                                            WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                            AND DATE(bh.timespam) <= '" . $toDate . "' 
                                            AND bh.BillingBranch = '" . $selBranch . "' 
                                            AND bh.cansel = 0
                                            AND i.catCode = '" . $Category . "' ";

                                        $run_today_bill = mysqli_query($con, $sel_today_bill);
                                        $row_today_bill = mysqli_fetch_assoc($run_today_bill);
                                        $Bill_count = $row_today_bill['Bill_count'];
                                    ?>
                                    <h2 class="text-center"><?php echo number_format($Bill_count); ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Cancel Bill Total(Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                        echo "<br>Category: ".$Category;
                                    ?></code>
                                    </h4>
                                    <?php
                                        // Execute query for total canceled bill
                                        $sel_today_bill = "SELECT SUM(bd.Price) AS TotalPrice
                                            FROM bill_head bh
                                            JOIN bill_data bd 
                                                ON bh.billNo = bd.billNo 
                                                AND bh.BillingBranch = bd.BillingBranch
                                            JOIN items i 
                                                ON bd.ItemCode = i.itemCode
                                            WHERE bh.cansel = 2
                                            AND DATE(bh.timespam) >= '" . $fromDate . "'
                                            AND DATE(bh.timespam) <= '" . $toDate . "'
                                            AND i.catCode = '" . $Category . "'
                                            AND bd.BillingBranch = '" . $selBranch . "'; ";

                                        $run_today_bill = mysqli_query($con, $sel_today_bill);
                                        $row_today_bill = mysqli_fetch_assoc($run_today_bill);
                                        $todayCBillTotal = $row_today_bill['TotalPrice'];

                                        if($todayCBillTotal == ""){
                                            $todayCBillTotal=0;
                                        }
                                    ?>
                                    <h2 class="text-center"><?php echo number_format($todayCBillTotal, 2, '.', ','); ?>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bills<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                    ?></code></h4>

                                    <div class="table-responsive pt-3">
                                        <input type="text" id="myInput" onkeyup="myFunction()"
                                            placeholder="Search for names.." title="Type in a name">
                                        <div style="overflow-y: auto; max-height: 500px;">
                                            <table class="table table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Branch No.</th>
                                                        <th>Bill No.</th>
                                                        <th>Cashier</th>
                                                        <th>Total Price</th>
                                                        <th>Total Discount</th>
                                                        <th>Total Payable Amount</th>
                                                        <th>Total Profit</th>
                                                        <th>Bill Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    $sel_query12 = "SELECT * FROM bill_head WHERE DATE(timespam)>='".$fromDate."' AND DATE(timespam)<='".$toDate."' AND BillingBranch='".$selBranch."' and cansel=0";
                                                    $result12 = mysqli_query($con, $sel_query12);
                                                    while ($row = mysqli_fetch_assoc($result12)) {

                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $count; ?></th>
                                                        <td><?php echo $row["BillingBranch"]; ?></td>
                                                        <td><?php echo $row["billNo"]; ?></td>
                                                        <td><?php echo $row["Cashier"]; ?></td>
                                                        <td><?php echo $row["billTotal"]; ?></td>
                                                        <td><?php echo $row["TotalDiscountSend"]; ?></td>
                                                        <td><?php echo $row["PaybleBillAmountSend"]; ?></td>
                                                        <td><?php echo $row["totalProfit"]; ?></td>
                                                        <td><?php echo date('Y-m-d', strtotime($row['timespam'])); ?>
                                                        </td>
                                                        <td><a class="btn btn-primary btn-sm"
                                                                href="adminBillItem.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>&billNo=<?php echo $row["billNo"]; ?>&BillingBranch=<?php echo $row["BillingBranch"]; ?>">View
                                                                Bill</a></td>
                                                    </tr>
                                                    <?php $count++; } ?>
                                                </tbody>
                                            </table>
                                            <script>
                                            // let totalPayablePrice = 0.00;
                                            // let totalProfit = 0.00;
                                            // document.querySelectorAll('#myTable tr').forEach(row => {
                                            //     // Get the total price from the row and add it to the total
                                            //     const PayablePrice = parseFloat(row.cells[6].textContent);
                                            //     if (!isNaN(PayablePrice)) {
                                            //         totalPayablePrice += PayablePrice;
                                            //     }
                                            // });
                                            // document.querySelectorAll('#myTable tr').forEach(row => {
                                            //     // Get the total price from the row and add it to the total
                                            //     const PayablePrice1 = parseFloat(row.cells[7].textContent);
                                            //     if (!isNaN(PayablePrice1)) {
                                            //         totalProfit += PayablePrice1;
                                            //     }
                                            // });
                                            // // totalPayablePrice = new Intl.NumberFormat("de-DE").format(
                                            // // totalPayablePrice);
                                            // // alert(totalPayablePrice);
                                            // totalProfit = totalProfit.toFixed(2);
                                            // document.getElementById('sales').innerHTML = totalPayablePrice;
                                            // document.getElementById('profit').innerHTML = totalProfit;
                                            </script>
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

                        <?php
                                    } 
                                
                                } else { 
                                    if ($Brand != "All"){
                                        $get_branchName = "SELECT branchName from branches where branchCode='".$selBranch."'";
                                        $run_get_branchName = mysqli_query($con,$get_branchName);
                                        $row_get_branchName = mysqli_fetch_assoc($run_get_branchName);
                                        $sel_branchName = $row_get_branchName['branchName'];
                                        // echo $sel_branchName."<br>";

                                        $sel_BrandyName = "SELECT brandName from brand_names where brandCode='".$Brand."'";
                                        $run_BrandName = mysqli_query($con,$sel_BrandyName);
                                        $row_BrandName = mysqli_fetch_assoc($run_BrandName);
                                        $BrandName = $row_BrandName['brandName'];
                                        // echo $BrandName."<br>";
                                    ?>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Sales (Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                        echo "<br>Brand: ".$Brand;

                                        $sel_totSale = "SELECT SUM(bd.Price) AS totSale 
                                        FROM bill_data bd
                                        JOIN bill_head bh
                                            ON bh.billNo = bd.billNo 
                                            AND bh.BillingBranch = bd.BillingBranch
                                        JOIN items i 
                                            ON bd.ItemCode = i.itemCode
                                        WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                        AND DATE(bh.timespam) <= '" . $toDate . "' 
                                        AND bh.BillingBranch = '" . $selBranch . "' 
                                        AND bh.cansel = 0
                                        AND i.brandCode = '" . $Brand . "'; ";

                                        $run_totSale = mysqli_query($con, $sel_totSale);
                                        $row_totSale = mysqli_fetch_assoc($run_totSale);
                                        $totSale = $row_totSale['totSale'];
                                        if (is_null($totSale)){
                                            $totSale = 0.00;
                                        } else {
                                            $totSale = number_format($totSale,2, '.', ',');
                                        }

                                    ?></code>
                                    </h4>

                                    <h2 class="text-center"><?php echo $totSale; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Profit (Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                        echo "<br>Brand: ".$Brand;

                                        $sel_totProfit = "SELECT SUM(bd.profit) AS totProfit
                                        FROM bill_data bd
                                        JOIN bill_head bh
                                            ON bh.billNo = bd.billNo 
                                            AND bh.BillingBranch = bd.BillingBranch
                                        JOIN items i 
                                            ON bd.ItemCode = i.itemCode
                                        WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                        AND DATE(bh.timespam) <= '" . $toDate . "' 
                                        AND bh.BillingBranch = '" . $selBranch . "' 
                                        AND bh.cansel = 0
                                        AND i.brandCode = '" . $Brand . "'; ";

                                        $run_totProfit = mysqli_query($con, $sel_totProfit);
                                        $row_totProfit = mysqli_fetch_assoc($run_totProfit);
                                        $totProfit = $row_totProfit['totProfit'];
                                        if (is_null($totProfit)){
                                            $totProfit = 0.00;
                                        } else {
                                            $totProfit = number_format($totProfit,2, '.', ',');
                                        }
                                    ?></code>
                                    </h4>

                                    <h2 class="text-center"><?php echo $totProfit; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bill Count <code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                        echo "<br>Brand: ".$Brand;
                                    ?></code>
                                    </h4>
                                    <?php
                                        // Execute query for bill count
                                        $sel_today_bill = "SELECT COUNT(bh.billNo) AS Bill_count 
                                            FROM bill_head bh
                                            JOIN bill_data bd 
                                                ON bh.billNo = bd.billNo 
                                                AND bh.BillingBranch = bd.BillingBranch
                                            JOIN items i 
                                                ON bd.ItemCode = i.itemCode
                                            WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                            AND DATE(bh.timespam) <= '" . $toDate . "' 
                                            AND bh.BillingBranch = '" . $selBranch . "' 
                                            AND bh.cansel = 0
                                            AND i.brandCode = '" . $Brand . "';";

                                        $run_today_bill = mysqli_query($con, $sel_today_bill);
                                        $row_today_bill = mysqli_fetch_assoc($run_today_bill);
                                        $Bill_count = $row_today_bill['Bill_count'];
                                    ?>
                                    <h2 class="text-center"><?php echo number_format($Bill_count); ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Cancel Bill Total(Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                        echo "<br>Brand: ".$Brand;
                                    ?></code>
                                    </h4>
                                    <?php
                                        // Execute query for total canceled bill
                                        $sel_today_bill = "SELECT SUM(bd.Price) AS TotalPrice
                                            FROM bill_head bh
                                            JOIN bill_data bd 
                                                ON bh.billNo = bd.billNo 
                                                AND bh.BillingBranch = bd.BillingBranch
                                            JOIN items i 
                                                ON bd.ItemCode = i.itemCode
                                            WHERE bh.cansel = 2
                                            AND DATE(bh.timespam) >= '" . $fromDate . "'
                                            AND DATE(bh.timespam) <= '" . $toDate . "'
                                            AND i.brandCode = '" . $Brand . "'
                                            AND bd.BillingBranch = '" . $selBranch . "'; ";

                                        $run_today_bill = mysqli_query($con, $sel_today_bill);
                                        $row_today_bill = mysqli_fetch_assoc($run_today_bill);
                                        $todayCBillTotal = $row_today_bill['TotalPrice'];

                                        if($todayCBillTotal == ""){
                                            $todayCBillTotal=0;
                                        }
                                    ?>
                                    <h2 class="text-center"><?php echo number_format($todayCBillTotal, 2, '.', ','); ?>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bills<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                    ?></code></h4>

                                    <div class="table-responsive pt-3">
                                        <input type="text" id="myInput" onkeyup="myFunction()"
                                            placeholder="Search for names.." title="Type in a name">
                                        <div style="overflow-y: auto; max-height: 500px;">
                                            <table class="table table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Branch No.</th>
                                                        <th>Bill No.</th>
                                                        <th>Cashier</th>
                                                        <th>Total Price</th>
                                                        <th>Total Discount</th>
                                                        <th>Total Payable Amount</th>
                                                        <th>Total Profit</th>
                                                        <th>Bill Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    $sel_query12 = "SELECT * FROM bill_head WHERE DATE(timespam)>='".$fromDate."' AND DATE(timespam)<='".$toDate."' AND BillingBranch='".$selBranch."' and cansel=0";
                                                    $result12 = mysqli_query($con, $sel_query12);
                                                    while ($row = mysqli_fetch_assoc($result12)) {

                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $count; ?></th>
                                                        <td><?php echo $row["BillingBranch"]; ?></td>
                                                        <td><?php echo $row["billNo"]; ?></td>
                                                        <td><?php echo $row["Cashier"]; ?></td>
                                                        <td><?php echo $row["billTotal"]; ?></td>
                                                        <td><?php echo $row["TotalDiscountSend"]; ?></td>
                                                        <td><?php echo $row["PaybleBillAmountSend"]; ?></td>
                                                        <td><?php echo $row["totalProfit"]; ?></td>
                                                        <td><?php echo date('Y-m-d', strtotime($row['timespam'])); ?>
                                                        </td>
                                                        <td><a class="btn btn-primary btn-sm"
                                                                href="adminBillItem.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>&billNo=<?php echo $row["billNo"]; ?>&BillingBranch=<?php echo $row["BillingBranch"]; ?>">View
                                                                Bill</a></td>
                                                    </tr>
                                                    <?php $count++; } ?>
                                                </tbody>
                                            </table>
                                            <script>
                                            // let totalPayablePrice = 0.00;
                                            // let totalProfit = 0.00;
                                            // document.querySelectorAll('#myTable tr').forEach(row => {
                                            //     // Get the total price from the row and add it to the total
                                            //     const PayablePrice = parseFloat(row.cells[6].textContent);
                                            //     if (!isNaN(PayablePrice)) {
                                            //         totalPayablePrice += PayablePrice;
                                            //     }
                                            // });
                                            // document.querySelectorAll('#myTable tr').forEach(row => {
                                            //     // Get the total price from the row and add it to the total
                                            //     const PayablePrice1 = parseFloat(row.cells[7].textContent);
                                            //     if (!isNaN(PayablePrice1)) {
                                            //         totalProfit += PayablePrice1;
                                            //     }
                                            // });
                                            // // totalPayablePrice = new Intl.NumberFormat("de-DE").format(
                                            // // totalPayablePrice);
                                            // // alert(totalPayablePrice);
                                            // totalProfit = totalProfit.toFixed(2);
                                            // document.getElementById('sales').innerHTML = totalPayablePrice;
                                            // document.getElementById('profit').innerHTML = totalProfit;
                                            </script>
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

                        <?php
                                    } else { 
                                        $get_branchName = "SELECT branchName from branches where branchCode='".$selBranch."'";
                                        $run_get_branchName = mysqli_query($con,$get_branchName);
                                        $row_get_branchName = mysqli_fetch_assoc($run_get_branchName);
                                        $sel_branchName = $row_get_branchName['branchName'];
                                        // echo $sel_branchName."<br>";
                                    ?>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Sales (Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;

                                        $sel_totSale = "SELECT SUM(bd.Price) AS totSale 
                                        FROM bill_data bd
                                        JOIN bill_head bh
                                            ON bh.billNo = bd.billNo 
                                            AND bh.BillingBranch = bd.BillingBranch
                                        WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                        AND DATE(bh.timespam) <= '" . $toDate . "' 
                                        AND bh.BillingBranch = '" . $selBranch . "' 
                                        AND bh.cansel = 0 ";

                                        $run_totSale = mysqli_query($con, $sel_totSale);
                                        $row_totSale = mysqli_fetch_assoc($run_totSale);
                                        $totSale = $row_totSale['totSale'];
                                        if (is_null($totSale)){
                                            $totSale = 0.00;
                                        } else {
                                            $totSale = number_format($totSale,2, '.', ',');
                                        }

                                    ?></code>
                                    </h4>

                                    <h2 class="text-center"><?php echo $totSale; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Profit (Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;

                                        $sel_totProfit = "SELECT SUM(bd.profit) AS totProfit
                                        FROM bill_data bd
                                        JOIN bill_head bh
                                            ON bh.billNo = bd.billNo 
                                            AND bh.BillingBranch = bd.BillingBranch
                                        WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                        AND DATE(bh.timespam) <= '" . $toDate . "' 
                                        AND bh.BillingBranch = '" . $selBranch . "' 
                                        AND bh.cansel = 0 ";

                                        $run_totProfit = mysqli_query($con, $sel_totProfit);
                                        $row_totProfit = mysqli_fetch_assoc($run_totProfit);
                                        $totProfit = $row_totProfit['totProfit'];
                                        if (is_null($totProfit)){
                                            $totProfit = 0.00;
                                        } else {
                                            $totProfit = number_format($totProfit,2, '.', ',');
                                        }
                                    ?></code>
                                    </h4>

                                    <h2 class="text-center"><?php echo $totProfit; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bill Count <code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                    ?></code>
                                    </h4>
                                    <?php
                                        // Execute query for bill count
                                        $sel_today_bill = "SELECT COUNT(bh.billNo) AS Bill_count 
                                            FROM bill_head bh
                                            JOIN bill_data bd 
                                                ON bh.billNo = bd.billNo 
                                                AND bh.BillingBranch = bd.BillingBranch
                                            WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                            AND DATE(bh.timespam) <= '" . $toDate . "' 
                                            AND bh.BillingBranch = '" . $selBranch . "' 
                                            AND bh.cansel = 0";

                                        $run_today_bill = mysqli_query($con, $sel_today_bill);
                                        $row_today_bill = mysqli_fetch_assoc($run_today_bill);
                                        $Bill_count = $row_today_bill['Bill_count'];
                                    ?>
                                    <h2 class="text-center"><?php echo number_format($Bill_count); ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Cancel Bill Total(Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                    ?></code>
                                    </h4>
                                    <?php
                                        // Execute query for total canceled bill
                                        $sel_today_bill = "SELECT SUM(bd.Price) AS TotalPrice
                                            FROM bill_head bh
                                            JOIN bill_data bd 
                                                ON bh.billNo = bd.billNo 
                                                AND bh.BillingBranch = bd.BillingBranch
                                            WHERE bh.cansel = 2
                                            AND DATE(bh.timespam) >= '" . $fromDate . "'
                                            AND DATE(bh.timespam) <= '" . $toDate . "'
                                            AND bd.BillingBranch = '" . $selBranch . "'; ";

                                        $run_today_bill = mysqli_query($con, $sel_today_bill);
                                        $row_today_bill = mysqli_fetch_assoc($run_today_bill);
                                        $todayCBillTotal = $row_today_bill['TotalPrice'];

                                        if($todayCBillTotal == ""){
                                            $todayCBillTotal=0;
                                        }
                                    ?>
                                    <h2 class="text-center"><?php echo number_format($todayCBillTotal, 2, '.', ','); ?>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bills<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Branch: ".$sel_branchName;
                                    ?></code></h4>

                                    <div class="table-responsive pt-3">
                                        <input type="text" id="myInput" onkeyup="myFunction()"
                                            placeholder="Search for names.." title="Type in a name">
                                        <div style="overflow-y: auto; max-height: 500px;">
                                            <table class="table table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Branch No.</th>
                                                        <th>Bill No.</th>
                                                        <th>Cashier</th>
                                                        <th>Total Price</th>
                                                        <th>Total Discount</th>
                                                        <th>Total Payable Amount</th>
                                                        <th>Total Profit</th>
                                                        <th>Bill Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    $sel_query12 = "SELECT * FROM bill_head WHERE DATE(timespam)>='".$fromDate."' AND DATE(timespam)<='".$toDate."' AND BillingBranch='".$selBranch."' and cansel=0";
                                                    $result12 = mysqli_query($con, $sel_query12);
                                                    while ($row = mysqli_fetch_assoc($result12)) {

                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $count; ?></th>
                                                        <td><?php echo $row["BillingBranch"]; ?></td>
                                                        <td><?php echo $row["billNo"]; ?></td>
                                                        <td><?php echo $row["Cashier"]; ?></td>
                                                        <td><?php echo $row["billTotal"]; ?></td>
                                                        <td><?php echo $row["TotalDiscountSend"]; ?></td>
                                                        <td><?php echo $row["PaybleBillAmountSend"]; ?></td>
                                                        <td><?php echo $row["totalProfit"]; ?></td>
                                                        <td><?php echo date('Y-m-d', strtotime($row['timespam'])); ?>
                                                        </td>
                                                        <td><a class="btn btn-primary btn-sm"
                                                                href="adminBillItem.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>&billNo=<?php echo $row["billNo"]; ?>&BillingBranch=<?php echo $row["BillingBranch"]; ?>">View
                                                                Bill</a></td>
                                                    </tr>
                                                    <?php $count++; } ?>
                                                </tbody>
                                            </table>
                                            <script>
                                            // let totalPayablePrice = 0.00;
                                            // let totalProfit = 0.00;
                                            // document.querySelectorAll('#myTable tr').forEach(row => {
                                            //     // Get the total price from the row and add it to the total
                                            //     const PayablePrice = parseFloat(row.cells[6].textContent);
                                            //     if (!isNaN(PayablePrice)) {
                                            //         totalPayablePrice += PayablePrice;
                                            //     }
                                            // });
                                            // document.querySelectorAll('#myTable tr').forEach(row => {
                                            //     // Get the total price from the row and add it to the total
                                            //     const PayablePrice1 = parseFloat(row.cells[7].textContent);
                                            //     if (!isNaN(PayablePrice1)) {
                                            //         totalProfit += PayablePrice1;
                                            //     }
                                            // });
                                            // // totalPayablePrice = new Intl.NumberFormat("de-DE").format(
                                            // // totalPayablePrice);
                                            // // alert(totalPayablePrice);
                                            // totalProfit = totalProfit.toFixed(2);
                                            // document.getElementById('sales').innerHTML = totalPayablePrice;
                                            // document.getElementById('profit').innerHTML = totalProfit;
                                            </script>
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

                        <?php
                                    }  

                                } 
                        ?>


                        <?php 
                        } else { 
                            if ($Category != "All"){
                                if ($Brand != "All"){

                                        $sel_CategoryName = "SELECT catName from categories where catCode='".$Category."'";
                                        $run_CategoryName = mysqli_query($con,$sel_CategoryName);
                                        $row_CategoryName = mysqli_fetch_assoc($run_CategoryName);
                                        $CategoryName = $row_CategoryName['catName'];
                                        // echo $CategoryName."<br>";

                                        $sel_BrandyName = "SELECT brandName from brand_names where brandCode='".$Brand."'";
                                        $run_BrandName = mysqli_query($con,$sel_BrandyName);
                                        $row_BrandName = mysqli_fetch_assoc($run_BrandName);
                                        $BrandName = $row_BrandName['brandName'];
                                        // echo $BrandName."<br>";
                                    ?>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Sales (Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Category: ".$Category;
                                        echo "<br>Brand: ".$Brand;

                                        $sel_totSale = "SELECT SUM(bd.Price) AS totSale 
                                        FROM bill_data bd
                                        JOIN bill_head bh
                                            ON bh.billNo = bd.billNo 
                                            AND bh.BillingBranch = bd.BillingBranch
                                        JOIN items i 
                                            ON bd.ItemCode = i.itemCode
                                        WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                        AND DATE(bh.timespam) <= '" . $toDate . "' 
                                        AND bh.cansel = 0
                                        AND i.catCode = '" . $Category . "' 
                                        AND i.brandCode = '" . $Brand . "'; ";

                                        $run_totSale = mysqli_query($con, $sel_totSale);
                                        $row_totSale = mysqli_fetch_assoc($run_totSale);
                                        $totSale = $row_totSale['totSale'];
                                        if (is_null($totSale)){
                                            $totSale = 0.00;
                                        } else {
                                            $totSale = number_format($totSale,2, '.', ',');
                                        }

                                    ?></code>
                                    </h4>

                                    <h2 class="text-center"><?php echo $totSale; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Profit (Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Category: ".$Category;
                                        echo "<br>Brand: ".$Brand;

                                        $sel_totProfit = "SELECT SUM(bd.profit) AS totProfit
                                        FROM bill_data bd
                                        JOIN bill_head bh
                                            ON bh.billNo = bd.billNo 
                                            AND bh.BillingBranch = bd.BillingBranch
                                        JOIN items i 
                                            ON bd.ItemCode = i.itemCode
                                        WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                        AND DATE(bh.timespam) <= '" . $toDate . "' 
                                        AND bh.cansel = 0
                                        AND i.catCode = '" . $Category . "' 
                                        AND i.brandCode = '" . $Brand . "'; ";

                                        $run_totProfit = mysqli_query($con, $sel_totProfit);
                                        $row_totProfit = mysqli_fetch_assoc($run_totProfit);
                                        $totProfit = $row_totProfit['totProfit'];
                                        if (is_null($totProfit)){
                                            $totProfit = 0.00;
                                        } else {
                                            $totProfit = number_format($totProfit,2, '.', ',');
                                        }
                                    ?></code>
                                    </h4>

                                    <h2 class="text-center"><?php echo $totProfit; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bill Count <code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Category: ".$Category;
                                        echo "<br>Brand: ".$Brand;
                                    ?></code>
                                    </h4>
                                    <?php
                                        // Execute query for bill count
                                        $sel_today_bill = "SELECT COUNT(bh.billNo) AS Bill_count 
                                            FROM bill_head bh
                                            JOIN bill_data bd 
                                                ON bh.billNo = bd.billNo 
                                                AND bh.BillingBranch = bd.BillingBranch
                                            JOIN items i 
                                                ON bd.ItemCode = i.itemCode
                                            WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                            AND DATE(bh.timespam) <= '" . $toDate . "' 
                                            AND bh.cansel = 0
                                            AND i.catCode = '" . $Category . "' 
                                            AND i.brandCode = '" . $Brand . "';";

                                        $run_today_bill = mysqli_query($con, $sel_today_bill);
                                        $row_today_bill = mysqli_fetch_assoc($run_today_bill);
                                        $Bill_count = $row_today_bill['Bill_count'];
                                    ?>
                                    <h2 class="text-center"><?php echo number_format($Bill_count); ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Cancel Bill Total(Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Category: ".$Category;
                                        echo "<br>Brand: ".$Brand;
                                    ?></code>
                                    </h4>
                                    <?php
                                        // Execute query for total canceled bill
                                        $sel_today_bill = "SELECT SUM(bd.Price) AS TotalPrice
                                            FROM bill_head bh
                                            JOIN bill_data bd 
                                                ON bh.billNo = bd.billNo 
                                                AND bh.BillingBranch = bd.BillingBranch
                                            JOIN items i 
                                                ON bd.ItemCode = i.itemCode
                                            WHERE bh.cansel = 2
                                            AND DATE(bh.timespam) >= '" . $fromDate . "'
                                            AND DATE(bh.timespam) <= '" . $toDate . "'
                                            AND i.catCode = '" . $Category . "'
                                            AND i.brandCode = '" . $Brand . "' ";

                                        $run_today_bill = mysqli_query($con, $sel_today_bill);
                                        $row_today_bill = mysqli_fetch_assoc($run_today_bill);
                                        $todayCBillTotal = $row_today_bill['TotalPrice'];

                                        if($todayCBillTotal == ""){
                                            $todayCBillTotal=0;
                                        }
                                    ?>
                                    <h2 class="text-center"><?php echo number_format($todayCBillTotal, 2, '.', ','); ?>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bills<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                    ?></code></h4>

                                    <div class="table-responsive pt-3">
                                        <input type="text" id="myInput" onkeyup="myFunction()"
                                            placeholder="Search for names.." title="Type in a name">
                                        <div style="overflow-y: auto; max-height: 500px;">
                                            <table class="table table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Branch No.</th>
                                                        <th>Bill No.</th>
                                                        <th>Cashier</th>
                                                        <th>Total Price</th>
                                                        <th>Total Discount</th>
                                                        <th>Total Payable Amount</th>
                                                        <th>Total Profit</th>
                                                        <th>Bill Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    $sel_query12 = "SELECT * FROM bill_head WHERE DATE(timespam)>='".$fromDate."' AND DATE(timespam)<='".$toDate."'  and cansel=0";
                                                    $result12 = mysqli_query($con, $sel_query12);
                                                    while ($row = mysqli_fetch_assoc($result12)) {

                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $count; ?></th>
                                                        <td><?php echo $row["BillingBranch"]; ?></td>
                                                        <td><?php echo $row["billNo"]; ?></td>
                                                        <td><?php echo $row["Cashier"]; ?></td>
                                                        <td><?php echo $row["billTotal"]; ?></td>
                                                        <td><?php echo $row["TotalDiscountSend"]; ?></td>
                                                        <td><?php echo $row["PaybleBillAmountSend"]; ?></td>
                                                        <td><?php echo $row["totalProfit"]; ?></td>
                                                        <td><?php echo date('Y-m-d', strtotime($row['timespam'])); ?>
                                                        </td>
                                                        <td><a class="btn btn-primary btn-sm"
                                                                href="adminBillItem.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>&billNo=<?php echo $row["billNo"]; ?>&BillingBranch=<?php echo $row["BillingBranch"]; ?>">View
                                                                Bill</a></td>
                                                    </tr>
                                                    <?php $count++; } ?>
                                                </tbody>
                                            </table>
                                            <script>
                                            // let totalPayablePrice = 0.00;
                                            // let totalProfit = 0.00;
                                            // document.querySelectorAll('#myTable tr').forEach(row => {
                                            //     // Get the total price from the row and add it to the total
                                            //     const PayablePrice = parseFloat(row.cells[6].textContent);
                                            //     if (!isNaN(PayablePrice)) {
                                            //         totalPayablePrice += PayablePrice;
                                            //     }
                                            // });
                                            // document.querySelectorAll('#myTable tr').forEach(row => {
                                            //     // Get the total price from the row and add it to the total
                                            //     const PayablePrice1 = parseFloat(row.cells[7].textContent);
                                            //     if (!isNaN(PayablePrice1)) {
                                            //         totalProfit += PayablePrice1;
                                            //     }
                                            // });
                                            // // totalPayablePrice = new Intl.NumberFormat("de-DE").format(
                                            // // totalPayablePrice);
                                            // // alert(totalPayablePrice);
                                            // totalProfit = totalProfit.toFixed(2);
                                            // document.getElementById('sales').innerHTML = totalPayablePrice;
                                            // document.getElementById('profit').innerHTML = totalProfit;
                                            </script>
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

                        <?php
                                } else {  

                                        $sel_CategoryName = "SELECT catName from categories where catCode='".$Category."'";
                                        $run_CategoryName = mysqli_query($con,$sel_CategoryName);
                                        $row_CategoryName = mysqli_fetch_assoc($run_CategoryName);
                                        $CategoryName = $row_CategoryName['catName'];
                                        // echo $CategoryName."<br>";
                                    ?>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Sales (Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Category: ".$Category;

                                        $sel_totSale = "SELECT SUM(bd.Price) AS totSale 
                                        FROM bill_data bd
                                        JOIN bill_head bh
                                            ON bh.billNo = bd.billNo 
                                            AND bh.BillingBranch = bd.BillingBranch
                                        JOIN items i 
                                            ON bd.ItemCode = i.itemCode
                                        WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                        AND DATE(bh.timespam) <= '" . $toDate . "' 
                                        AND bh.cansel = 0
                                        AND i.catCode = '" . $Category . "'  ";

                                        $run_totSale = mysqli_query($con, $sel_totSale);
                                        $row_totSale = mysqli_fetch_assoc($run_totSale);
                                        $totSale = $row_totSale['totSale'];
                                        if (is_null($totSale)){
                                            $totSale = 0.00;
                                        } else {
                                            $totSale = number_format($totSale,2, '.', ',');
                                        }

                                    ?></code>
                                    </h4>

                                    <h2 class="text-center"><?php echo $totSale; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Profit (Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Category: ".$Category;

                                        $sel_totProfit = "SELECT SUM(bd.profit) AS totProfit
                                        FROM bill_data bd
                                        JOIN bill_head bh
                                            ON bh.billNo = bd.billNo 
                                            AND bh.BillingBranch = bd.BillingBranch
                                        JOIN items i 
                                            ON bd.ItemCode = i.itemCode
                                        WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                        AND DATE(bh.timespam) <= '" . $toDate . "' 
                                        AND bh.cansel = 0
                                        AND i.catCode = '" . $Category . "' ";

                                        $run_totProfit = mysqli_query($con, $sel_totProfit);
                                        $row_totProfit = mysqli_fetch_assoc($run_totProfit);
                                        $totProfit = $row_totProfit['totProfit'];
                                        if (is_null($totProfit)){
                                            $totProfit = 0.00;
                                        } else {
                                            $totProfit = number_format($totProfit,2, '.', ',');
                                        }
                                    ?></code>
                                    </h4>

                                    <h2 class="text-center"><?php echo $totProfit; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bill Count <code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Category: ".$Category;
                                    ?></code>
                                    </h4>
                                    <?php
                                        // Execute query for bill count
                                        $sel_today_bill = "SELECT COUNT(bh.billNo) AS Bill_count 
                                            FROM bill_head bh
                                            JOIN bill_data bd 
                                                ON bh.billNo = bd.billNo 
                                                AND bh.BillingBranch = bd.BillingBranch
                                            JOIN items i 
                                                ON bd.ItemCode = i.itemCode
                                            WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                            AND DATE(bh.timespam) <= '" . $toDate . "' 
                                            AND bh.cansel = 0
                                            AND i.catCode = '" . $Category . "' ";

                                        $run_today_bill = mysqli_query($con, $sel_today_bill);
                                        $row_today_bill = mysqli_fetch_assoc($run_today_bill);
                                        $Bill_count = $row_today_bill['Bill_count'];
                                    ?>
                                    <h2 class="text-center"><?php echo number_format($Bill_count); ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Cancel Bill Total(Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Category: ".$Category;
                                    ?></code>
                                    </h4>
                                    <?php
                                        // Execute query for total canceled bill
                                        $sel_today_bill = "SELECT SUM(bd.Price) AS TotalPrice
                                            FROM bill_head bh
                                            JOIN bill_data bd 
                                                ON bh.billNo = bd.billNo 
                                                AND bh.BillingBranch = bd.BillingBranch
                                            JOIN items i 
                                                ON bd.ItemCode = i.itemCode
                                            WHERE bh.cansel = 2
                                            AND DATE(bh.timespam) >= '" . $fromDate . "'
                                            AND DATE(bh.timespam) <= '" . $toDate . "'
                                            AND i.catCode = '" . $Category . "' ";

                                        $run_today_bill = mysqli_query($con, $sel_today_bill);
                                        $row_today_bill = mysqli_fetch_assoc($run_today_bill);
                                        $todayCBillTotal = $row_today_bill['TotalPrice'];

                                        if($todayCBillTotal == ""){
                                            $todayCBillTotal=0;
                                        }
                                    ?>
                                    <h2 class="text-center"><?php echo number_format($todayCBillTotal, 2, '.', ','); ?>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bills<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                    ?></code></h4>

                                    <div class="table-responsive pt-3">
                                        <input type="text" id="myInput" onkeyup="myFunction()"
                                            placeholder="Search for names.." title="Type in a name">
                                        <div style="overflow-y: auto; max-height: 500px;">
                                            <table class="table table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Branch No.</th>
                                                        <th>Bill No.</th>
                                                        <th>Cashier</th>
                                                        <th>Total Price</th>
                                                        <th>Total Discount</th>
                                                        <th>Total Payable Amount</th>
                                                        <th>Total Profit</th>
                                                        <th>Bill Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    $sel_query12 = "SELECT * FROM bill_head WHERE DATE(timespam)>='".$fromDate."' AND DATE(timespam)<='".$toDate."' AND  cansel=0";
                                                    $result12 = mysqli_query($con, $sel_query12);
                                                    while ($row = mysqli_fetch_assoc($result12)) {

                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $count; ?></th>
                                                        <td><?php echo $row["BillingBranch"]; ?></td>
                                                        <td><?php echo $row["billNo"]; ?></td>
                                                        <td><?php echo $row["Cashier"]; ?></td>
                                                        <td><?php echo $row["billTotal"]; ?></td>
                                                        <td><?php echo $row["TotalDiscountSend"]; ?></td>
                                                        <td><?php echo $row["PaybleBillAmountSend"]; ?></td>
                                                        <td><?php echo $row["totalProfit"]; ?></td>
                                                        <td><?php echo date('Y-m-d', strtotime($row['timespam'])); ?>
                                                        </td>
                                                        <td><a class="btn btn-primary btn-sm"
                                                                href="adminBillItem.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>&billNo=<?php echo $row["billNo"]; ?>&BillingBranch=<?php echo $row["BillingBranch"]; ?>">View
                                                                Bill</a></td>
                                                    </tr>
                                                    <?php $count++; } ?>
                                                </tbody>
                                            </table>
                                            <script>
                                            // let totalPayablePrice = 0.00;
                                            // let totalProfit = 0.00;
                                            // document.querySelectorAll('#myTable tr').forEach(row => {
                                            //     // Get the total price from the row and add it to the total
                                            //     const PayablePrice = parseFloat(row.cells[6].textContent);
                                            //     if (!isNaN(PayablePrice)) {
                                            //         totalPayablePrice += PayablePrice;
                                            //     }
                                            // });
                                            // document.querySelectorAll('#myTable tr').forEach(row => {
                                            //     // Get the total price from the row and add it to the total
                                            //     const PayablePrice1 = parseFloat(row.cells[7].textContent);
                                            //     if (!isNaN(PayablePrice1)) {
                                            //         totalProfit += PayablePrice1;
                                            //     }
                                            // });
                                            // // totalPayablePrice = new Intl.NumberFormat("de-DE").format(
                                            // // totalPayablePrice);
                                            // // alert(totalPayablePrice);
                                            // totalProfit = totalProfit.toFixed(2);
                                            // document.getElementById('sales').innerHTML = totalPayablePrice;
                                            // document.getElementById('profit').innerHTML = totalProfit;
                                            </script>
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

                        <?php
                                } 
                            
                            } else { 
                                if ($Brand != "All"){

                                        $sel_BrandyName = "SELECT brandName from brand_names where brandCode='".$Brand."'";
                                        $run_BrandName = mysqli_query($con,$sel_BrandyName);
                                        $row_BrandName = mysqli_fetch_assoc($run_BrandName);
                                        $BrandName = $row_BrandName['brandName'];
                                        // echo $BrandName."<br>";
                                    ?>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Sales (Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Brand: ".$Brand;

                                        $sel_totSale = "SELECT SUM(bd.Price) AS totSale 
                                        FROM bill_data bd
                                        JOIN bill_head bh
                                            ON bh.billNo = bd.billNo 
                                            AND bh.BillingBranch = bd.BillingBranch
                                        JOIN items i 
                                            ON bd.ItemCode = i.itemCode
                                        WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                        AND DATE(bh.timespam) <= '" . $toDate . "' 
                                        AND bh.cansel = 0
                                        AND i.brandCode = '" . $Brand . "'; ";

                                        $run_totSale = mysqli_query($con, $sel_totSale);
                                        $row_totSale = mysqli_fetch_assoc($run_totSale);
                                        $totSale = $row_totSale['totSale'];
                                        if (is_null($totSale)){
                                            $totSale = 0.00;
                                        } else {
                                            $totSale = number_format($totSale,2, '.', ',');
                                        }

                                    ?></code>
                                    </h4>

                                    <h2 class="text-center"><?php echo $totSale; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Profit (Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Brand: ".$Brand;

                                        $sel_totProfit = "SELECT SUM(bd.profit) AS totProfit
                                        FROM bill_data bd
                                        JOIN bill_head bh
                                            ON bh.billNo = bd.billNo 
                                            AND bh.BillingBranch = bd.BillingBranch
                                        JOIN items i 
                                            ON bd.ItemCode = i.itemCode
                                        WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                        AND DATE(bh.timespam) <= '" . $toDate . "' 
                                        AND bh.cansel = 0
                                        AND i.catCode = '" . $Category . "'  ";

                                        $run_totProfit = mysqli_query($con, $sel_totProfit);
                                        $row_totProfit = mysqli_fetch_assoc($run_totProfit);
                                        $totProfit = $row_totProfit['totProfit'];
                                        if (is_null($totProfit)){
                                            $totProfit = 0.00;
                                        } else {
                                            $totProfit = number_format($totProfit,2, '.', ',');
                                        }
                                    ?></code>
                                    </h4>

                                    <h2 class="text-center"><?php echo $totProfit; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bill Count <code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Brand: ".$Brand;
                                    ?></code>
                                    </h4>
                                    <?php
                                        // Execute query for bill count
                                        $sel_today_bill = "SELECT COUNT(bh.billNo) AS Bill_count 
                                            FROM bill_head bh
                                            JOIN bill_data bd 
                                                ON bh.billNo = bd.billNo 
                                                AND bh.BillingBranch = bd.BillingBranch
                                            JOIN items i 
                                                ON bd.ItemCode = i.itemCode
                                            WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                            AND DATE(bh.timespam) <= '" . $toDate . "' 
                                            AND bh.cansel = 0
                                            AND i.catCode = '" . $Category . "' ";

                                        $run_today_bill = mysqli_query($con, $sel_today_bill);
                                        $row_today_bill = mysqli_fetch_assoc($run_today_bill);
                                        $Bill_count = $row_today_bill['Bill_count'];
                                    ?>
                                    <h2 class="text-center"><?php echo number_format($Bill_count); ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Cancel Bill Total(Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                        echo "<br>Brand: ".$Brand;
                                    ?></code>
                                    </h4>
                                    <?php
                                        // Execute query for total canceled bill
                                        $sel_today_bill = "SELECT SUM(bd.Price) AS TotalPrice
                                            FROM bill_head bh
                                            JOIN bill_data bd 
                                                ON bh.billNo = bd.billNo 
                                                AND bh.BillingBranch = bd.BillingBranch
                                            JOIN items i 
                                                ON bd.ItemCode = i.itemCode
                                            WHERE bh.cansel = 2
                                            AND DATE(bh.timespam) >= '" . $fromDate . "'
                                            AND DATE(bh.timespam) <= '" . $toDate . "'
                                            AND i.catCode = '" . $Category . "' ";

                                        $run_today_bill = mysqli_query($con, $sel_today_bill);
                                        $row_today_bill = mysqli_fetch_assoc($run_today_bill);
                                        $todayCBillTotal = $row_today_bill['TotalPrice'];

                                        if($todayCBillTotal == ""){
                                            $todayCBillTotal=0;
                                        }
                                    ?>
                                    <h2 class="text-center"><?php echo number_format($todayCBillTotal, 2, '.', ','); ?>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bills<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                    ?></code></h4>

                                    <div class="table-responsive pt-3">
                                        <input type="text" id="myInput" onkeyup="myFunction()"
                                            placeholder="Search for names.." title="Type in a name">
                                        <div style="overflow-y: auto; max-height: 500px;">
                                            <table class="table table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Branch No.</th>
                                                        <th>Bill No.</th>
                                                        <th>Cashier</th>
                                                        <th>Total Price</th>
                                                        <th>Total Discount</th>
                                                        <th>Total Payable Amount</th>
                                                        <th>Total Profit</th>
                                                        <th>Bill Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    $sel_query12 = "SELECT * FROM bill_head WHERE DATE(timespam)>='".$fromDate."' AND DATE(timespam)<='".$toDate."' AND  cansel=0";
                                                    $result12 = mysqli_query($con, $sel_query12);
                                                    while ($row = mysqli_fetch_assoc($result12)) {

                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $count; ?></th>
                                                        <td><?php echo $row["BillingBranch"]; ?></td>
                                                        <td><?php echo $row["billNo"]; ?></td>
                                                        <td><?php echo $row["Cashier"]; ?></td>
                                                        <td><?php echo $row["billTotal"]; ?></td>
                                                        <td><?php echo $row["TotalDiscountSend"]; ?></td>
                                                        <td><?php echo $row["PaybleBillAmountSend"]; ?></td>
                                                        <td><?php echo $row["totalProfit"]; ?></td>
                                                        <td><?php echo date('Y-m-d', strtotime($row['timespam'])); ?>
                                                        </td>
                                                        <td><a class="btn btn-primary btn-sm"
                                                                href="adminBillItem.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>&billNo=<?php echo $row["billNo"]; ?>&BillingBranch=<?php echo $row["BillingBranch"]; ?>">View
                                                                Bill</a></td>
                                                    </tr>
                                                    <?php $count++; } ?>
                                                </tbody>
                                            </table>
                                            <script>
                                            // let totalPayablePrice = 0.00;
                                            // let totalProfit = 0.00;
                                            // document.querySelectorAll('#myTable tr').forEach(row => {
                                            //     // Get the total price from the row and add it to the total
                                            //     const PayablePrice = parseFloat(row.cells[6].textContent);
                                            //     if (!isNaN(PayablePrice)) {
                                            //         totalPayablePrice += PayablePrice;
                                            //     }
                                            // });
                                            // document.querySelectorAll('#myTable tr').forEach(row => {
                                            //     // Get the total price from the row and add it to the total
                                            //     const PayablePrice1 = parseFloat(row.cells[7].textContent);
                                            //     if (!isNaN(PayablePrice1)) {
                                            //         totalProfit += PayablePrice1;
                                            //     }
                                            // });
                                            // // totalPayablePrice = new Intl.NumberFormat("de-DE").format(
                                            // // totalPayablePrice);
                                            // // alert(totalPayablePrice);
                                            // totalProfit = totalProfit.toFixed(2);
                                            // document.getElementById('sales').innerHTML = totalPayablePrice;
                                            // document.getElementById('profit').innerHTML = totalProfit;
                                            </script>
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

                        <?php
                                } else {  
                                ?>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Sales (Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }

                                        $sel_totSale = "SELECT SUM(bd.Price) AS totSale 
                                        FROM bill_data bd
                                        JOIN bill_head bh
                                            ON bh.billNo = bd.billNo 
                                            AND bh.BillingBranch = bd.BillingBranch
                                        JOIN items i 
                                            ON bd.ItemCode = i.itemCode
                                        WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                        AND DATE(bh.timespam) <= '" . $toDate . "' 
                                        AND bh.cansel = 0";

                                        $run_totSale = mysqli_query($con, $sel_totSale);
                                        $row_totSale = mysqli_fetch_assoc($run_totSale);
                                        $totSale = $row_totSale['totSale'];
                                        if (is_null($totSale)){
                                            $totSale = 0.00;
                                        } else {
                                            $totSale = number_format($totSale,2, '.', ',');
                                        }

                                    ?></code>
                                    </h4>

                                    <h2 class="text-center"><?php echo $totSale; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Profit (Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }

                                        $sel_totProfit = "SELECT SUM(bd.profit) AS totProfit
                                        FROM bill_data bd
                                        JOIN bill_head bh
                                            ON bh.billNo = bd.billNo 
                                            AND bh.BillingBranch = bd.BillingBranch
                                        JOIN items i 
                                            ON bd.ItemCode = i.itemCode
                                        WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                        AND DATE(bh.timespam) <= '" . $toDate . "' 
                                        AND bh.cansel = 0 ";

                                        $run_totProfit = mysqli_query($con, $sel_totProfit);
                                        $row_totProfit = mysqli_fetch_assoc($run_totProfit);
                                        $totProfit = $row_totProfit['totProfit'];
                                        if (is_null($totProfit)){
                                            $totProfit = 0.00;
                                        } else {
                                            $totProfit = number_format($totProfit,2, '.', ',');
                                        }
                                    ?></code>
                                    </h4>

                                    <h2 class="text-center"><?php echo $totProfit; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bill Count <code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                    ?></code>
                                    </h4>
                                    <?php
                                        // Execute query for bill count
                                        $sel_today_bill = "SELECT COUNT(bh.billNo) AS Bill_count 
                                            FROM bill_head bh
                                            JOIN bill_data bd 
                                                ON bh.billNo = bd.billNo 
                                                AND bh.BillingBranch = bd.BillingBranch
                                            JOIN items i 
                                                ON bd.ItemCode = i.itemCode
                                            WHERE DATE(bh.timespam) >= '" . $fromDate . "' 
                                            AND DATE(bh.timespam) <= '" . $toDate . "' 
                                            AND bh.cansel = 0";

                                        $run_today_bill = mysqli_query($con, $sel_today_bill);
                                        $row_today_bill = mysqli_fetch_assoc($run_today_bill);
                                        $Bill_count = $row_today_bill['Bill_count'];
                                    ?>
                                    <h2 class="text-center"><?php echo number_format($Bill_count); ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Cancel Bill Total(Rs.)<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                    ?></code>
                                    </h4>
                                    <?php
                                        // Execute query for total canceled bill
                                        $sel_today_bill = "SELECT SUM(bd.Price) AS TotalPrice
                                            FROM bill_head bh
                                            JOIN bill_data bd 
                                                ON bh.billNo = bd.billNo 
                                                AND bh.BillingBranch = bd.BillingBranch
                                            JOIN items i 
                                                ON bd.ItemCode = i.itemCode
                                            WHERE bh.cansel = 2
                                            AND DATE(bh.timespam) >= '" . $fromDate . "'
                                            AND DATE(bh.timespam) <= '" . $toDate . "' ";

                                        $run_today_bill = mysqli_query($con, $sel_today_bill);
                                        $row_today_bill = mysqli_fetch_assoc($run_today_bill);
                                        $todayCBillTotal = $row_today_bill['TotalPrice'];

                                        if($todayCBillTotal == ""){
                                            $todayCBillTotal=0;
                                        }
                                    ?>
                                    <h2 class="text-center"><?php echo number_format($todayCBillTotal, 2, '.', ','); ?>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bills<code><br>
                                    <?php
                                        if ($fromDate == $toDate){
                                            echo "Date: ".$fromDate; 
                                        } else {
                                            echo "From: ".$fromDate."<br>To: ".$toDate; 
                                        }
                                    ?></code></h4>

                                    <div class="table-responsive pt-3">
                                        <input type="text" id="myInput" onkeyup="myFunction()"
                                            placeholder="Search for names.." title="Type in a name">
                                        <div style="overflow-y: auto; max-height: 500px;">
                                            <table class="table table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Branch No.</th>
                                                        <th>Bill No.</th>
                                                        <th>Cashier</th>
                                                        <th>Total Price</th>
                                                        <th>Total Discount</th>
                                                        <th>Total Payable Amount</th>
                                                        <th>Total Profit</th>
                                                        <th>Bill Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    $sel_query12 = "SELECT * FROM bill_head WHERE DATE(timespam)>='".$fromDate."' AND DATE(timespam)<='".$toDate."'  and cansel=0";
                                                    $result12 = mysqli_query($con, $sel_query12);
                                                    while ($row = mysqli_fetch_assoc($result12)) {

                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $count; ?></th>
                                                        <td><?php echo $row["BillingBranch"]; ?></td>
                                                        <td><?php echo $row["billNo"]; ?></td>
                                                        <td><?php echo $row["Cashier"]; ?></td>
                                                        <td><?php echo $row["billTotal"]; ?></td>
                                                        <td><?php echo $row["TotalDiscountSend"]; ?></td>
                                                        <td><?php echo $row["PaybleBillAmountSend"]; ?></td>
                                                        <td><?php echo $row["totalProfit"]; ?></td>
                                                        <td><?php echo date('Y-m-d', strtotime($row['timespam'])); ?>
                                                        </td>
                                                        <td><a class="btn btn-primary btn-sm"
                                                                href="adminBillItem.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>&billNo=<?php echo $row["billNo"]; ?>&BillingBranch=<?php echo $row["BillingBranch"]; ?>">View
                                                                Bill</a></td>
                                                    </tr>
                                                    <?php $count++; } ?>
                                                </tbody>
                                            </table>
                                            <script>
                                            // let totalPayablePrice = 0.00;
                                            // let totalProfit = 0.00;
                                            // document.querySelectorAll('#myTable tr').forEach(row => {
                                            //     // Get the total price from the row and add it to the total
                                            //     const PayablePrice = parseFloat(row.cells[6].textContent);
                                            //     if (!isNaN(PayablePrice)) {
                                            //         totalPayablePrice += PayablePrice;
                                            //     }
                                            // });
                                            // document.querySelectorAll('#myTable tr').forEach(row => {
                                            //     // Get the total price from the row and add it to the total
                                            //     const PayablePrice1 = parseFloat(row.cells[7].textContent);
                                            //     if (!isNaN(PayablePrice1)) {
                                            //         totalProfit += PayablePrice1;
                                            //     }
                                            // });
                                            // // totalPayablePrice = new Intl.NumberFormat("de-DE").format(
                                            // // totalPayablePrice);
                                            // // alert(totalPayablePrice);
                                            // totalProfit = totalProfit.toFixed(2);
                                            // document.getElementById('sales').innerHTML = totalPayablePrice;
                                            // document.getElementById('profit').innerHTML = totalProfit;
                                            </script>
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

                        <?php
                                }  

                            } 
                            ?>


                        <?php 
                        } ?>

                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"></span>
                        <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Focus Solution (PVT)
                            LTD</span>
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
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/dashboard.js"></script>
    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
</body>

</html>
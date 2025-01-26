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

                        <div class="col-sm-12">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"
                                            style="color:white; background-color: darkblue; padding:5px; border-radius:5px;">
                                            Transfer</h4>
                                        <p class="card-description"> Please Fill All Fields</p>
                                        <form
                                            action="MATransferItems.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>&transferBranch=<?php echo $branchCode; ?>"
                                            method="POST" class="forms-sample">
                                            <div class="row">
                                                <div class="col-md-4 form-group">
                                                    <label for="BranchCode">Branch code</label>
                                                    <input type="text" id="BranchCode" name="BranchCode"
                                                        class="form-control" placeholder="Branch code" required
                                                        style="color:black; background-color: #EBEDEF;"
                                                        list="BranchList">
                                                    <datalist id="BranchList">
                                                        <?php
                                                            $select_branches = "select * from branches where branchCode!='".$branchCode."' ORDER BY branchName ASC";
                                                            $run_branches = mysqli_query($con, $select_branches);
                                                            while ($row_branches = mysqli_fetch_assoc($run_branches)) { 
                                                        ?>
                                                        <option value="<?php echo $row_branches['branchCode'];?>"
                                                            data-name="<?php echo $row_branches['branchName'];?>">
                                                            <?php echo $row_branches['branchName'];?>
                                                        </option>
                                                        <?php } ?>
                                                    </datalist>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="BranchName">Branch Name</label>
                                                    <input type="text" id="BranchName" name="BranchName"
                                                        class="form-control" placeholder="Branch Name" required
                                                        style="color:black; background-color: #EBEDEF;">
                                                </div>

                                                <script>
                                                document.getElementById('BranchCode').addEventListener('input',
                                                    function() {
                                                        var selectedBranchCode = this.value;
                                                        var optionsBranchList = document.getElementById(
                                                            'BranchList').options;
                                                        var isSelectedBranch = false;

                                                        // Check if the entered value matches any option in the datalist
                                                        for (var i = 0; i < optionsBranchList.length; i++) {
                                                            if (optionsBranchList[i].value === selectedBranchCode) {
                                                                isSelectedBranch = true;
                                                                document.getElementById('BranchName').value =
                                                                    optionsBranchList[i].getAttribute('data-name');
                                                                break;
                                                            }
                                                        }

                                                        // If no match is found, clear the BranchName input
                                                        if (!isSelectedBranch) {
                                                            document.getElementById('BranchName').value = '';
                                                        }
                                                    });
                                                </script>

                                                <div class="col-md-4 form-group">
                                                    <?php
                                                        $select_purches = "SELECT trancferNo FROM branches where branchCode='".$branchCode."'";
                                                        $run_purches = mysqli_query($con,$select_purches);
                                                        $row_purches = mysqli_fetch_assoc($run_purches);
                                                        $purches = $row_purches['trancferNo']+1;
                                                    ?>
                                                    <label for="TransferNo">Transfer No.</label>
                                                    <input type="text" name="TransferNo" class="form-control"
                                                        value="<?php echo $purches; ?>" id="TransferNo"
                                                        placeholder="Transfer No." required readonly
                                                        style="color:black; background-color: #FCF3CF;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 form-group">
                                                    <label for="PurchesNo">Item Code</label>
                                                    <input type="text" name="ItemCode" id="ItemCode"
                                                        class="form-control"
                                                        style="color:black; background-color: #EBEDEF;"
                                                        list="exampleList">
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
                                                <div class="col-md-4 form-group">
                                                    <label for="ItemName">Item name</label>
                                                    <input type="text" name="ItemName" class="form-control"
                                                        id="ItemName" placeholder="Item name"
                                                        style="color:black; background-color: #FDEBD0;">
                                                </div>
                                                <div class="col-md-2 form-group" style="display:none;">
                                                    <label for="availableQTY">Available QTY</label>
                                                    <input type="text" id="availableQTY" class="form-control">
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="QTY">QTY</label>
                                                    <input type="text" name="QTY" class="form-control" id="QTY"
                                                        placeholder="QTY"
                                                        style="color:black; background-color: #D4E6F1;">
                                                </div>
                                                <script>
                                                document.getElementById('QTY').addEventListener('input', function() {
                                                    var checkQTY =
                                                        0; // Declare outside event listener to persist value

                                                    var available = document.getElementById('availableQTY')
                                                        .value;
                                                    var transferQTY = this
                                                        .value; // 'this' refers to the input that triggered the event

                                                    if (transferQTY > available && checkQTY === 0) {
                                                        alert("Exceeded Quantity Limit.\nAvailable Quantity is " +
                                                            available);
                                                        checkQTY = 1;
                                                    }
                                                });
                                                </script>
                                                <div class="col-md-2 form-group">
                                                    <label for="CostPrice">Cost price (Rs.)</label>
                                                    <input type="text" name="CostPrice" class="form-control"
                                                        id="CostPrice" placeholder="Cost price"
                                                        style="color:black; background-color: #D4E6F1;">
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="TotalPrice">Total price (Rs.)</label>
                                                    <input type="text" name="TotalPrice" class="form-control"
                                                        id="TotalPrice" placeholder="Total price"
                                                        style="color:black; background-color: #D1F2EB;">
                                                </div>
                                                <script>
                                                // Function to calculate total price
                                                function calculateTotal() {
                                                    // Get the values of quantity and cost price
                                                    var quantity = parseFloat(document.getElementById('QTY').value);
                                                    var costPrice = parseFloat(document.getElementById('CostPrice')
                                                        .value);

                                                    // Calculate total price
                                                    var totalPrice = quantity * costPrice;

                                                    // Display total price
                                                    document.getElementById('TotalPrice').value = isNaN(totalPrice) ?
                                                        '' : totalPrice.toFixed(
                                                            2); // Display only if totalPrice is a valid number
                                                }

                                                // Call the calculateTotal function whenever quantity or cost price changes
                                                document.getElementById('QTY').addEventListener('input',
                                                    calculateTotal);
                                                document.getElementById('CostPrice').addEventListener('input',
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

                                                <div class="col-md-2 form-group" style="display:none;">
                                                    <label for="SellingPrice">Selling Price</label>
                                                    <input type="text" name="SellingPrice" class="form-control"
                                                        id="SellingPrice" placeholder="Selling Price"
                                                        style="color:black; background-color: #FADBD8;">
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
                                                Cart</button>
                                            <!-- Hidden input fields to store values for PHP arrays -->
                                            <input type="text" name="rowData" id="rowData" required
                                                style="display:none;"><br>

                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th> # </th>
                                                        <th> Item code </th>
                                                        <th> Item name </th>
                                                        <th> QTY </th>
                                                        <th> Cost price (Rs.) </th>
                                                        <th> Total price (Rs.) </th>
                                                        <th> Selling Price </th>
                                                        <th> </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="purchTableBody">

                                                </tbody>
                                            </table><br><br>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <h2 style="float:left;">Total Amount Rs. <span id="purchTot"></span>
                                                    </h2>
                                                    <h2 style="float:right;">Total Item Count: <span
                                                            id="itemTot">0</span></h2>
                                                    <input type="text" name="purchTotal" id="purchTotal"
                                                        style="display:none;" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <button type="submit" id="submitBTN"
                                                    class="btn btn-success">Transfer</button>
                                            </div>
                                        </form>
                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <script>
                                        $(document).ready(function() {

                                            $(window).keydown(function(event) {
                                                if (event.keyCode == 13) {
                                                    event.preventDefault();
                                                    // $('#addPurch').click();
                                                    $('#BranchCode').focus();
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
                                                    $('#QTY').focus();
                                                    return false;
                                                }
                                                if (event.keyCode === 27) {
                                                    event.preventDefault();
                                                    $('#submitBTN').click();
                                                    // $('#paymentM').focus();
                                                    return false;
                                                }
                                            });
                                            $('#QTY').keydown(function(event) {
                                                if (event.keyCode === 13) {
                                                    event.preventDefault();
                                                    $('#addPurch').click();
                                                    $('#ItemCode').focus();
                                                    return false;
                                                }
                                            });
                                            // $('#paymentM').keydown(function(event) {
                                            //     if (event.keyCode == 13) {
                                            //         if (this.value === 'cq') {
                                            //             event.preventDefault();
                                            //             // $('#addPurch').click();
                                            //             $('#chequeNo').focus();
                                            //             return false;
                                            //         }
                                            //         if (this.value === 'c') {
                                            //             event.preventDefault();
                                            //             $('#submitBTN').click();
                                            //             // $('#ItemCode').focus();
                                            //             return false;
                                            //         }
                                            //     }
                                            // });
                                            // $('#chequeNo').keydown(function(event) {
                                            //     if (event.keyCode == 13) {
                                            //         event.preventDefault();
                                            //         // $('#submitBTN').click();
                                            //         $('#chequeDate').focus();
                                            //         return false;
                                            //     }
                                            // });
                                            // $('#chequeDate').keydown(function(event) {
                                            //     if (event.keyCode == 13) {
                                            //         event.preventDefault();
                                            //         // $('#submitBTN').click();
                                            //         $('#chequeAmount').focus();
                                            //         return false;
                                            //     }
                                            // });
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
                                            const qty = document.getElementById('QTY').value;
                                            const costPrice = document.getElementById('CostPrice').value;
                                            const totalPrice = document.getElementById('TotalPrice').value;
                                            const sellingPrice = document.getElementById('SellingPrice').value;

                                            // Create a new row
                                            const newRow = `
                                                <tr>
                                                    <td>${rowNum}</td>
                                                    <td>${itemCode}</td>
                                                    <td>${itemName}</td>
                                                    <td>${qty}</td>
                                                    <td>${costPrice}</td>
                                                    <td>${totalPrice}</td>
                                                    <td>${sellingPrice}</td>
                                                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, ${rowNum - 1})">x</button></td>
                                                </tr>
                                            `;

                                            // Append the new row to the table body
                                            document.getElementById('purchTableBody').insertAdjacentHTML('beforeend',
                                                newRow);

                                            // Construct JSON object for row data
                                            const rowData = {
                                                itemCode: itemCode,
                                                itemName: itemName,
                                                qty: qty,
                                                costPrice: costPrice,
                                                totalPrice: totalPrice,
                                                sellingPrice: sellingPrice
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
                                            document.getElementById('QTY').value = '';
                                            document.getElementById('CostPrice').value = '';
                                            document.getElementById('TotalPrice').value = '';
                                            document.getElementById('SellingPrice').value = '';
                                        }

                                        // Function to calculate total purchase amount
                                        function calculatePurchaseTotal() {
                                            let total = 0;
                                            // Iterate through each row in the table
                                            document.querySelectorAll('#purchTableBody tr').forEach(row => {
                                                // Get the total price from the row and add it to the total
                                                const totalPrice = parseFloat(row.cells[5].textContent);
                                                if (!isNaN(totalPrice)) {
                                                    total += totalPrice;
                                                }
                                            });
                                            // Update the purchTot label with the total amount
                                            document.getElementById('purchTot').textContent = total.toFixed(2);
                                            document.getElementById('purchTotal').value = total.toFixed(2);

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

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Pending Transfer Note</h4>

                                    <div class="table-responsive pt-3">
                                        <input type="text" id="myInput" onkeyup="myFunction()"
                                            placeholder="Search for names.." title="Type in a name">
                                        <div style="overflow-y: auto; max-height: 500px;">
                                            <table class="table table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Receive Branch Code</th>
                                                        <th>Receive Branch Name</th>
                                                        <th>Transfer Stock Value</th>
                                                        <th>Transfer Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    $sel_query12 = "SELECT transfer_head.TransferNo,transfer_head.TransferBranchCode,transfer_head.ReceiveBranchCode,branches.branchName,transfer_head.TransferTot,transfer_head.timeSpan FROM transfer_head,branches WHERE transfer_head.ReceiveBranchCode=branches.branchCode and transfer_head.TransferBranchCode='".$branchCode."' and checked=0";
                                                    $result12 = mysqli_query($con, $sel_query12);
                                                    while ($row = mysqli_fetch_assoc($result12)) {
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $count; ?></th>
                                                        <td><?php echo $row["ReceiveBranchCode"]; ?></td>
                                                        <td><?php echo $row["branchName"]; ?></td>
                                                        <td><?php echo $row["TransferTot"]; ?></td>
                                                        <td><?php echo date('Y-m-d', strtotime($row["timeSpan"])); ?>
                                                        </td>
                                                        <td><a class="btn btn-primary btn-sm"
                                                                href="MAPendingTransferItems.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>&TransferNo=<?php echo $row["TransferNo"]; ?>&TransferBranchCode=<?php echo $row["TransferBranchCode"]; ?>&ReceiveBranchCode=<?php echo $row["ReceiveBranchCode"]; ?>">Transfer
                                                                Items</a>
                                                        </td>
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
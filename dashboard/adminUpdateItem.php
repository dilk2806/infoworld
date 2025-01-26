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
    $message = "Successfully Updated Item.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $count = 1;
}
if ($alert == 5 && $count == 0) {
    $message = "Successfully Updated Catagory.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $count = 1;
}
if ($alert == 6 && $count == 0) {
    $message = "Successfully Updated Brand.";
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

                        <div class="col-sm-12">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"
                                            style="color:white; background-color: darkblue; padding:5px; border-radius:5px;">
                                            Update Item</h4>
                                        <p class="card-description"> Please Fill All Fields</p>
                                        <form action="updateItem.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>"
                                            method="POST" class="forms-sample">
                                            <div class="row">
                                                <div class="col-md-3 form-group">
                                                    <label for="CatagoryCodeUpdate">Category code</label>
                                                    <select name="CatagoryCodeUpdate" id="CatagoryCodeUpdate"
                                                        class="validate[required] form-control" required
                                                        style="color:black; background-color: #EBEDEF;">
                                                        <option value="">Select a Category code</option>
                                                        <?php
                                                        $select_catCode = "select * from categories";
                                                        $run_catCode = mysqli_query($con,$select_catCode);
                                                        while($row = mysqli_fetch_assoc($run_catCode)){ 
                                                            echo "<option value='" . $row['catCode'] . "' data-name='" . $row['catName'] . "'>" . $row['catCode'] . " - " . $row['catName']. "</option>";
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <label for="CatagoryNameUpdate">Catagory name</label>
                                                    <input type="text" name="CatagoryNameUpdate" class="form-control"
                                                        id="CatagoryNameUpdate" placeholder="Catagory name" required
                                                        readonly style="color:black; background-color: #EBEDEF;">
                                                </div>
                                                <script>
                                                document.getElementById('CatagoryCodeUpdate').addEventListener('change',
                                                    function() {
                                                        var selectedOption = this.options[this.selectedIndex];
                                                        document.getElementById('CatagoryNameUpdate').value =
                                                            selectedOption
                                                            .dataset
                                                            .name;
                                                    });
                                                </script>
                                                <div class="col-md-3 form-group">
                                                    <label for="BrandCodeUpdate">Brand code</label>
                                                    <select name="BrandCodeUpdate" id="BrandCodeUpdate"
                                                        class="validate[required] form-control" required
                                                        style="color:black; background-color: #FCF3CF;">
                                                        <option value="">Select a brand code</option>
                                                    </select>
                                                </div>
                                                <script>
                                                $(document).ready(function() {
                                                    $('#CatagoryCodeUpdate').change(function() {
                                                        var CatagoryCode = $(this).val();
                                                        $.ajax({
                                                            url: 'searchBrandCode.php',
                                                            method: 'POST',
                                                            data: {
                                                                CatagoryCode: CatagoryCode
                                                            },
                                                            success: function(data) {
                                                                // data = data.replace(/'/g,
                                                                //     '');
                                                                $('#BrandCodeUpdate').html(
                                                                    '<option value="" data-brand=""></option>' +
                                                                    data);
                                                            }
                                                        });
                                                    });
                                                });
                                                </script>
                                                <div class="col-md-3 form-group">
                                                    <label for="BrandNameUpdate">Brand name</label>
                                                    <input type="text" name="BrandNameUpdate" class="form-control"
                                                        id="BrandNameUpdate" placeholder="Brand name" required
                                                        style="color:black; background-color: #FCF3CF;">
                                                </div>
                                                <script>
                                                document.getElementById('BrandCodeUpdate').addEventListener('change',
                                                    function() {
                                                        var selectedOption1 = this.options[this.selectedIndex];
                                                        document.getElementById('BrandNameUpdate').value =
                                                            selectedOption1
                                                            .dataset
                                                            .brand;
                                                    });
                                                </script>
                                                <script>
                                                $(document).ready(function() {
                                                    $('#BrandCodeUpdate').change(function() {
                                                        var BrandCode = $(this).val();
                                                        // alert(ItemCode);
                                                        $.ajax({
                                                            url: 'searchItemCode.php',
                                                            method: 'POST',
                                                            data: {
                                                                BrandCode: BrandCode
                                                            },
                                                            success: function(data) {
                                                                // data = data.replace(/'/g,
                                                                //     '');
                                                                $('#ItemCode').html(
                                                                    '<option value="" data-item="" data-cost="" data-sell="" data-reorder=""></option>' +
                                                                    data);
                                                            }
                                                        });
                                                    });
                                                });
                                                </script>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 form-group">
                                                    <label for="ItemCode">Item code</label>
                                                    <select name="ItemCode" id="ItemCode"
                                                        class="validate[required] form-control" required
                                                        style="color:black; background-color: #FDEBD0;">
                                                        <option value="">Select a brand code</option>
                                                    </select>
                                                </div>
                                                <script>
                                                document.getElementById('ItemCode').addEventListener('change',
                                                    function() {
                                                        var selectedOption1 = this.options[this.selectedIndex];
                                                        document.getElementById('ItemName').value =
                                                            selectedOption1
                                                            .dataset
                                                            .item;
                                                        document.getElementById('CostPrice').value =
                                                            selectedOption1
                                                            .dataset
                                                            .cost;
                                                        document.getElementById('SellingPrice').value =
                                                            selectedOption1
                                                            .dataset
                                                            .sell;
                                                        document.getElementById('ReorderLevel').value =
                                                            selectedOption1
                                                            .dataset
                                                            .reorder;
                                                    });
                                                </script>
                                                <div class="col-md-9 form-group">
                                                    <label for="ItemName">Item name</label>
                                                    <input type="text" name="ItemName" class="form-control"
                                                        id="ItemName" placeholder="Item name" required
                                                        style="color:black; background-color: #FDEBD0;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 form-group">
                                                    <label for="CostPrice">Cost price (Rs.)</label>
                                                    <input type="text" name="CostPrice" class="form-control"
                                                        id="CostPrice" placeholder="Cost price" required
                                                        style="color:black; background-color: #D4E6F1;">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="SellingPrice">Selling price (Rs.)</label>
                                                    <input type="text" name="SellingPrice" class="form-control"
                                                        id="SellingPrice" placeholder="Selling price" required
                                                        style="color:black; background-color: #D1F2EB;">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="ReorderLevel">Reorder level</label>
                                                    <input type="text" name="ReorderLevel" class="form-control"
                                                        id="ReorderLevel" placeholder="Reorder level" required
                                                        style="color:black; background-color: #FADBD8;">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary me-2">Update</button>
                                            <button type="reset" class="btn btn-light">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title"
                                                style="color:white; background-color: darkblue; padding:5px; border-radius:5px;">
                                                Update Catgorys</h4>
                                            <p class="card-description"> Please Fill All Fields</p>
                                            <form
                                                action="updateCatagory.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>"
                                                method="POST" class="forms-sample">
                                                <div class="form-group">
                                                    <label for="CatagoryCodeU">Category code</label>
                                                    <select name="CatagoryCodeU" id="CatagoryCodeU"
                                                        class="validate[required] form-control" required>
                                                        <option value="">Select a Category code</option>
                                                        <?php
                                                        $select_catCode = "select * from categories";
                                                        $run_catCode = mysqli_query($con,$select_catCode);
                                                        while($row = mysqli_fetch_assoc($run_catCode)){ 
                                                            echo "<option value='" . $row['catCode'] . "' data-name='" . $row['catName'] . "'>" . $row['catCode'] . " - " . $row['catName']. "</option>";
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="CatagoryNameU">Catagory name</label>
                                                    <input type="text" name="CatagoryNameU" class="form-control"
                                                        id="CatagoryNameU" placeholder="Catagory name" required>
                                                </div>
                                                <script>
                                                document.getElementById('CatagoryCodeU').addEventListener('change',
                                                    function() {
                                                        var selectedOption = this.options[this.selectedIndex];
                                                        document.getElementById('CatagoryNameU').value =
                                                            selectedOption
                                                            .dataset
                                                            .name;
                                                    });
                                                </script>
                                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                                <button type="reset" class="btn btn-light">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title"
                                                style="color:white; background-color: darkblue; padding:5px; border-radius:5px;">
                                                Update Brand</h4>
                                            <p class="card-description"> Please Fill All Fields</p>
                                            <form id="brandReg"
                                                action="updateBrand.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>"
                                                method="POST" class="forms-sample">
                                                <div class="form-group">
                                                    <label for="CatagoryCode">Category code</label>
                                                    <select name="CatagoryCode" id="CatagoryCode"
                                                        class="validate[required] form-control" required>
                                                        <option value="">Select a Category code</option>
                                                        <?php
                                                        $select_catCode = "select * from categories";
                                                        $run_catCode = mysqli_query($con,$select_catCode);
                                                        while($row = mysqli_fetch_assoc($run_catCode)){ 
                                                            echo "<option value='" . $row['catCode'] . "' data-name='" . $row['catName'] . "'>" . $row['catCode'] ." - ".$row['catName']. "</option>";
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="BrandCode">Brand code</label>
                                                    <select name="BrandCode" id="BrandCode"
                                                        class="validate[required] form-control" required>
                                                        <option value="">Select a brand code</option>
                                                    </select>
                                                </div>
                                                <script>
                                                $(document).ready(function() {
                                                    $('#CatagoryCode').change(function() {
                                                        var CatagoryCode = $(this).val();
                                                        $.ajax({
                                                            url: 'searchBrandCode.php',
                                                            method: 'POST',
                                                            data: {
                                                                CatagoryCode: CatagoryCode
                                                            },
                                                            success: function(data) {
                                                                // data = data.replace(/'/g,
                                                                //     '');
                                                                $('#BrandCode').html(
                                                                    '<option value="" data-brand=""></option>' +
                                                                    data);
                                                            }
                                                        });
                                                    });
                                                });
                                                </script>
                                                <div class="form-group">
                                                    <label for="BrandName">Brand name</label>
                                                    <input type="text" name="BrandName" class="form-control"
                                                        id="BrandName" placeholder="Brand name" required>
                                                </div>
                                                <script>
                                                document.getElementById('BrandCode').addEventListener('change',
                                                    function() {
                                                        var selectedOption1 = this.options[this.selectedIndex];
                                                        document.getElementById('BrandName').value = selectedOption1
                                                            .dataset
                                                            .brand;
                                                    });
                                                </script>
                                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                                <button type="reset" class="btn btn-light">Cancel</button>
                                            </form>
                                        </div>
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
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/dashboard.js"></script>
    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
</body>

</html>
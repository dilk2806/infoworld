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
                                            Change Password</h4>
                                        <p class="card-description"> Please Fill All Fields</p>
                                        <form action="newPass.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>"
                                            method="POST" class="forms-sample">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="newPW">New Password</label>
                                                    <input type="text" name="newPW" class="form-control" id="newPW"
                                                        placeholder="New Password" required>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="coPW">Re Enter the Password</label>
                                                    <input type="text" name="coPW" class="form-control" id="coPW"
                                                        placeholder="Re Enter the Password" required>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary me-2">Change</button>
                                            <button type="reset" class="btn btn-light">Cancel</button>
                                        </form>
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
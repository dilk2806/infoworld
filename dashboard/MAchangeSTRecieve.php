<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$returnNo = $_REQUEST['returnNo'];
$itemCode = $_REQUEST['itemCode'];
$done = $_REQUEST['done'];

$select_admin = "select * from `user` where `lid`='".$lid."'";
$run_admin = mysqli_query($con,$select_admin);
$row_admin = mysqli_fetch_assoc($run_admin);

$fname = $row_admin['fname'];
$wa = $row_admin['wa'];
$ut = $row_admin['user_type'];
$branchCode = $row_admin['branchCode'];

$costPrice = isset($_POST['costPrice']) ? $_POST['costPrice'] : null;
// echo '<script>alert("' . $costPrice . '");</script>';

$recievePrice = isset($_POST['recievePrice']) ? $_POST['recievePrice'] : null;
// echo '<script>alert("' . $recievePrice . '");</script>';

$repair = isset($_POST['recievePrice']) ? $_POST['repair'] : null;
$worrenty = isset($_POST['recievePrice']) ? $_POST['worrenty'] : null;


if ($done == 1) {

    $today = date("Y-m-d");
    $update_serialST = "UPDATE `retun_items_data` SET new_worrent='".$worrenty."', repair='".$repair."', `recieveDate`='".$today."',`status`='3',costPrice='".$costPrice."',recievePrice='".$recievePrice."' WHERE branchCode='".$branchCode."' and itemCode='".$itemCode."' and returnNo='".$returnNo."'";
    mysqli_query($con,$update_serialST);

    header("Location:MARecieve.php?lid=$lid&home=$home&alert=4");
} else {
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

    <div class="container">
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-sm-8">
                <div class="card">
                    <div class="text-center">
                        <div class="card-body">
                            <h4 class="card-title"
                                style="color:white; background-color: darkblue; padding:5px; border-radius:5px;">
                                Enter Cost Price and Customer Issue Price
                            </h4>
                            <p class="card-description"> </p>
                            <form
                                action="MAchangeSTRecieve.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>&returnNo=<?php echo $returnNo; ?>&itemCode=<?php echo $itemCode; ?>&done=1"
                                method="POST" class="forms-sample">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="costPrice">Cost Price</label>
                                        <input type="text" name="costPrice" class="form-control" id="costPrice"
                                            placeholder="Cost Price" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="recievePrice">Customer Issue Price</label>
                                        <input type="text" name="recievePrice" class="form-control" id="recievePrice"
                                            placeholder="Customer Issue Price" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="repair">REPAIR / REPLACEMENT </label>
                                        <input type="text" name="repair" class="form-control" id="repair"
                                            placeholder="REPAIR / REPLACEMENT " required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="worrenty">Worrenty</label>
                                        <select id="worrenty" name="worrenty" class="form-control">
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
                                </div><br><br>
                                <button type="submit" id="submitBTN" class="btn btn-primary me-2">Add</button>
                                <button type="reset" class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-auto py-3">
        <div class="container">
            <div class="d-flex justify-content-center">
                <span class="text-muted text-center">Copyright © 2024. All rights reserved.</span>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {

        $(window).keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                // $('#addPurch').click();
                $('#costPrice').focus();
                $('#costPrice').select();
                return false;
            }
        });
        $('#costPrice').keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                // $('#addPurch').click();
                $('#recievePrice').focus();
                $('#recievePrice').select();
                return false;
            }
        });
        $('#recievePrice').keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                // $('#submitBTN').click();
                $('#repair').focus();
                $('#repair').select();
                return false;
            }
        });
        $('#repair').keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                // $('#submitBTN').click();
                $('#worrenty').focus();
                $('#worrenty').select();
                return false;
            }
        });
        $('#worrenty').keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                $('#submitBTN').click();
                // $('#worrenty').focus();
                // $('#worrenty').select();
                return false;
            }
        });
    });
    </script>

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

<?php } ?>
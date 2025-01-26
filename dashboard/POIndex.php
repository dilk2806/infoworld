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
    $message = "Purchase successful.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $count = 1;
}
if ($alert == 2 && $count == 0) {
    $message = "Purchase is Empty.";
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
                            <a class="dropdown-item"
                                href="POIndex.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                                <i class="mdi mdi-grid-large dropdown-item-icon text-primary me-2"></i>
                                <span class="menu-title">Purchasing</span>
                            </a>
                            <a class="dropdown-item"
                                href="POCanselPurchase.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                                <i class="fa fa-cubes dropdown-item-icon text-primary me-2"></i>
                                <span class="menu-title">Cansel Purchase</span>
                            </a>
                            <a class="dropdown-item"
                                href="POStock.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>">
                                <i class="dropdown-item-icon mdi mdi-chart-line text-primary me-2"></i>
                                <span class="menu-title">Stock</span>
                            </a>
                            <a href="POProfile.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>"
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
        </nav><br><br><br><br>
        <!-- partial -->

        <div class="row">

            <div class="col-sm-12">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"
                                style="color:white; background-color: darkblue; padding:5px; border-radius:5px; margin-top:0; margin-bottom:0;">
                                Purchasing</h4>
                            <p class="card-description" style="margin-top:0; margin-bottom:0;"> Please Fill
                                All Fields</p>
                            <form
                                action="PurchesItems.php?lid=<?php echo $lid; ?>&home=<?php echo $home; ?>&branchCode=<?php echo $branchCode; ?>"
                                method="POST" class="forms-sample">
                                <div class="row" style="margin-top:0; margin-bottom:0;">
                                    <div class="col-md-3 form-group" style="margin-top:0; margin-bottom:0;">
                                        <label for="SuplierCode"><b>Supplier code</b></label>
                                        <input type="text" id="SuplierCode" name="SuplierCode" class="form-control"
                                            placeholder="Supplier code" required
                                            style="color:black; background-color: #EBEDEF;" list="SupCode">
                                        <datalist id="SupCode">
                                            <?php
                                                            $select_catCode = "select * from suplier";
                                                            $run_catCode = mysqli_query($con,$select_catCode);
                                                            while($row = mysqli_fetch_assoc($run_catCode)){ ?>
                                            <option value="<?php echo $row['SuplierCode']; ?>"
                                                data-name="<?php echo $row['SuplierName']; ?>">
                                                <?php echo $row['SuplierName']; ?></option>
                                            <?php } ?>
                                        </datalist>
                                    </div>
                                    <script>
                                    document.getElementById('SuplierCode').addEventListener('input',
                                        function() {
                                            var selectedItem1 = this.value;
                                            var optionsList1 = document.getElementById('SupCode')
                                                .options;

                                            // Check if the entered value matches any option in the datalist
                                            for (var i = 0; i < optionsList1.length; i++) {
                                                if (optionsList1[i].value === selectedItem1) {
                                                    // If match found, update the supplier name field with the corresponding name
                                                    document.getElementById('SuplierName').value =
                                                        optionsList1[i].getAttribute('data-name');
                                                    break;
                                                }
                                            }
                                        });
                                    </script>
                                    <div class="col-md-5 form-group" style="margin-top:0; margin-bottom:0;">
                                        <label for="SuplierName"><b>Supplier name</b></label>
                                        <input type="text" name="SuplierName" class="form-control" id="SuplierName"
                                            placeholder="Supplier name" required readonly
                                            style="color:black; background-color: #EBEDEF;">
                                    </div>
                                    <script>
                                    document.getElementById('SuplierCode').addEventListener('change',
                                        function() {
                                            var selectedOption = this.options[this.selectedIndex];
                                            document.getElementById('SuplierName').value =
                                                selectedOption
                                                .dataset
                                                .name;

                                            document.getElementById('InvoiceNo').focus();
                                        });
                                    </script>
                                    <div class="col-md-2 form-group" style="margin-top:0; margin-bottom:0;">
                                        <label for="InvoiceNo"><b>Invoice No.</b></label>
                                        <input type="text" name="InvoiceNo" class="form-control" id="InvoiceNo"
                                            placeholder="Invoice No." required
                                            style="color:black; background-color: #FCF3CF;">
                                    </div>
                                    <div class="col-md-2 form-group" style="margin-top:0; margin-bottom:0;">
                                        <?php
                                                        $select_purches = "SELECT purchesNo FROM branches where branchCode='".$branchCode."'";
                                                        $run_purches = mysqli_query($con,$select_purches);
                                                        $row_purches = mysqli_fetch_assoc($run_purches);
                                                        $purches = $row_purches['purchesNo']+1;
                                                    ?>
                                        <label for="PurchesNo"><b>Purches No.</b></label>
                                        <input type="text" name="PurchesNo" class="form-control"
                                            value="<?php echo $purches; ?>" id="PurchesNo" placeholder="Purches No."
                                            required readonly style="color:black; background-color: #FCF3CF;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 form-group" style="margin-top:0; margin-bottom:0;">
                                        <label for="PurchesNo"><b>Item Code</b></label>
                                        <input type="text" name="ItemCode" id="ItemCode" class="form-control"
                                            style="color:black; background-color: #EBEDEF;" list="exampleList">
                                        <datalist id="exampleList">
                                            <?php
                                                            $select_catCode1 = "select * from items ORDER BY itemCode ASC";
                                                            $run_catCode1 = mysqli_query($con,$select_catCode1);
                                                            while($row1 = mysqli_fetch_assoc($run_catCode1)){ 
                                                        ?>
                                            <option value="<?php echo $row1['itemCode'];?>"
                                                data-name="<?php echo $row1['itemName'];?>"
                                                data-cost="<?php echo $row1['costPrice'] ?>"
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

                                                        break;
                                                    }
                                                }
                                            }
                                        });
                                    </script>
                                    <!-- // Focus on the QTY input field after selecting an item code
                                                    document.getElementById('QTY').focus(); -->
                                    <div class="col-md-2 form-group" style="margin-top:0; margin-bottom:0;">
                                        <label for="ItemName"><b>Item name</b></label>
                                        <input type="text" name="ItemName" class="form-control" id="ItemName"
                                            placeholder="Item name" style="color:black; background-color: #FDEBD0;">
                                    </div>
                                    <div class="col-md-2 form-group" style="margin-top:0; margin-bottom:0;">
                                        <label for="QTY"><b>QTY</b></label>
                                        <input type="text" name="QTY" class="form-control" id="QTY" placeholder="QTY"
                                            style="color:black; background-color: #D4E6F1;">
                                    </div>
                                    <div class="col-md-2 form-group" style="margin-top:0; margin-bottom:0;">
                                        <label for="CostPrice"><b>Cost price (Rs.)</b></label>
                                        <input type="text" name="CostPrice" class="form-control" id="CostPrice"
                                            placeholder="Cost price" style="color:black; background-color: #D4E6F1;">
                                    </div>
                                    <div class="col-md-2 form-group" style="margin-top:0; margin-bottom:0;">
                                        <label for="TotalPrice"><b>Total price (Rs.)</b></label>
                                        <input type="text" name="TotalPrice" class="form-control" id="TotalPrice"
                                            placeholder="Total price" style="color:black; background-color: #D1F2EB;">
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

                                    <div class="col-md-2 form-group" style="margin-top:0; margin-bottom:10px;">
                                        <label for="SellingPrice"><b>Selling Price</b></label>
                                        <input type="text" name="SellingPrice" class="form-control" id="SellingPrice"
                                            placeholder="Selling Price" style="color:black; background-color: #FADBD8;">
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
                                <button type="button" style="margin-top:0; margin-bottom:0;" id="addPurch"
                                    class="btn btn-primary me-2"><b>Add to
                                        Cart</b></button>
                                <!-- Hidden input fields to store values for PHP arrays -->
                                <input type="text" style="display:none;" name="rowData" id="rowData" required><br>
                                <!-- style="display:none;" -->
                                <div style="overflow-y: auto; max-height: 250px;">
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
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <h2 style="float:left;">Total Amount Rs. <span id="purchTot"></span>
                                        </h2>
                                        <h2 style="float:right;">Total Item Count: <span id="itemTot">0</span></h2>
                                        <input type="text" style="display:none;" name="purchTotal" id="purchTotal"
                                            required>
                                        <!-- style="display:none;" -->
                                    </div>
                                </div>
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
                                                    <tr style="margin-top:0; margin-bottom:10px; padding-top:2px; padding-bottom:2px;">
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
                                    document.getElementById('purchTableBody').insertAdjacentHTML(
                                        'beforeend',
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
                                    calculatePurchaseTotalCheque();
                                });
                                </script>

                                <div class="row ">
                                    <div class="col-md-3 form-group" id="paymentMethod">
                                        <label for="paymentM"><b>Payment Method</b></label>
                                        <select name="paymentM" id="paymentM" class="form-control"
                                            onchange="toggleChequeFields()">
                                            <option value="">Select Payment Method</option>
                                            <option value="c">Cash</option>
                                            <option value="cq">Cheque</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2 form-group" id="cheque1" style="display:none;">
                                        <label for="chequeNo"><b>Cheque No.</b></label>
                                        <input type="text" name="chequeNo" class="form-control" id="chequeNo"
                                            placeholder="Cheque No." style="color:black; background-color: #D4E6F1;">
                                    </div>
                                    <div class="col-md-2 form-group" id="cheque2" style="display:none;">
                                        <label for="chequeDate"><b>Cheque Date</b></label>
                                        <input type="date" name="chequeDate" class="form-control" id="chequeDate"
                                            placeholder="Cheque Date" style="color:black; background-color: #D4E6F1;">
                                    </div>
                                    <div class="col-md-2 form-group" id="cheque3" style="display:none;">
                                        <label for="chequeAmount"><b>Cheque Amount (Rs.)</b></label>
                                        <input type="text" name="chequeAmount" class="form-control" id="chequeAmount"
                                            placeholder="Cheque Amount" style="color:black; background-color: #D4E6F1;">
                                    </div>
                                    <div class="col-md-3 form-group" id="BankNamediv" style="display:none;">
                                        <label for="BankName"><b>Bank Name</b></label>
                                        <input type="text" name="BankName" class="form-control" id="BankName"
                                            placeholder="eg: BOC, HNB..."
                                            style="color:black; background-color: #D4E6F1;">
                                    </div>

                                    <div class="col-md-3 form-group" id="cash" style="display:none;">
                                        <label for="amount"><b>Amount (Rs.)</b></label>
                                        <input type="text" name="amount" class="form-control" id="amount"
                                            placeholder="Amount (Rs.)" style="color:black; background-color: #D4E6F1;">
                                    </div>
                                </div>
                                <div style="overflow-y: auto; max-height: 250px;">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th> # </th>
                                                <th> Payment Type </th>
                                                <th> Paid Amount </th>
                                                <th> Cheque No. </th>
                                                <th> Cheque Date </th>
                                                <th> Bank Name </th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody id="chequeTableBody">

                                        </tbody>
                                    </table><br><br>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <h2 style="float:left;">Total Payable Amount (Rs.): <span
                                                id="payableAmount">0</span>
                                        </h2>
                                        <h2 style="float:right;">Total Paid Amount (Rs.): <span id="paidAmount">0</span>
                                        </h2>
                                        <input type="text" name="paidAmountInput" id="paidAmountInput" required
                                            style="display:none;">
                                    </div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <button type="button" id="addPayment" class="btn btn-info"
                                        onclick="addRowCheque()"><b>Add Payment Method</b></button>
                                    <button type="submit" id="submitBTN"
                                        class="btn btn-success"><b>Purchase</b></button>
                                </div>

                                <!-- Hidden input fields to store values for PHP arrays -->
                                <input type="text" style="display:none;" name="rowDataPayment" id="rowDataPayment"
                                    required>
                                <!-- style="display:none;" -->

                                <script>
                                // Counter for row number
                                let rowNumCheque = 1;

                                // Array to store row data
                                let rowDataArrayCheque = [];

                                // Function to add a new row to the table
                                function addRowCheque() {
                                    // Get form field values
                                    const paymentType = document.getElementById('paymentM').value;
                                    const chequeNo = document.getElementById('chequeNo').value;
                                    const chequeDate = document.getElementById('chequeDate').value;
                                    const chequeAmount = document.getElementById('chequeAmount').value;
                                    const amount = document.getElementById('amount').value;
                                    const BankName = document.getElementById('BankName').value;

                                    let newRowCheque = '';
                                    let rowDataCheque = {};

                                    if (paymentType === 'c') {
                                        const paymentTypeDisplay = 'Cash';
                                        const chequeNoDisplay = 'N/A';
                                        const chequeDateDisplay = 'N/A';
                                        const BankNameDisplay = 'N/A';
                                        newRowCheque = `
                                                        <tr>
                                                            <td>${rowNumCheque}</td>
                                                            <td>${paymentTypeDisplay}</td>
                                                            <td>${amount}</td>
                                                            <td>${chequeNoDisplay}</td>
                                                            <td>${chequeDateDisplay}</td>
                                                            <td>${BankNameDisplay}</td>
                                                            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRowCheque(this, ${rowNumCheque - 1})">x</button></td>
                                                        </tr>
                                                    `;
                                        rowDataCheque = {
                                            paymentType: paymentType,
                                            amount: amount,
                                            chequeNo: chequeNoDisplay,
                                            chequeDate: chequeDateDisplay,
                                            BankNameDisplay: BankNameDisplay,
                                        };
                                    } else if (paymentType === 'cq') {
                                        const paymentTypeDisplay = 'Cheque';
                                        newRowCheque = `
                                                        <tr>
                                                            <td>${rowNumCheque}</td>
                                                            <td>${paymentTypeDisplay}</td>
                                                            <td>${chequeAmount}</td>
                                                            <td>${chequeNo}</td>
                                                            <td>${chequeDate}</td>
                                                            <td>${BankName}</td>
                                                            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRowCheque(this, ${rowNumCheque - 1})">x</button></td>
                                                        </tr>
                                                    `;
                                        rowDataCheque = {
                                            paymentType: paymentType,
                                            amount: chequeAmount,
                                            chequeNo: chequeNo,
                                            chequeDate: chequeDate,
                                            BankName: BankName,
                                        };
                                    }

                                    // Append the new row to the table body
                                    document.getElementById('chequeTableBody').insertAdjacentHTML(
                                        'beforeend', newRowCheque);

                                    // Push JSON object to array
                                    rowDataArrayCheque.push(rowDataCheque);

                                    // Update hidden input field with JSON array
                                    document.getElementById('rowDataPayment').value = JSON.stringify(
                                        rowDataArrayCheque);

                                    // Increment row number
                                    rowNumCheque++;

                                    // Clear input fields
                                    document.getElementById('paymentM').value = '';
                                    document.getElementById('chequeNo').value = '';
                                    document.getElementById('chequeDate').value = '';
                                    document.getElementById('chequeAmount').value = '';
                                    document.getElementById('amount').value = '';

                                    // Call calculatePurchaseTotal to update total
                                    calculatePurchaseTotalCheque();
                                }

                                // Function to calculate total purchase amount
                                function calculatePurchaseTotalCheque() {
                                    let totalCheque = 0;
                                    // Iterate through each row in the table
                                    document.querySelectorAll('#chequeTableBody tr').forEach(row => {
                                        // Get the total price from the row and add it to the total
                                        const totalPriceCheque = parseFloat(row.cells[2]
                                            .textContent);
                                        if (!isNaN(totalPriceCheque)) {
                                            totalCheque += totalPriceCheque;
                                        }
                                    });
                                    // Update the paidAmount span with the total amount
                                    document.getElementById('paidAmount').textContent = totalCheque.toFixed(
                                        2);
                                    document.getElementById('paidAmountInput').value = totalCheque.toFixed(
                                        2);

                                    // Calculate total payable amount
                                    const totalPayableAmount = parseFloat(document.getElementById(
                                        'purchTotal').value);

                                    const payableAmount = totalPayableAmount - totalCheque;
                                    document.getElementById('payableAmount').textContent = payableAmount
                                        .toFixed(2);
                                }

                                // Function to remove a row from the table
                                function removeRowCheque(button, rowIndex) {
                                    // Traverse up to the row and remove it
                                    const row = button.closest('tr');
                                    row.remove();

                                    // Remove the corresponding row from the rowDataArray
                                    rowDataArrayCheque.splice(rowIndex, 1);

                                    // Update hidden input field with updated JSON array
                                    document.getElementById('rowDataPayment').value = JSON.stringify(
                                        rowDataArrayCheque);

                                    // Recalculate total
                                    calculatePurchaseTotalCheque();

                                    // Decrement row number
                                    rowNumCheque--;
                                }

                                // Event listener for keydown event on the document
                                document.addEventListener('keydown', function(event) {
                                    // Check if the key combination is CTRL+ENTER (keyCode for Enter is 13)
                                    if (event.ctrlKey && event.keyCode === 13) {
                                        // Submit the form
                                        document.querySelector('form').submit();
                                    }
                                });

                                // Function to toggle visibility of payment fields
                                function toggleChequeFields() {
                                    const paymentMethod = document.getElementById("paymentM").value;
                                    const chequeDiv1 = document.getElementById("cheque1");
                                    const chequeDiv2 = document.getElementById("cheque2");
                                    const chequeDiv3 = document.getElementById("cheque3");
                                    const cashDiv = document.getElementById("cash");
                                    const BankName = document.getElementById("BankNamediv");

                                    if (paymentMethod === "cq") {
                                        BankName.style.display = "block";
                                        chequeDiv1.style.display = "block";
                                        chequeDiv2.style.display = "block";
                                        chequeDiv3.style.display = "block";
                                        cashDiv.style.display = "none";
                                    } else if (paymentMethod === "c") {
                                        BankName.style.display = "none";
                                        chequeDiv1.style.display = "none";
                                        chequeDiv2.style.display = "none";
                                        chequeDiv3.style.display = "none";
                                        cashDiv.style.display = "block";
                                    } else {
                                        BankName.style.display = "none";
                                        chequeDiv1.style.display = "none";
                                        chequeDiv2.style.display = "none";
                                        chequeDiv3.style.display = "none";
                                        cashDiv.style.display = "none";
                                    }
                                }
                                </script>


                            </form>
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                            $(document).ready(function() {
                                $(window).keydown(function(event) {
                                    if (event.keyCode == 13) {
                                        event.preventDefault();
                                        // $('#addPurch').click();
                                        $('#SuplierCode').focus();
                                        return false;
                                    }
                                });
                                $('#SuplierCode').keydown(function(event) {
                                    if (event.keyCode == 13) {
                                        event.preventDefault();
                                        // $('#addPurch').click();
                                        $('#InvoiceNo').focus();
                                        return false;
                                    }
                                });
                                $('#InvoiceNo').keydown(function(event) {
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
                                        $('#paymentM').focus();
                                        return false;
                                    }
                                });
                                $('#QTY').keydown(function(event) {
                                    if (event.keyCode == 13) {
                                        event.preventDefault();
                                        // $('#addPurch').click();
                                        $('#CostPrice').focus();
                                        $('#CostPrice').select();
                                        return false;
                                    }
                                });
                                $('#CostPrice').keydown(function(event) {
                                    if (event.keyCode == 13) {
                                        event.preventDefault();
                                        // $('#addPurch').click();
                                        $('#TotalPrice').focus();
                                        $('#TotalPrice').select();
                                        return false;
                                    }
                                });
                                $('#TotalPrice').keydown(function(event) {
                                    if (event.keyCode == 13) {
                                        event.preventDefault();
                                        // $('#addPurch').click();
                                        $('#SellingPrice').focus();
                                        $('#SellingPrice').select();
                                        return false;
                                    }
                                });
                                $('#SellingPrice').keydown(function(event) {
                                    if (event.keyCode == 13) {
                                        event.preventDefault();
                                        $('#addPurch').click();
                                        $('#ItemCode').focus();
                                        return false;
                                    }
                                });
                                $('#paymentM').keydown(function(event) {
                                    if (event.keyCode == 13) {
                                        if (this.value === 'cq') {
                                            event.preventDefault();
                                            // $('#addPurch').click();
                                            $('#chequeNo').focus();
                                            return false;
                                        }
                                        if (this.value === 'c') {
                                            event.preventDefault();
                                            // $('#amount').click();
                                            $('#amount').focus();
                                            return false;
                                        }
                                    }
                                    if (event.keyCode == 27) {
                                        event.preventDefault();
                                        $('#submitBTN').click();
                                        // $('#chequeNo').focus();
                                        return false;
                                    }
                                });
                                $('#amount').keydown(function(event) {
                                    if (event.keyCode == 13) {
                                        event.preventDefault();
                                        $('#addPayment').click();
                                        $('#paymentM').focus();
                                        return false;
                                    }
                                });
                                $('#chequeNo').keydown(function(event) {
                                    if (event.keyCode == 13) {
                                        event.preventDefault();
                                        // $('#submitBTN').click();
                                        $('#chequeDate').focus();
                                        return false;
                                    }
                                });
                                $('#chequeDate').keydown(function(event) {
                                    if (event.keyCode == 13) {
                                        event.preventDefault();
                                        // $('#submitBTN').click();
                                        $('#chequeAmount').focus();
                                        return false;
                                    }
                                });
                                $('#chequeAmount').keydown(function(event) {
                                    if (event.keyCode == 13) {
                                        event.preventDefault();
                                        // $('#addPayment').click();
                                        $('#BankName').focus();
                                        return false;
                                    }
                                });
                                $('#BankName').keydown(function(event) {
                                    if (event.keyCode == 13) {
                                        event.preventDefault();
                                        $('#addPayment').click();
                                        $('#paymentM').focus();
                                        return false;
                                    }
                                });
                            });
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
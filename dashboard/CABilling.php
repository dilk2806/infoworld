<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$BillingBranch = $_REQUEST['BillingBranch'];
// $billNo = $_REQUEST['billNo'];

$select_admin = "select * from `user` where `lid`='".$lid."'";
$run_admin = mysqli_query($con,$select_admin);
$row_admin = mysqli_fetch_assoc($run_admin);

$fname = $row_admin['fname'];
$wa = $row_admin['wa'];
$ut = $row_admin['user_type'];
$branchCode = $row_admin['branchCode'];

$rowData = $_POST['rowData'];
$purchTotal = $_POST['purchTotal'];
$PaybleBillAmountSend = $_POST['PaybleBillAmountSend'];
$TotalDiscountSend = $_POST['TotalDiscountSend'];
$paidAmount = $_POST['paidAmount'];
$ballenceAmount = $_POST['ballenceAmount'];

$sel_branch = "select * from branches where branchCode='".$branchCode."'";
$run_branch = mysqli_query($con,$sel_branch);
$row_branch = mysqli_fetch_assoc($run_branch);
$btanch = $row_branch['branchName'];
$BranchAddress = $row_branch['BranchAddress'];
$BranchTel = $row_branch['BranchTel'];

$data = json_decode($rowData, true);

$select_billNo = "SELECT billNo FROM branches where branchCode='".$branchCode."'";
$run_billNo = mysqli_query($con,$select_billNo);
$row_billNo = mysqli_fetch_assoc($run_billNo);
$billNo = $row_billNo['billNo']+1;

// echo $SuplierCode."<br>";
// echo $SuplierName."<br>";
// echo $InvoiceNo."<br>";
// echo $PurchesNo."<br>";
// echo $rowData."<br>";

if($data!=''){
    $purchTotal = 0.0;
    $PaybleBillAmountSend = 0.0;
    $TotalDiscountSend = 0.0;
    $TotalBillProfit = 0.00;

    $sel_billNo = "SELECT * from bill_head WHERE BillingBranch='".$BillingBranch."' and billNo='".$billNo."'";
    $run_billNo = mysqli_query($con,$sel_billNo) or mysqli_error();
    if (mysqli_num_rows($run_billNo) == 0){
    
        // Iterate over the data and insert into the database
        foreach ($data as $item) {
            $itemCode = $item['itemCode'];
            $itemName = $item['itemName'];
            $serialNo = $item['serialNo'];
            $Warranty = $item['Warranty'];
            $costPrice = $item['costPrice'];
            $totalPrice = $item['totalPrice'];
            $sellingPrice = $item['sellingPrice'];
            $discountType = $item['discountType'];
            $discount = $item['discount'];
            $price = $item['price'];
            $qty = 1;

            if($itemCode!=''){
                $profit_price = $price - ($costPrice * $qty);

                // Prepare SQL statement
                $add_purch_data = "INSERT INTO `bill_data`(costPrice,profit,`BillingBranch`, `billNo`, `ItemCode`, `serialNo`, `TotalPrice`, `SellingPrice`, `DiscountType`, `Discount`, `Price`) 
                VALUES ('".$costPrice."','".$profit_price."','".$BillingBranch."','".$billNo."','".$itemCode."','".$serialNo."','".$totalPrice."','".$sellingPrice."','".$discountType."','".$discount."','".$price."')";
                $run_purch_data = mysqli_query($con,$add_purch_data) or mysqli_error();

                $sel_QTYstock = "select * from stock where branchCode='".$BillingBranch."' and itemCode='".$itemCode."'";
                $run_QTYstock = mysqli_query($con,$sel_QTYstock);
                $row_QTYstock = mysqli_fetch_assoc($run_QTYstock);
                $rowItemQTY = $row_QTYstock['qty'];
                $afterSellQty = $rowItemQTY - 1;

                $update_QTYstock = "UPDATE `stock` SET qty='".$afterSellQty."' WHERE branchCode='".$BillingBranch."' and itemCode='".$itemCode."'";
                mysqli_query($con,$update_QTYstock);

                $update_serialNo_sold = "UPDATE `serial_no` SET `sold`=1, Warranty='".$Warranty."', billNo='".$billNo."' WHERE serialNo='".$serialNo."'";
                mysqli_query($con,$update_serialNo_sold);

                $purchTotal += $totalPrice;
                $TotalBillProfit += $profit_price;
                $totaldis = 0;

                if ($discountType == 1) {
                    // Percentage discount
                    $totaldis = $qty * ($sellingPrice * ($discount / 100));
                } else if ($discountType == 2) {
                    // Price discount
                    $totaldis = ($qty * $discount);
                }
                // $total = number_format($total,2);
                $TotalDiscountSend += $totaldis;

                $PaybleBillAmountSend = $purchTotal - $TotalDiscountSend;

            }
            
        } 

        $add_transfer_head = "INSERT INTO `bill_head`(totalProfit,cusBallence,custPaid,`BillingBranch`, `billNo`, `billTotal`, `PaybleBillAmountSend`, `TotalDiscountSend`, `Cashier`) 
        VALUES ('".$TotalBillProfit."','".$ballenceAmount."','".$paidAmount."','".$BillingBranch."','".$billNo."','".$purchTotal."','".$PaybleBillAmountSend."','".$TotalDiscountSend."','".$lid."')";
        $run_purch_head = mysqli_query($con,$add_transfer_head) or mysqli_error();

        $update_purchNo = "UPDATE `branches` SET `billNo`='".$billNo."' WHERE branchCode='".$BillingBranch."'";
        $run_update = mysqli_query($con,$update_purchNo);
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
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
    <style>
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
    <title>Print Table</title>
</head>

<body>
    <button style="display:none;" id="addRowBtn">Add Row</button>
    <div class="col-lg-12 stretch-card" id="billContent">
        <div class="card">
            <div class="card-body">
                <div style="text-align: center;">
                    <img style="width:100%; margin:0; padding:0;" src="assets/images/bill_head.jpg"
                        alt="InfoWorld Computer Solution">
                </div>
                <div class="table-responsive pt-3">
                    <table cellspacing="0">
                        <tr>
                            <td class="noBorder" colspan="4" rowspan="2"><b>INVOICE</b></td>
                            <td colspan="2">INVOICE NO</td>
                            <td><input value="<?php echo $billNo; ?>" type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="2">INVOICE DATE</td>
                            <td><input value="<?php echo date("Y-m-d"); ?>" type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="2">CONTACT NO</td>
                            <td colspan="2"><input id="customerMobile" type="text" list="customerList"></td>

                            <input type="hidden" name="customerId" id="customerId" style="display:none;">
                            <datalist id="customerList">
                                <?php
                                $select_catCode1 = "SELECT * from customer";
                                $run_catCode1 = mysqli_query($con,$select_catCode1);
                                while($row1 = mysqli_fetch_assoc($run_catCode1)){ 
                            ?>
                                <option value="<?php echo $row1['mobile'];?>" data-name="<?php echo $row1['name'];?>"
                                    data-id="<?php echo $row1['id'];?>" data-address="<?php echo $row1['address'] ?>">
                                    <?php echo $row1['name'];?>
                                </option>
                                <?php } ?>
                            </datalist>

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

                            <td colspan="2">DUE DATE</td>
                            <td><input type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="2">CUSTOMER NAME</td>
                            <td colspan="2"><input id="customerName" type="text" list="customerListName"></td>
                            <datalist id="customerListName">
                                <?php
                                $select_catCode1 = "SELECT * from customer";
                                $run_catCode1 = mysqli_query($con,$select_catCode1);
                                while($row1 = mysqli_fetch_assoc($run_catCode1)){ 
                            ?>
                                <option value="<?php echo $row1['name'];?>" data-mobile="<?php echo $row1['mobile'];?>"
                                    data-id="<?php echo $row1['id'];?>" data-address="<?php echo $row1['address'] ?>">
                                    <?php echo $row1['mobile'];?>
                                </option>
                                <?php } ?>
                            </datalist>

                            <script>
                            document.getElementById('customerName').addEventListener('input', function() {
                                var customerName = this.value; // Changed variable name for clarity
                                var options = document.getElementById('customerListName').childNodes;
                                var optionsList = document.getElementById('customerListName').options;
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
                                            document.getElementById('customerAddress').value = options[i].getAttribute('data-address');
                                            document.getElementById('customerId').value = options[i].getAttribute('data-id');
                                            document.getElementById('customerMobile').value = options[i].getAttribute('data-mobile');
                                            break;
                                        }
                                    }
                                }
                            });
                            </script>

                            <td colspan="2">P.O. NO</td>
                            <td><input type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="2">CUSTOMER ADDRESS</td>
                            <td colspan="2"><input id="customerAddress" type="text"></td>
                            <td colspan="2">SALES PERSON</td>
                            <td><input type="text" value="<?php echo $lid; ?>"></td>
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
                                $sel_query12 = "SELECT bill_data.BillingBranch,bill_data.billNo,bill_data.ItemCode,bill_data.serialNo,bill_data.TotalPrice,bill_data.SellingPrice,bill_data.Discount,bill_data.Price,items.itemName FROM bill_data,items where  items.itemCode=bill_data.ItemCode and BillingBranch='".$BillingBranch."' and billNo='".$billNo."'";
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
                                <td style="margin:0px; padding:3px;"><?php echo $count; ?></td>
                                <td colspan="2"><?php echo $row["itemName"]; ?><br><?php echo $Warranty; ?></td>
                                <td><?php echo $seriao_no; ?></td>
                                <td>1</td>
                                <td><?php echo $row["TotalPrice"]; ?></td>
                                <td><?php echo $row["Price"]; ?></td>
                            </tr>
                            <?php $count++; } ?>

                            <?php
                            $sel_query122 = "SELECT * FROM bill_head where  BillingBranch='".$BillingBranch."' and billNo='".$billNo."'";
                            $result122 = mysqli_query($con, $sel_query122);
                            $row2 = mysqli_fetch_assoc($result122);
                            $cusBallence = $row2['cusBallence'];
                            if ($cusBallence >= 0) {
                                $cusBallence = "Cash Customer";
                            } else {
                                $cusBallence = "Credit Customer";
                            }
                        ?>
                            <tr>
                                <td style="text-align:center;" colspan=6><b>GRAND TOTAL (<?php echo $cusBallence; ?>)</b></td>
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
                                    <li>Please submit the <b> Original Invoice</b> for warranty claims.</li>
                                    <li>Warranty period is one year less than 14 working days</li>
                                    <li>Good once sold are not refundable</li>
                                    <li>Warranty covers <b> only Manufacture Defects</b>: Software & Virus issues,
                                        Damages or defects or due to other causes such as corrosion, insects,
                                        negligence, misuse, improper operations, power fluctuation, lightening or other
                                        natural disaster. Sabotage or accidents etc are <b>NOT</b> included under this
                                        warranty.</li>
                                    <li>The customer bound to protect all the <b> serial & warranty stickers</b> for any
                                        warranty claims. If not, <b> no </b>warranty claims will be issued for such
                                        items, even if the original invoice were produced or even the item is within the
                                        warranty period</li>
                                    <li>Repair or replacements necessitated by such causes not covered by the warranty
                                        are subject to changes for labor, time & material. Warranty replacement would be
                                        provided with available technology, if identical replacement is not available.
                                    </li>
                                    <li>InfoWorld Computer Solution is <b>not liable</b> or bounds to provide any <b> On
                                            Site Services</b> unless specified in the Quotation / Maintenance Agreement
                                        or in the Original Invoice. The customer bound to carry in any items at his /
                                        hers own expenses for such warranty claims / repairs or services.</li>
                                    <li>The customer bound with iWorld to pay above balance within one week.</li>
                                    <li>All payments can be made through cash or cheque & cheque to be drawn in favor of
                                        <b>InfoWorld Computer Solution. “A/C Payee Only”</b>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td colspan=2></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <th style="text-align: center; margin:0px; padding:0px; font-size:10px;">FOR & ON BEHALF OF PROF COMPUTERS </th>
                            <th style="text-align: center; margin:0px; padding:0px; font-size:10px;">RECEIVED ABOVE GOODS IN GOOD ORDER & IN GOOD CONDITIONS 
                            </th>
                        </tr>
                        <tr>
                            <td><br><br></td>
                            <td><br><br></td>
                        </tr>
                        <tr>
                            <th style="text-align: center; margin:0px; padding:0px; font-size:10px;">AUTHORIZED SIGNATURE</th>
                            <th style="text-align: center; margin:0px; padding:0px; font-size:10px;">RECEIVER’S SIGNATURE</th>
                        </tr>
                        <tr>
                            <th style="text-align: left; margin:0px; padding:0px; font-size:10px;">NAME : <input type="text"></th>
                            <th style="text-align: left; margin:0px; padding:0px; font-size:10px;">NAME : <input type="text"></th>
                        </tr>
                    </table>
                    <div class="our-info" style="text-align: center; position:absolute;bottom:0px; width:100%;">
                        <hr>
                        <h5 style="margin:0">Focus Solution (PVT) LTD</h5>
                        <h5 style="margin:0">Contact: 074 043 0551</h5>
                    </div>
                    <br><br>
                    <script type="text/javascript">
                    function printAndRedirect() {

                        var customerName = document.getElementById('customerName').value;
                        var customerAddress = document.getElementById('customerAddress').value;
                        var customerMobile = document.getElementById('customerMobile').value;
                        var customerId = document.getElementById('customerId').value;

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
                            window.location.reload(); // Refresh the page to restore the inputs
                            window.location =
                                'CACustomer.php?lid=<?php echo $lid ?>&home=<?php echo $home ?>&cusID=' +
                                customerId + '&cusName=' + customerName + '&cusAd=' + customerAddress +
                                '&cusMobile=' + customerMobile + '&billNo=<?php echo $billNo; ?>&alert=1';
                        }, 1000); // Adjust the delay as needed
                    }

                    document.getElementById('addRowBtn').addEventListener('click', function() {
                        // Get the table body element
                        var tableBody = document.getElementById('myTable').getElementsByTagName('tbody')[0];

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
    </div>
    <button style="text-align:center; width:100%;" class="btn btn-primary" onclick="printAndRedirect()">Print The
        Bill</button>
</body>

</html>


<?php
    // header("Location:CAIndex.php?lid=$lid&home=$home&alert=1");
} else{

header("Location:CAIndex.php?lid=$lid&home=$home&alert=2");
}
?>
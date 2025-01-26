<?php
require("db.php");
require("auth.php");
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];
$returnNo = $_REQUEST['returnNo'];
$itemCode = $_REQUEST['itemCode'];

$select_admin = "select * from `user` where `lid`='".$lid."'";
$run_admin = mysqli_query($con,$select_admin);
$row_admin = mysqli_fetch_assoc($run_admin);

$fname = $row_admin['fname'];
$wa = $row_admin['wa'];
$ut = $row_admin['user_type'];
$branchCode = $row_admin['branchCode'];

$sel_branch = "SELECT * from branches where branchCode='".$branchCode."'";
$run_branch = mysqli_query($con,$sel_branch);
$row_branch = mysqli_fetch_assoc($run_branch);

$branchName = $row_branch['branchName'];
$branchAddress = $row_branch['BranchAddress'];
$branchTP = $row_branch['BranchTel'];

$today = date("Y-m-d");
$update_serialST = "UPDATE `retun_items_data` SET `issueDate`='".$today."',`status`='4' WHERE branchCode='".$branchCode."' and itemCode='".$itemCode."' and returnNo='".$returnNo."'";
mysqli_query($con,$update_serialST);

$st0 = 0;
$sel_return = "SELECT * from retun_items_data where branchCode='".$branchCode."'  and returnNo='".$returnNo."'";
$run_return = mysqli_query($con,$sel_return);
while($row_return = mysqli_fetch_assoc($run_return)){
    if ($row_return['status'] == 1 or $row_return['status'] == 2 or $row_return['status'] == 3){
        $st0 ++; 
    }
}

if($st0 == 0){
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

<body onload="printAndRedirect()">
    <div class="col-lg-12 stretch-card" id="billContent">
        <div class="card">
            <div class="card-body">
                <div style="border:5px solid; padding:10px;">
                    <div>
                        <h4 style="display:flex; align-item:center; justify-content: center; padding:0px; margin:0px;"
                            class="card-title"><?php echo $branchName; ?></h4><br>
                        <h4 style="display:flex; align-item:center; justify-content: center; padding:0px; margin:0px;"
                            class="card-title"><?php echo $branchAddress; ?></h4><br>
                        <h4 style="display:flex; align-item:center; justify-content: center; padding:0px; margin:0px;"
                            class="card-title">Tel: <?php echo $branchTP; ?></h4><br>
                        <h4 style="display:flex; align-item:center; justify-content: center; padding:0px; margin:0px;"
                            class="card-title">RMA NOTE (Return to Customer) </h4>
                    </div>
                    <div class="table-responsive pt-3">
                        <?php
                        $sel_return = "SELECT * from retun_items_data where branchCode='".$branchCode."' and returnNo='".$returnNo."'";
                        $run_return = mysqli_query($con,$sel_return);
                        $row1_return = mysqli_fetch_assoc($run_return);
                        
                        $custId = $row1_return['custId'];
                        $sel_customer = "SELECT * from customer where id='".$custId."'";
                        $run_customer = mysqli_query($con,$sel_customer);
                        $row1_customer = mysqli_fetch_assoc($run_customer);
                        ?>
                        <table cellspacing="0" class="on-border">
                            <style>
                            .on-border {
                                border: 0;
                            }
                            </style>
                            <tr>
                                <td colspan="2" class="on-border">Date</td>
                                <td colspan="2" class="on-border" style="width:50%;"><?php echo date("Y-m-d"); ?></td>
                                <td colspan="2" class="on-border">Job No.</td>
                                <td class="on-border"><?php echo $returnNo; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="on-border"></td>
                                <td colspan="2" class="on-border"></td>
                                <td colspan="2" class="on-border">CUSTOMER NAME</td>
                                <td class="on-border"><?php echo $row1_customer['name']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="on-border"></td>
                                <td colspan="2" class="on-border"></td>
                                <td colspan="2" class="on-border">CONTACT NO</td>
                                <td class="on-border"><?php echo $row1_customer['mobile']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="on-border"></td>
                                <td colspan="2" class="on-border"></td>
                                <td colspan="2" class="on-border">CUSTOMER ADDRESS</td>
                                <td class="on-border"><?php echo $row1_customer['address']; ?></td>
                            </tr>
                        </table><br>
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th> NO </th>
                                    <th> ITEM </th>
                                    <th> SERIAL NO </th>
                                    <th> WARRANTY </th>
                                    <th> REPAIR / REPLACEMENT </th>
                                    <th> Repair Charges </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $count = 1;
                                    $sel_return = "SELECT * from retun_items_data where branchCode='".$branchCode."' and returnNo='".$returnNo."'";
                                    $run_return = mysqli_query($con,$sel_return);
                                    while($row_return = mysqli_fetch_assoc($run_return)){
                                        $itemcode = $row_return["itemCode"];  
                                        $new_worrent = $row_return["new_worrent"];  

                                        $sel_itemname = "SELECT itemName from items where itemCode='".$itemcode."'";
                                        $run_itemname = mysqli_query($con,$sel_itemname);
                                        $row_itemname = mysqli_fetch_assoc($run_itemname);

                                        $Warranty = $new_worrent;
                                        if ($Warranty == '1m') {
                                            $Warranty = "1 Month Warranty";
                                        } else if ($Warranty == '2m') {
                                            $Warranty = "2 Month Warranty";
                                        } else if ($Warranty == '3m') {
                                            $Warranty = "3 Month Warranty"; 
                                        } else if ($Warranty == '4m') {
                                            $Warranty = "4 Month Warranty";
                                        } else if ($Warranty == '5m') {
                                            $Warranty = "5 Month Warranty";
                                        } else if ($Warranty == '6m') {
                                            $Warranty = "6 Month Warranty";
                                        } else if ($Warranty == '1y') {
                                            $Warranty = "1 Year Warranty";
                                        } else if ($Warranty == '2y') {
                                            $Warranty = "2 Year Warranty";
                                        } else if ($Warranty == '3y') {
                                            $Warranty = "3 Year Warranty";
                                        } else if ($Warranty == '4y') {
                                            $Warranty = "4 Year Warranty";
                                        } else if ($Warranty == '5y') {
                                            $Warranty = "5 Year Warranty";
                                        } else if ($Warranty == '1mt') {
                                            $Warranty = "1 Month Test Warranty";
                                        } else if ($Warranty == '1bt') {
                                            $Warranty = "1 Year Warranty for Battery";
                                        } else if ($Warranty == '1mb') {
                                            $Warranty = "2 Year Warranty for Mother Board";
                                        }
                                        
                                ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $row_itemname["itemName"]; ?></td>
                                    <td><?php echo $row_return['serialNo']; ?></td>
                                    <td><?php echo $Warranty; ?></td>
                                    <td><?php echo $row_return["repair"]; ?></td>
                                    <td><?php echo $row_return["recievePrice"]; ?></td>
                                </tr>
                                <?php $count++; } ?>
                                <tr>
                                    <td style="text-align:center;" colspan="5"><b>GRAND TOTAL</b></td>
                                    <?php
                                    $sel_grandTot = "SELECT SUM(recievePrice) as grandTot from retun_items_data where branchCode='".$branchCode."' and returnNo='".$returnNo."'";
                                    $run_grandTot = mysqli_query($con,$sel_grandTot);
                                    $row_grandTot = mysqli_fetch_assoc($run_grandTot);
                                    ?>
                                    <td style="text-align:center;"> <b>Rs.
                                            <?php echo number_format($row_grandTot['grandTot'],2); ?></b></td>
                                </tr>

                                
                                <tr>
                                    <td rowspan="3" colspan="3" style="text-align:left; heigh:30px;">TECHNICAL OFFICER
                                    </td>
                                    <td style="text-align:left; heigh:30px;" rowspan="3" colspan="3">CUSTOMER </td>
                                </tr>
                                <tr></tr>
                            </tbody>
                        </table>

                        <div class="our-info" style="text-align: center; position:absolute;bottom:0px; width:100%;">
                            <hr>
                            <h5 style="margin:0">Focus Solution (PVT) LTD</h5>
                            <h5 style="margin:0">Contact: 074 043 0551</h5>
                        </div>
                        <br><br>
                        <script type="text/javascript">
                        function printAndRedirect() {

                            var divToPrint = document.getElementById('billContent');
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
                                    'MARecieve.php?lid=<?php echo $lid ?>&home=<?php echo $home ?>&alert=6';
                            }, 1000); // Adjust the delay as needed
                        }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <button style="text-align:center; width:100%;" class="btn btn-primary" onclick="printAndRedirect()">Print The
        Bill</button> -->
</body>

</html>

<?php
} else {
    header("Location:MARecieve.php?lid=$lid&home=$home&alert=4");
}
?>
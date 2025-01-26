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

$jobNo = $_POST['jobNo'];
$technicalOfficer = $_POST['technicalOfficer'];
$recievedDate = $_POST['recievedDate'];
$cusMobile = $_POST['customerMobile'];
$cusID = $_POST['customerId'];
$cusName = $_POST['customerName'];
$cusAd = $_POST['customerAddress'];
$rowData = $_POST['rowData'];

$data = json_decode($rowData, true);

if ($cusID == "") {
    if ($cusMobile!=""){
        $ins_cust = "INSERT INTO `customer`( `name`, `mobile`, `address`) 
        VALUES ('".$cusName."','".$cusMobile."','".$cusAd."')";
        $run_cust = mysqli_query($con,$ins_cust);

        echo '<script>alert("cust added.");</script>';

        $sel_cust_id = "SELECT * from customer where mobile='".$cusMobile."'";
        $run_cust_id = mysqli_query($con,$sel_cust_id);
        $row_cust_id = mysqli_fetch_assoc($run_cust_id);
        $cusID = $row_cust_id['id'];
    } else {
        $cusID = 0;
    }
    
} else {
    $upd_customer = "UPDATE customer set name='".$cusName."', mobile='".$cusMobile."', address='".$cusAd."' WHERE id='".$cusID."'";
    mysqli_query($con,$upd_customer);
}

if($data!=''){

    // Iterate over the data and insert into the database
    foreach ($data as $item) {
        $itemCode = $item['itemCode'];
        $itemName = $item['itemName'];
        $serialNo = $item['serialNo'];
        $description = $item['description'];

        if ($serialNo == "") {
            $serialNo = "No Serial";
        }
        
        if($itemCode!=''){

            // Prepare SQL statement
            $add_purch_data = "INSERT INTO `retun_items_data`(custId,itemCode,serialNo,`description`,`branchCode`, `returnNo`, `comeDate`,`status`) 
            VALUES ('".$cusID."','".$itemCode."','".$serialNo."','".$description."','".$branchCode."','".$jobNo."','".$recievedDate."',1)";
            $run_purch_data = mysqli_query($con,$add_purch_data) or mysqli_error();

        }
            
    } 
    

    $update_purchNo = "UPDATE `branches` SET `returnNo`='".$jobNo."' WHERE branchCode='".$branchCode."'";
    $run_update = mysqli_query($con,$update_purchNo);
    

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
                    <div style="display:flex; align-item:center; justify-content: center;">
                        <h4 class="card-title">RMA NOTE (RETURN)</h4>
                    </div>
                    <div class="table-responsive pt-3">
                        <table cellspacing="0" class="on-border">
                            <style>
                                .on-border{
                                    border:0;
                                }
                            </style>
                            <tr>
                                <td colspan="2" class="on-border">Date</td>
                                <td colspan="2" class="on-border" style="width:50%;"><?php echo date("Y-m-d"); ?></td>
                                <td colspan="2" class="on-border">Job No.</td>
                                <td class="on-border"><?php echo $jobNo; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="on-border"></td>
                                <td colspan="2" class="on-border"></td>
                                <td colspan="2" class="on-border">CUSTOMER NAME</td>
                                <td class="on-border"><?php echo $cusName; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="on-border"></td>
                                <td colspan="2" class="on-border"></td>
                                <td colspan="2" class="on-border">CONTACT NO</td>
                                <td class="on-border"><?php echo $cusMobile; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="on-border"></td>
                                <td colspan="2" class="on-border"></td>
                                <td colspan="2" class="on-border">CUSTOMER ADDRESS</td>
                                <td class="on-border"><?php echo $cusAd; ?></td>
                            </tr>
                        </table><br>
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th> NO </th>
                                    <th> ITEM </th>
                                    <th> SERIAL NO </th>
                                    <th> REPAIR / REPLACEMENT & WARRANTY </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $count = 1;
                                    $sel_return = "SELECT * from retun_items_data where branchCode='".$branchCode."' and returnNo='".$jobNo."'";
                                    $run_return = mysqli_query($con,$sel_return);
                                    while($row_return = mysqli_fetch_assoc($run_return)){
                                        $itemcode = $row_return["itemCode"];                                        
                                        $sel_itemname = "SELECT itemName from items where itemCode='".$itemcode."'";
                                        $run_itemname = mysqli_query($con,$sel_itemname);
                                        $row_itemname = mysqli_fetch_assoc($run_itemname);
                                ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $row_itemname["itemName"]; ?></td>
                                    <td><?php echo $row_return['serialNo']; ?></td>
                                    <td><?php echo $row_return["description"]; ?></td>
                                </tr>
                                <?php $count++; } ?>

                                <tr>
                                    <td colspan="4" style="text-align:left;"></td>
                                </tr>
                                <tr>
                                    <td rowspan="3" colspan="2" style="text-align:left;">TECHNICAL OFFICER</td>
                                    <td style="text-align:left;" rowspan="3" colspan="2">CUSTOMER </td>
                                </tr>
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
                                window.location =
                                    'MARecieve.php?lid=<?php echo $lid ?>&home=<?php echo $home ?>&alert=3';
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

    header("Location:MARecieve.php?lid=$lid&home=$home&alert=5");
}




?>
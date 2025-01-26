<?php
require('db.php');

$BrandCode = $_POST['BrandCode'];


$query = "SELECT * FROM items WHERE brandCode = '".$BrandCode."' ORDER BY brandCode ASC";
$result = mysqli_query($con, $query);


$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $itemCode = $row["itemCode"];
    $itemName = $row["itemName"];
    $costPrice = $row['costPrice'];
    $sellingPrice = $row['sellingPrice'];
    $reorderLevel = $row['reorderLevel'];
    $options .= "<option value='".$itemCode."' data-item='".$itemName."' data-cost='".$costPrice."' data-sell='".$sellingPrice."' data-reorder='".$reorderLevel."'>".$itemCode." - ".$itemName."</option>";
}

echo $options;

?>
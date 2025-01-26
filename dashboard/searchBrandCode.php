<?php
require('db.php');

$CatagoryCode = $_POST['CatagoryCode'];


$query = "SELECT * FROM brand_names WHERE catCode = '".$CatagoryCode."' ORDER BY brandCode ASC";
$result = mysqli_query($con, $query);

$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $brandCode = $row["brandCode"];
    $brandName = $row['brandName'];
    $options .= "<option value='".$brandCode."' data-brand='".$brandName."'>".$brandCode." - ".$brandName."</option>";
}

echo $options;
?>
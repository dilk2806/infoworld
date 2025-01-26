<?php 
require('db.php');
$lid = $_REQUEST['lid'];
$home = $_REQUEST['home'];

$newpw = $_POST['newPW'];
$confpw = $_POST['coPW'];

$sql1 = "select * from user where lid='".$lid."'";
$run1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_assoc($run1);


if ($newpw == $confpw){
    $sel_query10 = "UPDATE user SET pw='".$newpw."' WHERE lid='".$lid."'";
    $result10 = mysqli_query($con, $sel_query10);

    $U=$row1["user_type"];
    
    if ($U==0){
        header("Location:adminIndex.php?lid=$lid&home=$home");
    }else if($U==1){
        header("Location:MAIndex.php.php?lid=$lid&home=$home");
    }else if($U==2){
        header("Location:CAIndex.php?lid=$lid&home=$home");
    }else if($U==3){
        header("Location:POIndex.php?lid=$lid&home=$home");
    }
        
} else{
// echo "no."
header("Location:../index.html");
}
?>
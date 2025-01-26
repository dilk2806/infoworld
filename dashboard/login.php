<?php
require('db.php');
session_start();
 $search_val=$_POST['username'];
 $search_val1=$_POST['password'];

$login='N';
	
	
$sel_query="select * from user where lid= '$search_val' ;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {



$ltype=$row['user_type'];
$UN=$row['lid'];  
$PW=$row['pw'];
$GLOBALS['lid']=$UN;
$home='';



}
//?lname=".$lname
if($search_val1==$PW ){
			$_SESSION['lid'] = $UN;
	if($ltype==0 ){
		$home="adminIndex.php";
		header("Location:adminIndex.php?lid=$UN&home=$home"); // Redirect user to index.php
	}else if($ltype==1 ){
		$home="MAIndex.php";
		header("Location:MAIndex.php?lid=$UN&home=$home"); // Redirect user to index.php
	}else if($ltype==2 ){
	 	$home="CAIndex.php";
		header("Location:CAIndex.php?lid=$UN&home=$home"); // Redirect user to index.php
	}else if($ltype==3 ){
	 	$home="POIndex.php";
		header("Location:POIndex.php?lid=$UN&home=$home"); // Redirect user to index.php
	}
	 // $user = 'abc';

	 
}else{
	//echo $search_val;
	//echo $PW;
	//echo $ltype;
	header("Location:errorpw.html"); // Redirect user to index.php
}
 
exit();


?><?php
require('db.php');
session_start();
 $search_val=$_POST['username'];
 $search_val1=$_POST['password'];

$login='N';
	
	
$sel_query="select * from user where lid= '$search_val' ;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {



$ltype=$row['user_type'];
$UN=$row['lid'];  
$PW=$row['pw'];
$GLOBALS['lid']=$UN;
$home='';



}
//?lname=".$lname
if($search_val1==$PW ){
			$_SESSION['lid'] = $UN;
	if($ltype==0 ){
		$home="adminIndex.php";
		header("Location:adminIndex.php?lid=$UN&home=$home"); // Redirect user to index.php
	}else if($ltype==1 ){
		$home="MAIndex.php";
		header("Location:MAIndex.php?lid=$UN&home=$home"); // Redirect user to index.php
	}else if($ltype==2 ){
	 	$home="CAIndex.php";
		header("Location:CAIndex.php?lid=$UN&home=$home"); // Redirect user to index.php
	}else if($ltype==3 ){
	 	$home="POIndex.php";
		header("Location:POIndex.php?lid=$UN&home=$home"); // Redirect user to index.php
	}
	 // $user = 'abc';

	 
}else{
	//echo $search_val;
	//echo $PW;
	//echo $ltype;
	header("Location:errorpw.html"); // Redirect user to index.php
}
 
exit();


?><?php
require('db.php');
session_start();
 $search_val=$_POST['username'];
 $search_val1=$_POST['password'];

$login='N';
	
	
$sel_query="select * from user where lid= '$search_val' ;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {



$ltype=$row['user_type'];
$UN=$row['lid'];  
$PW=$row['pw'];
$GLOBALS['lid']=$UN;
$home='';



}
//?lname=".$lname
if($search_val1==$PW ){
			$_SESSION['lid'] = $UN;
	if($ltype==0 ){
		$home="adminIndex.php";
		header("Location:adminIndex.php?lid=$UN&home=$home"); // Redirect user to index.php
	}else if($ltype==1 ){
		$home="MAIndex.php";
		header("Location:MAIndex.php?lid=$UN&home=$home"); // Redirect user to index.php
	}else if($ltype==2 ){
	 	$home="CAIndex.php";
		header("Location:CAIndex.php?lid=$UN&home=$home"); // Redirect user to index.php
	}else if($ltype==3 ){
	 	$home="POIndex.php";
		header("Location:POIndex.php?lid=$UN&home=$home"); // Redirect user to index.php
	}
	 // $user = 'abc';

	 
}else{
	//echo $search_val;
	//echo $PW;
	//echo $ltype;
	header("Location:errorpw.html"); // Redirect user to index.php
}
 
exit();


?>
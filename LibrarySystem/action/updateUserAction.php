<?php
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
//get the user information from the user update page
$BOR_ID = $_POST['ID'];
$BOR_name = $_POST['name'];
$BOR_PIN = $_POST['PIN'];
$BOR_type = $_POST['type'];
$BOR_gender = $_POST['gender'];
$BOR_phone = $_POST['phone'];
$BOR_department = $_POST['department'];
$BOR_amount = $_POST['amount'];
//execute user updating operation
$sql_user = "Update borrower set BOR_phone='$BOR_phone', BOR_name='$BOR_name', BOR_PIN='$BOR_PIN', BOR_type='$BOR_type', BOR_gender='$BOR_gender', BOR_department='$BOR_department',BOR_amount='$BOR_amount' where BOR_ID='$BOR_ID'";
mysqli_query($con, $sql_user);
$row = mysqli_affected_rows($con);
if($row > 0){
	//update succesee, back to userMangeInfo page
	echo 'Update User success, wait for 3 second to forward....';
	echo '<meta http-equiv="refresh" content="3;url=../page/userMangInfo.php?page=1"/>';
}
//close session
mysqli_close($con);
?>
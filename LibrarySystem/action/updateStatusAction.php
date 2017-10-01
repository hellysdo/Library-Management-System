<?php
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
//get the user info from status page
$BOR_ID = $_POST['ID'];
$BOR_name = $_POST['name'];
$BOR_PIN = $_POST['PIN'];
$BOR_type = $_POST['type'];
$BOR_gender = $_POST['gender'];
$BOR_phone = $_POST['phone'];
$BOR_department = $_POST['department'];
$BOR_amount = $_POST['amount'];
//validate the password satisfing one capital letter requirement
if(preg_match('/[A-Z]+/', $BOR_PIN)){
	//excute the user information update action
	$sql_user = "Update borrower set BOR_phone='$BOR_phone', BOR_name='$BOR_name', BOR_PIN='$BOR_PIN', BOR_type='$BOR_type', BOR_gender='$BOR_gender', BOR_department='$BOR_department',BOR_amount='$BOR_amount' where BOR_ID='$BOR_ID'";
	mysqli_query($con, $sql_user);
	$row = mysqli_affected_rows($con);
	if($row>0){
		//update success, back to booksInfo page
		echo 'Update success, wait for 3 second to forward....';
		echo '<meta http-equiv="refresh" content="3;url=../page/booksInfo.php?page=1"/>';
	}
}else{
	//password doesn't satify basic need, re-operating again
	echo 'Your password should contain at least one capital letter !<br/>';
	echo '<meta http-equiv="refresh" content="3;url=../page/status.php"/>';
}
//close the session
mysqli_close($con);
?>
<?php
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
//get the return book id and user id
$BOO_ISBN = $_GET['BOO_ISBN'];
$BOR_ID = $_SESSION['BOR_ID'];
//execute the return action
$sql_borrow = "call return_book('$BOO_ISBN','$BOR_ID')";
mysqli_query($con, $sql_borrow);
$row = mysqli_affected_rows($con);
if($row == 0){
	//update the user information in session
	$_SESSION['BOR_amount'] = $_SESSION['BOR_amount']-1;
	echo '<meta http-equiv="refresh" content="0;url=../page/status.php"/>';
}
//close the session
mysqli_close($con);
?>
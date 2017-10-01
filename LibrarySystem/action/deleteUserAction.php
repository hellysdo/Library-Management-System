<?php
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
////get the user id needed to delete
$BOR_ID = $_GET['BOR_ID'];
//execute the user delete action
$sql_user = "Delete from borrower where BOR_ID='$BOR_ID'";
mysqli_query($con, $sql_user);
$row = mysqli_affected_rows($con);
if($row > 0){
	//delete success, forward to userManageInfo page
	echo 'Delete User Success!';
	echo '<meta http-equiv="refresh" content="1;url=../page/userMangInfo.php?page=1"/>';			
}
//close the session
mysqli_close($con);
?>
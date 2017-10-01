<?php
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
//get all the parameters posted by addUser page
$BOR_ID = $_POST['ID'];
$BOR_name = $_POST['name'];
$BOR_PIN = $_POST['PIN'];
$BOR_type = $_POST['type'];
$BOR_gender = $_POST['gender'];
$BOR_phone = $_POST['phone'];
$BOR_department = $_POST['department'];
//the sql used to add User
$sql_user = "Insert into borrower(BOR_ID, BOR_PIN, BOR_name, BOR_type, BOR_gender, BOR_phone, BOR_department, BOR_amount) values ('$BOR_ID', '$BOR_PIN', '$BOR_name', '$BOR_type', '$BOR_gender', '$BOR_phone', '$BOR_department', 0)";
//execute the sql
mysqli_query($con, $sql_user);
//get data from database
$row = mysqli_affected_rows($con);
if($row > 0){
	echo 'Add User Success!';
	echo '<meta http-equiv="refresh" content="1;url=../page/mainPage.php"/>';			
}
//close the session
mysqli_close($con);
?>
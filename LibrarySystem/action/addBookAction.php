<?php
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
//get all the parameters posted by addBook page
$BOO_ISBN = $_POST['ISBN'];
$BOO_title = $_POST['title'];
$BOO_author = $_POST['author'];
$BOO_press = $_POST['publisher'];
$BOO_publish_date = $_POST['publishdate'];
$BOO_intro = $_POST['description'];
$BOO_amount = $_POST['copies'];
//the sql used to add Book
$sql_book = "Insert into book values ('$BOO_ISBN', '$BOO_title', '$BOO_author', '$BOO_press', '$BOO_publish_date', '$BOO_intro', $BOO_amount)";
//execute the sql
mysqli_query($con, $sql_book);
//get data from database
$row = mysqli_affected_rows($con);
if($row > 0){
	echo 'Add Book Success!';
	//forward to homepage after adding successfully
	echo '<meta http-equiv="refresh" content="1;url=../page/mainPage.php"/>';
}
//close session
mysqli_close($con);
?>
<?php
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
//get the book information from update book page
$BOO_ISBN = $_POST['ISBN'];
$BOO_title = $_POST['title'];
$BOO_author = $_POST['author'];
$BOO_press = $_POST['publisher'];
$BOO_publish_date = $_POST['publishdate'];
$BOO_intro = $_POST['description'];
$BOO_amount = $_POST['copies'];
//execute the book update action
$sql_book = "Update book set BOO_title='$BOO_title', BOO_author='$BOO_author', BOO_press='$BOO_press', BOO_publish_date='$BOO_publish_date', BOO_intro='$BOO_intro', BOO_amount='$BOO_amount' where BOO_ISBN='$BOO_ISBN'";
mysqli_query($con, $sql_book);
$row = mysqli_affected_rows($con);
if($row > 0){
	//update success, forward to bookManagInfo page
	echo 'Update Book success, wait for 3 second to forward....';
	echo '<meta http-equiv="refresh" content="3;url=../page/bookMangInfo.php?page=1"/>';
}
//close the session
mysqli_close($con);
?>
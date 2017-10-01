<?php
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
//get the book id needed to delete
$BOO_ISBN = $_GET['BOO_ISBN'];
//if the user holding the book, the admin can not delete the book
//the return type: "1" -->nobody holding this book   "0"--> somebody has borrowed this book
$judge_Delete = "select delete_available('$BOO_ISBN') AS judgeType";
//execute the sql
$judgeDelete=mysqli_query($con, $judge_Delete);
$judge_row = mysqli_fetch_array($judgeDelete, MYSQLI_ASSOC);
if($judge_row['judgeType'] == 1){
	//tyep == 1, nobody holding the book, the admin can delete the book
	$sql_book = "Delete from book where BOO_ISBN='$BOO_ISBN'";
	//execute the book delete sql
	mysqli_query($con, $sql_book);
	$row = mysqli_affected_rows($con);
	if($row > 0){
		echo 'Delete Book Success!';
		echo '<meta http-equiv="refresh" content="1;url=../page/bookMangInfo.php?page=1"/>';
	}
}elseif($judge_row['judgeType'] == 0){
	//somebody holding the book, deleting is not allowed
	echo '<script> alert("Someone has borrowed this book, unable to delete!") </script>';
	echo '<meta http-equiv="refresh" content="0;url=../page/bookMangInfo.php?page=1"/>';
}
//close the session
mysqli_close($con);
?>
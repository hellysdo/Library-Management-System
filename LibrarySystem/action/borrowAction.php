<?php
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
//get parameter from bookInfo page
$BOO_ISBN = $_GET['BOO_ISBN'];
$BOO_amount = $_GET['BOO_amount'];
$BOR_ID = $_SESSION['BOR_ID'];
$BOR_type = $_SESSION['BOR_type'];
$BOR_amount = $_SESSION['BOR_amount'];
//judge the copies of book
if($BOO_amount>0){
	//judge type of user
	if($BOR_type == 's'){
		//student
		if($BOR_amount<3){
			//only three book allowed for student
			$sql_borrow = "call borrow_book(5,'$BOO_ISBN','$BOR_ID')";
			//execute the borrow action
			mysqli_query($con, $sql_borrow);
			$row = mysqli_affected_rows($con);
			if($row == 0){
				//update the book numbers holded by student
				$_SESSION['BOR_amount']=$_SESSION['BOR_amount']+1;
				echo '<script> alert("Borrow Success!") </script>';
				echo '<meta http-equiv="refresh" content="0;url=../page/booksInfo.php?page=1"/>';
			
			}else{
				echo '<script> alert("You have borrowed this book!") </script>';
				echo '<meta http-equiv="refresh" content="0;url=../page/booksInfo.php?page=1"/>';
			}
		}else{
			echo '<script> alert("Only three books can be borrowed!") </script>';
			echo '<meta http-equiv="refresh" content="0;url=../page/booksInfo.php?page=1"/>';
		}
	}elseif($BOR_type == 'p'){
		//professor
		if($BOR_amount<5){
			//only five book allowed for professor
			$sql_borrow = "call borrow_book(5,'$BOO_ISBN','$BOR_ID')";
			//execute the borrow action
			mysqli_query($con, $sql_borrow);
			$row = mysqli_affected_rows($con);
			if($row == 0){
				//update the book numbers holded by professor
				$_SESSION['BOR_amount']=$_SESSION['BOR_amount']+1;
				echo '<script> alert("Borrow Success!") </script>';
				echo '<meta http-equiv="refresh" content="0;url=../page/booksInfo.php?page=1"/>';
			}
		}else{
			echo '<script> alert("Only five books can be borrowed!") </script>';
			echo '<meta http-equiv="refresh" content="0;url=../page/booksInfo.php?page=1"/>';
		}
	}
}else {
	echo '<script> alert("No Copies Left!") </script>';
	//No copies left, return to bookInfo page
	echo '<meta http-equiv="refresh" content="0;url=../page/booksInfo.php?page=1"/>';
}
//close the session
mysqli_close($con);
?>
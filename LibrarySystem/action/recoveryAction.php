<?php
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
include_once '../BackupTools.php';
//get the book id needed to delete
$type = $_GET['type'];
$scanfile = $_GET['file'];
$fileName = strstr($scanfile, '.', true);
//clean and backup file name
$inputDir_user = '/home/hail/public_html/662/project/user/';
$iutputDir_book = '/home/hail/public_html/662/project/book/';
$iutputDir_user_book = '/home/hail/public_html/662/project/user_book/';
$outputDir_user_book1 = '/home/hail/public_html/662/project/user_book1/';
//backup depends on the type of data
if($type == "user"){
	if($scanfile != "N"){
		//drop table
		$del_Borrow = "DROP TABLE borrow";
		$del_Borrower = "DROP TABLE borrower";
		mysqli_query($con, $del_Borrow);
		mysqli_query($con, $del_Borrower);
		//recover user
		restore_tables($dbhost, $dbuser, $dbpass, $dbname, $inputDir_user, $fileName);
		restore_tables($dbhost, $dbuser, $dbpass, $dbname, $iutputDir_user_book, $fileName.'_book');
		
		//shell_exec($command_backUpUser);
		//shell_exec($command_backUpUser_Book);
		echo "Recovery Success !";
		echo '<meta http-equiv="refresh" content="1;url=../page/userMangInfo.php?page=1"/>';
	}else {
		echo '<script> alert("No User Table to Recover !") </script>';
		echo '<meta http-equiv="refresh" content="1;url=../page/userMangInfo.php?page=1"/>';
	}
}else if($type == "book"){
	if($scanfile != "N"){
		//drop table
		$del_Borrow = "DROP TABLE borrow";
		$del_Book = "DROP TABLE book";
		mysqli_query($con, $del_Borrow);
		mysqli_query($con, $del_Book);
		//recover book
		restore_tables($dbhost, $dbuser, $dbpass, $dbname, $iutputDir_book, $fileName);
		restore_tables($dbhost, $dbuser, $dbpass, $dbname, $outputDir_user_book1, $fileName.'_book');
		//exec($command_backUpUser);
		echo "Recovery Success !";
		echo '<meta http-equiv="refresh" content="1;url=../page/bookMangInfo.php?page=1"/>';
	}else{
		echo '<script> alert("No Recovery!") </script>';
		echo '<meta http-equiv="refresh" content="1;url=../page/bookMangInfo.php?page=1"/>';
	}
}
//close session
mysqli_close($con);
?>
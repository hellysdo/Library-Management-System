<?php
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
include_once '../BackupTools.php';
//get the book id needed to delete
$type = $_GET['type'];
$filename = $_GET['file'];
//clean and backup file name
$outputDir_user = '/home/hail/public_html/662/project/user/';
$outputDir_book = '/home/hail/public_html/662/project/book/';
$outputDir_user_book = '/home/hail/public_html/662/project/user_book/';
$outputDir_user_book1 = '/home/hail/public_html/662/project/user_book1/';
//backup depends on the type of data
if($type == "user"){
	//back up users
	if($filename != ""){
		//back up the user and user_book
		backup_tables($dbhost, $dbuser, $dbpass, $dbname, 'borrower', $outputDir_user, $filename);
		backup_tables($dbhost, $dbuser, $dbpass, $dbname, 'borrow', $outputDir_user_book, $filename.'_book');
		//shell_exec($command_backUpUser);
		//shell_exec($command_backUpUser_Book);
		echo "Back Up Success !";
		echo '<meta http-equiv="refresh" content="1;url=../page/userMangInfo.php?page=1"/>';
	}else{
		echo '<script> alert("Null is not allowed !") </script>';
		echo '<meta http-equiv="refresh" content="1;url=../page/userMangInfo.php?page=1"/>';
	}
	
	
}else if($type == "book"){
	//back up books
	if($filename != ""){
		backup_tables($dbhost, $dbuser, $dbpass, $dbname, 'book', $outputDir_book, $filename);
		backup_tables($dbhost, $dbuser, $dbpass, $dbname, 'borrow', $outputDir_user_book1, $filename.'_book');
		//shell_exec($command_backUpBook);
		echo "Back Up Success !";
		echo '<meta http-equiv="refresh" content="1;url=../page/bookMangInfo.php?page=1"/>';
	}else{
		echo '<script> alert("Null is not allowed !") </script>';
		echo '<meta http-equiv="refresh" content="1;url=../page/bookMangInfo.php?page=1"/>';
	}
	
}
//close session
mysqli_close($con);
?>
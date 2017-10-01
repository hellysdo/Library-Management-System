<?php
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
//grab the username and password posted from login page
$username = $_POST['username'];
$password = $_POST['password'];
//judg the type of user: Professor, Student, Admin
//"p"-->professor, "s"--> student "l"--> admin
$sql_Judge = "select return_type('$username') AS judgeType";
$judgeResult=mysqli_query($con, $sql_Judge);
$judge_row = mysqli_fetch_array($judgeResult, MYSQLI_ASSOC);
if($judge_row['judgeType'] == 'p'||$judge_row['judgeType'] == 's'){
	//Students and Professor
	//validate username and password in database
	$sql_user = "select * from borrower where BOR_ID = '$username'";
	$showResult=mysqli_query($con, $sql_user);
	$row = mysqli_fetch_array($showResult, MYSQLI_ASSOC);
	if(!empty($row)){
		//save the user basic information to session
		$_SESSION['BOR_ID']=$row['BOR_ID'];
		$_SESSION['BOR_type']=$row['BOR_type'];
		$_SESSION['BOR_name']=$row['BOR_name'];
		$_SESSION['BOR_amount']=$row['BOR_amount'];
		
		if($password==$row['BOR_PIN']){
			//verify the student or professor password
			echo '<meta http-equiv="refresh" content="0;url=../page/booksInfo.php?page=1"/>';
		}else{
			//if not correct, back to login page
			echo 'your password is not correct !';
			echo '<meta http-equiv="refresh" content="2;url=../startLogin.php"/>';
		}
	}else{
		//verify the username
		echo 'Username or Password is not correct! Wait for returning !';
		echo '<meta http-equiv="refresh" content="2;url=../startLogin.php"/>';
	}
}elseif($judge_row['judgeType']== 'l'){
	//verify the Admin
	$sql_user = "select * from librarian where LIB_ID = '$username'";
	$showResult=mysqli_query($con, $sql_user);
	$row = mysqli_fetch_array($showResult, MYSQLI_ASSOC);
	if(!empty($row)){	
		if($password==$row['LIB_PIN']){
			//verify the admin password
			echo '<meta http-equiv="refresh" content="0;url=../page/mainPage.php"/>';
		}else{
			echo 'your password is not correct !';
			echo '<meta http-equiv="refresh" content="2;url=../startLogin.php"/>';
		}
	}
}else {
	//admin username is not correct
	echo 'Username or Password is not correct! Wait for returning !';
	echo '<meta http-equiv="refresh" content="2;url=../startLogin.php"/>';
}
//close the session
mysqli_close($con);
?>

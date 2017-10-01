<?php
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
//get the data post by sign up page
$BOR_ID = $_POST['ID'];
$BOR_name = $_POST['name'];
$BOR_PIN = $_POST['PIN'];
$BOR_REPIN = $_POST['REPIN'];
$BOR_type = $_POST['type'];
$BOR_gender = $_POST['gender'];
$BOR_phone = $_POST['phone'];
$BOR_department = $_POST['department'];

//verity the length of password
$pwdLen=strlen($BOR_PIN);
if($pwdLen>0){
	//verity the consistecy of password
	if($BOR_PIN == $BOR_REPIN){
		//verify whether the password contain at least one capital letter 
		if(preg_match('/[A-Z]+/', $BOR_PIN)){
			//if the password satisfy the need, create a new account in database
			$sql_user = "Insert into borrower(BOR_ID, BOR_PIN, BOR_name, BOR_type, BOR_gender, BOR_phone, BOR_department, BOR_amount) values ('$BOR_ID', '$BOR_PIN', '$BOR_name', '$BOR_type', '$BOR_gender', '$BOR_phone', '$BOR_department', 0)";
			//execute the sign up action 
			mysqli_query($con, $sql_user);
			$row = mysqli_affected_rows($con);
			if($row>0){
				//register success, return to login page
				echo 'Register success, wait for 3 second to forward....';
				echo '<meta http-equiv="refresh" content="3;url=../startLogin.php"/>';
			}else{
				//the account has existed, sign up again
				echo 'The account has already existed!';
				echo '<meta http-equiv="refresh" content="3;url=../page/signup.php"/>';
			}					
		}else{
			//the password doesn't satisfy the requirement
			echo 'Your password should contain at least one capital letter !<br/>';
			echo '<meta http-equiv="refresh" content="3;url=../page/signup.php"/>';
		}
	}else{
		//the second password is not equal to the first one
		echo 'Two passwords are not same !<br/>';
		echo '<meta http-equiv="refresh" content="3;url=../page/signup.php"/>';
	}
}else{
	//password is not null allowed
	echo 'Null password is not allowed !<br/>';
	echo '<meta http-equiv="refresh" content="3;url=../page/signup.php"/>';
}
//close the session
mysqli_close($con);
?>
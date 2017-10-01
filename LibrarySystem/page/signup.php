<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Login Page</title>
	<script type="text/javascript">  
        function GoBack() {  
           window.history.back();   
        }  
    </script>
</head>
<body>
	<h2>SignUp Page</h2>
	<div>Already have an account?&nbsp;<a href="../startLogin.php">Click Here</a></div>
	<br />
	<!-- the table shows sign up information -->
	<form action="../action/signUpAction.php" method="post">
	<table border='1' cellpadding='0' cellspacing='0'>
		<tr>
			<td align='left'>UserId</td>
			<td><input align="middle" type="text" name="ID" id="" /></td>
		</tr>
		<tr>
			<td align='left'>UserName</td>
			<td><input align="middle" type="text" name="name" id="" /></td>
		</tr>
		<tr>
			<td align='left'>Gender</td>
			<td><select style="width: 100%; height: 100%" name="gender" id="">
				<option value="m">Male</option>
				<option value="f">Female</option>
			</select></td>
		</tr>
		<tr>
			<td align='left'>Password</td>
			<td><input type="password" name="PIN" id="" /></td>
		</tr>
		<tr>
			<td align='left'>Re-Password</td>
			<td><input type="password" name="REPIN" id="" /></td>
		</tr>
		<tr>
			<td align='left'>Phone</td>
			<td><input type="text" name="phone" id=""/></td>
		</tr>
		<tr>
			<td align='left'>Department</td>
			<td><input type="text" name="department" id=""/></td>
		</tr>
		<tr>
			<td align='left'>Type</td>
			<td><select style="width: 100%; height: 100%" name="type" id="">
			<option value="s">Student</option>
			<option value="p">Professor</option>
			</select></td>
		</tr>
	</table>
	<br />
	<input type="submit" name="loginSubmit" value="Sign Up"/>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="button" name="cancel" value="Cancel" onclick="GoBack();"/>
	</form>
</body>

</html>
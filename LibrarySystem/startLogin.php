<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Library Home Page</title>
</head>
<body>
	<h2>Library System</h2>
	<img src="./images/1.gif" alt="" /><hr />
	<form action="./action/loginAction.php" method="post">
		<table border='1' cellpadding='0' cellspacing='0'>
			<tr>
				<td align="left">UserName</td>
				<td><input type="text" name="username"/></td>
			</tr>
			<tr>
				<td align="left">PassWord</td>
				<td><input type="password" name="password"/></td>
			</tr>
		</table>
		<br />
		<input type="submit" name="login" value="log in"/>
		<input type="button" onclick="window.location.href='./page/signup.php'" value="sign up"/>
	</form>
	<hr />
	<img src="./images/mylogo.gif" alt="" />
</body>

</html>

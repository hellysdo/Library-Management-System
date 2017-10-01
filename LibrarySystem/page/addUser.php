<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>AddBook</title>
	<script type="text/javascript">  
	//go back to the previous page
        function GoBack() {  
           window.history.back();   
        }  
    </script>
</head>

<body>
	<h2>Add a User</h2>
	<img src="../images/1.gif" alt="" />
	<hr />
	<br />
	<form action="../action/addUserAction.php" method="post">
	<!-- the table to add user -->
	<table border='1' cellpadding='0' cellspacing='0'>
		<tr>
			<td align='left'>UserId</td>
			<td><input style="width: 250px" align="middle" type="text" name="ID" id="" /></td>
		</tr>
		<tr>
			<td align='left'>UserName</td>
			<td><input style="width: 250px" align="middle" type="text" name="name" id="" /></td>
		</tr>
		<tr>
			<td align='left'>Gender</td>
			<td><select style="width: 100%; height: 100%" name="gender" id="">
				<option value="m">Male</option>
				<option value="f">Female</option>
			</select></td>
		</tr>
		<tr>
			<td align='left'>PassWord</td>
			<td><input style="width: 250px" type="password" name="PIN" id="" /></td>
		</tr>
		<tr>
			<td align='left' style="width: 150px">Phone</td>
			<td><input style="width: 250px" type="text" name="phone" id=""/></td>
		</tr>
		<tr>
			<td align='left'>Department</td>
			<td><input style="width: 250px" type="text" name="department" id=""/></td>
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
	<!-- the button to submit the request or cancel to back -->
	<input style="font-size: 15px; font-weight: bold;" type="submit" name="addUser" value="&nbsp;Add&nbsp;"/>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
	<input style="font-size: 15px; font-weight: bold;" type="button" name="cancel" value="Cancel" onclick="GoBack();"/>
	
	</form>
</body>
</html>

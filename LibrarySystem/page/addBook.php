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
	<h2>Add a New Book</h2>
	<img src="../images/1.gif" alt="" />
	<hr />
	<br />
	<form action="../action/addBookAction.php" method="post">
	<!-- the table to add book -->
	<table border='1' cellpadding='0' cellspacing='0' width="35%">
		<tr>
			<td align='left'>ISBN</td>
			<td><input style="width: 320px" align="middle" type="text" name="ISBN" id="" /></td>
		</tr>
		<tr>
			<td align='left'>Title</td>
			<td><input style="width: 320px" align="middle" type="text" name="title" id="" /></td>
		</tr>
		<tr>
			<td align='left'>Author</td>
			<td><input style="width: 320px" type="text" name="author" id="" /></td>
		</tr>
		<tr>
			<td align='left'>Publisher</td>
			<td><input style="width: 320px" type="text" name="publisher" id="" /></td>
		</tr>
		<tr>
			<td align='left'>PublishDate</td>
			<td><input style="width: 320px" type="text" name="publishdate" id=""/></td>
		</tr>
		<tr>
			<td align='left' style="width: 150px">Description</td>
			<td><input style="width: 320px" type="text" name="description" id=""/></td>
		</tr>
		<tr>
			<td align='left'>Copies</td>
			<td><input style="width: 320px" type="text" name="copies" id=""/></td>
		</tr>
	</table>
	<br />
	<!-- the button to submit the request or cancel to back -->
	<input style="font-size: 15px; font-weight: bold;" type="submit" name="addbook" value="&nbsp;Add&nbsp;"/>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
	<input style="font-size: 15px; font-weight: bold;" type="button" name="cancel" value="Cancel" onclick="GoBack();"/>
	
	</form>
</body>
</html>

<?php 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Document</title>
</head>
<body>
<!-- Admin status bar -->
	<img src="../images/1.gif" alt="" /><span style="color: blue; font-size: 20px;">WELCOM: <a href=""><?php echo 'Admin';?></a> !</span>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../startLogin.php">LOG OUT?</a> 
	<hr />
	<!-- User operation branch -->
	<dl>
		<dt style="font-size: 20px">User Management</dt>
		<dd style="line-height: 40px"><a href="./userMangInfo.php?page=1">Update User Info</a></dd>
		<dd><a href="./addUser.php">Add User</a></dd>
	</dl>
	<!-- Book operation branch -->
	<dl>
		<dt style="font-size: 20px">Book Management</dt>
		<dd style="line-height: 40px"><a href="./bookMangInfo.php?page=1">Update Book Info</a></dd>
		<dd><a href="./addBook.php">Add Book</a></dd>
	</dl>
	<hr />
</body>
</html>
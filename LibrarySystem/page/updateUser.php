<?php 
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
//get user id
$BOR_ID = $_GET['BOR_ID'];
//get the user information which is to be updated
$sqlUser = "select * from borrower where BOR_ID='$BOR_ID'";
$row = mysqli_fetch_array(mysqli_query($con, $sqlUser), MYSQLI_ASSOC);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Update User</title>
	<script type="text/javascript">
		//go back to the previous page  
        function GoBack() {  
           window.history.back();   
        }
        //set the value of user gender and type
        function checkModel(){
        	document.getElementById("3").value = "<?php echo $row['BOR_gender'];?>";
        	document.getElementById("7").value = "<?php echo $row['BOR_type'];?>";
        }
        //validate at least one value has been changed if user want to update book infomation
        function verify(){
        	document.getElementById("1").removeAttribute("disabled");
        	document.getElementById("8").removeAttribute("disabled");
        	if((document.getElementById("1").value == '<?php echo $row['BOR_ID'];?>')&&
        			(document.getElementById("2").value == '<?php echo $row['BOR_name'];?>')&&
        			(document.getElementById("3").value == '<?php echo $row['BOR_gender'];?>')&&
        			(document.getElementById("4").value == '<?php echo $row['BOR_PIN'];?>')&&
        			(document.getElementById("5").value == '<?php echo $row['BOR_phone'];?>')&&
        			(document.getElementById("6").value == '<?php echo $row['BOR_department'];?>')&&
        			(document.getElementById("7").value == '<?php echo $row['BOR_type'];?>')&&
                	(document.getElementById("8").value == '<?php echo $row['BOR_amount'];?>')){
				alert("No Value Changed!");
				return false;
            }else{
				return true;
            } 
		}
    </script>
</head>
<body onload="checkModel()">
	<!-- table used to show updated user information -->
	<h2>Update User</h2>
	<img src="../images/1.gif" alt="" />
	<hr />
	<br />
	<form action="../action/updateUserAction.php" method="post" onsubmit="return verify();">

	<table border='1' cellpadding='0' cellspacing='0'>
		<tr>
			<td align='left'>UserId</td>
			<td><input disabled="disabled" style="width: 250px" align="middle" type="text" name="ID" id="1" value="<?php echo $row['BOR_ID'];?>"/></td>
		</tr>
		<tr>
			<td align='left'>UserName</td>
			<td><input style="width: 250px" align="middle" type="text" name="name" id="2" value="<?php echo $row['BOR_name'];?>"/></td>
		</tr>
		<tr>
			<td align='left'>Gender</td>
			<td><select style="width: 100%; height: 100%" name="gender" id="3">
				<option value="m">Male</option>
				<option value="f">Female</option>
			</select></td>
		</tr>
		<tr>
			<td align='left'>PassWord</td>
			<td><input style="width: 250px" type="text" name="PIN" id="4" value="<?php echo $row['BOR_PIN'];?>"/></td>
		</tr>
		<tr>
			<td align='left' style="width: 150px">Phone</td>
			<td><input style="width: 250px" type="text" name="phone" id="5" value="<?php echo $row['BOR_phone'];?>"/></td>
		</tr>
		<tr>
			<td align='left'>Department</td>
			<td><input style="width: 250px" type="text" name="department" id="6" value="<?php echo $row['BOR_department'];?>"/></td>
		</tr>
		<tr>
			<td align='left'>Type</td>
			<td><select style="width: 100%; height: 100%" name="type" id="7">
			<option value="s">Student</option>
			<option value="p">Professor</option>
			</select></td>
		</tr>
		<tr>
			<td align='left'>Borrowed Books</td>
			<td><input disabled="disabled" style="width: 250px" type="text" name="amount" id="8" value="<?php echo $row['BOR_amount'];?>"/></td>
		</tr>
	</table>
	<br />
	<!-- submit the update -->
	<input style="font-size: 15px; font-weight: bold;" type="submit" name="updateUser" value="&nbsp;Update&nbsp;"/>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<!-- cancel the update -->
	<input style="font-size: 15px; font-weight: bold;" type="button" name="cancel" value="Cancel" onclick="GoBack();"/>
	
	</form>
</body>
<!-- close session -->
<?php mysqli_close($con);?>
</html>
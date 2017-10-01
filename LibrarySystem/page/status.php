<?php 
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
//get the user id
$BOR_ID = $_SESSION['BOR_ID'];
//get user information from database
$sqlUser = "select * from borrower where BOR_ID='$BOR_ID'";
$row = mysqli_fetch_array(mysqli_query($con, $sqlUser), MYSQLI_ASSOC);
//get borrowed book information from database
$sqlBorrowed = "select BOO_ISBN, BOO_title, BOO_author, BOO_press, BOO_publish_date, BOO_intro from book where BOO_ISBN in (select BOO_ISBN from borrow where BOR_ID='$BOR_ID')";
$showResult = mysqli_query($con, $sqlBorrowed);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Status</title>
	<style type="text/css">
		td
		{
		    text-align:center;
		}
	</style>
	<script type="text/javascript">  
		//set the user gender and type value in basic information table
        function checkModel(){
        	document.getElementById("3").value = "<?php echo $row['BOR_gender'];?>";
        	document.getElementById("7").value = "<?php echo $row['BOR_type'];?>";
        }
        
		//validate at least one value has been changed if user want to update his personal infomation
        function verify(){
        	document.getElementById("1").removeAttribute("disabled");
        	document.getElementById("7").removeAttribute("disabled");
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
	<img src="../images/1.gif" alt="" />
	<h3>Personal Information</h3>
	<!-- table used to show user information -->
	<form action="../action/updateStatusAction.php" method="post" onsubmit="return verify();">
	<table border='1' cellpadding='0' cellspacing='0' bgcolor="#ced3ff">
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
			<td><select style="width: 100%; height: 100%" name="type" id="7" disabled="disabled">
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
	<input style="font-size: 15px; font-weight: bold;" type="submit" name="updateUser" value="&nbsp;Update&nbsp;"/>
	
	</form>
	<br />
	<!-- table used to show book holded by user -->
	<h3>Borrowed Books</h3>
	<table border="1" width="98%" cellpadding="0" cellspacing="0">
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ISBN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>Title</td>
			<td>Author</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;Publisher&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>&nbsp;&nbsp;PublishDate&nbsp;&nbsp;</td>
			<td>Status</td>
			
		</tr>
		<!-- loop the data we get from database, and show in page -->
		<?php while ($row_Borrow = mysqli_fetch_array($showResult, MYSQLI_ASSOC)){
		?>
		<tr>
			<td><?php echo $row_Borrow['BOO_ISBN'];?></td>
			<td><?php echo $row_Borrow['BOO_title'];?></td>
			<td><?php echo $row_Borrow['BOO_author'];?></td>
			<td><?php echo $row_Borrow['BOO_press'];?></td>
			<td><?php echo $row_Borrow['BOO_publish_date'];;?></td>
			<td><a href="../action/returnBookAction.php?BOO_ISBN=<?php echo $row_Borrow['BOO_ISBN'];?> " onclick="return confirm('Sure To Return?')">Return Book</a></td>
		</tr>
		<?php 
		}
		?>
	</table>
	<br />
	<br />
	<a href="./booksInfo.php?page=1"><input style="font-size: 15px; font-weight: bold; color: Black;" type="button" name="return" value="Return"/></a>
	<br />
</body>
<!-- close the session -->
<?php mysqli_close($con);?>
</html>
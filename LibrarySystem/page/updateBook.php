<?php 
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
//get the book id
$BOO_ISBN = $_GET['BOO_ISBN'];
//get the book information which is to be updated
$sqlBook = "select * from book where BOO_ISBN='$BOO_ISBN'";
$row = mysqli_fetch_array(mysqli_query($con, $sqlBook), MYSQLI_ASSOC);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Update Book</title>
	<script type="text/javascript">
		//go back to the previous page
        function GoBack() {  
           window.history.back();   
        }  
		//validate at least one value has been changed if user want to update book infomation
        function verify(){
        	if((document.getElementById("1").value == '<?php echo $row['BOO_ISBN'];?>')&&
        			(document.getElementById("2").value == '<?php echo $row['BOO_title'];?>')&&
        			(document.getElementById("3").value == '<?php echo $row['BOO_author'];?>')&&
        			(document.getElementById("4").value == '<?php echo $row['BOO_press'];?>')&&
        			(document.getElementById("5").value == '<?php echo $row['BOO_publish_date'];?>')&&
        			(document.getElementById("6").value == '<?php echo $row['BOO_intro'];?>')&&
                	(document.getElementById("7").value == '<?php echo $row['BOO_amount'];?>')){
				alert("No Value Changed!");
				return false;
            }else{
				return true;
            } 
		}
    </script>
</head>

<body>
	<h2>Update Book</h2>
	<img src="../images/1.gif" alt="" />
	<hr />
	<br />
	<!-- table used to show updated book information -->
	<form action="../action/updateBookAction.php" onsubmit="return verify();" method="post">

	<table border='1' cellpadding='0' cellspacing='0' width="35%">
		<tr>
			<td align='left'>ISBN</td>
			<td><input style="width: 320px" readonly="readonly" align="middle" type="text" name="ISBN" id="1" value="<?php echo $row['BOO_ISBN'];?>" /></td>
		</tr>
		<tr>
			<td align='left'>Title</td>
			<td><input style="width: 320px" align="middle" type="text" name="title" id="2" value="<?php echo $row['BOO_title'];?>"/></td>
		</tr>
		<tr>
			<td align='left'>Author</td>
			<td><input style="width: 320px" type="text" name="author" id="3" value="<?php echo $row['BOO_author'];?>"/></td>
		</tr>
		<tr>
			<td align='left'>Publisher</td>
			<td><input style="width: 320px" type="text" name="publisher" id="4" value="<?php echo $row['BOO_press'];?>"/></td>
		</tr>
		<tr>
			<td align='left'>PublishDate</td>
			<td><input style="width: 320px" type="text" name="publishdate" id="5" value="<?php echo $row['BOO_publish_date'];?>"/></td>
		</tr>
		<tr>
			<td align='left' style="width: 150px">Description</td>
			<td><input style="width: 320px" type="text" name="description" id="6" value="<?php echo $row['BOO_intro'];?>"/></td>
		</tr>
		<tr>
			<td align='left' style="width: 150px">Copies</td>
			<td><input style="width: 320px" type="text" name="copies" id="7" value="<?php echo $row['BOO_amount'];?>"/></td>
		</tr>
	</table>
	<br />
	<!-- submit the update -->
	<input style="font-size: 15px; font-weight: bold;" type="submit" name="updatebook" value="&nbsp;Update&nbsp;"/>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<!-- cancel the update -->
	<input style="font-size: 15px; font-weight: bold;" type="button" name="cancel" value="Cancel" onclick="GoBack();"/>
	</form>
</body>
<!-- close session -->
<?php mysqli_close($con);?>
</html>
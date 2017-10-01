<?php
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
//get all the user information
$sql = "select * from borrower";
//the total number of user
$totalNum = mysqli_num_rows(mysqli_query($con, $sql));
//get the current page
if(!isset($_GET['page'])){
	$page=1;
}else{
	$page=$_GET['page'];
}
$size = 10; //the max records shown in each page
$startPage=($page-1)*$size;
//get data from database
$sqlUser = "select * from borrower where 1=1 limit ".$startPage.",".$size;
$showResult = mysqli_query($con, $sqlUser);
//get the page count
$pagecount = intval(($totalNum-1)/$size) + 1;
$path = "/home/hail/public_html/662/project/user";
//grab the .sql file of user
$handle = opendir($path);
while (($file = readdir($handle))!== false){
	if($file != ".."&&$file != "."){
		$files[] = $file;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<style type="text/css">
		td
		{
		    text-align:center;
		}
	</style>
	<title>User List</title>
	<script type="text/javascript">
	//scan and load all the backed up files
	function checkModel(){
		<?php 
		foreach ($files as $arr){
		?>
		var opp = new Option("<?php echo $arr;?>","<?php echo $arr;?>");
		getEle("scanfile").add(opp);

		<?php 
		}
		?>
	}
	//forward to backup action
	function backUp(){
		window.location.href='../action/backUpAction.php?type=user&file='+getEle('filename').value;
	}
	//forward to recovery action
	function recovery(){
		window.location.href='../action/recoveryAction.php?type=user&file='+getEle('scanfile').value
	}
	//get the id of label
	function getEle(id){
		return document.getElementById(id);
	}
	</script>
</head>
<body onload="checkModel()">
	<!-- the top Admin status bar -->
	<h2 style="color:gray;">Users Management</h2>
	<img src="../images/1.gif" alt="" /><span style="color: blue; font-size: 20px;">WELCOM: <a href="./adminInfo.php"><?php echo 'Admin!';?></a> !</span>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./mainPage.php">MAIN PAGE</a> 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../startLogin.php">LOG OUT?</a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
	<input style="width: 100px;" type="text" placeholder='FileName' id='filename'/><span>.sql</span>&nbsp;
	<input type="submit" onclick="backUp()" value="BACKUP"/>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<select name="" id="scanfile">
		<option value="N">--Select File--</option>
	</select>
	<input type="submit" onclick="recovery()" value="RECOVERY"/>
	<hr />
	<br />
	<!-- the search bar -->
	<form action="./searchUserAdmin.php?page=1" method="post">
	<table>
		<tr>
			<td><select style="height: 22px;" name="option" id="">
				<option value="BOR_ID">UserId</option>
				<option value="BOR_name">UserName</option>
				<option value="BOR_phone">Phone</option>
				<option value="BOR_department">Department</option>
			</select></td>
			<td><input name="keyword" style="width: 200px;" type="text" placeholder='Input Key Words...' /></td>
			<td><button type="submit" style="color: red">Search</button></td>
		</tr>
	</table>
	</form>
	
	<br />
	<!-- the table shown user information -->
	<table border="1" width="90%" cellpadding="0" cellspacing="0">
		<tr>
			<td>UserId</td>
			<td>Username</td>
			<td>Gender</td>
			<td>Password</td>
			<td>Phone</td>
			<td>Department</td>
			<td>Type</td>
			<td>Borrowed Book</td>
			<td>Delete User</td>
			<td>Update User</td>
		</tr>
		<!-- loop the data we get from database, and show in page -->
		<?php while($row = mysqli_fetch_array($showResult, MYSQLI_ASSOC)){
		?>
		<tr>
			<td><?php echo $row['BOR_ID'];?></td>
			<td><?php echo $row['BOR_name'];?></td>
			<td><?php echo $row['BOR_gender'];?></td>
			<td><?php echo $row['BOR_PIN'];?></td>
			<td><?php echo $row['BOR_phone'];?></td>
			<td><?php echo $row['BOR_department'];?></td>
			<td><?php echo $row['BOR_type'];?></td>
			<td><?php echo $row['BOR_amount'];?></td>
			<td><a href="../action/deleteUserAction.php?BOR_ID=<?php echo $row['BOR_ID'];?>" onclick="return confirm('Sure To Delete?')">Delete</a></td>
			<td><a href="./updateUser.php?BOR_ID=<?php echo $row['BOR_ID'];?>">Update</a></td>
		</tr>
		<?php 
		}
		?>
	</table>
	<br />
	<br />
	<!-- split the result into multi page -->
	<?php 
	if(!isset($_GET['page']) || $_GET['page']<=1){
	?>
	<!-- show previous page -->
	<a href="userMangInfo.php?page=1">Previous</a>
	<?php }else{ ?>
	<a href="userMangInfo.php?page=<?php echo $page-1;?>">Previous</a>
	<?php } ?>
	<!-- show all the pages number and highlight current page -->
	<?php 
	//get the page numbers shown in the bottom, as we only hope user can view 9 page, if the total page less than 9
	//we show all of the page number, but if the total page is more than 9, we only show 9 pages each time
	$num = min($pagecount, 9);
	//the end page number will be shown in bottom
	$end = $page + floor($num/2) <= $pagecount ? $page + floor($num/2) : $pagecount;
	//the start page number will be shown in bottom
	$start = $end - $num + 1;
	//judge if the start page is negative, set the start page to 1, and reset the end page
	if($start < 1) {
		$end = $end - $start +1;
		$start = 1;
	}
	?>
	<!-- loop the page number to shown in the bottom -->
	<?php for($i=$start; $i<=$end; $i++){
		if($i==$page){?>
			<a href="userMangInfo.php?page=<?php echo $i;?>"><?php echo '['.$i.']';?></a>
	<?php
	}else{
	?>
	<a href="userMangInfo.php?page=<?php echo $i;?>"><?php echo $i;?></a>
	<?php 
	}
	?>		
	<?php 
	}
	?>
	<?php if($_GET['page']>=$pagecount) {?>
	<!-- show next page -->
	<a href="userMangInfo.php?page=<?php echo $pagecount;?>">Next</a>
	<?php }else{ ?>
	<a href="userMangInfo.php?page=<?php echo $page+1;?>">Next</a>

	<?php 
	}
	?>
	&nbsp;&nbsp;<span>Total&nbsp;<?php echo $page.'/'.$pagecount;?>&nbsp;Pages</span>
	<hr />
</body>
<?php mysqli_close($con);?>
</html>
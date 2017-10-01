<?php 
//activate the session in this page
session_start();
//include the mysql database connection page
include_once '../conn.php';
//the sql to get all the book information from database
$sql = "select * from book";
//the total records
$totalNum = mysqli_num_rows(mysqli_query($con, $sql));//the total records will be shown
//set the current page number
if(!isset($_GET['page'])){
	$page=1;
}else{
	$page=$_GET['page'];
}
//the records will be shown in each page
$size=10;
//the previous page before the current page
$startPage=($page-1)*$size;
//get each page data from database
$sqlBook = "select * from book where 1=1 limit ".$startPage.",".$size;
$showResult = mysqli_query($con, $sqlBook);
//calculate the total page count
$pagecount = intval(($totalNum-1)/$size) + 1;
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
	<title>Student Page</title>
</head>
<body>
	<!-- the User status bar -->
	<h2>Book Information</h2>
	<img src="../images/1.gif" alt="" /><span style="color: blue; font-size: 20px;">WELCOM: <?php if($_SESSION['BOR_type']=='s'){echo 'Student, ';}elseif ($_SESSION['BOR_type']=='p'){echo 'Professor, ';};?><a href="./status.php"><?php echo $_SESSION['BOR_name'];?></a> !</span>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../startLogin.php">LOG OUT?</a> 
	<hr />
	<br />
	<!-- the search bar -->
	<form action="./searchBook.php?page=1" method="post">
	<table>
		<tr>
			<td><select name="option" style="height: 22px;" id="">
				<option value="BOO_ISBN">ISBN</option>
				<option value="BOO_title">Title</option>
				<option value="BOO_author">Author</option>
				<option value="BOO_press">Publisher</option>
			</select></td>
			<td><input name="keyword" style="width: 200px;" type="text" placeholder='Input Key Words...' /></td>
			<td><button type="submit" style="color: red">Search</button></td>
		</tr>
	</table>
	</form>
	<br />
	<!-- the table shown book information -->
	<table border="1" width="95%" cellpadding="0" cellspacing="0">
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ISBN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>Title</td>
			<td>Author</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;Publisher&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>&nbsp;&nbsp;PublishDate&nbsp;&nbsp;</td>
			<td>Description</td>
			<td>Copies</td>
			<td>Status</td>
		</tr>
		<!-- loop the data we get from database, and show in page -->
		<?php while ($row = mysqli_fetch_array($showResult, MYSQLI_ASSOC)){
		?>
		<tr>
			<td><?php echo $row['BOO_ISBN'];?></td>
			<td><?php echo $row['BOO_title'];?></td>
			<td><?php echo $row['BOO_author'];?></td>
			<td><?php echo $row['BOO_press'];?></td>
			<td><?php echo $row['BOO_publish_date'];;?></td>
			<td><?php echo $row['BOO_intro'];;?></td>
			<td><?php echo $row['BOO_amount'];?></td>
			<!-- add borrow operation for book -->
			<td><a href="../action/borrowAction.php?BOO_ISBN=<?php echo $row['BOO_ISBN'];?>&BOO_amount=<?php echo $row['BOO_amount'];?>" onclick="return confirm('Sure To Borrow?')">borrow</a></td>
		</tr>
		<?php 
		}
		?>
	</table>
	<br />
	<!-- split the result into multi page -->
	<?php 
	if(!isset($_GET['page']) || $_GET['page']<=1){
	?>
	<!-- show previous page -->
	<a href="booksInfo.php?page=1">Previous</a>
	<?php }else{ ?>
	<a href="booksInfo.php?page=<?php echo $page-1;?>">Previous</a>
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
			<a href="booksInfo.php?page=<?php echo $i;?>"><?php echo '['.$i.']';?></a>
	<?php
	}else{
	?>
	<a href="booksInfo.php?page=<?php echo $i;?>"><?php echo $i;?></a>
	<?php 
	}
	?>		
	<?php 
	}
	?>
	<!-- show next page -->
	<?php if($_GET['page']>=$pagecount) {?>
	<a href="booksInfo.php?page=<?php echo $pagecount;?>">Next</a>
	<?php }else{ ?>
	<a href="booksInfo.php?page=<?php echo $page+1;?>">Next</a>

	<?php 
	}
	?>
	&nbsp;&nbsp;<span>Total&nbsp;<?php echo $page.'/'.$pagecount;?>&nbsp;Pages</span>
	<hr />
</body>
<!-- close the session -->
<?php mysqli_close($con);?>
</html>

<?php
	$page = "123";
	$path = "D:/test/";
	$handle = opendir($path);
	while (($file = readdir($handle))!== false){
		if($file != ".."&&$file != "."){
			$files[] = $file;
		}
	}
	foreach ($files as $arr){
		echo $arr;
		echo "<br/>";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Test</title>
	<script type="text/javascript">
	function checkModel(){
		<?php 
		foreach ($files as $arr){
		?>
		window.alert("<?php echo $arr;?>");
		<?php 
		}
		?>
	}
		
	</script>
</head>
<body onload="checkModel();">
	
</body>
	


</html>
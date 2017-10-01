<?php

//MySQL server and database
$dbhost = 'mysql1.cs.clemson.edu';
$dbuser = 'lj';
$dbpass = 'liujiang6620';
$dbname = 'library-lj';
$tables = '*';

//Call the core function
//backup_tables($dbhost, $dbuser, $dbpass, $dbname, $tables);

//function used to backup tables
function backup_tables($host, $user, $pass, $dbname, $tables = '*', $outputDir = '.', $filename) {
    $link = mysqli_connect($host,$user,$pass, $dbname);

    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }

    mysqli_query($link, "SET NAMES 'utf8'");

    //get all of the tables
    if($tables == '*')
    {
        $tables = array();
        $result = mysqli_query($link, 'SHOW TABLES');
        while($row = mysqli_fetch_row($result))
        {
            $tables[] = $row[0];
        }
    }
    else
    {
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }

    $return = '';
    //cycle through
    foreach($tables as $table)
    {
        $result = mysqli_query($link, 'SELECT * FROM '.$table);
        $num_fields = mysqli_num_fields($result);
        $num_rows = mysqli_num_rows($result);

        $return.= 'DROP TABLE IF EXISTS '.$table.';';
        $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";
        $counter = 1;

        //Over tables
        for ($i = 0; $i < $num_fields; $i++) 
        {   //Over rows
            while($row = mysqli_fetch_row($result))
            {   
                if($counter == 1){
                    $return.= 'INSERT INTO '.$table.' VALUES(';
                } else{
                    $return.= '(';
                }

                //Over fields
                for($j=0; $j<$num_fields; $j++) 
                {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_fields-1)) { $return.= ','; }
                }

                if($num_rows == $counter){
                    $return.= ");\n";
                } else{
                    $return.= "),\n";
                }
                ++$counter;
            }
        }
        $return.="\n\n\n";
    }

    //save file
    $pathName = $outputDir.$filename.'.sql';
    $handle = fopen($pathName,'w+');
    fwrite($handle,$return);
    if(fclose($handle)){
    	//echo $pathName;
    }
    mysqli_close($link);
}

//function used to restore tables
function restore_tables($host, $user, $pass, $dbname, $inputDir, $filename){
	$restore_link = mysqli_connect($host,$user,$pass, $dbname);
	$pathName = $inputDir.$filename.'.sql';
	$restore_sql = file_get_contents($pathName);
	//get each sql in file
	$segments = explode(";",$restore_sql);
	//traverse all the sqls
	foreach ($segments as $segment){
		mysqli_query($restore_link, $segment);
		
	}
	mysqli_close($restore_link);
}
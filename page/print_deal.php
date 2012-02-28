<?php
    $choice = $_POST["choice"];
    
	require('../database/appvars.php');
	
	// open connection
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("NO CONNECT!!");
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db(DB_NAME) or die("OPEN FAILED!!");

    if($choice == 0)
    {
        // SQL
        $sql = "UPDATE ncu_civil SET printable = '0' WHERE printable = '1'";
        mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");
    }
    else if($choice == 1)
    {
        
    }
    
	mysql_close($link);
	
	// jump the page
	header("location:print.php#jump");
	exit();
?>
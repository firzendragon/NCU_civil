<?
	// Get the search data
	$choice = $_POST["choice"];
	$context_id = $_POST["context_id"];
	
	require('../database/appvars.php');
	
	// open connection
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("NO CONNECT!!");
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db(DB_NAME) or die("OPEN FAILED!!");

	if($choice == 1)
	{
		for($i=0; $i<count($context_id); $i++)
		{
			// SQL
			$sql = "UPDATE ncu_civil SET del = '0' WHERE context_id = '$context_id[$i]'";
			mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");
		}
	}
	else if($choice == 2)
	{
		for($i=0; $i<count($context_id); $i++)
		{
			// SQL
			$sql = "DELETE FROM ncu_civil WHERE context_id = '$context_id[$i]'";
			mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");
		}
	}
	else if($choice == 3)
	{
		// SQL
		$sql = "UPDATE ncu_civil SET del = '0' WHERE del = '1'";
		mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");
	}
	else if($choice == 4)
	{
		// SQL
		$sql = "DELETE FROM ncu_civil WHERE del = '1'";
		mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");
	}
	
	// close connection
	mysql_close($link);
	
	// jump the page
	header("location:trash.php#jump");
	exit();
?>
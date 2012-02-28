<?php
	$context_id   = $_POST["context_id"];
	$id           = $_POST["id"];
	$object_name  = $_POST["object_name"];
    $contractor_name = $_POST["contractor_name"];
	$factory_name = $_POST["factory_name"];
	$flow_context_temp = $_POST["flow_context"];
	$report       = $_POST["report"];
    $payment      = $_POST["payment"];
	$write_year   = $_POST["write_year"];
	$write_month  = $_POST["write_month"];
    $write_day    = $_POST["write_day"];
    $report_year  = $_POST["report_year"];
	$report_month = $_POST["report_month"];
    $report_day   = $_POST["report_day"];
    $out_year     = $_POST["out_year"];
    $out_month    = $_POST["out_month"];
    $out_day      = $_POST["out_day"];
    $tester       = $_POST["tester"];
    $report_name  = $_POST["report_name"];
    $payment      = $_POST["payment"];

	require('../database/appvars.php');
	
	// open connection
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("NO CONNECT!!");
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db(DB_NAME) or die("OPEN FAILED!!");

	// SQL
	$sql = "SELECT * FROM ncu_civil WHERE context_id = '$context_id'";
	$result = mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");
	$row = mysql_fetch_assoc($result) or die("READ DATA FAILED");
    $flow_name = $row["flow_name"];
    
    $sql = "SELECT * FROM ncu_civil_flow WHERE flow_name = '$flow_name'";
	$result = mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");
	$row = mysql_fetch_assoc($result) or die("READ DATA FAILED");
    $flow_context = $row["flow_type"];
    
    for($i=0; $i<count($flow_context_temp); $i++)
    {
        $flow_context_temp2[] = $flow_context_temp[$i];
    }
    
    $flow_context = implode(",", $flow_context_temp2);
    
	// SQL
	$sql = "UPDATE ncu_civil SET id = '$id', object_name= '$object_name', contractor_name = '$contractor_name', factory_name = '$factory_name',
			flow_context = '$flow_context',
			report = '$report', payment = '$payment',
            write_year = '$write_year', write_month = '$write_month', write_day = '$write_day',
            report_year = '$report_year', report_month = '$report_month', report_day = '$report_day',
            out_year = '$out_year', out_month = '$out_month', out_day = '$out_day',
            tester = '$tester', report_name = '$report_name'
			WHERE context_id = '$context_id'";
	mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");

	// close connection
	mysql_close($link);
	
	// jump the page
	header("location:search.php#jump");
	exit();
?>
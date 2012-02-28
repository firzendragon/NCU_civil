<?php
	$id           = $_POST["id"];
	$object_name  = $_POST["object_name"];
    $contractor_name = $_POST["contractor_name"];
	$factory_name = $_POST["factory_name"];
	$flow_name    = $_POST["flow_name"];
    $flow_context_temp = $_POST["flow_context"];
	$write_year   = $_POST["write_year"];
	$write_month  = $_POST["write_month"];
    $write_day    = $_POST["write_day"];
    $out_year     = $_POST["out_year"];
    $out_month    = $_POST["out_month"];
    $out_day      = $_POST["out_day"];
    $tester       = $_POST["tester"];
    $report_name  = $_POST["report_name"];
	
	require('../database/appvars.php');
	
	// open connection
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("NO CONNECT!!");
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db(DB_NAME) or die("OPEN FAILED!!");

	// SQL
    $sql = "select * FROM ncu_civil_flow where flow_name = '$flow_name'";
    $result = mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");
    $row = mysql_fetch_assoc($result) or die("READ DATA FAILED");
    $flow_context = $row["flow_type"];
    $flow_index   = $row["flow_index"];
    
    if($row["context_id"] == 4) {
        $flow_context = $flow_context_temp[$flow_index];
    }
    else {
        for($i=0; $i<count(explode(",",$flow_context)); $i++)
        {
            $flow_context_temp2[] = $flow_context_temp[$flow_index];
            $flow_index++;
        }
        $flow_context = implode(",", $flow_context_temp2);
    }
    
	$sql = "INSERT INTO ncu_civil (id, object_name, contractor_name, factory_name, flow_name, flow_context, report, payment,
            write_year, write_month, write_day,
            report_year, report_month, report_day,
            out_year, out_month, out_day,
            tester, report_name, del, printable)
			VALUES('$id','$object_name','$contractor_name','$factory_name','$flow_name','$flow_context','0','0',
            '$write_year','$write_month','$write_day',
            '0','0','0',
            '$out_year','$out_month','$out_day',
            '$tester','$report_name','0','0')";
	mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");
    
	// close connection
	mysql_close($link);
	
	// jump the page
	header("location:search.php#jump");
	exit();
?>
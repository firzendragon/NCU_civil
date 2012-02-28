<?
    $account     = $_COOKIE["account"];
    $oldpassword = $_POST["oldpassword"];
    $newpassword = $_POST["newpassword"];
    
    require('../database/appvars.php');
    
    $link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("NO CONNECT!!");
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db(DB_NAME) or die("OPEN FAILED!!");
    
    $sql = "SELECT * FROM ncu_civil_member WHERE name = '$account' and password = '$oldpassword'";
    $result = mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");
    $total = mysql_num_rows($result);
        
    if ($total!=0) {
        $sql = "UPDATE ncu_civil_member SET password = '$newpassword' WHERE name = '$account'";
        mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");
    }
    
    mysql_free_result($result);
    mysql_close($link);
    
    header("location:home.php");
    exit();
?>
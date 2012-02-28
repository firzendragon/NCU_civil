<?  
    if($_POST["checkpwd"]) {
        $name     = $_POST["account"];
        $password = $_POST["password"];
        require('../database/appvars.php');
        
        $link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("NO CONNECT!!");
        mysql_query("SET NAMES 'utf8'");
        mysql_select_db(DB_NAME) or die("OPEN FAILED!!");  
  
        $sql = "SELECT * FROM ncu_civil_member WHERE name = '$name' and password = '$password'";
        $result = mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");
        $total = mysql_num_rows($result);
        
        if ($total!=0) {
            $row  = mysql_fetch_assoc($result) or die("READ DATA FAILED");
            setcookie("pass","TRUE");
            setcookie("power",$row["power"]);
            setcookie("account",$name);
        }
        
       	mysql_free_result($result);
        mysql_close($link);
    }
    if($_POST["logout"]) {
        setcookie("pass","");
        setcookie("power","");
        setcookie("account","");
    }
    header("location:home.php");
    exit();
?>
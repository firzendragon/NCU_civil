<?
    if($_COOKIE["pass"] != "TRUE")
    {
        header("location:home.php");
        exit();
    }
    
	require('../database/appvars.php');
	
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("NO CONNECT!!");
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db(DB_NAME) or die("OPEN FAILED!!");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link href="../CSS/style.css" 	rel="stylesheet" type="text/css" />
<link href="../CSS/layout.css" 	rel="stylesheet" type="text/css" />
<link href="../CSS/menu.css" 	rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://jquery-ui.googlecode.com/svn/tags/latest/themes/base/jquery-ui.css" type="text/css" media="all" />
<link type="text/css"  href="jquery-ui-1.8.16.custom/css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
</head>

<!---------------------------------------- dialog -->
<script src="http://www.google.com/jsapi"></script>
<script>
    google.load("jquery", "1.4");
    google.load("jqueryui", "1.7");
</script>
<script type="text/javascript">
function logout(){
    $('#checkleave').css({display:'inline'});
    $("#checkleave").dialog('open');
    $("#checkleave").dialog({
        title: '<font size=3>登出系統:</font>',
        bgiframe: true,
        width: 280,
        height: 600,
        modal: true,
        draggable: true,
        resizable: false,
        buttons: {
            "是的": function() {
                $('#logoutForm').appendTo(jQuery("form:first"));
                $('#logoutForm').submit();
            },
            '不要': function() {
                $(this).dialog('close');
            }
        }
    });
}
function editPassword(){
    $('#editpwd').css({display:'inline'});
    $("#editpwd").dialog('open');
    $("#editpwd").dialog({
        title: '<font size=3>確認您的帳號/密碼:</font>',
        bgiframe: true,
        width: 400,
        height: 600,
        modal: true,
        draggable: true,
        resizable: false,
        buttons: {
            "更新": function() {
                $('#editpwdForm').appendTo(jQuery("form:first"));
                $('#editpwdForm').submit();
            },
            '返回': function() {
                $(this).dialog('close');
            }
        }
    });
}
</script>
<!------------------------login / logout -->
<div id="checkleave" style="display:none">
    <form action="log.php" method="post" name="logoutForm" id="logoutForm">
    <font size=3>
    <BR>&nbsp;確認登出?
    <input type=hidden name=logout value=1>
    </font>
    </form>
</div>
<div id="editpwd" style="display:none">
    <form action="passwd.php" method="post" name="editpwdForm" id="editpwdForm">
    <font size=3>
    <BR>&nbsp;帳號: &nbsp;&nbsp;&nbsp;<? echo $_COOKIE["account"]; ?>
    <BR>&nbsp;舊密碼: <input type="password" name="oldpassword">
    <BR>&nbsp;新密碼: <input type="password" name="newpassword"><BR>
    </font>
    </form>
</div>
<!------------------------login / logout end-->

<script language="javascript">
function contact_print()
{
    var newstr = document.getElementById('printpage').innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = newstr;
    window.print();
    document.body.innerHTML = oldstr;
    return false;
}
function download()
{
    
}
function clear_print() {
    if (confirm("確定清除表格?"))
        ClearForm.submit();
}
function openclose() {
    if(document.getElementById("rule").style.display=="none")
        document.getElementById("rule").style.display="";
    else
        document.getElementById("rule").style.display="none";
}
</script>

<body id="page4">
<div id="main">
	<div id="header">
		<div class="address">
			<a href="#">www.demolink.org</a>
		</div>
		<div class="logo">
			<h1><a href="home.php">NCU<br /> CIVIL</a></h1>
			<span>國立中央大學土木工程學系土木材料品保中心</span>
		</div>
        <!-- search -->
		<form action="query.php" method="post" id="search-form">
			<fieldset>
				<select name = "choice">
					<option value=1>關鍵字查詢</option>
					<option value=2>依編號查詢</option>
					<option value=3>依工程查詢</option>
					<option value=4>依廠商查詢</option>
					<option value=5>依年分查詢</option>
					<option value=6>依月份查詢</option>
				</select>
				<input type="text" name="keyword"　class="text" accesskey="/" style="width:250px;"
					placeholder="查詢" autocomplete="off" tabindex="" spellcheck="false" />
				<input type="submit" value="查詢" class="submit" style="width:40px;"/>
			</fieldset>
		</form>
	</div>
	<!-- content -->
	<div id="content">
		<div class="wrapper">
			<div class="aside">
				<ul class="nav">
					<li><a href="home.php">	首頁</a></li>
					<li><a href="ad.php">公告欄</a></li>
					<li><a href="#">     成員簡介</a></li>
					<li><a href="#">     試驗項目</a></li>
					<li><a href="#">     相關連結</a></li>
					<li><a href="#">     聯絡我們</a></li>
				</ul>
				<div class="box">
					<div class="inner">
						<ul class="list1">
							<li><a href="search.php">試驗查詢</a></li>
							<? if($_COOKIE["power"] != "0") { ?>
							<li><a href="new.php">   試驗新增</a></li>
                            <? } ?>
							<li><a href="print.php"> 試驗列印</a></li>
                            <? if($_COOKIE["power"] != "0") { ?>
							<li><a href="trash.php"> 回收桶</a></li>
                            <? } ?>
                            <li><a href="passwd.php" onclick="editPassword(); return false;">修改密碼</a></li>
							<li><a href="log.php" onclick="logout(); return false;">登出</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="mainContent">
				<div class="section">
					<a target="_blank" name="jump"></a>
					<h2>列印</h2>
					<P>
                    <div class="txt1" STYLE="Overflow:auto;" id="printpage">
                    <TABLE BORDER="1" WIDTH="1400" CELLSPACING="2">
                        <TR HEIGHT="30">
                            <TD><font size="2" color="Black" face="Verdana">收件編號</TD>
                            <TD><font size="2" color="Black" face="Verdana">工程名稱</TD>
                            <TD><font size="2" color="Black" face="Verdana">承包商</TD>
                            <TD><font size="2" color="Black" face="Verdana">委託單位</TD>
                            <TD><font size="2" color="Black" face="Verdana">試驗項目</TD>
                            <TD><font size="2" color="Black" face="Verdana">報告</TD>
                            <TD><font size="2" color="Black" face="Verdana">收件日期</TD>
                            <TD><font size="2" color="Black" face="Verdana">報告日期</TD>
                            <TD><font size="2" color="Black" face="Verdana">預出日期</TD>
                            <TD><font size="2" color="Black" face="Verdana">試驗者</TD>
                            <TD><font size="2" color="Black" face="Verdana">報告編號</TD>
                        </TR>
<?php
	$sql = "SELECT * FROM ncu_civil WHERE printable = '1' and del = '0' ORDER BY id DESC";
	$result = mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");

	// print data
	for ($i=1; $i <= mysql_num_rows($result); $i++)
    {
		$row = mysql_fetch_assoc($result) or die("READ DATA FAILED");

		echo "<TR HEIGHT='30'>";
		echo "<TD><font color='Black' size='2' face='Verdana'>" . $row["id"] . "</TD>";
		echo "<TD><font color='Black' size='2' face='Verdana'>" . $row["object_name"] . "</TD>";
        echo "<TD><font color='Black' size='2' face='Verdana'>" . $row["contractor_name"] . "</TD>";
		echo "<TD><font color='Black' size='2' face='Verdana'>" . $row["factory_name"] . "</TD>";
        
        // flow
        echo "<TD><font color='Black' size='2' face='Verdana'>" . $row["flow_name"] . "</TD>";

		// report
		if ($row["report"] == 0)		echo "<TD><font color='#807e83' size='2' face='Verdana'>X</TD>";
		else if ($row["report"] == 1)	echo "<TD><font color='#807e83' size='2' face='Verdana'>O</TD>";
		else if ($row["report"] == 2)	echo "<TD><font color='#807e83' size='2' face='Verdana'></TD>";
				
		// year and month
        echo "<TD><font color='Black' size='2' face='Verdana'>" . $row["write_year"] .  "/" . $row["write_month"] .  "/" . $row["write_day"] . "</TD>";
		echo "<TD><font color='Black' size='2' face='Verdana'>" . $row["report_year"] . "/" . $row["report_month"] . "/" . $row["report_day"] . "</TD>";
        echo "<TD><font color='Black' size='2' face='Verdana'>" . $row["out_year"] . 	"/" . $row["out_month"] .    "/" . $row["out_day"] . "</TD>";
        
        // tester
        echo "<TD><font color='Black' size='2' face='Verdana'>" . $row["tester"] ."</TD>";
        
        // report_name
        echo "<TD><font color='Black' size='2' face='Verdana'>" . $row["report_name"] ."</TD>";
        
		echo "</TR>";
	}
    mysql_free_result($result);
	mysql_close($link);
?>
	</TABLE>
    <br>
                </div>
                </div>
				<FORM  METHOD='post' ACTION='print_deal.php' NAME='ClearForm'>
				<div class="section">
					<h3>列印選擇</h3>
					<div id="tabs1">
						<ul>
							<li><a href="print.php#jump" onClick="contact_print()"><span>列印</span></a></li>
                            <li><a href="print.php#jump" onClick="download()"><span>下載</span></a></li>
							<li><a href="print.php#jump" onClick="clear_print()"><span>清除表格</span></a></li>
						</ul>
					</div>
				</div>
                <INPUT TYPE="hidden" name='choice' value='0'>
				</FORM>
                <h3 onclick="openclose();" style="cursor: pointer;">列印注意事項</h3>
				<div class="section" id=rule style="display:none">
					<p>列印時如若表格太大，以至於超出頁面，請選擇［橫向］或［橫式］列印。</p>
					<p>列印完成後請清除表格，以利編輯及刪除等工作。</p>
				</div>
			</div>
		</div>
    </div>
	
	<!-- footer -->
	<div id="footer">
		<div class="wrapper">
			<div class="fleft">NCU Civil &copy; 2011&nbsp; &nbsp; <a href="privacy.php">條款及隱私權</a></div>
			<div class="fright">
				<ul class="nav">
					<li><a href="home.php">首頁</a>|</li>
					<li><a href="ad.php">  公告欄</a>|</li>
					<li><a href="#">       成員簡介</a>|</li>
					<li><a href="#">       試驗項目</a>|</li>
					<li><a href="#">       相關連結</a>|</li>
					<li><a href="#">       聯絡我們</a></li>
				</ul>
				<div class="alignright">
				32001 桃園縣中壢市中大路 300 號土木工程學系土木材料品保中心<BR>
				電話：03 - 4227151 - 34081 ~ 34082<BR>
				傳真：03 - 4227183
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
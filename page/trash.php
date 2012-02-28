<?
    if($_COOKIE["pass"] != "TRUE" || $_COOKIE["power"] == "0")
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

<SCRIPT LANGUAGE="javascript">
function Restore_data() {
    if (confirm("確定還原?")) {
        document.TrashForm.choice.value = 1;
        TrashForm.submit();
    }
}
function Dump_data() {
    if (confirm("確定清除?")) {
        document.TrashForm.choice.value = 2;
        TrashForm.submit();
    }
}
function Restore_all_data() {
    if (confirm("確定全部還原?")) {
        document.TrashForm.choice.value = 3;
        TrashForm.submit();
    }
}
function Dump_all_data() {
    if (confirm("確定全部清除?")) {
        document.TrashForm.choice.value = 4;
        TrashForm.submit();
    }
}
function Reset_data() {
    TrashForm.reset();
}
function select_all(formName, elementName, selectAllName) {
    if(document.forms[formName].elements[selectAllName].checked)
        for(var i = 0; i < document.forms[formName].elements[elementName].length; i++)
            document.forms[formName].elements[elementName][i].checked = true;
    else
        for(var i = 0; i < document.forms[formName].elements[elementName].length; i++)
            document.forms[formName].elements[elementName][i].checked = false;
}
function openclose() {
    if(document.getElementById("rule").style.display=="none")
        document.getElementById("rule").style.display="";
    else
        document.getElementById("rule").style.display="none";
}
</SCRIPT>

<body id="page2">
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
				<!-- Trash -->
				<FORM ACTION="trash_deal.php" METHOD="post" NAME="TrashForm">
				<div class="section">
					<a target="_blank" name="jump"></a>
					<h2>資料回收桶</h2>
					<P>
					<div class="txt1" STYLE="Overflow:auto;">
						<TABLE BORDER="0" ALIGN="center" WIDTH="1400" CELLSPACING="2">
							<TR BGCOLOR="#807e83" HEIGHT="23" ALIGN="center">
                                <TD><font size="2" color="White">全選&nbsp
									<INPUT TYPE="CHECKBOX" NAME="selall" VALUE="" onClick="select_all('TrashForm', 'context_id[]', this.name);">
								</TD>
								<TD><font size="2" color="White">收件編號</TD>
								<TD><font size="2" color="White">工程名稱</TD>
                                <TD><font size="2" color="White">承包商</TD>
								<TD><font size="2" color="White">委託單位</TD>
                                <TD><font size="2" color="White">試驗項目</TD>
								<TD><font size="2" color="White">報告</TD>
                                <TD><font size="2" color="White">收件日期</TD>
                                <TD><font size="2" color="White">報告日期</TD>
								<TD><font size="2" color="White">預出日期</TD>
                                <TD><font size="2" color="White">試驗者</TD>
                                <TD><font size="2" color="White">報告編號</TD>
							</TR>
<?php
	$sql = "SELECT * FROM ncu_civil WHERE del = '1' ORDER BY id DESC";
	$result = mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");

	// print data
	for ($i=1; $i <= mysql_num_rows($result); $i++)
    {
		$row = mysql_fetch_assoc($result) or die("READ DATA FAILED");
        $context_id = $row['context_id'];
		
		echo "<TR BGCOLOR='White' HEIGHT='25' ALIGN='center'>";
        
        // check col
		echo "<TD>";
		echo "<input TYPE='checkbox' name='context_id[]' VALUE='$context_id'>";
		echo "</TD>";
		
        // basic info
		echo "<TD><font color='#807e83' size='2' face='Verdana'>" . $row["id"] . 			"</TD>";
		echo "<TD><font color='#807e83' size='2' face='Verdana'>" . $row["object_name"] . 	"</TD>";
        echo "<TD><font color='#807e83' size='2' face='Verdana'>" . $row["contractor_name"] . "</TD>";
		echo "<TD><font color='#807e83' size='2' face='Verdana'>" . $row["factory_name"] . 	"</TD>";
		
		// flow
        echo "<TD><font color='#807e83' size='2' face='Verdana'>" . $row["flow_name"] ."</TD>";

		// report
		if ($row["report"] == 0)		echo "<TD><font color='#807e83' size='2' face='Verdana'>X</TD>";
		else if ($row["report"] == 1)	echo "<TD><font color='#807e83' size='2' face='Verdana'>O</TD>";
		else if ($row["report"] == 2)	echo "<TD><font color='#807e83' size='2' face='Verdana'></TD>";
		
		// year and month
        echo "<TD><font color='#807e83' size='2' face='Verdana'>" . $row["write_year"] .  "/" . $row["write_month"] .  "/" . $row["write_day"] . "</TD>";
		echo "<TD><font color='#807e83' size='2' face='Verdana'>" . $row["report_year"] . "/" . $row["report_month"] . "/" . $row["report_day"] . "</TD>";
        echo "<TD><font color='#807e83' size='2' face='Verdana'>" . $row["out_year"] . 	  "/" . $row["out_month"] .    "/" . $row["out_day"] . "</TD>";
		
        // tester
        echo "<TD><font color='#807e83' size='2' face='Verdana'>" . $row["tester"] ."</TD>";
        
        // report_name
        echo "<TD><font color='#807e83' size='2' face='Verdana'>" . $row["report_name"] ."</TD>";
        
		echo "</TR>";
	}
    mysql_free_result($result);
	mysql_close($link);
?>
						</TABLE>
					</div>
				</div>
				<div class="section">
					<h3>確認送出？</h3>
					<div id="tabs1">
						<ul>
							<li><a href="trash.php#jump" onClick="Restore_data()"> 	<span>還原</span></a></li>
							<li><a href="trash.php#jump" onClick="Dump_data()">  	<span>清除</span></a></li>
							<li><a href="trash.php#jump" onClick="Reset_data()">	<span>重新勾選</span></a></li>
							<li><a href="trash.php#jump" onClick="Restore_all_data()">	<span>全部還原</span></a></li>
							<li><a href="trash.php#jump" onClick="Dump_all_data()"> 	<span>全部清除</span></a></li>
						</ul>
					</div>
					<INPUT TYPE="hidden" name='choice' value='0'>
				</div>
				</FORM>
                <h3 onclick="openclose();" style="cursor: pointer;">回收桶注意事項</h3>
				<div class="section" id=rule style="display:none">
                    <h4>您可以根據以下幾個規則對資料進行處理：</h4>
					<div class="wrapper p2">
                        <ul class="list2 p2">
                            <li>一次勾選數個欄位還原</li>
                            <li>一次勾選數個欄位清除</li>
                            <li>直接還原所有欄位</li>
                            <li>直接清除所有欄位</li>
                        </ul>
						<p>請注意：資料一但清除，便再無紀錄，必須新增資料才能返回。</p>
                    </div>
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
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
function openclose(){
    if(document.getElementById("rule").style.display=="none")
        document.getElementById("rule").style.display="";
    else
        document.getElementById("rule").style.display="none";
}
function openclose2(){
    if(document.getElementById("item").style.display=="none")
        document.getElementById("item").style.display="";
    else
        document.getElementById("item").style.display="none";
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
function check_data()
{
    answer = confirm("資料確定新增?");
    if (answer)
    {
        if (document.NewForm.id.value.length == 0)
        {
            alert("「收件編號」必須填寫！")
            return false;
        }
        if (document.NewForm.object_name.value.length == 0)
        {
            alert("「工程名稱」必須填寫！")
            return false;
        }
        if (document.NewForm.factory_name.value.length == 0)
        {
            alert("「委託單位」必須填寫！")
            return false;
        }
        NewForm.submit();
    }
}
function Reset_data()
{
    NewForm.reset();
    for (var j=0; j<NewForm.flow_name.length; j++)
    {
        document.getElementById('test'+j).style.display = 'none';
    }
}
function find_value()
{
    for (var i=0; i<NewForm.flow_name.length; i++)
    {
        if (NewForm.flow_name[i].checked)
        {
            for (var j=0; j<NewForm.flow_name.length; j++)
            {
                document.getElementById('test'+j).style.display = 'none';
            }
            document.getElementById('test'+i).style.display = '';
        }
    }
}
</SCRIPT>

<body id="page3">
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
					<li><a href="home.php">首頁</a></li>
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
				<!-- /.box -->
			</div>
			<div class="mainContent">
				<!-- New -->
				<FORM ACTION="new_deal.php" METHOD="post" NAME="NewForm">
				<div class="section">
					<a target="_blank" name="jump"></a>
					<h2>新增一筆資料？</h2>
					<P>
					<TABLE WIDTH="500" style="border:none; border-collapse:collapse;">
						<TR HEIGHT="23"><TD vAlign="top" WIDTH="100">收件編號</TD>
							<TD vAlign="top" colSpan="2"><input TYPE="text" name="id" style="height:15px;width:150px;"></TD>
						</TR>
						<TR HEIGHT="23"><TD vAlign="top" WIDTH="100">工程名稱</TD>
							<TD vAlign="top" colSpan="2"><input TYPE="text" name="object_name"  style="height:15px;width:250px;"></TD>
						</TR>
                        <TR HEIGHT="23"><TD vAlign="top" WIDTH="100">承包商</TD>
							<TD vAlign="top" colSpan="2"><input TYPE="text" name="contractor_name" style="height:15px;width:250px;"></TD>
						</TR>
						<TR HEIGHT="23"><TD vAlign="top" WIDTH="100">委託單位</TD>
							<TD vAlign="top" colSpan="2"><input TYPE="text" name="factory_name" style="height:15px;width:250px;"></TD>
						</TR>
						<TR><TD vAlign="top" WIDTH="100">流程</TD>
							<TD vAlign="top" colSpan="2">需要哪些項目?
							<P><P>
<?
	$sql = "SELECT * FROM ncu_civil_flow";
	$resultFlow = mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");
	$totalFlow = mysql_num_rows($resultFlow);
    
    echo "<div id='start' style='display:none;'></div>";
	for ($i=0; $i<$totalFlow; $i++)
	{
		$rowFlow = mysql_fetch_assoc($resultFlow) or die("READ DATA FAILED");
        echo "<input TYPE='radio' name='flow_name' VALUE=" . $rowFlow["flow_name"] . " onclick='find_value();'><label> " . $rowFlow["flow_name"] . "</label><BR>";
        
        // SQL
        $flowName = $rowFlow["flow_name"];
        $sql = "SELECT * FROM ncu_civil_detail where flow_name = '$flowName'";
        $resultDetail = mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");
        $totalDetail = mysql_num_rows($resultDetail);
    
        echo "<div id='test$i' style='display:none;'>";
        for($j=1; $j<=$totalDetail; $j++)
        {
            $rowDetail = mysql_fetch_assoc($resultDetail) or die("READ DATA FAILED");
            if($rowFlow["context_id"] == 4) {
                echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                echo "<input TYPE='text' name='flow_context[]' style='height:15px; width:300px;'>";
            }
            else {
                echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                echo "<input TYPE='button' value=▼ onclick='NewForm.flow_context[0].value=0;'>";
                echo "<input TYPE='text' name='flow_context[]' VALUE='0' style='height:15px; width:40px;'>";
                echo "<input TYPE='button' value=▲ onclick='NewForm.flow_context[0].value=1;'>";
                echo "<label> " . $rowDetail["flow_type"] . "</label><BR>";
            }
        }
        echo "</div>";
	}
    echo "<div id='end' style='display:none;'></div><BR>";
?>
							</TD>
						</TR>
						<TR><TD vAlign="top" height="22" WIDTH="100">收件日期</TD>
							<TD vAlign="top" colSpan="2">
							<select name="write_year" style="height:20px; width:80px;">
<?
	echo "<option value=''>年</option>";
	for ($i=date("Y")-1; $i<=date("Y")+5; $i++)
		echo "<option value='$i'>".$i."</option>";
?>
							</select>
							<select name="write_month" style="height:20px; width:80px;">
<?
	echo "<option value=''>月</option>";
	for ($i=1; $i<=12; $i++)
		echo "<option value='$i'>".$i."</option>";
?>
							</select>
                            <select name="write_day" style="height:20px; width:80px;">
<?
	echo "<option value=''>日</option>";
	for ($i=1; $i<=31; $i++)
		echo "<option value='$i'>".$i."</option>";
?>
							</select>
							</TD>
						</TR>
                        <TR><TD vAlign="top" height="22" WIDTH="100">預出日期</TD>
							<TD vAlign="top" colSpan="2">
							<select name="out_year" style="height:20px; width:80px;">
<?
	echo "<option value=''>年</option>";
	for ($i=date("Y")-1; $i<=date("Y")+5; $i++)
		echo "<option value='$i'>".$i."</option>";
?>
							</select>
							<select name="out_month" style="height:20px; width:80px;">
<?
	echo "<option value=''>月</option>";
	for ($i=1; $i<=12; $i++)
		echo "<option value='$i'>".$i."</option>";
?>
							</select>
                            <select name="out_day" style="height:20px; width:80px;">
<?
	echo "<option value=''>日</option>";
	for ($i=1; $i<=31; $i++)
		echo "<option value='$i'>".$i."</option>";
?>
							</select>
							</TD>
						</TR>
                        <TR HEIGHT="23"><TD vAlign="top" WIDTH="100">試驗者</TD>
							<TD vAlign="top" colSpan="2"><input TYPE="text" name="tester" maxlength="40" style="height:15px;width:150px;"></TD>
						</TR>
                        <TR HEIGHT="23"><TD vAlign="top" WIDTH="100">報告編號</TD>
							<TD vAlign="top" colSpan="2"><input TYPE="text" name="report_name" maxlength="40" style="height:15px;width:150px;"></TD>
						</TR>
					</TABLE>
<?php
	mysql_free_result($resultFlow);
	mysql_close($link);
?>
				</div>
				<div class="section">
					<h3>確認送出？</h3>
					<div id="tabs1">
						<ul>
							<li><a href="#" onClick="check_data()"><span>送出</span></a></li>
							<li><a href="new.php#jump" onClick="Reset_data()"><span>重寫</span></a></li>
						</ul>
					</div>
				</div>
				</FORM>
                <h3 onclick="openclose();" style="cursor: pointer;">新增注意事項</h3>
				<div class="section" id=rule style="display:none">
					<h4>新增資料時請注意以下幾個規則，否則資料不符格式將無法新增：</h4>
					<div class="wrapper p2">
						<ul class="list3 p2">
							<li><span>收件編號</span>   長度不能超過20字元，ex: 11080801</li> 
							<li><span>工程名稱</span>	長度不能超過200字元，且中間不得存在空白。如有需求，請以底線取代，ex: Sensor_Shield</li> 
							<li><span>委託單位</span>	長度不能超過200字元，且中間不得存在空白。如有需求，請以底線取代，ex: Arduino_UNO</li>
							<li><span>流程</span>		勾選完需要的項目，並新增完成後，便只能編輯是否完成該流程，請謹慎選擇。如勾選錯誤，請刪除資料後重新輸入</li>
						</ul>
						<p>如需新增工程，請聯絡資料庫負責人或網頁開發者。</p>
					</div>
				</div>
				<h3 onclick="openclose2();" style="cursor: pointer;">項目介紹</h3>
                <div class="section" id=item style="display:none">
                    <div class="wrapper p2">
                        <ul class="list3 p2">
                            <li><span>收件編號</span>		- Adipiscing elit sed diam</li>
                            <li><span>工程名稱</span> 		- Lorem set sed diam</li>
                            <li><span>委託單位</span>		- Adipiscing elit sed diam feugiat nulla.</li>
                            <li><span>試驗項目</span>		- Afeugiat nulla facilisis at diam feugiat nulla.</li>
                            <li><span>試驗細節</span>		- Lorem set sed diam</li>
                            <li><span>收件日期</span>	    - Lorem set sed diam</li>
                            <li><span>報告日期</span>		- Lorem set sed diam</li>
                            <li><span>預出日期</span>		- Lorem set sed diam</li>
                        </ul>
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
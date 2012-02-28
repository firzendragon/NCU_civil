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
</script>
<!------------------------login / logout -->
<div id="checkleave" style="display:none">
    <form action="log.php" method="post" name="logoutForm" id="logoutForm">
    <font size=3>
    &nbsp;確認登出?
    <input type=hidden name=logout value=1>
    </font>
    </form>
</div>
<!------------------------login / logout end-->

<SCRIPT LANGUAGE="javascript">
function Print_data()
{
    document.SearchForm.choice.value = 1;
    SearchForm.submit();
}
function Edit_data()
{
    document.SearchForm.choice.value = 2;
    SearchForm.submit();
}
function Delete_data()
{
    document.SearchForm.choice.value = 3;
    SearchForm.submit();
}
function Reset_data()
{
    SearchForm.reset();
}
function select_all(formName, elementName, selectAllName)
{
    if(document.forms[formName].elements[selectAllName].checked)
        for(var i = 0; i < document.forms[formName].elements[elementName].length; i++)
            document.forms[formName].elements[elementName][i].checked = true;
    else
        for(var i = 0; i < document.forms[formName].elements[elementName].length; i++)
            document.forms[formName].elements[elementName][i].checked = false;
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
                            <li><a href="passwd.php">修改密碼</a></li>
							<li><a href="log.php" onclick="logout(); return false;">登出</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="mainContent">
<?
//--------------------start
function AptPg($AptPg_AllList, $AptPg_OnePgNum, $AptPg_NowPg, $AptPg_Href, $AptPg_BewVal="")
{
	require('../database/appvars.php');
	
	// open connection
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("NO CONNECT!!");
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db(DB_NAME) or die("OPEN FAILED!!");

	//如果不是第一次進入頁面，則網址應該會有目前在第幾頁的參數值
	if(!empty($_GET[AptPg_NowPg]))
	{
		//將$_GET[AptPg_NowPg]的值取代預設的「$AptPg_NowPg = 1」
		$AptPg_NowPg = $_GET[AptPg_NowPg];
	}

	/*===========先算出總共要分多少頁===============*/
	$Count=$AptPg_AllList/$AptPg_OnePgNum;
	$AptPg_AllPg=ceil($Count); //無條件進位
?>
				<!-- Search -->
				<FORM ACTION="search_deal.php" METHOD="post" NAME="SearchForm">
				<div class="section">
					<a target="_blank" name="jump"></a>
					<h2>您想查詢什麼？</h2>
                    <a href="search.php" style="text-decoration:none"><font color="black">品質</a>
                    <a href="technique.php" style="text-decoration:none"><font color="gray">技術</a>
					<P>
					<div class="txt1" STYLE="Overflow:auto;">
						<TABLE BORDER="1" WIDTH="1600" CELLSPACING="2">
							<TR BGCOLOR="#807e83" HEIGHT="23" ALIGN="center">
                                <TD><font size="2" color="White">全選&nbsp
									<INPUT TYPE="CHECKBOX" NAME="selall" VALUE="" onClick="select_all('SearchForm', 'context_id[]', this.name);">
								</TD>
								<TD><font size="2" color="White">收件編號</TD>
								<TD width="500"><font size="2" color="White">工程名稱</TD>
                                <TD><font size="2" color="White">承包商</TD>
                                <TD><font size="2" color="White">收件日期</TD>
                                <TD><font size="2" color="White">預出日期</TD>
                                <TD><font size="2" color="White">試驗</TD>
								<TD><font size="2" color="White">高度</TD>
                                <TD><font size="2" color="White">壓實度</TD>
                                <TD><font size="2" color="White">含油篩</TD>
								<TD><font size="2" color="White">含油量</TD>
                                <TD><font size="2" color="White">篩分析</TD>
                                <TD><font size="2" color="White">單位重</TD>
                                <TD><font size="2" color="White">黏滯度</TD>
                                <TD><font size="2" color="White">針入度</TD>
                                <TD><font size="2" color="White">穩流值</TD>
                                <TD><font size="2" color="White">配合設計</TD>
                                <TD><font size="2" color="White">特殊試驗</TD>
							</TR>
<?php
	// SQL
	$index = ($AptPg_NowPg-1) * $AptPg_OnePgNum;
	$num   = $AptPg_OnePgNum;
	$sql = "SELECT * FROM ncu_civil WHERE del = '0' ORDER BY id DESC LIMIT $index, $num";
	$result = mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");

	// print data
	for ($i=1; $i <= mysql_num_rows($result); $i++)
    {
		$row = mysql_fetch_assoc($result) or die("READ DATA FAILED");
        $context_id = $row['context_id'];
        
		echo "<TR BGCOLOR='White' HEIGHT='25' ALIGN='left'>";
        
		// check col
		echo "<TD ALIGN='center'>";
		if($row["printable"] == '0')
		{
			echo "<input TYPE='checkbox' name='context_id[]' VALUE='$context_id'>";
		}
		echo "</TD>";
        
        // basic info
		echo "<TD><font color='#807e83' size='2' face='Verdana'>" . $row["id"] . 			"</TD>";
		echo "<TD><font color='#807e83' size='2' face='Verdana'>" . $row["object_name"] . 	"</TD>";
        echo "<TD><font color='#807e83' size='2' face='Verdana'>" . $row["contractor_name"] . 	"</TD>";
        
        // date
        if($row["write_year"]==0 || $row["write_month"]==0 || $row["write_day"]==0)
            echo "<TD><font color='#807e83' size='2' face='Verdana'></TD>";
        else
            echo "<TD><font color='#807e83' size='2' face='Verdana'>" . $row["write_year"] .  "/" . $row["write_month"] .  "/" . $row["write_day"] . "</TD>";
        
        if($row["out_year"]==0 || $row["out_month"]==0 || $row["out_day"]==0)
            echo "<TD><font color='#807e83' size='2' face='Verdana'></TD>";
        else
            echo "<TD><font color='#807e83' size='2' face='Verdana'>" . $row["out_year"] . 	  "/" . $row["out_month"] .    "/" . $row["out_day"] . "</TD>";
        
        // flow
        echo "<TD><font color='#807e83' size='2' face='Verdana'>" . $row["flow_name"] ."</TD>";
        
        if($row["flow_name"]=='瀝青試驗(I)') {
            $flow_context = explode(",",$row["flow_context"]);
            for($j=0;$j<9;$j++) {
                if($flow_context[$j]!=0)
                    echo "<TD ALIGN='center'><font color='#807e83' size='2' face='Verdana'>" . $flow_context[$j] ."</TD>";
                else
                    echo "<TD ALIGN='center'><font color='#807e83' size='2' face='Verdana'></TD>";
            }
            for($j=9;$j<11;$j++)
                echo "<TD ALIGN='center'><font color='#807e83' size='2' face='Verdana'></TD>";
        }
        else if($row["flow_name"]=='瀝青試驗(II)') {
            $flow_context = explode(",",$row["flow_context"]);
            for($j=0;$j<9;$j++) {
                echo "<TD ALIGN='center'><font color='#807e83' size='2' face='Verdana'></TD>";
            }
            $flow_context_temp1 = $flow_context[0]+$flow_context[1];
            if($flow_context_temp1!=0)
                echo "<TD ALIGN='center'><font color='#807e83' size='2' face='Verdana'>" . $flow_context_temp1 ."</TD>";
            else
                echo "<TD ALIGN='center'><font color='#807e83' size='2' face='Verdana'></TD>";
                
            $flow_context_temp2 = $flow_context[2]+$flow_context[3]+$flow_context[4]+$flow_context[5]+$flow_context[6]+$flow_context[7];
            if($flow_context_temp2!=0)
                echo "<TD ALIGN='center'><font color='#807e83' size='2' face='Verdana'>" . $flow_context_temp2 ."</TD>";
            else
                echo "<TD ALIGN='center'><font color='#807e83' size='2' face='Verdana'></TD>";
        }
        else if($row["flow_name"]=='其他零星試驗') {
            for($j=0;$j<10;$j++) {
                echo "<TD ALIGN='center'><font color='#807e83' size='2' face='Verdana'></TD>";
            }
            echo "<TD ALIGN='center'><font color='#807e83' size='2' face='Verdana'>1</TD>";
        }
        else {
            for($j=0;$j<11;$j++)
                echo "<TD ALIGN='center'><font color='#807e83' size='2' face='Verdana'></TD>";
        }
        
        
		echo "</TR>";
	}
?>
						<TR>
<?
	// 顯示各頁的數字
	for($a=1; $a <= $AptPg_AllPg; $a++)
	{
		// 當總頁數只有一頁時不顯示
		if($AptPg_AllPg==1) 
		{
			continue;
		}
		elseif($AptPg_AllPg!=1)
		{
			// 如果現在的頁數不等於該數字，則顯示連結
			if($a != $AptPg_NowPg)
			{
				echo "&nbsp";
				echo "<a href=" . $AptPg_Href . "?AptPg_NowPg=" . $a . "&AptPg_OnePgNum=" . $AptPg_OnePgNum. ">";
				echo "<font face='Verdana'>". $a ."</font>";
				echo "</a>";
				echo "&nbsp";
			}
			elseif($a == $AptPg_NowPg)
			{
				echo"&nbsp;<font face='Verdana'>". $a ."</font>&nbsp";
			}
		}
	}
?>
						</TR>
						</TABLE>
					</div>
				</div>
				<div class="section">
					<h3>確認送出？</h3>
					<div id="tabs1">
						<ul>
							<li><a href="technique.php#jump" onClick="Print_data()"> <span>加入列印</span></a></li>
                            <? if($_COOKIE["power"] != "0") { ?>
							<li><a href="technique.php#jump" onClick="Edit_data()">  <span>編輯資料</span></a></li>
							<li><a href="technique.php#jump" onClick="Delete_data()"><span>刪除資料</span></a></li>
                            <? } ?>
							<li><a href="technique.php#jump" onClick="Reset_data()"> <span>重新勾選</span></a></li>
						</ul>
					</div>
					<INPUT TYPE="hidden" name='choice' value='0'>
				</div>
				</FORM>
				<!-- / Search -->
<?
}
//---------------------------------End
	// SQL
	$sql = "SELECT * FROM ncu_civil WHERE del = '0' ORDER BY id DESC";
	$result = mysql_query($sql, $link) or die("EXECUTE SQL FAILED!!");

	//-------------------------------- 分頁開始
	$AptPg_AllList  = mysql_num_rows($result);	// 總筆數
	$AptPg_OnePgNum = 30;						// 每頁要顯示幾筆資料
	$AptPg_NowPg    = 1;						// 起始在第幾頁
	$AptPg_Href     = "";						// 網址
	
	AptPg($AptPg_AllList, $AptPg_OnePgNum, $AptPg_NowPg, $AptPg_Href, $AptPg_BewVal);
	//-------------------------------- 分頁結束

	mysql_free_result($result);
	mysql_close($link);
?>
				
                <h3 onclick="openclose();" style="cursor: pointer;">查詢注意事項</h3>
                <div class="section" id=rule style="display:none">
                    <h4>您可以根據以下幾個規則對資料進行處理：</h4>
                    <div class="wrapper p2">
                        <ul class="list2 p2">
                            <li>一次勾選數個欄位加入列印</li> 
                            <li>一次勾選一個欄位編輯資料</li> 
                            <li>一次勾選數個欄位刪除資料</li>
                        </ul>
                        <p>請注意：當不能勾選的時候，代表該資料處於待列印狀態。如要編輯或刪除，必須先至 <a href="print.php#jump">列印</a> 頁面清除列印表格。</p>
                    </div>
                </div>
                <h3 onclick="openclose2();" style="cursor: pointer;">查詢服務說明</h3>
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
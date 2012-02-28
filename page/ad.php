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
function checkPassword(){
    $('#checkpwd').css({display:'inline'});
    $("#checkpwd").dialog('open');
    $("#checkpwd").dialog({
        title: '<font size=3>確認您的帳號/密碼:</font>',
        bgiframe: true,
        width: 280,
        height: 600,
        modal: true,
        draggable: true,
        resizable: false,
        buttons: {
            "登入": function() {
                $('#pwdForm').appendTo(jQuery("form:first"));
                $('#pwdForm').submit();
            },
            '返回': function() {
                $(this).dialog('close');
            }
        }
    });
}
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
                $('#logoutForm').appendTo(jQuery("form:first"));
                $('#logoutForm').submit();
            },
            '返回': function() {
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
<div id="checkpwd" style="display:none; font-size:15px;">
    <form action="log.php" method="post" name="pwdForm" id="pwdForm">
    <BR>&nbsp;帳號 : <input type="text"     name="account"  style="width:200px; height:17px;">
    <BR>&nbsp;密碼 : <input type="password" name="password" style="width:200px; height:17px;">
    <input type=hidden name=checkpwd value=1>
    </form>
</div>
<div id="checkleave" style="display:none">
    <form action="log.php" method="post" name="logoutForm" id="logoutForm">
    <font size=3>
    &nbsp;確認登出?
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

<body id="page5">
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
        <? if($_COOKIE["pass"] == "TRUE") {?>
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
        <? } ?>
	</div>
	<!-- content -->
	<div id="content">
		<div class="wrapper">
			<div class="aside">
				<ul class="nav">
					<li><a href="home.php">	首頁</a></li>
					<li><a href="ad.php" class="current">公告欄</a></li>
					<li><a href="#">     成員簡介</a></li>
					<li><a href="#">     試驗項目</a></li>
					<li><a href="#">     相關連結</a></li>
					<li><a href="#">     聯絡我們</a></li>
				</ul>
				<div class="box">
					<div class="inner">
						<ul class="list1">
							<? if($_COOKIE["pass"] != "TRUE") { ?>
							<li><a href="log.php" onclick="checkPassword(); return false;"> 管理人登入</a></li>
                            <? } else { ?>
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
                            <? } ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="mainContent">
				<div class="section">
					<a target="_blank" name="jump"></a>
					<h2 class="outdent">公告欄</h2>
					<P>
					<div class="wrapper">
						<img src="../images/map.gif" alt="" class="img-indent" />
						<dl class="address">
							<dt>The Company Name Inc.<br />
								8901 Marmora Road,<br />
								Glasgow, D04 89GR.</dt>
							<dd><span>Telephone:</span>+1 959 603 6035</dd>
							<dd><span>FAX:</span>+1 101 889 9898</dd>
							<dd class="alt">E-mail: <a href="#">mail@demolink.org</a></dd>
						</dl>
						<dl class="address last">
							<dt>The Company Name Inc.<br />
							8901 Marmora Road,<br />
							Glasgow, D04 89GR.</dt>
							<dd><span>Telephone:</span>+1 959 603 6035</dd>
							<dd><span>FAX:</span>+1 101 889 9898</dd>
							<dd class="alt">E-mail: <a href="#">mail@demolink.org</a></dd>
						</dl>
					</div>
				</div>
				<div class="section">
					<h3>公告列表</h3>
					<div class="wrapper">
						<div class="col-1">
							<h6>Argentina</h6>
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. Phasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et</p>
							<h6>Denmark</h6> 
							<p>Morbi nunc odio, gravida at, cursus nec, luctus a, lorem. Maecenas tristique orci ac sem. Duis ultricies pharetra magna. Donec accumsan malesuada orci.</p>
							<h6>Finland</h6> 
							<p>Quisque nulla. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.</p> 
							<h6>France</h6> 
							<p>Ut pharetra augue nec augue. Nam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem.</p>
						</div>
					</div>
				</div>
				<div class="section">
					<h3>張貼您的公告？</h3>
					<h4>Cras at nisi odio. Nunc id neque sit amet tortor cursus lacinia. Curabitur lacus erat, blandit porta rhoncus in, tempor ut nisl. </h4>
					<p>Proin tellus mauris, posuere eu imperdiet sit amet, tristique vitae sapien. Vestibulum bibendum enim scelerisque turpis sollicitudin vitae lobortis purus rhoncus. Sed venenatis augue euismod nunc viverra venenatis. </p>
					<form action="" id="contacts-form">
						<fieldset>
							<div class="col-1">
								<label>Name:<br /><input type="text" value=""/></label>
								<label>E-mail:<br /><input type="text" value=""/></label>
								<label>Fax:<br /><input type="text" value=""/></label>
							</div>
							<div class="col-2">Message:<br /><textarea cols="" rows=""></textarea>
								<div class="alignright"><a href="#" onclick="document.getElementById('contacts-form').reset()" class="link1">clear</a>&nbsp; &nbsp; &nbsp; <a href="#" onclick="document.getElementById('contacts-form').submit()" class="link1">submit</a></div>
							</div>
						</fieldset>
					</form>
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
					<li><a href="home.php">	首頁</a>|</li>
					<li><a href="ad.php" class="current">公告欄</a>|</li>
					<li><a href="#">     成員簡介</a>|</li>
					<li><a href="#">     試驗項目</a>|</li>
					<li><a href="#">     相關連結</a>|</li>
					<li><a href="#">     聯絡我們</a></li>
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
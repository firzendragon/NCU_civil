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

<body id="page1">
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
	
	<div id="content">
		<div class="wrapper">
			<div class="aside">
				<ul class="nav">
					<li><a href="home.php" class="current">	首頁</a></li>
					<li><a href="ad.php">公告欄</a></li>
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
				<h2>歡迎來到國立中央大學土木材料品保中心工程查詢系統</h2>
				<p>
				<div class="txt1">您可以在這裡編輯眾多工程，上傳您的統計與分析，以及設計能讓廠商看見的資訊。</div>
				<div class="line-hor"></div>
                <!-- image -->
				<div class="banner" style="display:inline;">
                    <table>
                    <tr>
                    <td rowspan="2">
                        <img src="../images/banner.jpg" alt="" />&nbsp;
                    </td>
                    <td>
                        <img src="../images/banner2.jpg" alt="" />
                        <img src="../images/banner3.jpg" alt="" />
                    </td>
                    <tr><td>
                        <img src="../images/banner4.jpg" alt="" />
                        <img src="../images/banner5.jpg" alt="" />
                    </td></tr>
                    </table>
                    <br>
				</div>
				<div class="wrapper">
					<div class="col-1">
						<h3>想加入我們的團隊嗎？</h3>
						<h4>　　工程材料在土木工程相關學域中是一個歷史悠久的傳統領域，但長久以來它所包含的內容已經歷了許多的轉變。傳統的工程結構皆以安全性為最主要考量，且結構材料除了鋼筋混凝土以外，幾無其他選擇，因此粗大厚重的強壯結構物隨處可見，造就了土木工程師既土又木的呆板印象。事實上，目前工程設計的觀念，除了安全考量外，越來越重視工程系統的功能性:服務性、耐久性及經濟性，因此所採用工程材料的來源趨於多元化，形式趨於多樣化、精緻化，而製作的方式則趨向於規格化、模組化。因應這樣的需求，近年來工程材料相關領域的發展相當蓬勃而快速。以最常用的水泥混凝土為例，飛灰水泥;爐石水泥、聚合物及活化粉等相繼引進混凝土配比中，附加劑、纖維等的使用也日漸普遍，而配比技術的演進也造就了高強度混凝土、高性能混凝土、自充填混凝土、聚合物混凝土等的急速發展。這些，都顯示了工程材料有關領域的轉變，為因應工程界的需求，在工程材料的研究發展工作就愈發顯得重要。</h4>
						<p>
						<h4>　　再者，世界各國目前普遍面臨資源與能源的逐漸匱乏，兩地球村 「永續發展」的理念亦逐漸受到重視。對於天然資源的開發與使用，一方面必須以謹慎的態度來使有限的資源獲得最大的效能；另一方面，則不再將已利用之資源或材料視為廢棄物，而同時強化資源再生永續利用的觀念。由於自然資源瀕於枯竭，尋求替代材料應用於土木工程的趨勢愈趨迫切，於是利用大量海砂、飛灰、底灰、爐石及其他 工業副產品等邊緣材料於工程建設中，也成為目前的一個重要趨勢。而建築廢棄物、拆除混凝土、路面刨除料等過去視為營建廢棄物的東西，現在也從資源再生的觀念切入，成為工程材料研究發展的熱門課題。</h4>
						<p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>
						<ul class="list2 p2">
							<li><a href="#">Lorem ipsum dolor sit amet, consectetuer</a></li> 
							<li><a href="#">Adipiscing elit, sed diam nonummy</a></li> 
							<li><a href="#">Nibh euismod tincidunt ut laoreet dolore</a></li>
						</ul>
						<p>Dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea comm.</p>
						<a href="#" class="link1">繼續閱讀</a>
					</div>
					<div class="col-2">
						<h3 class="alt">最新公告</h3>
						<ul class="list3">
							<li><span>July 18, 2010</span>   - Adipiscing elit sed diam</li>
							<li><span>July 18, 2010</span>   - Lorem set sed diam</li>
							<li><span>July 18, 2010</span>   - Adipiscing elit sed diam feugiat nulla.</li>
							<li><span>July 18, 2010</span>   - Afeugiat nulla facilisis at diam feugiat nulla.</li>
							<li><span>July 18, 2010</span>   - Lorem set sed diam</li>
						</ul>
						<p><a href="ad.php#jump" class="link1">所有公告</a></p>
						<form action="" id="newsletter-form">
							<fieldset>
								<h4>立即申辦電子報！</h4>
								<input type="text" name="mail" class="text" accesskey="/" style="width:250px;"
									placeholder="在此輸入您的信箱:" autocomplete="off" tabindex="" spellcheck="false" />
								<input type="submit" value="確定" class="submit" style="width:40px;" />
							</fieldset>
						</form>
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
					<li><a href="home.php" class="current">	首頁</a>|</li>
					<li><a href="ad.php">公告欄</a>|</li>
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
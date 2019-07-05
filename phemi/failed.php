<?
require "../admin/conn";
if (!isset($_SESSION["phemi"])) {header("location:index.php");}
$userid=$_SESSION["phemi"];
if (ro(mysql_query("select * from users where userid='$userid' and status=0"))!=0) {unset($_SESSION["phemi"]);red("phemi/index.php?notactive");}
$a=mysql_query("select * from users where userid='$userid'");
$email=re($a,0,'email');
$name=re($a,0,'name');
$id=re($a,0,'id');
$upassword=re($a,0,'password');
$b=mysql_query("select * from sent where owner='$userid'");
$c=mysql_query("select * from failed where owner='$userid' order by id desc");
$usent=ro($b);
$ufailed=ro($c);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="../style.css">
<title>failed emails - user control panel - phemi (TM) - php e-mailer interface</title>
<script>
function doupload(dest) {
document.getElementById("frm").src="browse.php?dest="+dest;
document.getElementById("bx").style.top=(document.body.clientHeight/3);
document.getElementById("bx").style.left=(document.body.clientWidth/2)-200;
document.getElementById("bx").style.display="block";
}
</script>
</head>
<body>
<div id="bx" style="display:none;border:1px solid black;width:400px;height:110px;position:absolute;background:#666666;padding:5px; left:389px; top:73px">
<iframe src="browse.php" id="frm" style="width:100%;height:100%;border:0px;background:white" scrolling="no"></iframe>
</div>
<?=logo();?>
<div align="center">
<?
if ($_POST) {
}
else if ($_GET) {
if (isset($_GET['delete'])) {
$del=ge("delete");
if (mysql_query("delete from failed where id='$del'")) {$done=1;}
else {$done=0;}
}
}
$ufailed=ro(mysql_query("select * from failed where owner='$userid' order by id desc"));
?>
<p><a href="home.php">home</a> | <a href="sent.php">sent (<?=$usent;?>)</a> | 
<font color="#666666"><b>failed (<?=$ufailed;?>)</b></font> | 
<a href="options.php">options</a> | 
<a href="index.php?logout">logout</a></p>
<?
if (isset($_GET['id'])) {
$id=ge("id");
$a=mysql_query("select * from failed where id='$id'");
$email=re($a,0,'to');
$name=re($a,0,'name');
$to=re($a,0,'to');
$subject=re($a,0,'subject');
$message=re($a,0,'body');
?>
<table border="1" width="500" id="table3" cellpadding="0" style="border-collapse: collapse">
<tr class="header">
<td width="50%" valign="top">resend email</td>
</tr>
<tr>
<td width="50%" valign="top">
<form method="POST" action="home.php" id="form" enctype="multipart/form-data">
<table border="0" width="100%" id="table4" cellpadding="0" cellspacing="0">
<tr>
<td width="18%" align="right">from email:</td>
<td width="79%"><input type="text" name="fromemail" size="35" value="<?=$email;?>" class="input"></td>
</tr>
<tr>
<td width="18%" align="right">from name:</td>
<td width="79%">
<input type="text" name="fromname" size="35" value="<?=$name;?>" class="input"></td>
</tr>
<tr>
<td width="18%">
<p align="right">to:</td>
<td width="79%"><input type="text" name="to" size="70" class="input" value="<?=$to;?>"><br>
<a href="javascript:doupload('to');" style="font-size:7pt">insert addresses from notepad</a></td>
</tr>
<tr>
<td width="18%">
<p align="right">subject:</td>
<td width="79%">
<input type="text" value="<?=$subject;?>" name="subject" size="35" class="input"></td>
</tr>
<tr>
<td colspan="2">
<textarea rows="12" name="message" cols="93" class="input" contenteditable><?=$message;?></textarea></td>
</tr>
<tr>
<td width="18%">&nbsp;</td>
<td width="79%">
<input type="submit" value="resend email" name="submit" class="button">
<input type="reset" value="cancel" name="submit" class="button" onclick="top.location='failed.php'"></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
<?
}

if (isset($done)) {
if ($done==1) {echo "<p>email deleted!</p>";}
else if ($done==0) {echo "<p><div style='color:red;font-weight:bold'>server error! unable to delete email! please try again much later!</div></p>";}
}
if (!$_POST && !isset($_GET['id'])) {
?>
<table border="1" width="500" id="table3" cellpadding="0" style="border-collapse: collapse">
<tr class="header">
<td width="50%" valign="top">failed emails</td>
</tr>
<tr>
<td width="50%" valign="top">
<form method="POST" action="options.php">
<table border="0" width="100%" id="table4" cellpadding="0" cellspacing="0">
<tr><td width="17">&nbsp;</td><td width="25">&nbsp;</td><td width="151"><u>
subject</u></td><td><u>number of emails</u></td></tr>
<?
for ($i=1;$i<=$ufailed;$i++) {
$subject=re($c,$i-1,'subject');
$id=re($c,$i-1,'id');
$to=re($c,$i-1,'to');
$recp=count(split(",",$to));
echo "<td>".($ufailed-$i+1)."</td><td><a href='failed.php?delete=$id' onclick=\"if (!confirm('are you sure you want to delete this email?')) {return false}\"><img src='../admin/images/delete.gif' border='0' title='delete this email' /></a></td><td><a href='failed.php?id=$id'>$subject</a></td><td>$recp</td></tr>";
}

?>
</table>
</form>
</td>
</tr>
</table>
<?
}
?>
</div>

</body>
</html>
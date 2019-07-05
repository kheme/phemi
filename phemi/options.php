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
$c=mysql_query("select * from failed where owner='$userid'");
$usent=ro($b);
$ufailed=ro($c);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="../style.css">
<title>options - user control panel - phemi (TM) - php e-mailer interface</title>
</head>
<body>
<?=logo();?>
<div align="center">
<p><a href="home.php">home</a> | <a href="sent.php">sent (<?=$usent;?>)</a> | 
<a href="failed.php">failed (<?=$ufailed;?>)</a> | <font color="#666666"><b>
options</b></font> | 
<a href="index.php?logout">logout</a></p>
<?
if ($_POST) {
$email=po("email");
$name=po("name");
$userid=po("userid");
$password=po("password");
$password0=po("password0");
$password1=po("password1");

if ($upassword!=$password) {echo "<p><div style='color:red;font-weight:bold'>sorry, you have entered an incorrect password.<br />to change your details, you must enter your current password correctly!</div></p>";}
else if($password0!=$password1) {echo "<p><div style='color:red;font-weight:bold'>sorry, your passwords do not match! please confirm your password by entering it again correctly!</div></p>";}
else {
if (mysql_query("update users set `userid`='$userid',`email`='$email',`name`='$name' where `id`='$id'")) {
if ($password1!="") {mysql_query("update users set `password`='$password1' where `id`='$id'");}
$_SESSION["phemi"]=$userid;
echo "<p>your details have been changed!</p>";
}
else {echo "<p><div style='color:red;font-weight:bold'>sorry, there was a server error and your details were not saved! please try again much later.</div></p>";}
}
}
?>
<table border="1" width="500" id="table3" cellpadding="0" style="border-collapse: collapse">
<tr class="header">
<td width="50%" valign="top">options</td>
</tr>
<tr>
<td width="50%" valign="top">
<form method="POST" action="options.php">
<table border="0" width="100%" id="table4" cellpadding="0" cellspacing="0">
<tr>
<td width="147" align="right">user id:</td>
<td><input type="text" name="userid" size="20" value="<?=$userid;?>" class="input"></td>
</tr>
<tr>
<td width="147" align="right">name:</td>
<td>
<input type="text" name="name" size="20" value="<?=$name;?>" class="input"></td>
</tr>
<tr>
<td width="147" align="right">email address:</td>
<td>
<input type="text" name="email" size="20" value="<?=$email;?>" class="input"></td>
</tr>
<tr>
<td width="147" align="right">current password:</td>
<td>
<input type="password" name="password" size="20" class="input"></td>
</tr>
<tr>
<td colspan="2">
<p align="center"><i><u>if you don't want to change your password, leave the 
following fields blank</u></i></td>
</tr>
<tr>
<td width="147">
<p align="right">new password:</td>
<td>
<input type="password" name="password0" size="20" class="input"></td>
</tr>
<tr>
<td width="147">
<p align="right">confirm new password:</td>
<td>
<input type="password" name="password1" size="20" class="input"></td>
</tr>
<tr>
<td width="147">&nbsp;</td>
<td>
<input type="submit" value="change" name="submit" class="button"></td>
</tr>
</table>
</form>
</td>
</tr>
</table>

</div>

</body>
</html>
<?
require "conn";
val();

if (isset($_POST['submit'])) { // Checks if a form was POSTed at all
 if (po("submit")=="Submit") {
 if (!isset($_POST['user']) && !isset($_POST['pass'])) {
 if (isset($_POST['old'])) $a=po('old'); else exit(); // Check if the "old" field was POSTed else exit
 if (isset($_POST['new'])) $b=po('new'); else exit(); // Check if the "new" field was POSTed else exit
 if (isset($_POST['con'])) $c=po('con'); else exit(); // Check if the "con" field was POSTed else exit
}

if (isset($_POST['old'])) $a=po('old');
if (isset($_POST['new'])) $b=po('new');
if (isset($_POST['con'])) $c=po('con');

if ($a!=$pass && $a!="") {$error='Invalid password!<p><input type="button" value="Back" onclick="location=\'options.php\'">';} // Validates password and send error message when incorrect
else if ($b!=$c && ($b!="" || $c!="")) {$error='Passwords do not match!<p><input type="button" value="Back" onclick="location=\'options.php\'">';} // Validates new password and its confirmantion and sends error message when incorrect
else if ($a=="" && $b!="" && $c!="") {$error='Please go back and enter your password!<p><input type="button" value="Back" onclick="location=\'options.php\'">';} // Checks if new password was entered without old password
else {
if (po('new')=="") {$a=$pass;} // Checks if new password was entered or not
else if ($b==$c) {$a=$c;$_SESSION['ebsta_pass']=$c;} // Replaces current session username with new username
$mess=po('mess');
$email=po('email');
$usa=po('user');
mysql_query("update ebsta set pass='$a',user='$usa',mess='$mess',email='$email',var='1'");
$_SESSION['ebsta_user']=po('user');
echo "<script>alert('Your new settings have been saved!');location.replace('./')</script>";
}
}
}

$var=re(mysql_query("select * from ebsta"),0,'var');
$mess=re(mysql_query("select * from ebsta"),0,'mess');
$email=re(mysql_query('select * from ebsta'),0,'email');
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>eBSta - Options &amp; Settings</title>
<meta name="keywords" content="eBStaF" />
<meta name="description" content="eBSta - Options &amp; Settings" />
<meta name="robots" content="noindex" />
<link rel="stylesheet" type="text/css" href="../style.css">
<script src="script.php"></script>
</head>
<body>
<?toplink()?>
<p align="center"><b style="font-size:10pt">Options &amp; Settings</b>
<hr color="#000000" width="100%" align="left" />
</p>
<?
if (isset($error)) echo $error;
else {
?>
<form method="POST">
<table border="0" width="100%" cellspacing="1" background="images/bg.jpg">
<tr>
<td width="50%" style="font-size: 10pt; font-weight: bold">Login Options</td>
<td width="50%" style="font-size: 10pt; font-weight: bold">Message Options</td>
</tr><tr>
<td width="100%" valign="top" colspan="2">
<p align="center">&nbsp;</td>
</tr><tr>
<td width="50%" valign="top">
<table border="0" width="100%" style="font-family:Trebuchet MS;font-size:10pt" cellpadding="2" id="table3">
<? if ($var=="0") { ?>
<tr>
<td width="30%">
<p align="right">Username: </td>
<td width="80%">
<input name="user" onmouseover="this.focus()" size="20" style="font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100" value="<?=$user?>"></td>
</tr>
<?
}
else {echo "<input type=\"hidden\" name=\"user\" onmouseover=\"this.focus()\"  size=\"20\" style=\"font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100\" value=\"$user\">";}
?>
<tr>
<td width="30%">
<p align="right">Old Password: </td>
<td width="80%">
<input type="password" onmouseover="this.focus()" name="old" size="20" style="font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100"></td>
</tr><tr>
<td width="30%">
<p align="right">New password: </td>
<td width="80%">
<input type="password" onmouseover="this.focus()" name="new" size="20" style="font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100"></td>
</tr><tr>
<td width="30%">
<p align="right">Confirm Password: </td>
<td width="80%">
<input type="password" onmouseover="this.focus()" name="con" size="20" style="font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100"></td>
</tr>
</table>
</td>
<td width="50%" valign="top" style="border-left: 2px dotted #C0C0C0">
<table border="0" width="100%" style="font-family:Trebuchet MS;font-size:10pt" cellpadding="2" id="table4">
<tr>
<td width="39%">
<p align="right">Send massages to: </td>
<td width="57%">
<select size="1" name="mess" style="font-family: Verdana; font-size: 8pt; border: 1px solid #C0C0C0" style="width:150">
<option value="0" <? if ($mess==0) {echo "selected";} ?>>Select Option</option>
<option value="1" <? if ($mess==1) {echo "selected";} ?>>Here</option>
<option value="2" <? if ($mess==2) {echo "selected";} ?>>Email address</option>
<option value="3" <? if ($mess==3) {echo "selected";} ?>>Here &amp; email address</option>
</select></td>
</tr><tr>
<td width="39%">
<p align="right">Email Address:</td>
<td width="57%">
<input onmouseover="this.focus()" name="email" size="20" style="font-family:Verdana;font-size:8pt;border:1px solid #C0C0C0;width:100" value="<?=$email?>"></td>
</tr>
</table></td></tr><tr>
<td width="100%" valign="top" colspan="2">
<p align="center">
&nbsp;</td>
</tr><tr>
<td width="100%" valign="top" colspan="2">
<p align="center">
<input type="submit" value="Submit" name="submit">&nbsp;&nbsp;&nbsp;
<input type="reset" value="Cancel" onclick="location.replace('./')" name="Cancel"></td>
</tr>
</table>
</form>
<?
}
lab();
?>
</body>
</html>
<?
require "conn";
if (isset($_GET['logout'])) { // Logs user out and terminates eBSta session
 if (ge("logout")==null) {unset($_SESSION['ebsta_user']);unset($_SESSION['ebsta_pass']);}
}
val();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>eBSta - Home</title>
<meta name="robots" content="noindex" />
<link rel="stylesheet" type="text/css" href="style.css">
<script src="script.php"></script>
</head>
<body onselectstart="return false">
<?toplink()?>
<p align="center"><b style="font-size:10pt">Home</b>
<hr color="#000000" width="100%" align="left" />
</p>
<p>
</p>
<b>eBSta Summary</b><p></p>
<table width="100%" cellpadding="2" border="0" style="font-size: 10px; border-collapse: collapse" bordercolor="#111111" cellspacing="0">
<tr>
<td width="25%" valign="top">
<p><a href="Users/" style="text-decoration: none"><b>Users</b></a><a class="top" style="text-decoration:none" href='Users/'><br /><?
$a=mysql_query("select * from users");
$b=ro($a);
$fb=$b;
if ($b!=0) {
 if ($b==1) {echo "<font color='blue'><b>$b</b></font> User!";}
 else {echo "<font color='blue'><b>$b</b></font> total Users!";}
}
else {echo "<font color='red'><b>No</b></font> no Users!";}
?></a></p>
</td>
</tr>
</table>
<p><hr color="#000000" width="100%" align="left" /></p>
<p><b>Server Status</b></p>
<table border="0" width="500" id="table1" cellpadding="4" style="border-collapse: collapse" cellspacing="4">
<tr>
<td bgcolor="#C0C0C0" width="111"><b>Login</b></td>
<td bgcolor="#C0C0C0"><b>Email</b></td>
<td bgcolor="#C0C0C0" width="179"><b>Emails Today</b></td>
</tr>
<?
$a=mysql_query("select * from smtp");
$b=ro($a);
for ($c=0;$c<$b;$c++) {
$login=re($a,$c,'login');
$email=re($a,$c,'email');
$sent=re($a,$c,'sent');
echo "<tr><td>$login</td><td>$email</td><td>$sent</td></tr>";
}
?>
</table>

</body>
</html>
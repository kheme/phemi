<?
require "admin/conn";
if (isset($_SESSION["phemi"])) {header("location:phemi/home.php");}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css">
<title>phemi (TM) - php e-mailer interface</title>
</head>
<body>
<?=logo();?>
<div align="center">
<table border="1" width="500" id="table1" cellpadding="0" style="border-collapse: collapse">
<tr class="header">
<td width="50%" valign="top">existing user login</td>
<td width="50%" valign="top">new user signup</td>
</tr>
<tr>
<td width="50%" valign="top">
<form method="POST" action="phemi/index.php">
<table border="0" width="100%" id="table2" cellpadding="0" cellspacing="0">
<tr>
<td width="68" align="right">user id:</td>
<td><input type="text" name="userid" size="20" class="input"></td>
</tr>
<tr>
<td width="68" align="right">password:</td>
<td>
<input type="password" name="password" size="20" class="input"></td>
</tr>
<tr>
<td width="68">&nbsp;</td>
<td><i><a href="loginhelp.php">can't login?</a></i></td>
</tr>
<tr>
<td width="68">&nbsp;</td>
<td>
<input type="submit" value="login" name="submit" class="button"></td>
</tr>
</table>
</form>
</td>
<td width="50%" valign="top">
<form action="signup.php">
<table border="0" width="100%" id="table3" cellpadding="2">
<tr>
<td width="93" align="right">choose user id:</td>
<td><input type="text" name="userid" size="20" class="input"></td>
</tr>
<tr>
<td width="93" align="right">email address:</td>
<td>
<input type="text" name="email" size="20" class="input"></td>
</tr>
<tr>
<td width="93">&nbsp;</td>
<td>
<input type="submit" value="continue" name="submit" class="button"></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</div>
</body>
</html>
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
<title>eBSta - User Manual</title>
<meta name="keywords" content="eBStaF" />
<meta name="description" content="eBStaF - Home" />
<meta name="robots" content="noindex" />
<link rel="stylesheet" type="text/css" href="../style.css">
<script src="script.php"></script>
</head>
<body onselectstart="return false">
<?toplink()?>
<p align="center"><b style="font-size:10pt">Help - User Manual</b><hr color="#000000" width="100%" align="left" />
</p>
<p>
</p>
<b>eBSta Summary</b><p></p>
<p>
&nbsp;</p>
<table border="1" width="100%" cellspacing="1" style="border-collapse:collapse;border:1px solid dotted" bordercolor="#C0C0C0">

<tr>
<td>&nbsp;</td>
</tr><tr>
<td>&nbsp;</td>
</tr>

</table>
<?=lab()?>
</body>
</html>
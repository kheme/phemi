<?
require "../admin/conn";
if (!$_POST) {
$dest=ge("dest");
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body background="white">
<table border="1" width="100%" height="100%" id="table5" cellpadding="0" style="border-collapse: collapse">
<tr class="header">
<td width="50%" valign="top">insert addresses from notepad</td>
</tr>
<tr>
<td width="50%" valign="top">
<form method="POST" action="browse.php" enctype="multipart/form-data">
<input type="hidden" name="dest" value="<?=$dest;?>">
<table border="0" width="100%" id="table6" cellpadding="0" cellspacing="0">
<tr>
<td width="97%">
<p align="center">
<input type="file" name="textfile" class="input" size="35"></td>
</tr>
<tr>
<td width="97%" align="center">
<input type="submit" value="insert addresses" name="submit" class="button">
<input type="reset" value="cancel" name="submit" class="button" onclick="parent.document.getElementById('bx').style.display='none'"></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</body>
</html>
<?
}
else {
$dest=po("dest");
$id=date("U");
$uploaddir=path."/tmp/";
$u=$uploaddir.$id.".tmp";
if (move_uploaded_file($_FILES['textfile']['tmp_name'], $u)) {
$a=fopen($u,"r");
$a=fread($a,filesize($u));
$a=split(",",$a);
$b=count($a);
$c="";
for ($d=0;$d<$b;$d++) {$c.=trim($a[$d]).",";}
$c=substr($c,0,-1);
?>
<script>
parent.document.getElementById("form").<?=$dest?>.value="<?=$c;?>";
parent.document.getElementById("bx").style.display="none";
</script>
<?
}
}
?>
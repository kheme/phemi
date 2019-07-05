<?
require "../conn";
if (isset($_GET['logout'])) { // Logs user out and terminates eBSta session
 if (ge("logout")==null) {unset($_SESSION['ebsta_user']);unset($_SESSION['ebsta_pass']);}
}
val();
head("Users");
if (isset($_GET['id'])) {
$id=ge("id");
if (mysql_query("update users set status=1 where id='$id'")) {echo "Activated Successfully!";}
else {echo "Activation Failed!";}
}
?>
<div>
<table border="0" width="400" id="table1" cellpadding="4" style="border-collapse: collapse" cellspacing="4">
<tr><td width="8%"></td><td width='20%' bgcolor="#C0C0C0"><b>ID</b></td>
	<td bgcolor="#C0C0C0" width="123"><b>User Id</b></td><td bgcolor="#C0C0C0">
	<b>Emails Today</b></td></tr>
<?
$a=mysql_query("select * from users");
$b=ro($a);
for ($c=0;$c<$b;$c++) {
$id=re($a,$c,'id');
$userid=re($a,$c,'userid');
$sent=re($a,$c,'sent');
$status=re($a,$c,'status');
if ($status==0) {$prnt="<a href='index.php?id=$id'><img src='../images/delete.gif' border='0' title='Click to activate'></a>";}
else {$prnt="<img src='../images/correct.gif' border='0' title='Activated!'>";}
echo "<tr><td align='center'>$prnt</td><td>$id</td><td>$userid</td><td>$sent</td></tr>";
}
?>
</table>
</div>
</body>
</html>
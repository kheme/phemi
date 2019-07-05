<?
require "../admin/conn";
require("class.phpmailer.php");
if (!isset($_SESSION["phemi"])) {header("location:index.php");}
if (re(mysql_query("select day from day"),0,'day')!=date("z")) {mysql_query("update users set sent=0");$day=date("z");mysql_query("update `day` set `day`='$day'");}
$userid=$_SESSION["phemi"];
if (ro(mysql_query("select * from users where userid='$userid' and status=0"))!=0) {unset($_SESSION["phemi"]);red("phemi/index.php?notactive");}
$a=mysql_query("select * from users where userid='$userid'");

///////////////////////////////////////////////////////////
if ($_POST) {
$reach=0;
$totalsent="";
$stotal=0;$ftotal=0;
$totalfailed="";
$id=date("U");
$to=split(",",po("to"));
$subject=po("subject");
$msg=po("message");
$fromname=po("fromname");
$from=po("fromemail");
$cto=min(2000,count($to));
$mail = new PHPMailer();
$mail->From     = $from;
$mail->FromName = $fromname;
$mail->Subject  = $subject;
$mail->Body     = $msg;
for ($c=0;$c<$cto;$c++) {
$toemail=$to[$c];
$asent=re(mysql_query("select * from users where userid='$userid'"),0,'sent')+1;
if ($asent>2000) {$reach=1;break;}
else {
$mail->AddAddress("$toemail");
if ($mail->Send()) {$mail->ClearAddresses();$mail->ClearAllRecipients();$mail->ClearCustomHeaders();$totalsent.=$toemail.",";$stotal++;mysql_query("update users set sent='$asent' where userid='$userid'");}
else {$totalfailed.="$toemail,";$ftotal++;}
}

}
$sid=date("U");
$totalsent=substr($totalsent,0,-1);$totalfailed=substr($totalfailed,0,-1);
if ($stotal!=0) {mysql_query("insert into sent values('$userid','$from','$fromname','$totalsent','$subject','$msg','$sid')");}
if ($ftotal!=0) {mysql_query("insert into failed values('$userid','$from','$fromname','$totalfailed','$subject','$msg','$sid')");}
}


///////////////////////////////////////////////////////////

$email=re($a,0,'email');
$sent=re($a,0,'sent');
$name=re($a,0,'name');
$b=mysql_query("select * from sent where owner='$userid'");
$c=mysql_query("select * from failed where owner='$userid'");
$usent=ro($b);
$ufailed=ro($c);
$sent=re(mysql_query("select * from users where userid='$userid'"),0,'sent');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="../style.css">
<title>home - user control panel - phemi (TM) - php e-mailer interface</title>
<script>
function doupload(dest) {
document.getElementById("frm").src="browse.php?dest="+dest;
document.getElementById("bx").style.top=(document.body.clientHeight/3);
document.getElementById("bx").style.left=(document.body.clientWidth/2)-200;
document.getElementById("bx").style.display="block";
}
</script>
</head>
<body onload="load();dotime()">
<div id="bx" style="display:none;border:1px solid black;width:400px;height:110px;position:absolute;background:#666666;padding:5px; left:373px; top:182px">
<iframe src="browse.php" id="frm" style="width:100%;height:100%;border:0px;background:white" scrolling="no"></iframe>
</div>
<?=logo();?>
<div align="center">
<p><font color="#666666"><b>home</b></font> | <a href="sent.php">sent (<?=$usent;?>)</a> | 
<a href="failed.php">failed (<?=$ufailed;?>)</a> | <a href="options.php">options</a> | 
<a href="index.php?logout">logout</a></p>
<p>
<table border="1" width="500" style="border-collapse: collapse; font-size:6pt" cellspacing="1" bordercolor="#FFFFFF"><tr>
<td colspan="3" bgcolor="#C0C0C0">
<table border="1" width="0%" style="border-collapse:collapse" id="bar" cellspacing="0" bgcolor="navy"><tr><td></td></tr></table>
</td></tr><tr>
<td width="33%" style="text-align:left;font-size:7pt" bordercolor="#FFFFFF">0</td>
<td width="33%" style="text-align:center;font-size:7pt" bordercolor="#FFFFFF"><div id="val"></div></td>
<td width="33%" style="text-align:right;font-size:7pt" bordercolor="#FFFFFF">2000</td>
</tr></table>
<script>
total=2000;
sent=<?=$sent;?>;
percent=(sent/total)*100;
count=0;
function load() {
if (count<=percent) {
document.getElementById("val").innerHTML=sent + " emails sent today";
document.getElementById("bar").style.width=count++ + "%";
if (count>80) {document.getElementById("bar").bgColor="red"};
window.setTimeout("load()",20)}
}

H=<?=date("G");?>;
M=<?=date("i");?>;
S=<?=date("s");?>;

function dotime() {
S++;
if (S>59) {S=0;}
if (S==0) {M++;}
if (M>59) {M=0;}
if (M==0 && S==0) {H++;}
if (H>23) {H=0;}
h=23-H;m=59-M;s=59-S;
//if (h==1) {h=0;}
//if (m==1) {m=0;}
//if (s==1) {s=0;}
if (h<10) {h="0"+h;}
if (m<10) {m="0"+m;}
if (s<10) {s="0"+s;}
document.getElementById("er").innerHTML="daily limit will reset to zero in "+h+"hrs "+m+"mins "+s+"secs";
if (h==0 && m==0 && s==0) {alert("reseting daily limits to zero");location.reload();}
window.setTimeout("dotime()",1000)
}

</script>
</p>
<p><u id="er"></u></p>
<p style="text-align:center">
<?
if ($_POST) {
if ($reach==1) {echo "<p><div style='color:red;font-weight:bold'>sorry, you have reached today's limit for sending emails!<br />some emails may not have sent, please check the failed messages box</div></p>";}
echo "successful emails: $stotal<br />failed emails: $ftotal";
}
?>
</p>
<table border="1" width="500" id="table3" cellpadding="0" style="border-collapse: collapse">
<tr class="header">
<td width="50%" valign="top">send email</td>
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
<td width="79%"><input type="text" name="to" size="70" class="input"><br>
<a href="javascript:doupload('to');" style="font-size:7pt">insert addresses from notepad</a></td>
</tr>
<tr>
<td width="18%">
<p align="right">subject:</td>
<td width="79%">
<input type="text" name="subject" size="35" class="input"></td>
</tr>
<tr>
<td colspan="2">
<textarea rows="12" name="message" cols="93" class="input" contenteditable></textarea></td>
</tr>
<tr>
<td width="18%">&nbsp;</td>
<td width="79%">
<input type="submit" value="send email" name="submit" class="button"></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</div>
</body>
</html>
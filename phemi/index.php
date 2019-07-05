<?
require "../admin/conn";
$day=date("z");mysql_query("update `day` set `day`='$day'");
if (isset($_GET["logout"])) {unset($_SESSION["phemi"]);}
if (isset($_SESSION["phemi"])) {header("location:home.php");}
if ($_POST) {
$userid=po("userid");
$password=po("password");
if (ro(mysql_query("select * from users where userid='$userid' and password='$password' and status=1"))!=0) {$_SESSION["phemi"]=$userid;red("phemi/home.php");}
else if (ro(mysql_query("select * from users where userid='$userid' and password='$password' and status=0"))!=0) {red("phemi/index.php?notactive");}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="../style.css">
<title>existing user login - phemi (TM) - php e-mailer interface</title>
</head>
<body>
<?=logo();?>
<div align="center">
<?
if ($_POST) {?><p><b style="color:#FF0000">access denied! please enter correct userid and password to proceed!</b></p><?;}
else if (isset($_GET["notactive"])) {?><p><b style="color:#FF0000">access denied! your account has not been activated!</b></p><p><a href="../notactive.php">click here</a> for more information</p><?;}
loginform();?> 
</div>

</body>
</html>
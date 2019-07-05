<?
require "admin/conn";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css">
<title>new user singup - phemi (TM) - php e-mailer interface</title>
<script>
function a() {
if (form.email.value=="") {alert("please enter an email address!");form.email.focus();return false;}
else if (form.email.value.indexOf("@")<1) {alert("please enter a valid email address!");form.email.select();return false;}
else if (form.userid.value=="") {alert("please enter a userid!");form.userid.focus();return false;}
else if (form.password.value=="") {alert("please enter a password!");form.password.focus;return false;}
else if (form.password.value!=form.password1.value) {alert("your passwords do not match!\nplease confirm your password by entering it again correctly!");form.password1.select();return false}
}
</script>
</head>
<body>
<?=logo();?>
<div align="center">
<?
if (!$_POST) {
signupform();
?>
</form>
</div>
<?
}
else {
$email=po("email");
$name=po("name");
$userid=po("userid");
$password=po("password");
$password1=po("password1");
$id=time("U");
if ($password!=$password1) {echo "<p><div style='color:red;font-weight:bold'>sorry, your passwords do not match! please confirm your password by entering it again correctly!</div></p>";signupform();}
else if (ro(@mysql_query("select * from users where userid='$userid'"))!=0) {echo "<p><div style='color:red;font-weight:bold'>sorry, that userid has already been taken! please try a different userid!</div></p>";signupform();}
else if (strpos($email,"@")<1) {echo "<p><div style='color:red;font-weight:bold'>please enter a vaid email addresss!</div></p>";signupform();}
else {
if (mysql_query("insert into users values(0,0,'$email','$name','$userid','$password','$id')")) {
echo "<p><div style='color:blue;font-weight:bold'>your account had been created! you can now login with your userid and password.</div></p>";
echo "<p>now continue below to complete the signup process</p>";
?>
<form action="https://www.e-gold.com/sci_asp/payments.asp" method="POST" target=_top>
<div align="center">
<input type="hidden" name="PAYEE_ACCOUNT" value="2950923">
<input type="hidden" name="PAYEE_NAME" value="phemi">
$30<input type=hidden name="PAYMENT_UNITS" value=1>USD worth of e-gold
<input type=hidden name="PAYMENT_METAL_ID" value=1>
<input type="hidden" name="STATUS_URL" value="mailto:phemi@phemi.tk">
<input type="hidden" name="NOPAYMENT_URL" value="<?=address;?>/failed.php">
<input type="hidden" name="NOPAYMENT_URL_METHOD" value="LINK">
<input type="hidden" name="PAYMENT_URL" value="<?=address;?>/done.php">
<input type="hidden" name="PAYMENT_URL_METHOD" value="LINK">
<input type="hidden" name="BAGGAGE_FIELDS" value="TRANSACTIONID">
<input type="hidden" name="TRANSACTIONID" value="<?=$id;?>">
<input type="hidden" name="SUGGESTED_MEMO" value='Thanks for paying with e-gold!'>
<br>
<input border="0" src="images/paywithegold.gif" name="submit" width="88" height="31" type="image">
</div></form>
<?
}
else {echo "<p><div style='color:red;font-weight:bold'>sorry, there was an error on the server and your account wasn't created! please try again much later.</div></p>";signupform();}
}
}
?>
</body>
</html>
<?
require "admin/conn";
$a=ge("id");
if (ro(@mysql_query("select * from users where userid='$a'"))!=0) {echo "<script>alert(\"SORRY, $a already exists and is NOT available!\")</script>";}
else {echo "<script>alert(\"CONGRATULATIONS, $a is available!\")</script>";}
?>
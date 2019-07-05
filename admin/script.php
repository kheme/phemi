<?
if (isset($_SERVER['HTTP_REFERER'])) {
require "conn";
?>
<!--
function onn(text) {setTimeout("window.status='"+text+"'",0);}

function off() {window.status="";}

function func1() {
if (guy.style.top=="0px") {form.user.focus();return false}
a=guy.style.top.replace("px","").toString()
b=Math.floor(a)+2
guy.style.top=b
setTimeout("func1()",1)
}

function func2() {
if (guy.style.top=="-110px") {return false}
a=guy.style.top.replace("px","").toString()
guy.style.top=a-2
setTimeout("func2()",10)
}

function load() {
images=new Array(<?
$dir=path."/ebsta/images/";
$string="";
if (is_dir($dir)) {
if ($dh=opendir($dir)) {
while (($file=readdir($dh))!==false) {
if (filetype($dir.$file)!="dir" && $file!=="." && $file!=="Thumbs.db" && $file!=="index.php" && $file!==".." && $file!=="picker.cur" && $file!=="_vti_cnf") {
$string=$string."'images/$file',";
}
}
closedir($dh);
}
}

$Dir=path."/img/";
$Dtring="";
if (is_dir($Dir)) {
if ($Dh=opendir($Dir)) {
while (($File=readdir($Dh))!==false) {
if (filetype($Dir.$File)!="dir" && $File!=="." && $File!=="Thumbs.db" && $File!=="index.php" && $File!==".." && $File!=="picker.cur" && $File!=="_vti_cnf") {
$string=$string."'../img/$File',";
}
}
closedir($Dh);
}
}

$string=substr($string,0,strrpos($string,','));
echo $string;
?>)
Objs=new Array()
total=images.length
loaded=0
error=0
ul=new Array()
for (i=0; i<images.length; i++) {
Objs[i]=new Image();
Objs[i].onload=a;
Objs[i].onerror=b;
Objs[i].src=images[i];
}
function a() {
loaded++
bar.style.width=Math.round(loaded/total*100)+"%"
per.innerHTML=Math.round(loaded/total*100)+"% done!"
window.status="Loading images ["+Math.round(loaded/total*100)+"%] done"
if (total==loaded+error) {lo.style.display='none';page.style.display='block';setTimeout("window.status=''",2000);
if (error!=0) {alert('Unable to load '+error+' image(s)')}}
}
}
function b() {
error++
bar.style.width=Math.round(loaded/total*100)+"%"
per.innerHTML=Math.round(loaded/total*100)+"% done!"
window.status="Loading images ["+Math.round(loaded/total*100)+"%] done"
if (total==loaded+error) {lo.style.display='none';page.style.display='block';setTimeout("window.status=''",2000);
if (error!=0) {alert('Unable to load '+error+' image(s)')}}
}

document.onkeydown=function(){
if (event.keyCode==118) {window.resizeTo(800,600)}
if (event.keyCode==119) {window.resizeTo(1024,768)}
if (event.keyCode==120) {window.resizeTo(1280,800)}
}
-->
<?
}
else {echo " ";}
?>
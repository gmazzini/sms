<?php
include "auth.php";
if(isset($_GET['to']))$to=$_GET['to'];
if(isset($_GET['text']))$text=$_GET['text'];
if(isset($_GET['token']))$token=$_GET['token'];
if(strlen($to)>10&&strlen($text)>4&&$aaa[$token]==1){
  $fp=fopen("/home/inout","w+");
  fwrite($fp,"$to|$text\n");
  fclose($fp);
}
?>

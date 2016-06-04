<?php
$dev=1;
$pw=(isset($dev) and $dev===1) ? "" : "K1a6";
$conn = mysql_connect("localhost","root",$pw); 
if (!$conn) die('データベースに接続できません。');
mysql_select_db("p03time", $conn); 
mysql_query('set names utf8', $conn);   
?>
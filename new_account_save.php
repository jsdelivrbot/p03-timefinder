<?php
header ( "Location: login.php" ); // 画面転送
$uid = $_POST ['userid'];
$pass = $_POST ['passwd'];
$uname = $_POST ['username'];
$sex = $_POST ['sex'];
$year = $_POST ['year'];
$month = $_POST ['month'];
$day = $_POST ['day'];
$email = $_POST ['mail'];
$job = $_POST ['job'];
$birthday = $_POST ['year'] . '-' . $_POST ['month'] . '-' . $_POST ['day'];

// echo "ここにユーザー名".$uid.'</br>'.$pass.'</br>'.$uname.'</br>'.$sex.'</br>'.$year.'</br>'.$month.'</br>'.$day.'</br>'.$email.'</br>'.$job;
$sql = "INSERT INTO tb_user (userid,passwd,username,sex,birthday,email,job) VALUES ('{$uid}','{$pass}','{$uname}',{$sex},'{$birthday}','{$email}',{$job})";
include ('db_inc.php'); // データベース接続
$rs = mysql_query ( $sql, $conn ); // SQL文を実行
?>
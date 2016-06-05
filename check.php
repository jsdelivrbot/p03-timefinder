<?php
session_start ();
$u = $_POST ['userid']; // ログイン画面より送信されたユーザID、例えば,'k12jk230';
$p = $_POST ['passwd']; // ログイン画面より送信されたパスワード、例えば,'ar37';
$sql = "SELECT * FROM tb_user WHERE userid= '{$u}'  AND PASSWD='{$p}'";
include ("db_inc.php");
$rs = mysql_query ( $sql, $conn );
if (! $rs) die ( 'エラー: ' . mysql_error () );
$row = mysql_fetch_array ( $rs );
if ($row) { 
	$_SESSION ['userid'] = $row ['userid'];
	$_SESSION['username'] = $row['username'];
	if($row ['job']==0){
		$url = 'admin.php'; // 転送先のURL
		header ( 'Location:' . $url ); // 画面転送
	}else{
		$url = 'index.php'; // 転送先のURL
		header ( 'Location:' . $url ); // 画面転送
	}
} else {
	include('page_header.php');	
	echo '<h2>ログイン失敗！</h2>';
	echo '<h2>ユーザー名もしくはパスワードが違います！</h2>';
	echo '<a href="login.php">戻る</a>';
	echo '</body>';
	include('page_footer.php');
}
?>
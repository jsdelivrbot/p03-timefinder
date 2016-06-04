<?php
session_start();
if (! isset ( $_SESSION ['userid'] )) {
// もし、ログインしていない, または、ユーザ種別は先生ではないかつ管理者の場合
	header ( "Location: login.php" );
	exit (); // 処理中止
} else {
	include ('header_inc.php'); // 画面出力開始
?>
<body bgcolor="azure">
<h1>現在の共有中メンバー</h1>
<?php
	echo '<head><meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8"></head>';
	$query = "SELECT username,userid FROM tb_share_id NATURAL JOIN tb_user WHERE share='".$uname."'";
	include ('db_inc.php'); // データベース接続 $rs = mysql_query($sql, $conn);
	$rs = mysql_query ( $query );
	if (! $rs) die ( 'エラー: ' . h ( mysql_error () ) );
	echo "<table border=1>";
	echo "<tr bgcolor='#ffd78c'>";
	echo "<td>ユーザー名</td>";
	echo "</tr>";
	// 配列の要素を一つずつ取り出して出力
	while ( $row = mysql_fetch_array ( $rs ) ) {
		$us[]=$row ['userid'];
		$un[]=$row ['username'];
		echo "<tr>";
		echo "<td>" . $row['username'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
?>
<h2>共有するメンバーの削除</h2>
<form action="share_schedule_delete_save.php" method="post">
<?php
echo "<table>";
for($t=0;$t<count($us);$t++){
	echo "<tr><td><input type='checkbox' name='chk1[]' value='".$us[$t]."'></td><td>".$un[$t]."</td></td></tr>";
}
echo "</table>";
?>
<input id="submit_button" type="submit" value="削除"> <input id="reset_button" type="reset" value="取消">
</form>
<FORM>
	<INPUT type="button" value="戻る" onClick="history.back()">
</FORM>
<?php  ?>
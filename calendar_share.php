<?php include("page_header.php"); ?>
<div align="center">
<h1>現在共有中のメンバーのスケジュール一覧</h1>
<?php
	include ('db_inc.php'); // データベース接続 $rs = mysql_query($sql, $conn);
	echo '<head><meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8"></head>';
	$userid = $_SESSION['userid'];
	$query = "SELECT * FROM tb_schedule_share NATURAL JOIN tb_user NATURAL JOIN tb_share_id WHERE tb_share_id.share='{$userid}' AND tb_share_id.userid=tb_schedule_share.userid";
	$rs = mysql_query ( $query );
	if (! $rs) die ( 'エラー: ' . h ( mysql_error () ) );
	echo '<table class="table table-striped table-hover">';
	echo "<tr bgcolor='#ffd78c'>";
	echo "<th>" . "予定名" . "</th>";
	echo "<th>" . "場所" . "</th>";
	echo "<th>" . "説明" . "</th>";
	echo "<th>" . "開始日時～終了日時" . "</th>";
	echo "<th>" . "公開設定" . "</th>";
	//echo "<td>" . "番号" . "</td>";
	echo "<th>" . "ユーザー名" . "</th>";
	echo "</tr>";
	// 配列の要素を一つずつ取り出して出力
	while ( $row = mysql_fetch_array ( $rs ) ) {
		if($row ['scope']==0){
		//echo "<tr bgcolor='#cccccc'>";
		echo "<tr>";
		echo "<td>" . $row ['title'] . "</td>";
		echo "<td>" . $row ['place'] . "</td>";
		echo "<td>" . $row ['kmemo'] . "</td>";
		echo "<td>" . $row ['kstime']."～". $row ['ketime'] . "</td>";
		//echo "<td>" . $row ['scope'] . "</td>";
		echo "<td>";
		if($row ['scope']==0){
			echo '公開する';
		}else{
			echo '公開しない';
		}
		echo "</td>";
		//echo "<td>" . $row ['kid'] . "</td>";
		echo "<td>" . $row ['username'] . "</td>";
		echo "</tr>";
		}else{
			echo "<tr>";
			echo "<td>" . "予定あり" . "</td>";
			echo "<td>" . " " . "</td>";
			echo "<td>" . " " . "</td>";
			echo "<td>" . $row ['kstime']."～". $row ['ketime'] . "</td>";
			//echo "<td>" . $row ['scope'] . "</td>";
			echo "<td>";
			if($row ['scope']==0){
				echo '公開する';
			}else{
				echo '公開しない';
			}
			echo "</td>";
			//echo "<td>" . $row ['kid'] . "</td>";
			echo "<td>" . $row ['username'] . "</td>";
			echo "</tr>";
		}
	}
	echo "</table>";
?>
<input type="button" onclick="location.href='share_schedule_entry.php'"value="共有メンバー追加">
<input type="button" onclick="location.href='share_schedule_delete.php'"value="共有メンバー削除">
</div>>
<?php include("page_footer.php"); ?>
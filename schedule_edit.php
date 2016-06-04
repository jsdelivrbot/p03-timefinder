<?php include('page_header.php');
	if (!isset($_SESSION['userid'])){
		echo '<div class="text-danger">このサービスを利用するためにログインする必要があります</div>';
		include('page_footer.php');
		exit;
	}
	include ('db_inc.php'); 
	$userid = $_SESSION['userid'];
	$opt = '<h1>新規予定作成</h1>' ; 
 	if (isset($_GET['kid'])){	
 		$opt = '<h1>予定編集</h1>' ;
		$kid=$_GET ['kid'] ;
		$sql = "SELECT * FROM tb_schedule WHERE kid={$kid} AND userid='{$userid}'";
		$rs = mysql_query ($sql, $conn);
		if (! $rs) die ( 'エラー: ' . mysql_error ());
		$row = mysql_fetch_array ($rs);
		$t=$row ['title'];
		$p=$row ['place'];
		$km=$row ['kmemo'];
		$kst=$row ['kstime'];
		$ket=$row ['ketime'];
		$c=$row ['cid'];
	}
	echo $opt;
?>
<form action="schedule_save.php" method="post">
<table class="table table-striped table-hover">
<tr><th align=right>予定名：</th>
<td><input class="form-control" type="text" name="title" placeholder="予定名" value="<?php echo $t; ?>"></td></tr>
<tr><th align=right>開始日時：</th><td><select name="year1">
<?php
  list($y, $m, $d, $h, $t) = array(date('Y'),date('n'),date('d'),date('h'),date('i'));
  if (isset($kst)){
 	  list($ksdate, $kstime) = explode(' ', $kst);
 	  list($y, $m, $d) = explode('-', $ksdate);
 	  list($h, $t ) = explode(':', $kstime);
  }
  for($i=$y-1; $i<=$y+2; $i++){
		$selected = ($i==$y) ? 'selected' : '';
		echo "<option value=\"$i\" {$selected}>{$i}</option>";
  }
  echo '</select> 年 <select name="month1">';
	for($i=1;$i<=12;$i++){
		$selected = ($i==$m) ? 'selected' : '';
		echo "<option value=\"$i\" {$selected}>{$i}</option>";
	}
	echo '</select> 月 <select name="day1">';
	for($i=1;$i<=31;$i++){
		$selected = ($i==$d) ? 'selected' : '';
		echo "<option value=\"$i\" {$selected}>{$i}</option>";
	}
?>
</select> 日
<input type="text" name="hour1" size="1" value=<?=$h;?>>時
<input type="text" name="minute1" size="1" value=<?=$t;?>>分
</td></tr>
<tr><th align=right>終了日時：</th><td><select name="year2">
<?php
 	list($y, $m, $d, $h, $t) = array(date('Y'),date('n'),date('d'),date('h'),date('i'));
 	if (isset($ket)){
 		list($kedate, $ketime) = explode(' ', $ket);
 	  list($y, $m, $d) = explode('-', $kedate);
 	  list($h, $t ) = explode(':', $ketime);
 	}
	for($i=$y-1; $i<=$y+2; $i++){
		$selected = ($i==$y) ? 'selected' : '';
		echo "<option value=\"$i\" {$selected}>{$i}</option>";
  }
  echo '</select> 年 <select name="month2">';
	for($i=1;$i<=12;$i++){
		$selected = ($i==$m) ? 'selected' : '';
		echo "<option value=\"$i\" {$selected}>{$i}</option>";
	}
	echo '</select> 月 <select name="day2">';
	for($i=1;$i<=31;$i++){
		$selected = ($i==$d) ? 'selected' : '';
		echo "<option value=\"$i\" {$selected}>{$i}</option>";
	}
?>
</select> 日
<input type="text" name="hour2" size="1" value=<?php echo $h; ?>>時
<input type="text" name="minute2" size="1" value=<?php echo $t; ?>>分
</td></tr>
<tr><th align=right>場所：</th>
<td><input class="form-control" type="text" name="place" placeholder="場所" value=<?php echo $p; ?>></td>
</tr><tr><th align=right>説明：</th>
<td><textarea class="form-control" name="kmemo" rows="4" cols="40" placeholder="ここに説明を書いてください"><?php echo $km; ?></textarea></td>
</tr><tr><th align=right>カテゴリー選択：</th>	<td>
<?php
	$sql = "SELECT * FROM tb_calendar WHERE owner='{$userid}'";
	$rs = mysql_query ($sql, $conn);
	if (! $rs) die ( 'エラー: ' . mysql_error ());
	$row = mysql_fetch_array ($rs);
	echo '<select class="form-control" name="cid">';
	echo '<option value="0">未分類</option>';
	while($row){
		echo '<option value="'.$row['cid'].'">' . $row['cname'] . '</option>';
		$row = mysql_fetch_array ($rs);
	}
	echo '</select>';
	echo "<input type='hidden' name='kid' value=$kid>";
?>
</td></tr>
</table>
<input id="submit_button" type="submit" value="登録">
<input id="reset_button" type="reset" value="取消">
</form>

<?php include('page_footer.php');?>
<?php 
include('page_header.php');
include ('db_inc.php');
$userid   = $_SESSION['userid'];
$kstime   = $ketime = date('Y-n-d h:i');
$members  = $week = array();
$length   = 1;
$unit     = 0;
?>
<script type="text/javascript">
$(function () {
  $('.date').datetimepicker({
    locale: 'ja',
    format : 'YYYY-MM-DD HH:mm:ss'
  });
});
</script>
<h2 class="bg-primary">空き時間検索</h2>
<?php
	if (isset($_POST['query_ready'])){ // ready to compute 
		include('sparetime_inc.php');
	}	
?>
<?php
	if (!isset($_POST['member_ready']) and !isset($_POST['query_ready'])) : // step 1: select members 
?>
<h3><span class="text-danger">Step 1</span>: メンバー選択</h3>
<form class="form-horizontal" action="sparetime.php" method="post">
<input type="hidden" name="member_ready">
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<?php	
	$sql = "SELECT * FROM tb_user WHERE NOT userid='admin' ";
	$rs = mysql_query($sql, $conn);
	if (!$rs) die ('エラー: ' . mysql_error());
	while ($row = mysql_fetch_array($rs)) {
		$uid 	= $row['userid'] ;
    $checked = in_array($uid, $members) ? 'checked' : '';
		$uname= $row['username'] ;
		echo '<label class="checkbox-inline">';
		echo "<input type=\"checkbox\" name=\"members[]\" value=\"$uid\" {$checked}/> " . $uname ;
		echo '</label>';
	}	
?>
</div></div>
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<input class="btn btn-primary btn-block" type="submit" value="次へ">
</div></div>
</form>
<?php
	elseif (!isset($_POST['query_ready'])) :  // step 2: query condition
?>
<h3><span class="text-danger">Step 2</span>: 検索条件入力</h3>
<form class="form-horizontal" action="sparetime.php" method="post">
<input type="hidden" name="query_ready">
<div class="form-group">
  <label class="control-label col-sm-2">検索期間</label>
  <div class="col-sm-10">
    <div class="input-group date">
    	<input class="form-control" type='text' name="kstime" value="<?=$kstime ?>"/>
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
    <div class="input-group date">
    	<input class="form-control" type='text' name="ketime" value="<?=$ketime ?>"/>
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
  </div>
</div>
<div class="form-group">
  <label class="control-label col-sm-2"">空き時間:</label>
  <div class="col-sm-10">
  <input type="number" min="1" class="form-control" name="length" value="<?=$length ?>"/>
  <?php
  	$units = array('分','時間',/*'終日'*/);
  	for ($i=0; $i < count($units); $i++){
      $checked = ($i==$unit) ? 'checked' : '';
  		echo '<label class="radio-inline">';
      echo "<input type=\"radio\" name=\"unit\" value=\"$i\" {$checked}/> " . $units[$i];
  		echo '</label>';
  	}
  ?>
  </div>
</div>
<div class="form-group">
  <label class="control-label col-sm-2" for="email">曜日指定:</label>
  <div class="col-sm-10">
	<?php
		$wdays = array("日", "月", "火", "水", "木", "金", "土");// 配列の初期化
		for ($i=0; $i < count($wdays); $i++){
			$checked = in_array($i, $week) ? 'checked' : '';
			echo '<label class="checkbox-inline">';
			echo "<input type=\"checkbox\" name=\"week[]\" value=\"{$i}\" {$checked}>" . $wdays[$i];
			echo '</label>';
		}
	?>
	</div>
</div>

<div class="form-group">
  <label class="control-label col-sm-2">VIP指定:</label>
  <div class="col-sm-10">
<?php
	$memers = array();
	foreach ($_POST['members'] as $uid)  $members[] = "'" . $uid ."'"; // single quoting each userid
	$members = implode(',', $members);
	echo '<input type="hidden" name="members" value="' . $members.'">';
	$sql = "SELECT * FROM tb_user WHERE userid IN ($members) ";
	//echo $sql;
	$rs = mysql_query($sql, $conn);
	if (!$rs) die ('エラー: ' . mysql_error());
	while ($row = mysql_fetch_array($rs)) {
		$uid 	= $row['userid'] ;
		$uname= $row['username'] ;
		echo '<label class="checkbox-inline">';
		echo "<input type=\"checkbox\" name=\"vip[]\" value=\"$uid\"/> " . $uname ;
		echo '</label>';
	}
	?>	
  </div>
</div>  
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <input class="btn btn-default" type="submit" value="検索">
    <input class="btn btn-default" type="reset" value="取消">
  </div>
</div>
</form>
<?php endif; ?>

<!-- </div> -->
<?php include('page_footer.php');?>
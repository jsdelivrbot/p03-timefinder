<?php include('page_header.php');
	if (!isset($_SESSION['userid'])){
		echo '<div class="text-danger">このサービスを利用するためにログインする必要があります</div>';
		include('page_footer.php');
		exit;
	}
	include ('db_inc.php'); 
	$userid = $_SESSION['userid'];
	$opt = '<h1>新規予定作成</h1>' ; 
	$kid = $cid = -1;
	$t = $p = $km = '';
	$kst = $ket = date('Y-n-d H:i:s');
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
<form class="form-horizontal" action="schedule_save.php" method="post">
<input type="hidden" name="kid" value="<?=$kid;?>">
<div class="form-group">
  <label class="control-label col-sm-2">予定名：</label>
  <div class="col-sm-10">
  	<input type="text" class="form-control" name="title" value="<?=$t ?>"/>
  </div>
</div>
<div class="form-group">
  <label class="control-label col-sm-2">開始日時:</label>
  <div class="col-sm-10">
    <div class="input-group date">
    	<input class="form-control" type="text" name="kstime" value="<?=$kst ?>"/>
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
  </div>
</div>
<div class="form-group">
  <label class="control-label col-sm-2">終了日時:</label>
  <div class="col-sm-10">
    <div class="input-group date">
    	<input class="form-control" type="text" name="ketime" value="<?=$ket ?>"/>
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
  </div>
</div>
<div class="form-group">
  <label class="control-label col-sm-2">場所：</label>
  <div class="col-sm-10">
  	<input type="text" class="form-control" name="place" value="<?=$p ?>"/>
  </div>
</div>
<div class="form-group">
  <label class="control-label col-sm-2">説明：</label>
  <div class="col-sm-10">
  	<textarea class="form-control" rows="4" name="kmemo"><?=$km ?></textarea>
  </div>
</div>
<div class="form-group">
  <label class="control-label col-sm-2">カテゴリー選択：</label>
  <div class="col-sm-10">
  <select class="form-control" name="cid">
  <option value="0">未分類</option>
<?php
	$sql = "SELECT * FROM tb_calendar WHERE owner='{$userid}'";
	$rs = mysql_query ($sql, $conn);
	if (! $rs) die ( 'エラー: ' . mysql_error ());
	while($row = mysql_fetch_array ($rs)){
		echo '<option value="'.$row['cid'].'">' . $row['cname'] . '</option>';
	}
?>
	</select>
	</div>
</div>
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <input class="btn btn-success" type="submit" value="登録">
    <input class="btn btn-default" type="reset" value="取消">
  </div>
</div>
</form>

<?php include('page_footer.php');?>
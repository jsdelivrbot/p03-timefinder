<?php include('page_header.php');
	if (!isset($_SESSION['userid'])){
		echo '<div class="text-danger">このサービスを利用するためにログインする必要があります</div>';
		include('page_footer.php');
		exit;
	}
	include ('db_inc.php'); 
	$userid = $_SESSION['userid'];
	if (isset($_GET['kid'])){	
		$kid=$_GET ['kid'] ;
		$sql = "SELECT * FROM vw_yotei WHERE kid={$kid} AND userid='{$userid}'";
		$rs = mysql_query ($sql, $conn);
		if (! $rs) die ( 'エラー: ' . mysql_error ());
		$row = mysql_fetch_array ($rs);
		$t 		=	$row ['title'];
		$p 		= $row ['place'];
		$km 	= $row ['kmemo'];
		$kst 	= $row ['kstime'];
		$ket 	= $row ['ketime'];
		$cid 	= $row ['cid'];
		$cname= $row ['cname'];
 	  list($ksdate, $kstime) = explode(' ', $kst);
 	  list($y, $m, $d) = explode('-', $ksdate);
 	  list($h, $t ) = explode(':', $kstime);
 		list($kedate, $ketime) = explode(' ', $ket);
 	  list($y, $m, $d) = explode('-', $kedate);
 	  list($h, $t ) = explode(':', $ketime);
	}
?>
<table class="table table-striped table-hover">
<tr><th>予定名：</th><td><?php echo $t; ?></td></tr>
<tr><th>開始日時：</th><td><?php echo $p; ?></td></tr>
<tr><th>終了日時：</th><td><?php echo $p; ?></td></tr>
<tr><th>場所：</th><td><?php echo $kmemo; ?></td></tr>
<tr><th>説明：</th><td><?php echo $p; ?></td></tr>
<tr><th>カテゴリ：</th><td><?php echo $p; ?></td></tr>

<?php include('page_footer.php'); ?>
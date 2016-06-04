<?php

session_start();



if ( !isset($_SESSION['userid'])) {

	// もし、ログインしていない, または、ユーザ種別は先生ではないかつ管理者の場合

	header("Location: login.php") ;

	exit(); //処理中止



}else{

	header("Location: share_schedule.php") ;// 画面転送

	include('header_inc.php');//画面出力開始

//$userid=$_SESSION['userid'];



$chk=$_POST['chk1'];





//echo $chk[0].$chk[1];

/*

echo "ここにユーザー名".$uname.'</br>'.$title.'</br>'.$kdate.'</br>'.$kstime.'</br>'.$ketime.'</br>'.

$place.'</br>'.$kmemo.'</br>'.$scope;

*/



/*

 * INSERT INTO tb_schedule VALUES

('','tanaka','2015-7-15','2015-7-15 00:00:01','2015-7-15 23:59:58','誕生日','自宅','２２歳になる誕生日',1),



UPDATE tb_schedule

SET kmemo='実装'

WHERE kid=8

UPDATE tb_schedule SET kdate='2015-07-23',kstime='2015-07-25 12:00:00',ketime='2015-07-25 14:00:00',title='研究',place='ここ',kmemo='じ',scope=1 WHERE kid=8 AND userid='tanaka';

$sql="UPDATE tb_schedule SET kdate='{$kdate}',kstime='{$kstime}',ketime='{$ketime}',title='{$title}',place='{$place}',kmemo='{$kmemo}',scope=$scope WHERE kid=$kid AND userid='{$uname}'";

INSERT INTO `tb_share_id` (`share`, `userid`) VALUES ('tanaka', 'tanaka')



$sql='DELETE FROM tb_share_id WHERE ';

for($t=0;$t<count($ui);$t++){

	if($t==0){

		$sql.="(share='".$uname."' AND userid='".$ui[$t]."')";

	}else{

		$sql.=" OR (share='".$uname."' AND userid='".$ui[$t]."')";

	}

}



*

*/



$sql='INSERT INTO `tb_share_id` (`share`, `userid`) VALUES ';

for($t=0;$t<count($chk);$t++){

	if($t==0){

		$sql.="('".$uname."','".$chk[$t]."')";

	}else{

		$sql.=",('".$uname."','".$chk[$t]."')";

	}

}

//echo $sql;



 //$sql="INSERT INTO `tb_share_id` (`share`, `userid`) VALUES ('{$uname}', 'tanaka')";



include('db_inc.php');  // データベース接続

$rs = mysql_query($sql, $conn); //SQL文を実行





}

?>
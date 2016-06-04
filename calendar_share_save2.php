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

	$ui=$_POST['ui2'];



$sql='DELETE FROM tb_share_id WHERE ';

for($t=0;$t<count($ui);$t++){

	if($t==0){

		$sql.="(share='".$uname."' AND userid='".$ui[$t]."')";

	}else{

		$sql.=" OR (share='".$uname."' AND userid='".$ui[$t]."')";

	}

}

//echo $sql;



?>



<?php



include('db_inc.php');  // データベース接続

$rs = mysql_query($sql, $conn); //SQL文を実行







}

?>
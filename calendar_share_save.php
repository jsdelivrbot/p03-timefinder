<?php

session_start();



if ( !isset($_SESSION['userid'])) {

	// もし、ログインしていない, または、ユーザ種別は先生ではないかつ管理者の場合

	header("Location: login.php") ;

	exit(); //処理中止



}else{

	include('header_inc.php');//画面出力開始

//$userid=$_SESSION['userid'];

echo '<body bgcolor="azure">';

$chk=$_POST['chk1'];

echo "<h2>このメンバーの共有を削除しますか？</h2>";



$query = "SELECT * FROM tb_user";

include ('db_inc.php'); // データベース接続 $rs = mysql_query($sql, $conn);

$rs = mysql_query ( $query );

echo "<table border=1>";

echo "<tr bgcolor='#ffd78c'>";

echo "<td>" . "ユーザー名" . "</td>";

echo "</tr>";

// 配列の要素を一つずつ取り出して出力



while ( $row = mysql_fetch_array ( $rs ) ) {

	for($i=0;$i<count($chk);$i++){

		if($chk[$i]==$row['userid']){

			echo "<tr>";

			echo "<td>" . $row['username'] . "</td>";

			echo "</tr>";

		}

	}

}

echo "</table>";



?>

<form  action="share_schedule_delete_save2.php" method="post">

<?php

for($l=0;$l<count($chk);$l++){

	echo "<input type='hidden' name='ui2[]' value='".$chk[$l]."'>";

}

?>

<input id="submit_button" type="submit" value="削除">

</form>

<FORM>

<INPUT type="button" value="戻る" onClick="history.back()">

</FORM>

<?php







}

?>
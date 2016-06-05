<?php
$vars = array_merge($_POST,$_GET);
$s = $vars['kstime'];
$e = $vars['ketime'];
$m = $vars['members'];
$len = $vars['length'];
$unit = $vars['unit'];
//$vip = $vars['vip'];
//$week = $vars['week'];

$st = analyze($s);
$et = analyze($e);
echo '<code>検索期間:</code> <br>' . interval($st, $et) . '<br>';

// intersecting query
$sql = "SELECT * FROM tb_schedule WHERE ". 
  " (  (kstime>'$s' AND kstime<'$e') " .  //  kstime in [s, e]
  " OR (ketime<'$s' AND ketime>'$s') " .  //  ketime in [s, e]
  " OR (kstime<'$s' AND ketime>'$e') " .  //  [kstime, ketime] contains [s, e] 
  " ) AND userid IN ($m) ORDER BY kstime";
//echo $sql;   

$rs = mysql_query ( $sql );
if (!$rs) die ('エラー: ' . mysql_error());
$occupied  = array(); //  空き時間検索だけなら、この配列は必要ではない
$sparetime = array();
$a = $b = '';         //  現在結合作業進行中の時区間
while ($row = mysql_fetch_array($rs)) {
  $t1 = $row['kstime'];
  $t2 = $row['ketime'];
  if (empty($a) or empty($a) ){
    $a = $t1;
    $b = $t2;
  //  $occupied[$t1] = $t2; // first interval
    if (comp($a, $s)) $sparetime[$s] = $a;  
  }else if (comp($t1, $b) > 0) {  // [a, b] < [t1, t2]
  //  $occupied[$t1] = $t2; // begin a new occupied interval
    $sparetime[$b] = $t1; // [b, t1] : free time interval
    $a = $t1; 
    $b = $t2;
  }else{
    if (comp($t2,$b) > 0) { // [a, b] overlaps [t1, t2]
   //   $occupied[$a] = $t2;  // [a ,b] -> [a, t2]
      $b = $t2;
    }
  }
}
if (!empty($b) and comp($e, $b) > 0) $sparetime[$b] = $e;
if (empty($b)) $sparetime[$s] = $e; 
echo '<code>空き時間:</code> <br>'; 
foreach ($sparetime as $t1=>$t2){
  $t_1 = analyze($t1);
  $t_2 = analyze($t2);
  echo interval($t_1, $t_2);
  echo  ' (' . timespan($t_2[7]-$t_1[7]). ')';
  echo '<br>';
}

// Datetime conversion: 'yyyy-mm-dd hh:nn:ss' -> an array
// i.e. (week, jp_week, year, month, day, hour, minute, second, unix_time)
function analyze($datetime=null){
  if ($datetime){
    list($date, $time) = explode(' ', $datetime);
    list($y, $m, $d)  = explode('-', $date);
    list($h, $n)  = explode(':', $time);
    $t =  mktime($h, $n, 0, $m, $d, $y);
  }else{
    $t = time();
  }
  $w = date('w', $t);
  $wdays = array("日", "月", "火", "水", "木", "金", "土");
  return array($w,$wdays[$w], $y,$m,$d,$h,$n,$t);
}

function comp($dt1, $dt2){
  list($date, $time) = explode(' ', $dt1);
  list($y, $m, $d)  = explode('-', $date);
  list($h, $n)  = explode(':', $time);
  $t1 =  mktime($h, $n, 0, $m, $d, $y);
  list($date, $time) = explode(' ', $dt2);
  list($y, $m, $d)  = explode('-', $date);
  list($h, $n)  = explode(':', $time);
  $t2 =  mktime($h, $n, 0, $m, $d, $y);
  return $t1 - $t2;
}

function interval($t1, $t2){
  $r  = implode('/',array_slice($t1,2,3)) . '('. $t1[1] . ') ';
  $r .= implode(':',array_slice($t1,5,2)) . '～';
  if($t1[2]==$t2[2]){ // same year
    if ($t1[3]==$t2[3]){ // same month
      if ($t1[4]==$t2[4]){ // same day
        return $r . implode(':',array_slice($t2,6,2));
      }
    }
    $r .= implode('/',array_slice($t2,3,2))  . '('. $t2[1] . ') ';
    $r .= implode(':',array_slice($t2,5,2));
    return $r;
  } 
  $r  .= implode('/',array_slice($t2,2,3)) . '('. $t2[1] . ') ';
  return $r . implode(':',array_slice($t2,5,2));
}

// Timespan transformation: seconds to human readable form: days,hours,minutes

function timespan($second){
  $minutes = round($second/60);
  $hours   = round($minutes/60);
  $days    = round($hours/24);
  $hours  %= 24;
  $minutes%= 60; 
  $d = ($days   > 0) ? $days    . '日'   : '';
  $h = ($hours  > 0) ? $hours   . '時間' : '';
  $m = ($minutes> 0) ? $minutes . '分'   : '';
  return $d . $h . $m;
}

?>
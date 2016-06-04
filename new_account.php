<?php include('page_header.php'); ?>
<h1>新規アカウント作成</h1>
<form action="new_account_save.php" method="post">
<table>
<tr>
  <th align=right>ユーザーID：</th><td><input type="text" name="userid" placeholder="ユーザー名"></td>
</tr>
<tr>
  <th align=right>パスワード：</th><td><input type="password" name="passwd" placeholder="パスワード"></td>
</tr>
<tr>
  <th align=right>名前：</th><td><input type="text" name="username" placeholder="名前"></td>
</tr>
<tr>
  <th align=right>性別：</th><td><input type="radio" name="sex" value="1" checked>男 <input
    type="radio" name="sex" value="2">女
  </td>
</tr>
<tr>
  <th align=right>誕生日：</th><td><select name="year">
  <?php
  $y=date('Y');
    for($i=$y-100;$i<=$y;$i++){
      echo '<option value="'.$i.'">'.$i.'</option>';
    }
  ?>
  </select> 年 <SELECT name="month">
  <?php
    for($i=1;$i<=12;$i++){
      echo '<option value="'.$i.'">'.$i.'</option>';
    }
  ?>
  </SELECT> 月 <SELECT name="day">
  <?php
    for($i=1;$i<=31;$i++){
      echo '<option value="'.$i.'">'.$i.'</option>';
    }
  ?>
  </select> 日
  </td>
</tr>
<tr>
  <th align=right>メールアドレス：</th><td><input type="text" name="mail"
    placeholder="testmail@test.jp"></td>
</tr>
<tr>
  <th align=right>所属部署：</th><td><select name="job">
      <option value="" selected="selected">選択してください</option>
      <option value="1">営業</option>
      <option value="2">企画</option>
      <option value="3">総務</option>
      <option value="4">法務</option>
      <option value="5">広報</option>
      <option value="6">工事</option>
      <option value="8">製造</option>
      <option value="7">その他</option>
  </select></td>
</tr>
</table>
<input id="submit_button" type="submit" value="作成"> <input
id="reset_button" type="reset" value="取消">
</form>
<?php include('page_footer.php'); ?>
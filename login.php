<?php include('page_header.php'); ?>
<h2>空き時間検索システムへログイン</h2>
<form class="form-horizontal" action="check.php" method="post">
  <div class="form-group has-warning">
    <div class="col-sm-12"><input type="text" id="vs1" name="userid" class="form-control" placeholder="ログインID（英数の文字列）">
    </div>
  </div>
   <div class="form-group has-success">
    <div class="col-sm-12"><input type="password" id="vs2" name="passwd" class="form-control" placeholder="パスワード">
    </div>
  </div>
  <div class="form-group has-error">
        <div class="col-sm-12"><input class="btn btn-info btn-block" type="submit" value="ログイン">
    </div>
  </div>
</form>
<?php include('page_footer.php'); ?>
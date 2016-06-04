『スケジュール共有を前提とした空き時間検索システムの開発』

【開発環境】
Eclipse-php
xampp

【添付ファイル】
マニュアル		
pbs-deploy		//ソースコード
pbs12jk078db.sql	//データベース

【ソースコードの説明】
----------------------------------------------------------------
その他機能
----------------------------------------------------------------
login.php		//ログイン画面
logout.php		//ログアウト画面
new_account.php		//新規アカウント作成画面
new_account_save.php	//new_account.phpで入力した内容をSQL文で登録
check.php		//login.phpで入力した内容をSQL文で確認
db_inc.php		//データベース接続用(実行したい場合localhostに書き換えて)
header_inc.php		//画面上部に表示するメニューバー
admin.php		//管理者でログイン時に表示(今回は管理者用アカウントを利用しなかった)
----------------------------------------------------------------
個人スケジュール一覧機能＆個人スケジュール管理機能
----------------------------------------------------------------
index.php				//個人スケジュール一覧画面
calendar.php				//個人スケジュールをcalendarで表示
calendar.css				//calendar.phpのデザインを指定
private_schedule_entry.php		//個人スケジュール登録画面
private_schedule_entry_save.php		//private_schedule_entry.phpで入力した内容をSQL文で登録
private_schedule_change.php		//個人スケジュール変更画面
private_schedule_change_save.php	//private_schedule_change.phpで入力した内容をSQL文で登録
private_schedule_delete.php		//個人スケジュール削除確認画面
private_schedule_delete_save.php	//private_schedule_delete.phpで確認した内容をSQL文で削除
----------------------------------------------------------------
スケジュール共有機能
----------------------------------------------------------------
share_setting.php		//カテゴリーごとの公開設定画面
share_setting_save.php		//share_setting.phpで入力した内容をSQL文で登録
share_schedule.php		//共有するメンバーに追加したメンバーのスケジュールを一覧で表示する
share_schedule_entry.php	//追加メンバーを選択し、追加する
share_schedule_entry_save.php	//share_schedule_entry.phpで入力した内容をSQL文で登録
share_schedule_delete.php	//削除メンバーを選択し、削除する
share_schedule_delete_save.php	//share_schedule_delete.phpで選択したメンバーを削除するか確認する
share_schedule_delete_save2.php	//share_schedule_delete_save.phpで入力した内容をSQL文で削除
----------------------------------------------------------------
空き時間検索機能
----------------------------------------------------------------
sparetime_search.php	//空き時間検索画面を表示する
sparetime_result.php	//sparetime_search.phpで入力した条件から空き時間を求め、出力する
----------------------------------------------------------------
出欠アンケート機能
----------------------------------------------------------------
enquete_take.php	//出欠アンケートを作成する画面
enquete_take_save.php	//enquete_take.phpで作成した内容をSQL文で登録
enquete.php		//出欠アンケートを一覧で確認する画面
enquete_detail.php	//出欠アンケートの詳細確認と出欠回答する画面
enquete_choice.php	//enquete_detail.phpで回答した結果をSQL文で登録
enquete_result.php	//出欠アンケート結果を確認する画面
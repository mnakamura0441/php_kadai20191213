<?php
// セッションのスタート
session_start();
// var_dump($_POST);
// exit();
include('functions.php');

// / ログイン状態のチェック
// SESSIONチェック＆リジェネレイト
checkSessionId();
// 入力チェック
if (
  !isset($_POST['name']) || $_POST['name'] == '' ||
  !isset($_POST['lid']) || $_POST['lid'] == '' ||
  !isset($_POST['lpw']) || $_POST['lpw'] == '' ||
  !isset($_POST['kanri_flg']) || $_POST['kanri_flg'] == ''
) {
  exit('ParamError');
}

//POSTデータ取得
$name = $_POST['name'];
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];
$kanri_flg = $_POST['kanri_flg'];
//DB接続
$pdo = connectToDb();

//データ登録SQL作成
$sql = 'INSERT INTO user_table (id, name, lid, lpw, kanri_flg)
VALUES(NULL, :a1, :a2, :a3 :a4)';

$stmt = $pdo->prepare($sql);
var_dump($stmt);
exit('ok');
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $lid, PDO::PARAM_STR);
$stmt->bindValue(':a3', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':a4', $kanri_flg, PDO::PARAM_INT);

$status = $stmt->execute();
// var_dump($status);
// exit('ok');

//データ登録処理後
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  //index.phpへリダイレクト
  header('Location: user_entryindex.php');
}
